<?php

namespace Controllers;

use Repositories\ChairRepository\ChairRepository;

class ChairController
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

        $this->repository = new ChairRepository($this->connector);
    }

    public function indexAction()
    {
        $resultsData = array();

        $results_check = $this->repository->checkTableChair();
        $results_chose = $this->repository->chooseTemplate($results_check);

        if ($results_chose) {
            $resultsDataQuery = $this->repository->showTable();

            $resultsData = ['results' => $resultsDataQuery];

            $resultsTemplate = 'chair-success.html.twig';
        } else {
            $resultsTemplate = 'chair-error.html.twig';
        }

        return $this->twig->render($resultsTemplate, $resultsData);
    }
}
