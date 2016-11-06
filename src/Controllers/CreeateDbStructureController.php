<?php

namespace Controllers;

use Repositories\CreeateDbStructureRepository\CreeateDbStructureRepository;
use Views\Renderer;

class CreeateDbStructureController
{

    private $repository;

    private $loader;

    private $twig;

    public $connector;

    public function __construct($connector)
    {
        $this->connector = $connector;

        $this->loader = new \Twig_Loader_Filesystem('src/Views/templates/');
        $this->twig = new \Twig_Environment($this->loader, array(
            'cache' => false,
        ));

        $this->repository = new CreeateDbStructureRepository($this->connector);
    }


    public function indexAction()
    {
        $resultsData = array();


        $results_check = $this->repository->checkDatabase();
        $results_chose = $this->repository->chooseTemplate($results_check);

        if ($results_chose)
        {
            $resultsTemplate = 'creeateDbStructure-error.html.twig';
        }else{
            $resultsTemplate = 'creeateDbStructure.html.twig';
        }

        return $this->twig->render($resultsTemplate, ['index' => $resultsData]);
    }

    public function creeateDbStructureAction()
    {
        $this->repository->generateDbTables();

        $resultsData = array();
        $resultsTemplate = 'creeateDbStructure-success.html.twig';

        return $this->twig->render($resultsTemplate, ['index' => $resultsData]);
    }
}