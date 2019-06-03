<?php

namespace App\Http\Controllers\Backend;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\UserRepository;



class UserController extends Controller
{
    protected  $user;
   public function __construct(UserRepository $user)
   {
       $this->user = $user;
   }

   public function getAll(Request $request)
   {
       $start = intval($request->input('start'));
       $length = intval($request->input('length'));
       $draw = intval($request->input('draw'));

       if(!empty($request->input('search.value')))
       {
           $data = User::where('name','LIKE','%'.$request->input('search.value').'%')->skip($start)->take($length)->get();
           $recordsTotal = User::where('name','LIKE','%'.$request->input('search.value').'%')->count();
           $recordsFiltered = $recordsTotal - $data->count();

           // $data = $users->skip($start)->take($length)->get();
           //  $recordsTotal = $users->count();

       }
       else
       {
           $data = User::skip($start)->take($length)->get();
           //  $data = $users->skip($start)->take($length)->get();

           $recordsFiltered = User::count() - $data->count();
       }
       // $recordsFiltered = User::count()-$data->count();

       return array(
           "data"=>$data,
           "draw"=>$draw,
           "length"=>$length,
           "recordsTotal"=>$recordsFiltered,
           "recordsFiltered"=>$recordsFiltered
       );
   }

   public function create(Request $request)
   {
       $request->validate(['name'=>'required','email'=>'required','password'=>'required','phone'=>'required']);

       $data = $request->only(['name','email','password','phome']);

       $data['password']= bcrypt($data['password']);
       $this->user->create($data);

       return response()->json(['response'=>'ugurla elave edildi']);
   }

    public function update(Request $request)
    {
        $request->validate(['name'=>'required','email'=>'required','password'=>'required','phone'=>'required']);
        $user_id= $request->input('id');
        $data = $request->only(['name','email','password','phome']);

        $data['password']= bcrypt($data['password']);
        $this->user->update($user_id,$data);

        return response()->json(['response'=>'ugurla elave edildi']);
    }
}
