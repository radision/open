<?php

namespace App;

use Illuminate\Support\Facades\Auth;

class Verifier
{

    public function verify($mobile, $password)
    {
        $credentials = [
            'mobile'   => $mobile,
            'password' => $password,
        ];

        if (Auth::once($credentials)) {
            return Auth::user()->id;
        }

        return false;
    }

}

