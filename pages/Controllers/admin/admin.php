<?php

use App\Modules\Authentication\Middlewares\AdminMiddleware;
use App\Core\Helper;

if(!AdminMiddleware::handleRequest()) {
    flash()->error("Vous n'avez pas l'autorisation d'accéder à cette page");
    Helper::redirect("/login");
    return;
}