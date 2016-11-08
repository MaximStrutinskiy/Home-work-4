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
                'id_student' => $result['id_student'],
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
                'id_discipline' => $result['id_discipline'],
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
        $statement = $this->connector->getPdo()->prepare('DELETE FROM student WHERE id_student = :id');

        $statement->bindValue(':id', $studentData['id'], \PDO::PARAM_INT);

        return $statement->execute();
    }

    public function find($id)
    {
        $statement = $this->connector->getPdo()->prepare('SELECT * FROM student WHERE id_student = :id LIMIT 1');
        $statement->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $statement->execute();
        $studentsData = $this->fetchStudentData($statement);

        return $studentsData[0];
    }

    public function search(array $search)
    {
        $statement = $this->connector->getPdo()->prepare('SELECT * FROM student WHERE firsst_name = :search');
        $statement->bindValue(':search', $search['search'], \PDO::PARAM_STR);
        $statement->execute();
        $studentsData = $this->fetchStudentData($statement);

        return $studentsData;
    }

    private function fetchStudentData($statement)
    {
        $results = [];
        while ($result = $statement->fetch()) {
            $results[] = [
                'id_student' => $result['id_student'],
                'firsst_name' => $result['firsst_name'],
                'last_name' => $result['last_name'],
                'email' => $result['email'],
                'phone' => $result['phone'],
                'id_discipline' => $result['id_discipline'],
            ];
        }

        return $results;
    }

    public function update(array $studentData)
    {
        $statement = $this->connector->getPdo()->prepare('UPDATE student SET firsst_name = :firstName, last_name = :lastName, email = :email, phone = :phone, id_discipline = :id_discipline WHERE id_student = :id_student');
        $statement->bindValue(':firstName', $studentData['firsst_name'], \PDO::PARAM_STR);
        $statement->bindValue(':lastName', $studentData['last_name'], \PDO::PARAM_STR);
        $statement->bindValue(':email', $studentData['email'], \PDO::PARAM_STR);
        $statement->bindValue(':phone', $studentData['phone'], \PDO::PARAM_INT);
        $statement->bindValue(':id_discipline', $studentData['id_discipline'], \PDO::PARAM_INT);
        $statement->bindValue(':id_student', $studentData['id_student'], \PDO::PARAM_INT);

        return $statement->execute();
    }
}
