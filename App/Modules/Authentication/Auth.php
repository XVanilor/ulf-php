<?php

namespace App\Modules\Authentication;

use App\Modules\Authentication\Models\User;
use App\Modules\Database;

/**
* TODO
* Improve password hashing and verification algorithm
**/

class Auth {
    /**
     * Log a user and create session instance
     *
     *
     * Developer MUST provides only credential tokens into $credentials
     * $credentials must contains :
     *      - All authorized login fields plaintext values provided in $config['auth']['auth_fields']
     *      - A password or any unique and secret authentication token
     *
     * @param array $credentials
     *
     * @return User|boolean depending on authentication attempt succeed or not
     **/
    protected function login(array $credentials){

        if(($id = $this->loginAttempt($credentials)) !== false) {
            return User::get($id);
        }
        return false;

    }

    /**
     * Attempt to login using provided credentials
     *
     * @param array $credentials
     *
     * @return boolean|int
     */
    private function loginAttempt(array $credentials){

        global $config;
        $db = new Database();

        $sql = "SELECT id, password WHERE ";
        foreach($config['auth']['authorized_login_columns'] as $key => $field) {
            $sql .= $field . " = ?";
            if($key !== array_key_last($config['auth']['login_fields']))
                $sql .= " OR ";
        }

        $sql .= "LIMIT 1"; //Only get the first row that login match
        $user = $db->request($sql, $credentials);

        /**
         * @todo
         *
         * Check $user return values
         *
         */
        if(!empty($user))
            if(password_verify($credentials['password'], $user[$config['auth']['password_field']]))
                return $user['id'];

        return false;
    }

}