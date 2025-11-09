<?php

namespace App\Controller;

use App\Model\CidadeModel;
use App\Model\CargoModel;
use App\Model\CategoriaVagaModel;
use Core\Library\ControllerMain;
use Core\Library\Files;
use Core\Library\Redirect;
use Core\Library\Session;
use Core\Library\Validator;

class Vaga extends ControllerMain
{
    protected $files;

    public function __construct()
    {
        $this->auxiliarconstruct();
        $this->loadHelper('formHelper');
        $this->files = new Files();
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {   
        $CidadeModel = new CidadeModel();
        $CategoriaVagaModel = new CategoriaVagaModel();

        $dados = [
            'aVagas' => $this->model->listaVagas(),
            'aCidade' => $CidadeModel->lista('cidade'),
            'aCategoriaVaga' => $CategoriaVagaModel->lista('descricao')
        ];

        return $this->loadView("sistema/vagas", $dados);
    }

    public function vaga_detalhada()
    {
        return $this->loadView("sistema/vaga_detalhada");
    }

    public function form()
    {   
        $CargoModel = new CargoModel();
        $CidadeModel = new CidadeModel();
        $CategoriaVagaModel = new CategoriaVagaModel();

        $dados = [
            'aCidade' => $CidadeModel->lista('cidade'),
            'aCargo' => $CargoModel->lista('descricao'),
            'aCategoriaVaga' => $CategoriaVagaModel->lista('descricao')
        ];
        
        return $this->loadView("sistema/publicar_vaga", $dados);
    }

    /**
     * insert
     *
     * @return void
     */
    public function insert()
    {   
        $post = $this->request->getPost();

        $post['estabelecimento_id'] = Session::get('userEstabId');
        
        // Verifica se o checkbox "Acombinar" foi marcado
        if (!empty($post['ACombinar'])) {
            $post['faixaSal'] = 'A combinar';
            unset($post['ACombinar']); // remove o checkbox do array $post
        }

        $existe = $this->model->existeVaga( 
            $post['estabelecimento_id'],
            $post['descricao'],
            $post['dtInicio'],
            $post['dtFim'],
            $post['modalidade'],
            $post['vinculo'],
            $post['nivelExperiencia'],
            $post['categoria_vaga_id'],
            $post['faixaSal']
        );

        if ($existe) {
            return Redirect::page($this->controller . "/form", ["msgError" => "Você já cadastrou esta vaga anteriormente."]);
        }

        if (Validator::make($post, $this->model->validationRules)) {
            return Redirect::page($this->controller . "/form", ["msgError" => "Preencha os campos obrigatórios corretamente."]);
        } else {
            if ($this->model->insert($post)) {
                return Redirect::page($this->controller . "/form", ["msgSucesso" => "Vaga cadastrada com sucesso."]);
            } else {
                return Redirect::page($this->controller . "/form");
            }
        }
    }

    /**
     * update
     *
     * @return void
     */
    public function update()
    {
        $post = $this->request->getPost();

        if (Validator::make($post, $this->model->validationRules)) {
            return Redirect::page($this->controller . "/form/update/" . $post['id']);    // error
        } else {
            if ($this->model->update($post)) {
                return Redirect::page($this->controller, ["msgSucesso" => "Registro alterado com sucesso."]);
            } else {
                return Redirect::page($this->controller . "/form/update/" . $post['id']);
            }
        }
    }

    /**
     * delete
     *
     * @return void
     */
    public function delete()
    {
        $post = $this->request->getPost();

        if ($this->model->delete($post)) {
            return Redirect::page($this->controller, ["msgSucesso" => "Registro Excluído com sucesso."]);
        } else {
            return Redirect::page($this->controller);
        }
    }
}