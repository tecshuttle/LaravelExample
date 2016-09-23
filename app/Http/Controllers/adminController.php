<?php namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Session, Validator, DB, Auth;
use App\Http\Requests\ValidateRequest;

class AdminController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function index(Request $request)
    {
        return $request->user();
    }

    function get_session_id()
    {
        $url = 'http://' . $_GET['redirect'] . '/?a=set_cookie&sid=' . Session::getId();
        return redirect($url, 302); //默认为301
    }
}

//end file