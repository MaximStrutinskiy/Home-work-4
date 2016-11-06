<?php

namespace Repositories\CreeateDbStructureRepository;

interface CreeateDbStructureInterface
{
    public function checkDatabase();

    public function chooseTemplate($results);

    public function generateDbTables();
}
