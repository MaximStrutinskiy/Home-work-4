<?php

namespace Repositories\StudentRepository;

interface StudentInterface
{
    public function checkTables();

    public function chooseTemplate($results);

    public function showTable();

    public function insert(array $studentData);

    public function update(array $studentData);

    public function find($id);

    public function remove(array $studentData);
}
