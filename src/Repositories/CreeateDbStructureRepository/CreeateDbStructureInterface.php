<?php

namespace Repositories\CreeateDbStructureRepository;

interface CreeateDbStructureInterface
{
    public function checkDatabase();

    public function generateDbTables();

    public function chooseTemplate($results);
}
