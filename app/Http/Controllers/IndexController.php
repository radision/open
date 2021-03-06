<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;

class IndexController extends BaseController
{

    public function index(Request $request)
    {
        $admin = $request->session()->get('oauth_administrator');
        if ($admin)
        {
            return redirect('/admin/dashboard');
        }
        return view('user.login');
    }

    public function login(Request $request)
    {
        $name = $request->input('name');
        $passwd = $request->input('passwd');

        $admin = DB::table('admin')->where('name', $name)->where('passwd', md5($passwd))->first();
        if (! $admin)
        {
            $msg = array('error' => '错误的用户名或密码');
            return view('user.login', $msg);
        }
        $request->session()->set('oauth_administrator', serialize($admin));
        return redirect('/admin/dashboard');
    }

}
