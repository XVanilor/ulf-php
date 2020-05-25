<?php

use App\Modules\Authentication\Models\User;
use App\Modules\Validator;
use App\Modules\Authentication\Middlewares\AdminMiddleware;

/**
 *
 * TODO
 * Improve error handling
 *
 */

if (!is_numeric($_GET['id']))
    exit("L'ID est mal formatté");

if(!AdminMiddleware::handleRequest()) {
    flash()->error("Vous n'avez pas l'autorisation d'accéder à cette page", "/login");
    return;
}

$user = new User();
$user = $user->get($_GET['id']);

if(!empty($_POST)){

    $_POST["is_admin"] = (isset($_POST['is_admin']) && $_POST['is_admin'] === "on") ? 1 : 0;

    $validation = [
        "email" => "email",
        "is_admin" => "int"
    ];
    $validator = Validator::validate($validation, $_POST);

    if($validator === true){
        $user->first_name = $_POST['first_name'];
        $user->last_name = $_POST['last_name'];
        $user->gender = $_POST['gender'];
        $user->salary = $_POST['salary'];
        $user->birthdate = $_POST['birthdate'];
        $user->birthplace = $_POST['birthplace'];
        $user->job = $_POST['job'];
        $user->service = $_POST['service'];
        $user->manager = $_POST['manager'];
        $user->email = $_POST['email'];
        $user->is_admin = $_POST['is_admin'];
        $user->update();
    }

    if(!empty($_POST['password']))
        if($_POST['password'] === $_POST['password_confirm'])
        {
            $user->password = $_POST['password'];
            $user->updatePassword();
        }

}

view('admin/users/edit', ["user" => $user]);