<?php


namespace App\Modules;


interface MiddlewareInterface
{

    /**
     * Check if request validate a condition
     *
     * @return boolean
     *
     */
    public static function handleRequest();

}