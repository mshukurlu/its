<?php
namespace App\Repository;
use App\User;

/**
 * Created by PhpStorm.
 * User: Murad
 * Date: 6/3/2019
 * Time: 6:47 PM
 */

class UserRepository implements UserInterface
{
    protected  $userModel;

    public function __construct(User $user)
    {
        $this->userModel = $user;
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

    public function getForApi($request)
    {
        $start = intval($request->input('start'));
        $length = intval($request->input('length'));
        $draw = intval($request->input('draw'));

        if(!empty($request->input('search.value')))
        {
            $data = User::where('name','LIKE','%'.$request->input('search.value').'%')->skip($start)->take($length)->get();
            $recordsTotal = User::where('name','LIKE','%'.$request->input('search.value').'%')->count();
            //   $recordsFiltered = $recordsTotal - $data->count();

            // $data = $users->skip($start)->take($length)->get();
            //  $recordsTotal = $users->count();

        }
        else
        {
            $data = User::skip($start)->take($length)->get();
            //  $data = $users->skip($start)->take($length)->get();
            $recordsTotal = User::count();
            //$recordsFiltered = User::count());
        }
        // $recordsFiltered = User::count()-$data->count();

        return array(
            "data"=>$data,
            "draw"=>$draw,
            "length"=>$length,
            "recordsTotal"=>$recordsTotal,
            "recordsFiltered"=>$recordsTotal
        );
    }

    public function updateUser($user_id, $data)
    {
        // TODO: Implement updateUser() method.
    }
}