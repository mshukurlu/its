<?php

namespace App\Http\Controllers\Backend;

use App\Repository\UserInterface;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;




class UserController extends Controller
{
    protected  $user;
   public function __construct(UserInterface $user)
   {
       $this->user = $user;
   }

   public function getAll(Request $request)
   {
      return $this->user->getForApi($request);
   }

   public function create(Request $request)
   {
       $request->validate(['name'=>'required','email'=>'required','password'=>'required','phone'=>'required']);
        //technical debt
       $data = $request->only(['name','email','password','phome']);

       $data['password']= bcrypt($data['password']);

       $this->user->create($request->only(['name','email','password','phone']));

       return response()->json(['response'=>'ugurla elave edildi']);
   }

    public function update(Request $request)
    {
        $request->validate(['name'=>'required','email'=>'required','password'=>'required','phone'=>'required']);
        //technical debt
        $user_id= $request->input('id');
        $data = $request->only(['name','email','password','phone']);

        $data['password']= bcrypt($data['password']);
        $this->user->update($user_id,$data);

        return response()->json(['response'=>'ugurla elave edildi']);
    }
}
