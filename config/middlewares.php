<?php

return [

    "middlewares" => [

        "admin" => \App\Modules\Authentication\Middlewares\AdminMiddleware::class,
        "auth" => \App\Modules\Authentication\Middlewares\AuthMiddleware::class

    ]

];