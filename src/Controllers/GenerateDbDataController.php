<?php

namespace Controllers;

use Repositories\GenerateDbDataRepository\GenerateDbDataRepository;

class GenerateDbDataController
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

        $this->repository = new GenerateDbDataRepository($this->connector);
    }

    public function indexAction()
    {
        $resultsData = array();

        $results_check = $this->repository->checkTables();
        $results_chose = $this->repository->chooseTemplate($results_check);

        if ($results_chose) {
            $resultsTemplate = 'generateDbData-error.html.twig'; //echo "true сгенерирован";
        } else {
            $resultsTemplate = 'generateDbData.html.twig'; //echo "false не сгенерирован, нужно генерировать";
        }

        return $this->twig->render($resultsTemplate, ['index' => $resultsData]);
    }

    public function generateDbDataAction()
    {
        $this->repository->generateDbData();

        $resultsData = array();
        $resultsTemplate = 'generateDbData-success.html.twig';

        return $this->twig->render($resultsTemplate, ['index' => $resultsData]);
    }

    public function generateStudentDataAction($limit = 20)
    {
        for ($i = 0; $i < $limit; ++$i) {
            $this->repository->generateStudentData();
        }

        $resultsData = array();
        $resultsTemplate = 'generateStudentData.html.twig';

        return $this->twig->render($resultsTemplate, ['index' => $resultsData]);
    }
}
