<?php

namespace core;

class BaseController
{
    private $twig;

    public function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader('../templates');
        $this->twig = new \Twig\Environment($loader);
        $this->twig->addGlobal('session', $_SESSION);
    }

    public function render($name, $context)
    {
        echo $this->twig->render($name, $context);
    }

    // public function displayInJson($array)
    // {
    //     echo json_encode($array);
    //     header("Location: /api/products");
    //     exit; 
    // }
}
