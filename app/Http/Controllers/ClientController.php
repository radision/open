<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;

include_once(__DIR__.'/MyController.php');

class ClientController extends MyController
{

    public function index(Request $request)
    {
        $list = DB::table('oauth_clients')->orderBy('id', 'desc')->get();
        return view('client.list')->with('list', $list);
    }

    public function add(Request $request)
    {
        $name = $request->input('name');
        $url = $request->input('url');

        $secret = md5($name.$url.time());

        $max_id = DB::table('oauth_clients')->max('id');
        $insert_id = (int)$max_id + 1;

        DB::table('oauth_clients')->insert(
            ['id' => $insert_id, 'name' => $name, 'secret' => $secret]
        );

        return redirect('/client');
    }

    public function destroy($id)
    {
        DB::table('oauth_clients')->where('id', '=', $id)->delete();
        return response()->json(array('error' => false));
    }

}

