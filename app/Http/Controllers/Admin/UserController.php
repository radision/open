<?php

namespace App\Http\Controllers\Admin;

use DB;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;

class UserController extends BaseController
{

    public function index(Request $request)
    {
        $list = DB::table('users')
            ->orderBy('users.created_at', 'desc')
            ->get();
        return view('user.list')->with('list', $list);
    }

    public function add(Request $request)
    {
        $mobile = $request->input('mobile');
        $password = $request->input('password');

        $password = md5($password);
        DB::table('users')->insert(
            ['mobile' => $mobile, 'password' => $password, 'created_at' => DB::raw('now()')]
        );

        return redirect('/admin/user');
    }

}
