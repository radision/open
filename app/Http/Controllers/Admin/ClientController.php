<?php

namespace App\Http\Controllers\Admin;

use DB;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;

class ClientController extends BaseController
{

    public function index(Request $request)
    {
        $list = DB::table('oauth_clients')
            ->join('oauth_client_endpoints', 'oauth_clients.id', '=', 'oauth_client_endpoints.client_id')
            ->select('oauth_clients.*', 'oauth_client_endpoints.redirect_uri')
            ->orderBy('oauth_clients.created_at', 'desc')
            ->get();
        return view('client.list')->with('list', $list);
    }

    public function add(Request $request)
    {
        $name = $request->input('name');
        $url = $request->input('url');

        $client_id = md5(rand(0, 99999).$name.$url);
        $secret = md5($name.$url.time());
        DB::table('oauth_clients')->insert(
            ['id' => $client_id, 'name' => $name, 'secret' => $secret, 'created_at' => DB::raw('now()')]
        );

        DB::table('oauth_client_endpoints')->insert(
            ['client_id' => $client_id, 'redirect_uri' => $url, 'created_at' => DB::raw('now()')]
        );

        return redirect('/admin/client');
    }

    public function destroy($id)
    {
        DB::table('oauth_clients')->where('id', '=', $id)->delete();
        return response()->json(array('error' => false));
    }

}

