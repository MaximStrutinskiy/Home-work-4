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

    public function searchAction()
    {
        $resultsData = array();

        $results_check = $this->repository->checkTables();
        $results_chose = $this->repository->chooseTemplate($results_check);

        if ($results_chose) {
            if (isset($_POST['search'])) {
                $search = $_POST['search'];
            } else {
                $search = 'no values';
            }

            $resultsDataQuery = $this->repository->search(['search' => $search]);

            $resultsData = ['results' => $resultsDataQuery];

            $resultsTemplate = 'student-search-success.html.twig';
        } else {
            $resultsTemplate = 'student-error.html.twig';
        }

        return $this->twig->render($resultsTemplate, $resultsData);
    }

    public function newAction()
    {
        if (isset($_POST['firsst_name'])) {
            $this->repository->insert(
                [
                    'firsst_name' => $_POST['firsst_name'],
                    'last_name' => $_POST['last_name'],
                    'email' => $_POST['email'],
                    'phone' => $_POST['phone'],
                    'id_discipline' => $_POST['id_discipline'],
                ]
            );

            return $this->indexAction();
        }

        return $this->twig->render('students_form.html.twig',
            [
                'firsst_name' => '',
                'last_name' => '',
                'email' => '',
                'phone' => '',
                'id_discipline' => '',
            ]
        );
    }

    public function editAction()
    {
        if (isset($_POST['firsst_name'])) {
            $this->repository->update(
                [
                    'firsst_name' => $_POST['firsst_name'],
                    'last_name' => $_POST['last_name'],
                    'email' => $_POST['email'],
                    'phone' => $_POST['phone'],
                    'id_discipline' => $_POST['id_discipline'],
                    'id_student' => (int) $_GET['id'],
                ]
            );

            return $this->indexAction();
        }

        $studentData = $this->repository->find((int) $_GET['id']);

        return $this->twig->render('students_form.html.twig',
            [
                'firsst_name' => $studentData['firsst_name'],
                'last_name' => $studentData['last_name'],
                'email' => $studentData['email'],
                'phone' => $studentData['phone'],
                'id_discipline' => $studentData['id_discipline'],
            ]
        );
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
