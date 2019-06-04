<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
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

   public function getAll()
   {
      return $this->user->getForApi();
   }

   public function create(Request $request,UserCreateRequest $validate)
   {
        //technical debt
       $data = $request->only(['name','email','password','phome']);

       $data['password']= bcrypt($data['password']);

       $this->user->create($request->only(['name','email','password','phone']));

       return response()->json(['response'=>'ugurla elave edildi']);
   }

    public function update(Request $request,UserUpdateRequest $request2)
    {
        //technical debt
        $user_id = $request->input('id');
        $data = $request->only(['name','email','password','phone']);

        if($request->has('password')) {
            $data['password'] = bcrypt($data['password']);
        }

        $this->user->update($user_id,$data);

        return response()->json(['response'=>'ugurla yeniləndi']);
    }

    public function delete($id)
    {
        $this->user->deleteUser($id);

        return response()->json(['response'=>'Ugurla silindi']);
    }
}
