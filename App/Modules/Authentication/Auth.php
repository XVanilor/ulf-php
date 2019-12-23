<?php

namespace App\Modules\Authentication;

use App\Modules\Authentication\Models\User;
use App\Modules\Database;

/**
 *
 * Class Auth
 * @package App\Modules\Authentication
 *
 */

class Auth {

    /**
     * Authentication DB table
     *
     */
    protected $table = "users";

    /**
     * Log a user and create session instance
     *
     *
     * Developer MUST provides only credential tokens into $credentials
     * $credentials must contains :
     *      - Login field plaintext value provided identified by "login" array key
     *      - A password or any unique and secret authentication token identified by "password" array key
     *
     * @param array $credentials
     *
     * @return User|boolean depending if authentication attempt succeed or not
     **/
    public function login(array $credentials){

        if(($id = $this->loginAttempt($credentials)) !== false)
            return User::get($id);

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
        $passwordColumn = $config['auth']['password_column'];

        $sql = "SELECT id, ".$passwordColumn." FROM ".$this->table." WHERE ";
        foreach($config['auth']['authorized_login_columns'] as $key => $field) {
            $sql .= $field . " = ? ";
            if($key !== array_key_last($config['auth']['authorized_login_columns']))
                $sql .= " OR ";
        }

        $sql .= "LIMIT 1"; //Only get the first row that login match
        $user = $db->findOne($sql, [$credentials["login"]]);

        if($user instanceof \stdClass)
            if(password_verify($credentials["password"], $user->$passwordColumn))
                return $user->id;

        return false;
    }

}