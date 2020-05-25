<?php

use App\Core\Helper;
use App\Modules\Authentication\Middlewares\AuthMiddleware;
use App\Modules\Authentication\Auth;

if(!AuthMiddleware::handleRequest()){
    Helper::redirect("/login");
    return;
}

var_dump(Auth::user());
die();

view("dashboard", ["user" => Auth::user()]);