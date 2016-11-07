<?php

namespace Controllers;

use Repositories\StudentRepository\StudentRepository;

class StudentController
{
    private $repository;

    private $loader;

    private $twig;

    public function __construct($connector)
    {
        $this->loader = new \Twig_Loader_Filesystem('src/Views/templates/');
        $this->twig = new \Twig_Environment($this->loader, array(
            'cache' => false,
        ));

        $this->repository = new StudentRepository($connector);
    }

    public function indexAction()
    {
        $resultsData = array();

        $results_check = $this->repository->checkTables();
        $results_chose = $this->repository->chooseTemplate($results_check);

        if ($results_chose) {

            $resultsDataQuery = $this->repository->showTable();
            $resultsData = ['results' => $resultsDataQuery];

            $resultsTemplate = 'student-success.html.twig';
        } else {
            $resultsTemplate = 'student-error.html.twig';
        }

        return $this->twig->render($resultsTemplate, $resultsData);
    }

    public function deleteAction()
    {
        if (isset($_POST['id'])) {
            $id = (int) $_POST['id'];
            $this->repository->remove(['id' => $id]);
            return $this->indexAction();
        }
        return $this->twig->render('student_delete.html.twig', array('student_id' => $_GET['id']));
    }
}