<?php

namespace src\controllers;

use core\BaseController;

use src\models\Fav;
use src\models\Product;


class FavController extends BaseController
{
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new Product();
    }

    public function displayFavsInJson()
    {
        header('Content-Type: application/json');
        header("Access-Control-Allow-Origin: *");
        if (isset($_GET['id_employee'])) {
            $id_employee = $_GET['id_employee'];
            $favs = $this->model->getAllFavs($id_employee);
            echo json_encode($favs);
        }
    }

    public function addToFavs()
    {
        header('Content-Type: application/json');
        header("Access-Control-Allow-Origin: *");
        $id_product = $_GET['id_product'];
        $id_employee = $_GET['id_employee'];
        $favModel = new Fav;
        $addedFav = $favModel->insertInDb($id_employee, $id_product);
        echo json_encode($addedFav);
    }

    public function removeFromFavs()
    {
        header('Content-Type: application/json');
        header("Access-Control-Allow-Origin: *");
        $id_product = $_GET['id_product'];
        $id_employee = $_GET['id_employee'];
        $favModel = new Fav;
        $removedFav = $favModel->deleteInDb($id_employee, $id_product);
        echo json_encode($removedFav);
    }
}
