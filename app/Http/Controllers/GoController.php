<?php

namespace App\Http\Controllers;

use DateTime;


require_once app_path().'/curl/getloc.php';
class GoController extends CouponFunctionController
{
    public function redirect($geturlcode) {
        $linkget = getloc($geturlcode);
        return Redirect::to($linkget);
    }

}