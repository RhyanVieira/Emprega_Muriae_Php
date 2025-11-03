<?php
// app\controller\Home.php

namespace App\Controller;

use Core\Library\ControllerMain;
use App\Model\CidadeModel;
use App\Model\CargoModel;
use App\Model\CategoriaVagaModel;
use App\Model\VagaModel;

class Home extends ControllerMain
{
    public function index()
    {
        $CargoModel = new CargoModel();
        $CidadeModel = new CidadeModel();
        $CategoriaVagaModel = new CategoriaVagaModel();
        $VagaModel = new VagaModel();

        $dados = [
            'aCidade' => $CidadeModel->lista('cidade'),
            'aCargo' => $CargoModel->lista('descricao'),
            'aCategoriaVaga' => $CategoriaVagaModel->lista('descricao'),
            'VagaHome' => $VagaModel->vagaHome(),
            'vagaTotal' => $CategoriaVagaModel->listaTotalVagas(),
        ];
        
        $this->loadView("home", $dados);
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
    public function termo_de_uso()
    {
        return $this->loadView("sistema/termos_uso");
    }
}