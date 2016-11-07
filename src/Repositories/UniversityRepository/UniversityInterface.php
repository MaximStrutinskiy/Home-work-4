<?php

namespace Repositories\UniversityRepository;

interface UniversityInterface
{
    public function checkTableUniversity();

    public function showTable();

    public function chooseTemplate($results);

}
