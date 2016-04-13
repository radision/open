<?php

namespace App\Http\Controllers\Base;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;

class UserBaseController extends BaseController
{
    public function __construct()
    {
        $this->middleware('user');
    }

}
