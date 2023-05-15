<?php

namespace src\controllers;

use core\BaseController;
use src\models\Employee;

class EmployeeController extends BaseController
{
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new Employee();
    }

    public function auth()
    {
        // verifier si les infos de login sont valides et si oui rediriger vers la route home
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $result = $this->model->checkCredentials($email, $password);
            if ($result != false) {
                $_SESSION['username'] = $result['name'];
                header("Location: /");
            } else {
                // $_SESSION['username'] = ', veuillez vous connecter';
                header("Location: /login");
            }
        }
    }

    public function logOut()
    {
        session_destroy();
        // Rediriger l'utilisateurice vers la page de connexion
        header("Location: /login");
    }

    public function displayList()
    {
        $employees = $this->model->getAll();
        $this->render('employee/list.html.twig', ['employees' => $employees]);
    }

    public function displayForm()
    {
        // no need for data
        $this->render('/employee/add.html.twig', []);
    }

    public function create()
    {
        // Appeler la méthode "insertInDb" du modèle
        $this->model->insertInDb($_POST);
        header("Location: /employee");
    }

    public function addFifty()
    {
        $id = $_GET['id'];
        // Appeler la méthode "addQuantity" du modèle avec l'ID de produit en paramètre
        $this->model->changeCredits($id, 50);
        header("Location: /employee");
    }

    public function edit()
    {
        // Afficher les infos du produit dont l'id à été récupérer dans l'url
        $employee = $this->model->getOne($_GET['id']);
        $this->render('/employee/edit.html.twig', ['e' => $employee]);
    }

    public function update()
    {
        $this->model->updateInDb($_POST);
        header("Location: /employee");
    }

    public function delete()
    {
        $id = $_GET['id'];
        // Appeler la méthode "deleteInDb" du modèle avec l'ID de produit en paramètre
        $this->model->deleteInDb($id);
        header("Location: /employee");
    }
}
