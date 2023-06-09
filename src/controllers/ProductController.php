<?php

namespace src\controllers;

use core\BaseController;
use src\models\Product;

class ProductController extends BaseController
{
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new Product();
    }

    public function displayList()
    {
        $biscuits = $this->model->getAll();
        $this->render('/product/list.html.twig', ['products' => $biscuits]);
    }

    public function displayInJson()
    {
        header('Content-Type: application/json');
        header("Access-Control-Allow-Origin: *");
        $products = $this->model->getAll();
        echo json_encode($products);
    }

    public function displayUpdatedProductInJson()
    {
        header('Content-Type: application/json');
        header("Access-Control-Allow-Origin: *");
        $id = $_GET['id'];
        // Appeler la méthode "addQuantity" du modèle avec l'ID de produit en paramètre
        $this->model->changeQuantity($id, -1);
        $product = $this->model->getOne(($_GET['id']));
        echo json_encode($product);
    }

    public function displayForm()
    {
        // no need for data
        $this->render('/product/add.html.twig', []);
    }

    public function create()
    {
        // Appeler la méthode "insertInDb" du modèle
        $this->model->insertInDb($_POST);
        $_SESSION['notification'] = 'nouveau produit ajouté !';
        header("Location: /product");
    }


    public function addTen()
    {
        $id = $_GET['id'];
        // Appeler la méthode "addQuantity" du modèle avec l'ID de produit en paramètre
        $this->model->changeQuantity($id, 10);
        $_SESSION['notification'] = 'commande réussie !';
        header("Location: /product");
    }

    public function edit()
    {
        // Afficher les infos du produit dont l'id à été récupérer dans l'url
        $product = $this->model->getOne($_GET['id']);
        $this->render('/product/edit.html.twig', ['p' => $product]);
    }

    public function update()
    {
        $this->model->updateInDb($_POST);
        $_SESSION['notification'] = 'le produit a été mis à jour avec succès !';
        header("Location: /product");
    }

    public function delete()
    {
        $id = $_GET['id'];
        // Appeler la méthode "deleteInDb" du modèle avec l'ID de produit en paramètre
        $this->model->deleteInDb($id);
        $_SESSION['notification'] = 'suppression effectuée !';
        header("Location: /product");
    }
}
