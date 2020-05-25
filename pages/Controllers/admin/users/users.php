<?php

use App\Modules\Authentication\Models\User;
use App\Modules\Authentication\Middlewares\AdminMiddleware;

if(!AdminMiddleware::handleRequest()){
    flash()->error("Vous n'avez pas l'autorisation d'accéder à cette page");
    header("Location: /login");
}

$users = new User();
$users = $users->all();

view('admin/users/users', ["users" => $users]);