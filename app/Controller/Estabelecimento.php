<?php

namespace App\Controller;

use Core\Library\ControllerMain;
use Core\Library\Files;
use Core\Library\Redirect;
use Core\Library\Session;
use Core\Library\Validator;
use App\Model\EstabelecimentoModel;

class Estabelecimento extends ControllerMain
{
    protected $files;

    public function __construct()
    {
        $this->auxiliarconstruct();
        $this->loadHelper('formHelper');
        $this->files = new Files();
        $this->model = new EstabelecimentoModel();
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        return $this->loadView("sistema/empresas");
    }

    public function cadastro(){
        return $this->loadView("sistema/cadastro_estabelecimento");
    }

    public function form($action, $id)
    {   
        $this->validaNivelAcesso();
        return $this->loadView("sistema/formUf", $this->model->getById($id));
    }

    /**
     * insert
     *
     * @return void
     */
    public function insert()
    {
        $post = $this->request->getPost();

        if (Validator::make($post, $this->model->validationRules)) {
            return Redirect::page($this->controller . "/form/insert/0");
        } else {
            if ($this->model->insert($post)) {
                return Redirect::page($this->controller, ["msgSucesso" => "Registro inserido com sucesso."]);
            } else {
                return Redirect::page($this->controller . "/form/insert/0");
            }
        }
    }

    public function cadastroParaUsuario()
    {
        $post = $this->request->getPost();

        if (!empty($_FILES['logo']['name'])) {

            $nomeRetornado = $this->files->upload($_FILES, 'estabelecimento');

            // se for boolean, significa que o upload falhou
            if (is_bool($nomeRetornado)) {
                Session::set('inputs', $post);
                return Redirect::page($this->controller . "/cadastro" . $post['id'], ["msgError" => "Erro ao fazer upload da nova imagem."]);
            } else {
                $post['logo'] = $nomeRetornado[0];

                if (!empty($post['nomeImagem'])) {
                    $this->files->delete($post['nomeImagem'], "estabelecimento");
                }
            }
        } else {
            $post['logo'] = $post['nomeImagem'];
        }

        // Inserção via insertGetId() que retorna o ID real
        $id = $this->model->insertGetId($post);

        if ($id > 0) {
            Session::set('ultimo_id_estab', $id);
            return Redirect::page("usuario/cadastroUsuarioFinal");
        } else {
            Session::set('inputs', $post);
            return Redirect::page($this->controller . "/cadastro", ["msgError" => "Erro ao cadastrar Empresa."]);
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