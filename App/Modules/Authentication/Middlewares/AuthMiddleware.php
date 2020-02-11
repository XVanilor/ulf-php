<?php


namespace App\Modules\Authentication\Middlewares;

use App\Modules\MiddlewareInterface;

class AuthMiddleware implements MiddlewareInterface
{

    /**
     * Is user authenticated ?
     *
     * @return bool
     *
     */
    public static function handleRequest()
    {
        if(isset($_SESSION['user']) && $_SESSION['user'] !== NULL)
            return true;
        return false;
    }

}