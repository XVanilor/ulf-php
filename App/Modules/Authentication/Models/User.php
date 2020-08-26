<?php

namespace App\Modules\Authentication\Models;

use App\Core\Helper;
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
     * User properties
     * @var string
     */
    public $id;
    public $first_name;
    public $last_name;
    public $email;
    public $password;
    public $is_admin;

    /**
     *
     * DB-related vars
     *
     */

    private $primaryKey = "id";
    /**
     *
     * Column names in DB
     * @var array
     *
     */
    private $columns = [
        "id", "first_name", "last_name", "email", "password", "is_admin"
    ];

    /**
     *
     * Columns that are not retrieved when get() or all() method is called
     * @var array
     *
     */
    private $hidden = [
        "password"
    ];
    /**
     *
     * Selectable vars by DB using get() or all()
     * @var array
     *
     */
    private $requestables;

    /**
     *
     * Updatable vars using update()
     * @var array
     *
     */
    private $updatables;

    /**
     *
     * User constructor.
     * Defines by default password empty in order to avoid password issues
     *
     */
    public function __construct()
    {
        $this->password = "";
        $this->requestables = array_diff($this->columns, $this->hidden);
        $this->updatables = array_diff($this->requestables, [$this->primaryKey]);
    }

    /**
     *
     * Create a new user in DB
     *
     * @return void
     *
     */
    public function create()
    {
        $db = new Database();
        $db->request("INSERT INTO ".$this->table." (".implode(", ", array_diff($this->columns, [$this->primaryKey])).") VALUES(?,?,?,?,?)",
            [
                $this->first_name,
                $this->last_name,
                $this->gender,
                $this->salary,
                $this->birthdate,
                $this->birthplace,
                $this->job,
                $this->service,
                $this->manager,
                $this->email,
                $this->hashedPassword(),
                0
            ]);

        $db = NULL;
        return;
    }

    /**
     *
     * Update User vars in DB except password, which must be updated separately
     *
     * @return void
     *
     */
    public function update()
    {
        $db = new Database();

        $sql = "UPDATE ".$this->table." SET ";
        foreach($this->updatables as $key => $updatable) {
            $sql .= $updatable . " = ?";
            if($key !== array_key_last($this->updatables))
                $sql .= ",";
            $sql .= " ";
        }

        $sql .= "WHERE ".$this->primaryKey." = ?";
        $db->request($sql,
            [
                $this->first_name,
                $this->last_name,
                $this->gender,
                $this->salary,
                $this->birthdate,
                $this->birthplace,
                $this->job,
                $this->service,
                $this->manager,
                $this->email,
                $this->is_admin,
                $this->id
            ]
        );

        $db = NULL;
        return;
    }

    /**
     *
     * Update password in a separated method as it's considered as sensitive data
     *
     * @return void
     *
     **/
    public function updatePassword()
    {
        global $config;
        $db = new Database();

        $db->request("UPDATE ".$this->table." SET ".$config['auth']['password_column']." = ? WHERE ".$this->primaryKey." = ?",
            [
                $this->hashedPassword(),
                $this->id
            ]);

        $db = NULL;
        return;
    }

    /**
     *
     * Retrieve a single user from DB using it's ID
     *
     * @param int $id
     *
     * @return User
     *
     */
    public function get(int $id)
    {
        $db = new Database();
        $sql = "SELECT ".implode(", ", $this->requestables)." FROM ".$this->table." WHERE ".$this->primaryKey." = ?";

        $datas = $db->findOne($sql, [$id]);

        $this->first_name = $datas->first_name;
        $this->last_name = $datas->last_name;
        $this->email = $datas->email;
        $this->is_admin = $datas->is_admin;

        $db = NULL;
        return $this;
    }

    public function delete()
    {
        $db = new Database();
        $db->request("DELETE FROM ".$this->table." WHERE ".$this->primaryKey." = ?",
            [
                $this->id
            ]);
        $db = null;
        return;
    }

    /**
     *
     * Retrieve all users from DB
     *
     * @return array
     *
     */
    public function all()
    {
        $db = new Database();

        $users = $db->findMany("SELECT ".implode(", ", $this->requestables)." FROM ".$this->table);
        $db = NULL;

        return $users;
    }

    /**
     *
     * Hash object instance password using configured hashing algorithm in config/authentication.php .
     * PLEASE USE A STRONG ONE LIKE ARGON2ID OR SHA2/3-256/512
     *
     * @return string
     */
    private function hashedPassword(){

        global $config;

        $this->password = password_hash(
            $this->password,
            $config['auth']['password_hashing']['algo']
        );

        return $this->password;
    }

}