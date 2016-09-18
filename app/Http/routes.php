<?php
// 简单路由
Route::get('/', function () {
    return view('welcome');
});

Route::get('/blade', 'UserController@blade');
Route::get('/session', 'UserController@session');
Route::get('/paging', 'UserController@paging');
Route::match(['get', 'post'], '/input', 'UserController@input');
Route::match(['get', 'post'], '/store', 'UserController@store');

//为多重动作注册路由
Route::match(['get', 'post'], '/get-post', function () {
    return 'get and post';
});

Route::any('foo', function () {
    return 'any foo ' . url('foo') . ' ' . url('router');
});

//路由参数
Route::get('posts/{pid}/comments/{comment?}', function ($pId, $commentId = 'empty') {
    return "postId = $pId, comments = $commentId";
});

//正则表达式限制参数。也可为参数设定全局规则pattern filter。
Route::get('user/{id}/{name?}', function ($id, $name = 'empty') {
    return "userId = $id, name = $name";
})->where(['id' => '[0-9]?', 'name' => '[a-z]+']);

//命名路由
Route::get('user/list', ['as' => 'userList', function () {
    return 'name router: ' . route('userList');
}]);

Route::get('user/info/{id?}', 'UserController@UserInfo')->name('userInfo');

//路由群组：中间件、命名空间、子域名、前缀
Route::group([
    /*'middleware' => 'auth',*/
    'namespace' => 'Member',
    'domain' => '{account}.tomtalk.net',
    'prefix' => 'member'], function () {
    Route::get('{id?}', 'MemberController@detail');
});

//CSRF保护：试了一下，还是不知道怎么用。

//路由模型绑定
Route::get('user/model/{user}', 'UserController@UserModel')->name('userModel');

//请求方法伪造 - echo method_field('PUT')

//抛出404错误 - abort(404)
