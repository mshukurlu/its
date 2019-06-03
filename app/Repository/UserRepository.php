<?php
namespace App\Repository;
use App\User;

/**
 * Created by PhpStorm.
 * User: Murad
 * Date: 6/3/2019
 * Time: 6:47 PM
 */

class UserRepository
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
}