<?php

namespace App\Http\Controllers\Member;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;

class MemberController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function detail($account, $id = 0)
    {
        /**
         * csrf_field()会生成如下HTML。
         * <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
         */
        return "$account $id csrf = " . csrf_field();
    }
}
