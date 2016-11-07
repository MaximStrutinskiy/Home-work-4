<?php

namespace Repositories\UniversityRepository;

use Repositories\Connector;

class UniversityRepository implements UniversityInterface
{
    public $connector;

    public function __construct($connector)
    {
        $this->connector = $connector;
    }

    public function checkTableUniversity()
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
            SELECT * FROM university
        ');
        $statement->execute();
        return $this->showResultsData($statement);
    }

    private function showResultsData($statement)
    {
        $results = [];
        while ($result = $statement->fetch()) {
            $results[] = [
                'id_university' => $result['id_university'],
                'name' => $result['name'],
                'city' => $result['city'],
                'site' => $result['site']
            ];
        }

        return $results;
    }
}
