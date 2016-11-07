<?php

namespace Repositories\StudentRepository;

interface StudentInterface
{
    public function checkTables();

    public function chooseTemplate($results);

    public function showTable();
}
