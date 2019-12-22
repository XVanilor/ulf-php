<?php

namespace App\Modules\Authentication\Models;

use App\Modules\Authentication\Auth;
use App\Modules\Database;
use App\Modules\ModelInterface;

class User extends Auth implements ModelInterface {

    /**
     * DB-related vars
     *
     */
    private $table;

    /**
     * User-related vars
     * Var names are similar to column names
     *
     */
    public $first_name;
    public $last_name;
    public $email;
    public $plainPassword;
    private $cipherPassword;

    /**
     * User constructor.
     *
     */
    public function __construct()
    {
        $this->table = "users";
        $this->plainPassword = NULL;
        $this->cipherPassword = NULL;
    }

    public function create()
    {

        global $config;
        $db = new Database();

        $this->cipherPassword = password_hash(
            $this->plainPassword,
            $config['auth']['password_hashing']['algo']
        );
        $this->plainPassword = NULL;

        $db->request("INSERT INTO ".$this->table ." (first_name, last_name, email, password) VALUES(?,?,?,?)",
            [
                $this->first_name,
                $this->last_name,
                $this->email,
                $this->cipherPassword
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