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
     * User vars
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
    private $db;

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
     * Columns that are not retrieved when User()->get or User->all() method is called
     * @var array
     *
     */
    private $hidden = [
        "password"
    ];
    private $requestables;
    private $primaryKey = "id";

    /**
     *
     * User constructor.
     * Defines by default password empty in order to avoid password issues
     *
     */
    public function __construct()
    {
        $this->password = "";
        $this->db = new Database();
        $this->requestables = implode(", ",array_diff($this->columns, $this->hidden));
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
        $this->db->request("INSERT INTO ".$this->table." ".$this->columns." VALUES(?,?,?,?,?)",
            [
                $this->first_name,
                $this->last_name,
                $this->email,
                $this->hashedPassword(),
                0
            ]);
        return;
    }

    /**
     * Update User vars in DB except password, which must be called separately
     *
     * @return void
     *
     */
    public function update()
    {

        $sql = "UPDATE ".$this->table." SET ";
        foreach($this->columns as $key => $column) {
            $sql .= $column . " = ?";
            if($key !== array_key_last($this->columns))
                $sql .= ", ";
        }

        $sql .= "WHERE ".$this->primaryKey." = ?";
        $this->db->request($sql,
            [
                $this->first_name,
                $this->last_name,
                $this->email,
                $this->is_admin,
                $this->id
            ]
        );
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
        $this->db->request("UPDATE ".$this->table." SET ".$config['auth']['password_column']." = ? WHERE ".$this->primaryKey." = ?",
            [
                $this->hashedPassword(),
                $this->id
            ]);

    }

    /**
     * Retrieve a single user from DB using it's ID
     *
     * @param int $id
     *
     * @return User
     *
     */
    public function get(int $id)
    {
        $datas = $this->db->findOne("SELECT ".$this->requestables." FROM ".$this->table." WHERE ".$this->primaryKey." = ?", [$id]);

        foreach(explode(", ", $this->requestables) as $requestable)
            $this->$requestable = $datas->$requestable;

        return $this;
    }

    public function delete(int $id)
    {
        // TODO: Implement delete() method.
    }

    /**
     * Retrieve all users from DB
     *
     * @return array
     *
     */
    public function all()
    {
        return $this->findMany("SELECT ".$this->requestables." FROM ".$this->table);
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