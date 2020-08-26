<?php

namespace App\Modules;

use PDO;
use PDOException;
use PDOStatement;
use App\Core\Helper;

/**
 *
 * Class Database
 * @package App\Modules
 *
 */

class Database extends PDO
{

    protected $host;
    protected $db;
    protected $user;
    protected $password;
    protected $port;
    protected $dsn;
    protected $defaultDB;
    protected $defaultPort;
    protected $opt;

    public function __construct($name = NULL)
    {

        $this->defaultDB = strtoupper("MYSQL"); //Here is setup the default Database
        $this->defaultPort = 3306;

        $dbEnv = Helper::getEnv(($name) ? $name : $this->defaultDB . "_DB");

        $this->host = $dbEnv['HOST'];
        $this->db = $dbEnv['DB'];
        $this->user = $dbEnv['USER'];
        $this->password = $dbEnv['PASSWORD'];
        $this->port = (!empty($dbEnv['PORT'])) ? $dbEnv['PORT'] : $this->defaultPort;
        $this->dsn = "mysql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->db;
        $this->opt = [
            PDO::ATTR_AUTOCOMMIT => false,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        ];

        if(getenv("DEBUG"))
            array_push($this->opt, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

        try {
            parent::__construct($this->dsn, $this->user, $this->password, $this->opt);
        } catch (PDOException $e) {
            echo "<br />
                    <em style='background-color: red; color: white; margin: 20px 20px;'>
                        Error thrown : ". $e->getMessage() .".
                    </em>";
        }

    }

    /**
     * Override the default prepare() method to get a shortened one
     *
     * @param string $sql
     * @param array $datas The inputs you want to throw in your SQL request
     *
     * @return PDOStatement
     **/
    public function request(string $sql, array $datas = NULL){

        $request = \PDOStatement::class;
        $this->beginTransaction();
        try{
            $request = $this->prepare($sql);
            $request->execute($datas);
            $this->commit();
        }
        catch (PDOException $e){
            var_dump($e->getMessage());
            $this->rollBack();
            exit();
        }
        return $request;
    }

    public function findOne(string $sql, array $datas = NULL){
        $request = $this->request($sql, $datas);

        return $request->fetch();
    }

    public function findMany(string $sql, array $datas = NULL){
        $request = $this->request($sql, $datas);

        return $request->fetchAll();
    }

}