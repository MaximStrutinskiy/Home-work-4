<?php

namespace Repositories\CreeateDbStructureRepository;
use Repositories\Connector;

class CreeateDbStructureRepository implements CreeateDbStructureInterface
{
    public $connector;

    function __construct($connector){
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
                'id_university' => $result['id_university']
            ];
        }

        return $results;
    }

    //если таблица существует - тогда true, иначе false
    public function chooseTemplate($results){
        if ($results) {
            return true;
        }else{
            return false;
        }
    }

    //функция генерации страницы
    public function generateDbTables()
    {
        echo "DB is generated";
    }
}