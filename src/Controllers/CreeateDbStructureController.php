<?php

namespace Controllers;

use Repositories\creeateDbStructureRepository;
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
    }

    public function creeateDbStructureAction()
    {
        $this->repository = new creeateDbStructureRepository($this->connector);
        $this->loader = new \Twig_Loader_Filesystem('src/Views/templates/');
        $this->twig = new \Twig_Environment($this->loader, array(
            'cache' => false,
        ));

        $resultsData = array();
        return $this->twig->render('creeateDbStructure-success.html.twig', ['index' => $resultsData]);
    }

    public function indexAction()
    {
        $resultsData = array();
        return $this->twig->render('creeateDbStructure.html.twig', ['index' => $resultsData]);
    }
}