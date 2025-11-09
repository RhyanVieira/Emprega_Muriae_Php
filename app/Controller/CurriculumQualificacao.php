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

        // Se não existir o campo no formulário atribui ele como nulo, caso contrário converte para inteiro
        $idQualificacao = isset($post['curriculum_qualificacao_id']) ? (int)$post['curriculum_qualificacao_id'] : null;

        // Evita duplicidade (mesma empresa + mesmo curso)
        $existe = $this->model->existeQualificacao(
            $idCurriculo,
            $post['instituicao'],
            $post['descricao'],
            $idQualificacao,
        );

        if ($existe) {
            return Redirect::page("curriculum/index", ["msgAlerta" => "Essa qualificação já foi cadastrada anteriormente."]);
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
        $post['curriculum_id'] = $idCurriculo;

        $curriculoExistente = $this->model->getCurriculumQualificacaoById($post['curriculum_qualificacao_id']);
        $dadosAlterados = array_diff_assoc($post, $curriculoExistente[0]);
        if (empty($dadosAlterados)) {
            // Nenhum campo foi modificado
            return Redirect::page("curriculum/index", ["msgAlerta" => "Nenhuma alteração detectada no currículo."]);
        }

        // Se não existir o campo no formulário atribui ele como nulo, caso contrário converte para inteiro
        $idQualificacao = isset($post['curriculum_qualificacao_id']) ? (int)$post['curriculum_qualificacao_id'] : null;

        // Evita duplicidade (mesma empresa + mesmo curso)
        $existe = $this->model->existeQualificacao(
            $idCurriculo,
            $post['instituicao'],
            $post['descricao'],
            $idQualificacao,
        );

        if ($existe) {
            return Redirect::page("curriculum/index", ["msgAlerta" => "Essa qualificação já foi cadastrada anteriormente."]);
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