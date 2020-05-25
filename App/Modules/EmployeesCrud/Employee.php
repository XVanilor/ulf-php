<?php


namespace Modules\EmployeesCrud;

use App\Modules\Authentication\Models\User;
use App\Modules\Database;
use App\Modules\ModelInterface;

class Employee extends User implements ModelInterface
{

    public $primaryKey;
    public $table;

    public $id;
    public $gender;
    public $salary;
    public $birthdate;
    public $birthplace;
    public $job;
    public $service;
    public $manager;

    private $columns = [
        "id", "gender", "salary", "birthdate", "birthplace", "job", "service", "manager"
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

    public function __construct()
    {
        parent::__construct();
        $this->primaryKey = "id";
        $this->table = "employees";

        $this->requestables = array_diff($this->columns, $this->hidden);
        $this->updatables = array_diff($this->requestables, [$this->primaryKey]);

    }

    public function all()
    {
        // TODO: Implement all() method.
    }

    public function create()
    {
        $db = new Database();
        $db->request("INSERT INTO ".$this->table." (".implode(", ", array_diff($this->columns, [$this->primaryKey])).") VALUES(?,?,?,?,?)",
            [
                $this->gender,
                $this->salary,
                $this->birthdate,
                $this->birthplace,
                $this->job,
                $this->service,
                $this->manager,
                0
            ]);

        $db = NULL;
        return;
    }

    public function get(int $id)
    {
        $db = new Database();
        $sql = "SELECT ".implode(", ", $this->requestables)." FROM ".$this->table." WHERE ".$this->primaryKey." = ?";
        var_dump($sql);
        die;

        $datas = $db->findOne($sql, [$id]);

        var_dump($datas);

        $this->first_name = $datas->first_name;
        $this->last_name = $datas->last_name;
        $this->email = $datas->email;
        $this->is_admin = $datas->is_admin;

        var_dump($this);
        die;

        $db = NULL;
        return $this;
    }

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
                $this->gender,
                $this->salary,
                $this->birthdate,
                $this->birthplace,
                $this->job,
                $this->service,
                $this->manager,
                $this->id
            ]
        );

        $db = NULL;
        return;
    }


    public function delete()
    {
        // TODO: Implement delete() method.
    }

}