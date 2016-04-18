<?php

namespace App\Http\Controllers\Admin;

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
            $admin_info = unserialize($admin);
            if ($admin_info->id)
            {
                return redirect('/admin/dashboard');
            }
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $name = $request->input('name');
        $passwd = $request->input('passwd');

        $admin = DB::table('admin')->where('name', $name)->where('passwd', md5($passwd))->first();
        if (! $admin)
        {
            $msg = array('error' => '错误的用户名或密码');
            return view('admin.login', $msg);
        }
        $request->session()->set('oauth_administrator', serialize($admin));
        return redirect('/admin/dashboard');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('oauth_administrator');
        $request->session()->flush();
    }


    public function dashboard(Request $request)
    {
        return view('admin.dashboard');
    }

}
