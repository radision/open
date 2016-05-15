<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;

class UserController extends BaseController
{

    public function profile(Request $request)
    {
        $user = $request->session()->get('oauth_user');
        $user_info = unserialize($user);
        $id = $user_info->id;
        $user_attribute = DB::table('user_attributes')->where('id', '=', $id)->get();
        if ($user_attribute)
        {
            $user_attribute = current($user_attribute);
        }
        $user_tags = DB::table('user_tags')->where('id', '=', $id)->get();
        print_r($user_tags);exit();
        $user_tags_list = array();
        if ($user_tags)
        {
            $user_tags = current($user_tags);
            foreach ($user_tags as $tag)
            {
                $user_tags_list[] = $tag;
            }
        }
        return view('user.profile')
            ->with('user_info', $user_info)
            ->with('user_attribute', $user_attribute)
            ->with('user_tags', implode(',', $user_tags_list));
    }

    public function attribute(Request $request)
    {
        $user = $request->session()->get('oauth_user');
        $user_info = unserialize($user);
        $id = $user_info->id;

        $user_table_info = array();
        $name = $request->input('name');
        $name && $user_table_info['name'] = $name;
        $email = $request->input('email');
        $email && $user_table_info['email'] = $email;
        $user_table_info && $user_table_info['updated_at'] = DB::raw('now()');
        $user_table_info && DB::table('users')->where('id', '=', $id)->update($user_table_info);

        $user_attribute_info = array();
        $gender = $request->input('gender');
        $gender && $user_attribute_info['gender'] = $gender;
        $city = $request->input('city');
        $city && $user_attribute_info['city'] = $city;
        $user_attribute = DB::table('user_attributes')->where('id', '=', $id)->get();
        if ($user_attribute && $user_attribute_info)
        {
            DB::table('user_attributes')->where('id', '=', $id)->update($user_attribute_info);
        }
        if (!$user_attribute && $user_attribute_info)
        {
            $user_attribute_info['id'] = $id;
            DB::table('user_attributes')->insert($user_attribute_info);
        }

        $tags = $request->input('tags');
        if ($tags)
        {
            $tag_list = explode(',', $tags);
            DB::table('user_tags')->where('id', '=', $id)->delete();
            foreach ($tag_list as $tag)
            {
                if (trim($tag))
                {
                    $tag_info = array(
                        'id'    => $id,
                        'tag'   => $tag,
                        'created_at' => DB::raw('now()')
                    );
                    DB::table('user_tags')->insert($tag_info);
                }
            }
        }
        return redirect('/profile');
    }

}

