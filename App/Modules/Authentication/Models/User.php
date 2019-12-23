<?php

namespace App\Modules\Authentication\Models;

use App\Modules\Authentication\Auth;
use App\Modules\Database;
use App\Modules\ModelInterface;

/**
 *
 * Class User
 * @package App\Modules\Authentication\Models
 *
 */

class User extends Auth implements ModelInterface {

    /**
     *
     * User vars
     *
     */
    public $first_name;
    public $last_name;
    public  $email;
    public $password;

    /**
     *
     * User constructor.
     * Defines by default plainPassword & cipherPassword empty
     *
     */
    public function __construct()
    {
        $this->plainPassword = "";
        $this->cipherPassword = "";
    }

    public function create()
    {

        global $config;
        $db = new Database();

        /**
         * Hash password using configured hashing algorithm.
         * PLEASE USE A STRONG ONE LIKE ARGON2ID OR SHA2/3-256/512
         */
        $this->password = password_hash(
            $this->password,
            $config['auth']['password_hashing']['algo']
        );

        $db->request("INSERT INTO ".$this->table ." (first_name, last_name, email, password) VALUES(?,?,?,?)",
            [
                $this->first_name,
                $this->last_name,
                $this->email,
                $this->password
            ]);

    }

    public function update()
    {
        // TODO: Implement update() method.
    }

    public static function get(int $id)
    {
        // TODO: Implement get() method.
    }

    public static function delete(int $id)
    {
        // TODO: Implement delete() method.
    }

}