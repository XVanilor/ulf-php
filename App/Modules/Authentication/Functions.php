<?php

use App\Modules\Authentication\Auth;

if(!function_exists("auth")){

    function auth() {

        $auth = new Auth();
        return $auth;

    }

}

if(!function_exists("auth_namespace")){

    function auth_namespace() {

        return Auth::class;

    }

}