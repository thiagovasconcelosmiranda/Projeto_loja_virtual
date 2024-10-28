<?php

namespace App\Helper;
use App\Models\User;

class helper {
    public static function auth(){
        $array = [];
        if (!empty(auth()->user())) {
          $auth = auth()->user()->name;
          $array['user'] = $auth;
          $array['name'] = str_split($auth)[0];
          $array['id'] = auth()->user()->id;
          $array['email'] = auth()->user()->email;
          $array['_token'] = auth()->user()->remember_token;
        }
        return $array;
    }
}