<?php

namespace Repositories\GenerateDbDataRepository;

use Repositories\Connector;
use Faker\Factory as Faker;

class GenerateDbDataRepository implements GenerateDbDataInterface
{
    public $connector;

    public function __construct($connector)
    {
        $this->connector = $connector;
    }

    public function checkTables()
    {
        $statement = $this->connector->getPdo()->prepare('
            SELECT * FROM chair
        ');
        $statement->execute();

        return $this->fetchResultsData($statement);
    }

    private function fetchResultsData($statement)
    {
        $results = [];
        while ($result = $statement->fetch()) {
            $results[] = [
                'id_chair' => $result['id_chair'],
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

    public function generateDbData()
    {
        $this->genContDbTableChair();
        $this->genContDbTableDiscipline();
        $this->genContDbTableTeacher();
        $this->genContDbTableDisciplineTeacher();
        $this->genContDbTableDisciplineHomework();
    }

    public function genContDbTableChair()
    {
        $statement = $this->connector->getPdo()->prepare('
            INSERT INTO `chair` VALUES (1,\'Advanced PHP\',1),(2,\'Javascript\',1),(3,\'Ruby on Rails\',1);
        ');
        $statement->execute();

        return $statement;
    }

    public function genContDbTableDiscipline()
    {
        $statement = $this->connector->getPdo()->prepare('
            INSERT INTO `discipline` VALUES (1,\'PHP OOP\',1),(2,\'PHP MySQL\',1),(3,\'JavaScript - Base\',2),(4,\'RoR-Base\',3),(5,\'PHP MVC\',1),(6,\'PHP CMS\',1);
        ');
        $statement->execute();

        return $statement;
    }

    public function genContDbTableTeacher()
    {
        $statement = $this->connector->getPdo()->prepare('
            INSERT INTO `teacher` VALUES (1,\'Yuriy \',\'Tarnavskiy\',1),(2,\'Olexander\',\'Moshta\',1),(3,\'Dmitriy\',\'Chabanenko\',1),(4,\'Sergey\',\'Polishuk\',1),(5,\'Sergey\',\'Kluchnik\',2),(6,\'Alex\',\'Galushka\',3);
        ');
        $statement->execute();

        return $statement;
    }

    public function genContDbTableDisciplineTeacher()
    {
        $statement = $this->connector->getPdo()->prepare('
            INSERT INTO `discipline_teacher` VALUES (1,1,3),(2,1,2),(3,2,1),(4,3,5),(5,4,6),(6,5,4),(7,5,1),(8,6,4);
        ');
        $statement->execute();

        return $statement;
    }

    public function genContDbTableDisciplineHomework()
    {
        $statement = $this->connector->getPdo()->prepare('
            INSERT INTO `homework` VALUES (1,\'PHP OOP - base\',1),(2,\'Creeate DB in MySQL\',2);
        ');
        $statement->execute();

        return $statement;
    }

    public function generateStudentData()
    {
        $faker = Faker::create();
        $statement = $this->connector->getPdo()->prepare('
                INSERT INTO `student` (`firsst_name`, `last_name`, `email`, `phone`, `id_discipline`) VALUES (:firstName, :lastName, :email, :phone, :discipline);
            ');
        $statement->bindValue(':firstName', $faker->firstName, \PDO::PARAM_STR);
        $statement->bindValue(':lastName', $faker->lastName, \PDO::PARAM_STR);
        $statement->bindValue(':email', $faker->email, \PDO::PARAM_STR);
        $statement->bindValue(':phone', $faker->phoneNumber, \PDO::PARAM_INT);
        $statement->bindValue(':discipline', $faker->numberBetween($min = 1, $max = 6), \PDO::PARAM_INT);
        $statement->execute();

        return $statement;
    }
}
