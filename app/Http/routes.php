<?php
// 简单路由
Route::get('/', function () {
    return view('welcome');
});

Route::get('/blade', 'UserController@blade');
Route::get('/session', 'UserController@session');
Route::get('/get_session_id', 'adminController@get_session_id');
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

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
});

Route::get('/admin', ['middleware' => ['auth'], 'uses' => 'AdminController@index']);
Route::post('/postRegister', ['uses' => 'Auth\AuthController@postRegister']);

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
});

//Oauth2
Route::get('oauth/client_form', 'Oauth2ClientController@form');
Route::get('oauth/client_access_token', 'Oauth2ClientController@access_token');


Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});

Route::get('oauth/authorize', ['as' => 'oauth.authorize.get', 'middleware' => ['check-authorization-params', 'auth'], function() {
    echo '123';
    $authParams = Authorizer::getAuthCodeRequestParams();

    $formParams = array_except($authParams,'client');

    $formParams['client_id'] = $authParams['client']->getId();

    $formParams['scope'] = implode(config('oauth2.scope_delimiter'), array_map(function ($scope) {
        return $scope->getId();
    }, $authParams['scopes']));

    return View::make('oauth.authorization-form', ['params' => $formParams, 'client' => $authParams['client']]);
}]);

Route::post('oauth/authorize', ['as' => 'oauth.authorize.post', 'middleware' => ['csrf', 'check-authorization-params', 'auth'], function() {

    echo 'abc';
    $params = Authorizer::getAuthCodeRequestParams();
    $params['user_id'] = Auth::user()->id;
    $redirectUri = '/';

    // If the user has allowed the client to access its data, redirect back to the client with an auth code.
    if (Request::has('approve')) {
        $redirectUri = Authorizer::issueAuthCode('user', $params['user_id'], $params);
    }

    // If the user has denied the client to access its data, redirect back to the client with an error message.
    if (Request::has('deny')) {
        $redirectUri = Authorizer::authCodeRequestDeniedRedirectUri();
    }

    return Redirect::to($redirectUri);
}]);

//end file
