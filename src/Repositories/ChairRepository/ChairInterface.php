<?php

namespace Repositories\ChairRepository;

interface ChairInterface
{
    public function checkTableChair();

    public  function chooseTemplate($results);

    public function showTable();
}
