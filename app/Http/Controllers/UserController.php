<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;

include_once(__DIR__.'/MyController.php');

class UsertController extends MyController
{

    public function index(Request $request)
    {
        $list = DB::table('user')
            ->orderBy('user.created_at', 'desc')
            ->get();
        return view('user.list')->with('list', $list);
    }

    public function add(Request $request)
    {
        $name = $request->input('name');
        $password = $request->input('password');

        $password = md5($password);
        DB::table('user')->insert(
            ['name' => $name, 'password' => $password, 'created_at' => DB::raw('now()')]
        );

        return redirect('/admin/user');
    }

    public function profile()
    {

    }

}

