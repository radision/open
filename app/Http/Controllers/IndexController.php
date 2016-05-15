<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;

class IndexController extends BaseController
{

    public function login(Request $request)
    {
        return view('user.login');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('oauth_user');
        $request->session()->flush();
        return redirect('/login');
    }

    public function verify(Request $request)
    {
        $mobile = $request->input('mobile');
        $password = $request->input('password');
        $password = md5($password);

        $user = DB::table('users')
            ->where('mobile', '=', $mobile)
            ->where('password', '=', $password)
            ->first();
        if ($user)
        {
            $request->session()->set('oauth_user', serialize($user));
            return redirect('/profile');
        }
        return view('user.login')->with('error', '错误的手机号或密码');
    }


}
