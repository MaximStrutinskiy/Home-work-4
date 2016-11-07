<?php

namespace Controllers;

use Repositories\UniversityRepository\UniversityRepository;

class UniversityController
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

        $this->repository = new UniversityRepository($this->connector);
    }

    public function indexAction()
    {
        $resultsData = array();

        $results_check = $this->repository->checkTableUniversity();
        $results_chose = $this->repository->chooseTemplate($results_check);

        if ($results_chose) {
            $resultsDataQuery = $this->repository->showTable();

            $resultsData = ['results' => $resultsDataQuery];

            $resultsTemplate = 'university-success.html.twig';
        } else {
            $resultsTemplate = 'university-error.html.twig';
        }

        return $this->twig->render($resultsTemplate, $resultsData);
    }
}
