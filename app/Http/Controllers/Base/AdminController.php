<?php

namespace App\Http\Controllers\Base;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;

class AdminBaseController extends BaseController
{
    public function __construct()
    {
        $this->middleware('admin');
    }

}
