<?php

namespace App\Controller;

use Core\Library\ControllerMain;
use Core\Library\Files;
use Core\Library\Redirect;
use Core\Library\Session;
use Core\Library\Validator;
use App\Model\PessoaFisicaModel;
use App\Model\CidadeModel;
use App\Model\CargoModel;
use App\Model\IdiomaModel;
use App\Model\CurriculumModel;

class PessoaFisica extends ControllerMain
{
    protected $files;

    public function __construct()
    {
        $this->auxiliarconstruct();
        $this->loadHelper('formHelper');
        $this->files = new Files();
        $this->model = new PessoaFisicaModel();
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $CargoModel = new CargoModel();
        $CidadeModel = new CidadeModel();
        $IdiomaModel = new IdiomaModel();
        $CurriculumModel = new CurriculumModel();

        $dados = [
            'aCidade' => $CidadeModel->lista('cidade'),
            'aCargo' => $CargoModel->lista('descricao'),
            'aIdioma' => $IdiomaModel->lista('descricao'),
            'curriculosPublicos' => $CurriculumModel->listarCurriculosPublicos(),
        ];
        return $this->loadView("sistema/candidatos", $dados);
    }

    public function cadastro(){
        return $this->loadView("sistema/cadastro_pessoa_fisica");
    }

    public function cadastroParaUsuario()
    {
        $post = $this->request->getPost();

        $post['perfil_publico'] = !empty($post['perfil_publico']) && $post['perfil_publico'] == '1' ? 1 : 2;

        // Inserção via insertGetId() que retorna o ID real
        $id = $this->model->insertGetId($post);

        if ($id > 0) {
            Session::set('ultimo_id_pf', $id);
            return Redirect::page("usuario/cadastroUsuarioFinal");
        } else {
            Session::set('inputs', $post);
            return Redirect::page($this->controller . "/cadastro", ["msgError" => "Erro ao cadastrar Pessoa Física."]);
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