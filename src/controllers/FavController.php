<?php

namespace src\controllers;

use core\BaseController;
use src\models\Fav;


class FavController extends BaseController
{
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new Fav();
    }

    public function displayFavInJson()
    {
        header('Content-Type: application/json');
        header("Access-Control-Allow-Origin: *");
        $favs = $this->model->getAll();
        echo json_encode($favs);
    }

    public function addToFavs()
    {
        if (isset($_POST['id_employee']) && isset($_POST['id_product'])) {
            $id_employee = $_POST['id_employee'];
            $id_product = $_POST['id_product'];
            $this->model->insertInDb($id_employee, $id_product);
        }
    }

    public function deleteFromFavs()
    {
        $id = $_GET['id'];
        // Appeler la méthode "deleteInDb" du modèle avec l'ID de produit en paramètre
        $this->model->deleteInDb($id);
        $_SESSION['notification'] = 'suppression effectuée !';
        header("Location: /fav");
    }
}
