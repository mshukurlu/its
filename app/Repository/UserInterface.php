<?php
namespace App\Repository;
/**
 * Created by PhpStorm.
 * User: Murad
 * Date: 6/3/2019
 * Time: 6:47 PM
 */

interface UserInterface
{
    public function getById($user_id);
    public function getAll();
    public function updateUser($user_id,$data);
    public function deleteUser($user_id);
}