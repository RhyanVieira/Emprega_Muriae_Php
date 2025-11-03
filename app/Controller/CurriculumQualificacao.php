<?php

namespace App\Controller;

use Core\Library\ControllerMain;
use Core\Library\Files;
use Core\Library\Redirect;
use Core\Library\Session;
use Core\Library\Validator;

class CurriculumQualificacao extends ControllerMain
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
        return $this->loadView("sistema/cadastrar_curriculo");
    }

    public function insert()
    {
        $post = $this->request->getPost();

        // Recupera o Id do currículo salvo na sessão
        $idCurriculo = Session::get('curriculo_id');

        if (!$idCurriculo) {
            return Redirect::page("curriculum/index", ["msgError" => "Você precisa cadastrar seu currículo antes de adicionar a escolaridade."]);
        }

        $post['curriculum_id'] = $idCurriculo;

        // Evita duplicidade (mesma empresa + mesmo cargo)
        $existe = $this->model->existeQualificacao(
            $idCurriculo,
            $post['instituicao'],
            $post['descricao'],
        );

        if ($existe) {
            return Redirect::page("curriculum/index", ["msgError" => "Essa qualificação já foi cadastrada anteriormente."]);
        }

        // Valida os dados
        if (Validator::make($post, $this->model->validationRules)) {
            Session::set('inputs', $post);
            return Redirect::page("curriculum/index", ["msgError" => "Preencha os campos obrigatórios corretamente."]);
        }

        // Faz o insert
        if ($this->model->insert($post)) {
            return Redirect::page("curriculum/index", ["msgSucesso" => "Qualificação cadastrada com sucesso!"]);
        } else {
            Session::set('inputs', $post);
            return Redirect::page("curriculum/index", ["msgError" => "Erro ao cadastrar a escolaridade."]);
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

        // Recupera o Id do currículo salvo na sessão
        $idCurriculo = Session::get('curriculo_id');

        if (!$idCurriculo) {
            return Redirect::page("curriculum/index", ["msgError" => "Você precisa cadastrar seu currículo antes de adicionar uma qualificação."]);
        }

        $post['curriculum_id'] = $idCurriculo;

                // Evita duplicidade (mesma empresa + mesmo cargo)
        $existe = $this->model->existeQualificacao(
            $idCurriculo,
            $post['instituicao'],
            $post['descricao'],
        );

        if ($existe) {
            return Redirect::page("curriculum/index", ["msgError" => "Essa qualificação já foi cadastrada anteriormente."]);
        }

        if (Validator::make($post, $this->model->validationRules)) {
            return Redirect::page("curriculum/index", ["msgError" => "Preencha os campos corretamente"]);
        } else {
            if ($this->model->update($post)) {
                return Redirect::page("curriculum/index", ["msgSucesso" => "Registro alterado com sucesso."]);
            } else {
                return Redirect::page("curriculum/index", ["msgError" => "Erro na atualização do registro."]);
            }
        }
    }

    /**
     * delete
     *
     * @return void
     */
    public function delete($id = null)
    {
        if (empty($id)) {
            return Redirect::page("curriculum/index", ["msgError" => "ID do currículo qualificação inválido."]);
        }

        $idCurriculo = Session::get('curriculo_id');
        if (empty($idCurriculo)) {
            return Redirect::page("login", ["msgError" => "Faça login para continuar."]);
        }

        $registro = $this->model->idExclusao($idCurriculo, $id);

        if (!$registro) {
            return Redirect::page("curriculum/index", ["msgError" => "Currículo não encontrado ou acesso negado."]);
        }

        // Exclui o registro do banco
        if ($this->model->delete($id)) {
            return Redirect::page("curriculum/index", ["msgSucesso" => "Currículo de qualificação excluído com sucesso!"]);
        } else {
            return Redirect::page("curriculum/index", ["msgError" => "Erro ao excluir qualificação de experiência."]);
        }
    }
}