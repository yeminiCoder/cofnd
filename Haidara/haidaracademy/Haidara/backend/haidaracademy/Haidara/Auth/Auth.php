<?php
namespace Haidara\Auth;
use Haidara\Models\User;

/**
 * Created by PhpStorm.
 * User: haida
 * Date: 08/07/2018
 * Time: 15:24
 */

class Auth{
    public function user()
    {
      return User::findbyId(isset($_SESSION['user'])?$_SESSION['user']:null);
    }

    public function check()
    {
        return isset($_SESSION['user']);
    }

    public function atempt($email, $password)
    {
        var_dump($email);die;
       return  User::find($email,$password);
    }

}