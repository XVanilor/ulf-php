<?php

return [

    "auth" => [

        "authorized_login_columns" => [
            "email"
        ],

        "password_column" => "password",

        "password_hashing" => [
            "algo" => PASSWORD_ARGON2ID
        ]
    ]
];