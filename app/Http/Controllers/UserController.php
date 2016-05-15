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
        $user_tags_list = array();
        if ($user_tags)
        {
            foreach ($user_tags as $tag)
            {
                $user_tags_list[] = $tag->tag;
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

        $name = $request->input('name');
        $email = $request->input('email');
        $gender = $request->input('gender');
        $city = $request->input('city');

        $user_table_info = array();
        $name && $user_table_info['name'] = $name;
        $email && $user_table_info['email'] = $email;
        if ($user_table_info)
        {
            $user_table_info['updated_at'] = DB::raw('now()');
            DB::table('users')->where('id', '=', $id)->update($user_table_info);
            $user_info = current(DB::table('users')->where('id', '=', $id)->get());
            $request->session()->set('oauth_user', serialize($user_info));
        }

        $user_attribute_info = array();
        $gender && $user_attribute_info['gender'] = $gender;
        $city && $user_attribute_info['city'] = $city;
        $user_attribute = DB::table('user_attributes')->where('id', '=', $id)->get();
        if ($user_attribute && $user_attribute_info)
        {
            DB::table('user_attributes')->where('id', '=', $id)->update($user_attribute_info);
        }
        elseif (!$user_attribute && $user_attribute_info)
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

