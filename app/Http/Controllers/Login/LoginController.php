<?php

namespace App\Http\Controllers\Login;

use App\Model\Common\Admin;
use App\Model\Common\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class LoginController extends Controller
{

    public function doLogin(Request $request)
    {
        $data = Input::get();
        $username =  $data['username'];
        $password =  $data['password'];
        $result = objectToArray( DB::table("user")->where("username",$username)->where("password",$password)->get());

        if ($result == null){
            return 0;
        }
        session(["username" => $username]);
        session(["count" => $result[0]['count']]);
        return 1;
    }

    public function adminLogin()
    {
        $data = Input::get();
        $username =  $data['username'];
        $password =  $data['password'];
        $result = objectToArray( DB::table("admin")->where("admin",$username)->where("password",$password)->get());
        if ($result == null){
            return 0;
        }
        session(["admin" => $username]);
        return 1;
    }
    public function logout()
    {
        Session()->flush();
        return 1;

    }
}
