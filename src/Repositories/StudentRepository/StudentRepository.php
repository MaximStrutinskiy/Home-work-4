<?php

namespace Repositories\StudentRepository;

use Repositories\Connector;

class StudentRepository implements StudentInterface
{
    public $connector;

    public function __construct($connector)
    {
        $this->connector = $connector;
    }

    public function checkTables()
    {
        $statement = $this->connector->getPdo()->prepare('
            SELECT * FROM student
        ');
        $statement->execute();

        return $this->fetchResultsData($statement);
    }

    private function fetchResultsData($statement)
    {
        $results = [];
        while ($result = $statement->fetch()) {
            $results[] = [
                'id_student' => $result['id_student']
            ];
        }
        return $results;
    }

    public function chooseTemplate($results)
    {
        if ($results) {
            return true;
        } else {
            return false;
        }
    }

    public function showTable()
    {
        $statement = $this->connector->getPdo()->prepare('
            SELECT * FROM student
        ');
        $statement->execute();
        return $this->showResultsData($statement);
    }

    private function showResultsData($statement)
    {
        $results = [];
        while ($result = $statement->fetch()) {
            $results[] = [
                'id_student' => $result['id_student'],
                //error in word, i don't fix this firsst_name
                'firsst_name' => $result['firsst_name'],
                'last_name' => $result['last_name'],
                'email' => $result['email'],
                'phone' => $result['phone'],
                'id_discipline' => $result['id_discipline']
            ];
        }

        return $results;
    }

}
