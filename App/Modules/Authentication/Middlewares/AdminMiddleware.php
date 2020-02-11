<?php


namespace App\Modules\Authentication\Middlewares;

use App\Modules\MiddlewareInterface;
use App\Modules\Authentication\Models\User;

class AdminMiddleware implements MiddlewareInterface {

        public static function handleRequest()
        {
            if(AuthMiddleware::handleRequest() === true)
                if($_SESSION['user']->is_admin === 1)
                    return true;
            return false;
        }

}