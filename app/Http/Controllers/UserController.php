<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Session, Validator, DB;
use App\Http\Requests\ValidateRequest;


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

    function input()
    {
        return view('input');
    }

    function store1(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:5',
            'old' => 'required',
        ], [
            'name.required' => '请填写姓名1',
            'name.max' => '姓名不能超过:max个字符1',
            'old.required' => '我们需要知道你的年龄1',
        ]);

        if ($validator->fails()) {
            return redirect('/input')
                ->withErrors($validator)
                ->withInput();
        }

        return 'validation is OK!';
    }

    function store2(Request $request)
    {
        $request->flash();

        $this->validate($request, [
            'name' => 'required|max:5',
            'old' => 'required',
        ], [
            'name.required' => '请填写姓名',
            'name.max' => '姓名不能超过:max个字符',
            'old.required' => '我们需要知道你的年龄',
        ]);

        return 'validation is OK!';
    }

    function store3(ValidateRequest $request)
    {
        return 'validation is OK!';
    }

    function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:5',
            'old' => 'required',
        ], [
            'name.required' => '请填写姓名',
            'name.max' => '姓名不能超过:max个字符',
            'old.required' => '我们需要知道你的年龄',
            'reason.required' => '你为何如此长寿？'
        ]);

        $validator->sometimes(['reason'], 'required', function ($input) {
            return $input->old >= 100;
        });

        if ($validator->fails()) {
            return redirect('/input')
                ->withErrors($validator)
                ->withInput();
        }

        return 'validation is OK!';
    }

    function paging(Request $request)
    {
        $users = DB::table('users')->paginate(3);
        return view('paging', ['users' => $users]);
    }
}

//end file