<?php

namespace Repositories;

class Connector
{
    private $pdo;

    /**
     * StudentsRepository constructor.
     * Initialize the database connection with sql server via given credentials
     * @param $databasename
     * @param $user
     * @param $pass
     */
    public function __construct($databasename, $user, $pass)
    {
        $this->pdo = new \PDO('mysql:host=localhost;dbname=' . $databasename . ';charset=UTF8', $user, $pass);
        if (!$this->pdo) {
            echo "error connect to db";
        }

    }

    public function getPdo()
    {
        return $this->pdo;
    }
}