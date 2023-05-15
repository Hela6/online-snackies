<?php

namespace src\controllers;

use core\BaseController;
use src\models\Employee;
use src\models\Product;

class HomeController extends BaseController
{
    public function home()
    {
        $title = "home";
        $employeeModel = new Employee;
        $totalEmployees = $employeeModel->count();
        $productModel = new Product;
        $totalProducts = $productModel->count();
        $this->render('home.html.twig', ['title' => $title, 'employees' => $totalEmployees, 'products' => $totalProducts]);
    }

    public function login()
    {
        $title = "login";
        $this->render('login.html.twig', ['title' => $title]);
    }

    public function employees()
    {
        $title = "employee list";
        $this->render('employee/list.html.twig', ['title' => $title]);
    }

    public function updateEmployee()
    {
        $title = "edit employee";
        $this->render('employee/update.html.twig', ['title' => $title]);
    }

    public function products()
    {
        $title = "products list";
        $this->render('products/list.html.twig', ['title' => $title]);
    }

    public function updateProduct()
    {
        $title = "edit product";
        $this->render('employee/update.html.twig', ['title' => $title]);
    }
}
