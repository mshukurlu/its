<?php
namespace App\Repository;
use App\User;
use function foo\func;
use Illuminate\Http\Request;

/**
 * Created by PhpStorm.
 * User: Murad
 * Date: 6/3/2019
 * Time: 6:47 PM
 */

class UserRepository implements UserInterface
{
    protected  $userModel,$request,$start,$length,$draw,$ordering,$orderBy,$dir,$columns=[];
    protected  $_result;

    public function __construct(User $user,Request $request)
    {
        $this->userModel = $user;
        $this->request = $request;
        $this->columns = array(
            0=>'id',
            1=>'name',
            2=>'email',
            3=>'phone'
        );
        $this->start = intval($request->input('start'));
        $this->length = intval($request->input('length'));
        $this->draw = intval($request->input('draw'));
        $this->ordering = intval($request->input('order[0][column]'));
        $this->orderBy = $this->columns[$this->ordering];
        $this->dir = $request->input('order')[0]['dir'];

    }

    public function getById($user_id)
    {
       return $this->userModel->find($user_id);
    }

    public function getAll()
    {
        return $this->userModel->all();
    }

    public function update($user_id, $data)
    {
        return $this->userModel->find($user_id)->update($data);
    }

    public function deleteUser($user_id)
    {
       return $this->userModel->destroy($user_id);
    }

    public function create($data)
    {
        return $this->userModel->create($data);
    }

    public function getForApi()
    {
         if($this->search($this->request))
         {
             return $this->_result;
         }

         return $this->getAllResults();
    }

    protected function search()
    {
        if($this->request->input('search')) {
            $data = User::
                 where('name', 'LIKE', '%' . $this->request->input('search.value') . '%')
                ->orWhere('email', 'LIKE', '%' . $this->request->input('search.value') . '%')
                ->orWhere('phone', 'LIKE', '%' . $this->request->input('search.value') . '%')
                ->skip($this->start)
                ->take($this->length)
                ->orderBy($this->orderBy, $this->dir)
                ->get();
            $recordsTotal = User::where('name', 'LIKE', '%' . $this->request->input('search.value') . '%')->count();

            $this->_result =  $this->responseArray($data,$this->draw,$this->length,$recordsTotal,$recordsTotal);

            return true;
        }

        return false;
    }

     protected function getAllResults()
     {
         $data = User::skip($this->start)->take($this->length)->orderBy($this->orderBy,$this->dir)->get();

         $recordsTotal = User::count();

         return $this->responseArray($data,$this->draw,$this->length,$recordsTotal,$recordsTotal);
     }

    protected function responseArray($data,$draw,$length,$recordsTotal,$recordsFiltered)
    {
     return  response()->json( array(
            "data"=>$data,
            "draw"=>$this->draw,
            "length"=>$this->length,
            "recordsTotal"=>$recordsTotal,
            "recordsFiltered"=>$recordsFiltered
        ));
    }
}