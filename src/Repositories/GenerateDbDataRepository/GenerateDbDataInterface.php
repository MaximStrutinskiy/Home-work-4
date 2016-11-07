<?php

namespace Repositories\GenerateDbDataRepository;

interface GenerateDbDataInterface
{
    public function checkTables();

    public function chooseTemplate($results_check);

    public function generateDbData();

    public function generateStudentData();
}
