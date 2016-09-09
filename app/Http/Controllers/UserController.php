<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;

class UserController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function UserInfo($id = 0)
    {
        echo method_field('PUT');
        return "userId = $id " . route('userInfo', ['id' => $id]);
    }

    function UserModel($user)
    {
        dd($user);
        return $user;
    }
}
