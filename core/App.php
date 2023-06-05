<?php

namespace core;

use src\controllers\HomeController;
use src\controllers\ProductController;
use src\controllers\EmployeeController;
use src\controllers\FavController;

class App
{
    public function __construct()
    {
        session_start();
    }

    public function run()
    {
        $uri =  strtok($_SERVER['REQUEST_URI'], "?");
        if ($uri == '/api/products') {
            $controller = new ProductController();
            $controller->displayInJson();
        } else if ($uri == '/api/product/consume' && isset($_GET['id'])) {
            $controller = new ProductController();
            $controller->displayUpdatedProductInJson();
        } else if ($uri == '/api/products/favs' && isset($_GET['id_employee'])) {
            $controller = new FavController();
            $controller->displayFavsInJson();
        } else if ($uri == '/api/products/addToFavs' && isset($_GET['id_product']) && isset($_GET['id_employee'])) {
            $controller = new FavController();
            $controller->addToFavs();
        } else if ($uri == '/api/products/removeFromFavs' && isset($_GET['id_product']) && isset($_GET['id_employee'])) {
            $controller = new FavController();
            $controller->removeFromFavs();
        } else if ($uri == '/api/auth') {
            $controller = new EmployeeController();
            $controller->auth(false);
        } else if (isset($_SESSION['username'])) {
            if ($uri == '/') {
                $controller = new HomeController();
                $controller->home();
            } else if ($uri == '/employee') {
                $controller = new EmployeeController();
                $controller->displayList();
            } else if ($uri == '/employee/restock' && isset($_GET['id'])) {
                $controller = new EmployeeController();
                $controller->addFifty();
            } else if ($uri == '/employee/edit' && isset($_GET['id'])) {
                $controller = new EmployeeController();
                $controller->edit();
            } else if ($uri == '/employee/delete' && isset($_GET['id'])) {
                $controller = new EmployeeController();
                $controller->delete();
            } else if ($uri == '/employee/update' && isset($_POST['name'])) {
                $controller = new EmployeeController();
                $controller->update();
            } else if ($uri == '/employee/displayForm') {
                $controller = new EmployeeController();
                $controller->displayForm();
            } else if ($uri == '/employee/create') {
                $controller = new EmployeeController();
                $controller->create();
            } else if ($uri == '/product') {
                $controller = new ProductController();
                $controller->displayList();
            } else if ($uri == '/product/restock' && isset($_GET['id'])) {
                $controller = new ProductController();
                $controller->addTen();
            } else if ($uri == '/product/edit' && isset($_GET['id'])) {
                $controller = new ProductController();
                $controller->edit();
            } else if ($uri == '/product/delete' && isset($_GET['id'])) {
                $controller = new ProductController();
                $controller->delete();
            } else if ($uri == '/product/update' && isset($_POST['name'])) {
                $controller = new ProductController();
                $controller->update();
            } else if ($uri == '/product/displayForm') {
                $controller = new ProductController();
                $controller->displayForm();
            } else if ($uri == '/product/create') {
                $controller = new ProductController();
                $controller->create();
            } else if ($uri == '/logout') {
                $controller = new EmployeeController();
                $controller->logOut();
            } else {
                http_response_code(404);
                echo 'page introuvable';
            }
        } else if ($uri == '/login') {
            $controller = new HomeController();
            $controller->login();
        } else if ($uri == '/users/auth') {
            $controller = new EmployeeController();
            $controller->auth();
        }
    }
}
