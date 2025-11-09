<?php

namespace App\Controller;

use Core\Library\ControllerMain;
use Core\Library\Files;
use Core\Library\Redirect;
use Core\Library\Session;
use Core\Library\Validator;

class CurriculumIdioma extends ControllerMain
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
        return $this->loadView("sistema/cadastro_curriculo");
    }

    /**
     * insert
     *
     * @return void
     */
    public function insert()
    {
        $post = $this->request->getPost();

        // Recupera o Id do currículo salvo na sessão
        $idCurriculo = Session::get('curriculo_id');

        if (!$idCurriculo) {
            return Redirect::page("curriculum/index", ["msgError" => "Você precisa cadastrar seu currículo antes de adicionar um idioma."]);
        }
        
        $post['curriculum_id'] = $idCurriculo;

        // Se não existir o campo no formulário atribui ele como nulo, caso contrário converte para inteiro
        $idIdioma = isset($post['curriculum_idioma_id']) ? (int)$post['curriculum_idioma_id'] : null;

        $existe = $this->model->existeDuplicado(
            $idCurriculo, 
            $post['idioma_id'],
            $idIdioma
        );

        if ($existe) {
            return Redirect::page("curriculum/index", ["msgAlerta" => "Você já cadastrou este idioma anteriormente."]);
        }

        // Valida os dados
        if (Validator::make($post, $this->model->validationRules)) {
            Session::set('inputs', $post);
            return Redirect::page("curriculum/index", ["msgError" => "Preencha os campos obrigatórios corretamente."]);
        }

        // Faz o insert
        if ($this->model->insert($post)) {
            return Redirect::page("curriculum/index", ["msgSucesso" => "Idioma cadastrado com sucesso!"]);
        } else {
            Session::set('inputs', $post);
            return Redirect::page("curriculum/index", ["msgError" => "Erro ao cadastrar o idioma."]);
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

        $curriculoExistente = $this->model->getCurriculumIdiomaById($post['curriculum_idioma_id']);
        $dadosAlterados = array_diff_assoc($post, $curriculoExistente[0]);
        if (empty($dadosAlterados)) {
            // Nenhum campo foi modificado
            return Redirect::page("curriculum/index", ["msgAlerta" => "Nenhuma alteração detectada no currículo."]);
        }

        // Se não existir o campo no formulário atribui ele como nulo, caso contrário converte para inteiro
        $idIdioma = isset($post['curriculum_idioma_id']) ? (int)$post['curriculum_idioma_id'] : null;

        $existe = $this->model->existeDuplicado(
            $idCurriculo, 
            $post['idioma_id'],
            $idIdioma
        );

        if ($existe) {
            return Redirect::page("curriculum/index", ["msgAlerta" => "Você já cadastrou este idioma anteriormente."]);
        }

        if (Validator::make($post, $this->model->validationRules)) {
            Session::set("inputs", $post);
            return Redirect::page("curriculum/index", ["msgError" => "Preencha os campos corretamente"]);
        } else {
            if ($this->model->update($post)) {
                return Redirect::page("curriculum/index", ["msgSucesso" => "Registro alterado com sucesso."]);
            } else {
                Session::set("inputs", $post);
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
        var_dump($id);
        if (empty($id)) {
            return Redirect::page("curriculum/index", ["msgError" => "ID do currículo idioma inválido."]);
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
            return Redirect::page("curriculum/index", ["msgSucesso" => "Currículo de idioma excluído com sucesso!"]);
        } else {
            return Redirect::page("curriculum/index", ["msgError" => "Erro ao excluir idioma de experiência."]);
        }
    }
}