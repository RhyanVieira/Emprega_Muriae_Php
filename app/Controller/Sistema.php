<?php

namespace App\Controller;

use Core\Library\ControllerMain;

class Sistema extends ControllerMain
{
    public function index()
    {
        return $this->loadView("sistema/home");
    }

    public function sobre_nos()
    {
        return $this->loadView("sistema/sobre_nos");
    }
    public function politica_privacidade()
    {
        return $this->loadView("sistema/politica_privacidade");
    }
    public function contato()
    {
        return $this->loadView("sistema/contato");
    }
    public function blog()
    {
        return $this->loadView("sistema/blog");
    }
}
