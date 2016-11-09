<?php

namespace Repositories\ChairRepository;

use Repositories\Connector;

class ChairRepository implements ChairInterface
{
    public $connector;

    public function __construct($connector)
    {
        $this->connector = $connector;
    }

    public function checkTableChair()
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

    public function showTable()
    {
        $statement = $this->connector->getPdo()->prepare('
            SELECT * FROM chair
        ');
        $statement->execute();

        return $this->showResultsData($statement);
    }

    private function showResultsData($statement)
    {
        $results = [];
        while ($result = $statement->fetch()) {
            $results[] = [
                'id_chair' => $result['id_chair'],
                'name' => $result['name'],
                'id_university' => $result['id_university'],
            ];
        }

        return $results;
    }
}
