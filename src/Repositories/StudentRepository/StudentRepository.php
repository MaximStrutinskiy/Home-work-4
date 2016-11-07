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

    public function insert(array $studentData)
    {
        $statement = $this->connector->getPdo()->prepare('INSERT INTO `student` (`firsst_name`, `last_name`, `email`, `phone`, `id_discipline`) VALUES(:firsstName, :lastName, :email, :phone, :id_discipline)');
        $statement->bindValue(':firsstName', $studentData['firsst_name']);
        $statement->bindValue(':lastName', $studentData['last_name']);
        $statement->bindValue(':email', $studentData['email']);
        $statement->bindValue(':phone', $studentData['phone']);
        $statement->bindValue(':id_discipline', $studentData['id_discipline']);

        return $statement->execute();
    }

    public function remove(array $studentData)
    {
        $statement = $this->connector->getPdo()->prepare("DELETE FROM student WHERE id_student = :id");

        $statement->bindValue(':id', $studentData['id'], \PDO::PARAM_INT);

        return $statement->execute();
    }
}
