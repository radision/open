<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;

include_once(__DIR__.'/MyController.php');

class AdminController extends MyController
{

    public function index(Request $request)
    {
        return view('admin.dashboard');
    }

}

