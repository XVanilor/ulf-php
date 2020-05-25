<?php

if (!is_numeric($_GET['id']))
    exit("L'ID est mal formatté");

use App\Modules\Authentication\Models\User;
use App\Modules\Authentication\Middlewares\AdminMiddleware;

if(!AdminMiddleware::handleRequest()) {
    flash()->error("Vous n'avez pas l'autorisation d'accéder à cette page", "/login");
    return;
}

$user = new User();
$user->get($_GET['id'])->delete();
flash()->success("L'utilisateur a bien été supprimé !", "/admin/utilisateurs");