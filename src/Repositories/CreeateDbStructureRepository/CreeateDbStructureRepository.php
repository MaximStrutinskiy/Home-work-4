<?php

namespace Repositories\CreeateDbStructureRepository;

use Repositories\Connector;

class CreeateDbStructureRepository implements CreeateDbStructureInterface
{
    public $connector;

    public function __construct($connector)
    {
        $this->connector = $connector;
    }

    //проверяем базу на наличие таблицы - университет, если ее нет то загружаем шаблон с action, который ее сгенерирует
    public function checkDatabase()
    {
        $statement = $this->connector->getPdo()->prepare('
            SELECT * FROM university
        ');
        $statement->execute();

        return $this->fetchResultsData($statement);
    }

    private function fetchResultsData($statement)
    {
        $results = [];
        while ($result = $statement->fetch()) {
            $results[] = [
                'id_university' => $result['id_university'],
            ];
        }

        return $results;
    }

    //если таблица c 1 университетом существует - тогда true, иначе false
    public function chooseTemplate($results)
    {
        if ($results) {
            return true;
        } else {
            return false;
        }
    }

    //функция генерации таблиц
    public function generateDbTables()
    {
        $this->generateDBTableUniversity();
        $this->genContDbTableUniversity();
        $this->generateDBTableChair();
        $this->generateDBTableDiscipline();
        $this->generateDBTableTeacher();
        $this->generateDBTableDisciplineTeacher();
        $this->generateDBTableDisciplineHomework();
        $this->generateDBTableDisciplineStudent();
        $this->generateDBTableDisciplineStudentHomework();
    }

    public function generateDBTableUniversity()
    {
        $statement = $this->connector->getPdo()->prepare('
            DROP TABLE IF EXISTS `university`;
            CREATE TABLE `university` (
              `id_university` int(11) NOT NULL AUTO_INCREMENT,
              `name` varchar(45) NOT NULL,
              `city` varchar(45) NOT NULL,
              `site` varchar(45) NOT NULL,
              PRIMARY KEY (`id_university`)
            ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
        ');
        $statement->execute();

        return $statement;
    }

    //добавим в таблицу с университетами - Университет геекхаб, для проверки условия checkDatabase();
    public function genContDbTableUniversity()
    {
        $statement = $this->connector->getPdo()->prepare('
            INSERT INTO `university` VALUES (1,\'GeekHub\',\'Cherkasi\',\'www.geekhub.ck.ua\'),(2,\'LoftBlog\',\'Sankt-Piterburg\',\'www.loftblog.com\');
        ');
        $statement->execute();

        return $statement;
    }

    public function generateDBTableChair()
    {
        $statement = $this->connector->getPdo()->prepare('
            DROP TABLE IF EXISTS `chair`;
            CREATE TABLE `chair` (
              `id_chair` int(11) NOT NULL AUTO_INCREMENT,
              `name` varchar(45) NOT NULL,
              `id_university` int(11) NOT NULL,
              PRIMARY KEY (`id_chair`),
              KEY `id_university` (`id_university`),
              CONSTRAINT `chair_ibfk_1` FOREIGN KEY (`id_university`) REFERENCES `university` (`id_university`)
            ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
        ');
        $statement->execute();

        return $statement;
    }

    public function generateDBTableDiscipline()
    {
        $statement = $this->connector->getPdo()->prepare('
            DROP TABLE IF EXISTS `discipline`;
            CREATE TABLE `discipline` (
              `id_discipline` int(11) NOT NULL AUTO_INCREMENT,
              `name` varchar(45) NOT NULL,
              `id_chair` int(11) NOT NULL,
              PRIMARY KEY (`id_discipline`),
              KEY `id_chair` (`id_chair`),
              CONSTRAINT `discipline_ibfk_1` FOREIGN KEY (`id_chair`) REFERENCES `chair` (`id_chair`)
            ) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
        ');
        $statement->execute();

        return $statement;
    }

    public function generateDBTableTeacher()
    {
        $statement = $this->connector->getPdo()->prepare('
            DROP TABLE IF EXISTS `teacher`;
            CREATE TABLE `teacher` (
              `id_teacher` int(11) NOT NULL AUTO_INCREMENT,
              `first_name` varchar(45) NOT NULL,
              `last_name` varchar(45) NOT NULL,
              `id_chair` int(11) NOT NULL,
              PRIMARY KEY (`id_teacher`),
              KEY `id_chair` (`id_chair`),
              CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`id_chair`) REFERENCES `chair` (`id_chair`)
            ) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
        ');
        $statement->execute();

        return $statement;
    }

    public function generateDBTableDisciplineTeacher()
    {
        $statement = $this->connector->getPdo()->prepare('
            DROP TABLE IF EXISTS `discipline_teacher`;
            CREATE TABLE `discipline_teacher` (
              `id_discipline_teacher` int(11) NOT NULL AUTO_INCREMENT,
              `id_discipline` int(11) NOT NULL,
              `id_teacher` int(11) NOT NULL,
              PRIMARY KEY (`id_discipline_teacher`),
              KEY `id_discipline` (`id_discipline`),
              KEY `id_teacher` (`id_teacher`),
              CONSTRAINT `discipline_teacher_ibfk_1` FOREIGN KEY (`id_discipline`) REFERENCES `discipline` (`id_discipline`),
              CONSTRAINT `discipline_teacher_ibfk_2` FOREIGN KEY (`id_teacher`) REFERENCES `teacher` (`id_teacher`)
            ) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
        ');
        $statement->execute();

        return $statement;
    }

    public function generateDBTableDisciplineHomework()
    {
        $statement = $this->connector->getPdo()->prepare('
            DROP TABLE IF EXISTS `homework`;
            CREATE TABLE `homework` (
              `id_homework` int(11) NOT NULL AUTO_INCREMENT,
              `name` varchar(45) NOT NULL,
              `id_discipline` int(11) NOT NULL,
              PRIMARY KEY (`id_homework`),
              KEY `id_discipline` (`id_discipline`),
              CONSTRAINT `homework_ibfk_1` FOREIGN KEY (`id_discipline`) REFERENCES `discipline` (`id_discipline`)
            ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
        ');
        $statement->execute();

        return $statement;
    }

    public function generateDBTableDisciplineStudent()
    {
        $statement = $this->connector->getPdo()->prepare('
            DROP TABLE IF EXISTS `student`;
            CREATE TABLE `student` (
              `id_student` int(11) NOT NULL AUTO_INCREMENT,
              `firsst_name` varchar(45) NOT NULL,
              `last_name` varchar(45) NOT NULL,
              `email` varchar(45) NOT NULL,
              `phone` varchar(45) NOT NULL,
              `id_discipline` int(11) NOT NULL,
              PRIMARY KEY (`id_student`),
              KEY `id_discipline` (`id_discipline`),
              CONSTRAINT `student_ibfk_1` FOREIGN KEY (`id_discipline`) REFERENCES `discipline` (`id_discipline`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ');
        $statement->execute();

        return $statement;
    }

    public function generateDBTableDisciplineStudentHomework()
    {
        $statement = $this->connector->getPdo()->prepare('
            DROP TABLE IF EXISTS `student_homework`;
            CREATE TABLE `student_homework` (
              `id_student_homework` int(11) NOT NULL AUTO_INCREMENT,
              `id_student` int(11) NOT NULL,
              `id_homework` int(11) NOT NULL,
              `result` tinyint(1) NOT NULL,
              PRIMARY KEY (`id_student_homework`),
              KEY `id_student` (`id_student`),
              KEY `id_homework` (`id_homework`),
              CONSTRAINT `student_homework_ibfk_1` FOREIGN KEY (`id_student`) REFERENCES `student` (`id_student`),
              CONSTRAINT `student_homework_ibfk_2` FOREIGN KEY (`id_homework`) REFERENCES `homework` (`id_homework`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ');
        $statement->execute();

        return $statement;
    }
}
