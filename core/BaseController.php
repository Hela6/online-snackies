<?php

namespace core;

class BaseController
{
    private $twig;

    public function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader('../templates');
        $this->twig = new \Twig\Environment($loader);

        if (isset($_SESSION['username'])) {
            $this->twig->addGlobal('username', $_SESSION['username']);
        }


        if (isset($_SESSION['notification'])) {
            $this->twig->addGlobal('notification', $_SESSION['notification']);
            unset($_SESSION['notification']);
        }
    }

    public function render($name, $context)
    {
        echo $this->twig->render($name, $context);
    }
}
