<?php

namespace Controllers;

use Views\Renderer;

class IndexController
{

    private $loader;

    private $twig;

    public function __construct($connector)
    {
        $this->loader = new \Twig_Loader_Filesystem('src/Views/templates/');
        $this->twig = new \Twig_Environment($this->loader, array(
            'cache' => false,
        ));
    }

    public function indexAction()
    {
        $resultsData = array();

        return $this->twig->render('index.html.twig', ['index' => $resultsData]);
    }
}