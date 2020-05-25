<?php

use App\Core\Helper;
use App\Modules\Authentication\Models\User;
use App\Modules\Authentication\Middlewares\AuthMiddleware;

if(AuthMiddleware::handleRequest()){
    header('Location: /admin');
    return;
}

if(!empty($_POST)){

    if(isset($_POST['email']) && isset($_POST['password'])) {

        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

            $user = new User();
            $credentials = [
                "login" => $_POST['email'],
                "password" => $_POST['password']
            ];

            if($user->login($credentials) !== false) {

                flash()->success("Vous êtes maintenant authentifié !");
                Helper::redirect("/admin");
                return;
            }

            else
                flash()->error("Email ou mot de passe incorrect");
        }
        else
            flash()->error("Format d'email invalide, merci de recommencer");
    }
    else
        flash()->error("Veuillez utiliser un email et un mot de passe pour vous connecter");
}

view("login", ['routes' => $routes]);