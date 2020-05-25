<?php

use App\Modules\Authentication\Models\User;
use App\Modules\Authentication\Middlewares\AdminMiddleware;

if(!AdminMiddleware::handleRequest()) {
    flash()->error("Vous n'avez pas l'autorisation d'accéder à cette page", "/login");
    return;
}

if(!empty($_POST)){

    if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password_confirm'])){

        if($_POST['password'] != $_POST['password_confirm']) {
            flash()->error("Vos mots de passe sont différents");
            return;
        }

        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            flash()->error("Votre email n'est pas valide");
            return;
        }

        $user = new User();
        $user->first_name = $_POST['first_name'];
        $user->last_name = $_POST['last_name'];
        $user->email = $_POST['email'];
        $user->password = $_POST['password'];
        $user->create();

        flash()->success("Vous êtes désormais inscrit ! Vous pouvez maintenant <a href=\"/login\">vous connecter</a>");

    }
    else
        flash()->error("Veuillez remplir tous les champs");

}

view("admin/users/create");