<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;

class MyController extends BaseController
{
    public function __construct()
    {
        $this->middleware('admin');
    }

}
