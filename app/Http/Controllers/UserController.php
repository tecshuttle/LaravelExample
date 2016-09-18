<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Session;


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

    function blade()
    {
        return view('blade', ['html' => '<b>Big</b>', 'users' => ['Tom', 'Jack', 'Rebeca', 'Charlotte'], 'time' => time()]);
    }

    function session(Request $request)
    {
        var_dump($request->session()->get('name'));
        var_dump(session('old'));

        session(['name' => 'Tom']);
        session(['old' => 235]);

        $request->session()->put('name', 'Tom');
        $request->session()->push('students', 'Tom');
    }
}
