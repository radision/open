<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;

class UserController extends BaseController
{

    public function profile(Request $request)
    {
        $user = $request->session()->get('oauth_user');
        $user_info = unserialize($user);
        return view('user.profile')->with('user_info', $user_info);
    }

}

