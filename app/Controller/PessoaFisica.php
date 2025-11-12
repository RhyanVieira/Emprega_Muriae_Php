<?php

namespace App\Controller;

use App\Model\CurriculumExperienciaModel;
use App\Model\CurriculumQualificacaoModel;
use App\Model\CurriculumIdiomaModel;
use App\Model\CurriculumEscolaridadeModel;
use App\Model\EscolaridadeModel;
use App\Model\Curriculum;
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
    public function index($pagina = 1)
    {   
        $aParametros        = Self::getRotaParametros();
        $filtros = $aParametros['get'];
        unset($filtros['parametros']);

        $CargoModel = new CargoModel();
        $CidadeModel = new CidadeModel();
        $IdiomaModel = new IdiomaModel();
        $CurriculumModel = new CurriculumModel();

        $limite = 6; // número de candidatos por página
        $offset = ((int)$pagina - 1) * $limite;

        $totalRegistros = $CurriculumModel->countCurriculosPublicos($filtros); // retorna total de candidatos com perfil público no banco
        $totalPaginas = ceil($totalRegistros / $limite);

        $dados = [
            'aCidade' => $CidadeModel->lista('cidade'),
            'aCargo' => $CargoModel->lista('descricao'),
            'aIdioma' => $IdiomaModel->lista('descricao'),
            'aCurriculos' => $CurriculumModel->listarCurriculos($filtros, $limite, $offset),
            'paginaAtual' => (int)$pagina,
            'totalPaginas' => (int)$totalPaginas,
            'filtros' => $filtros,
            'totalRegistros' => $totalRegistros
        ];
        return $this->loadView("sistema/candidatos", $dados);
    }

    public function perfil($id = 0){
        $CurriculumModel = new CurriculumModel();

        $curriculoExistente = null;

        // Busca o currículo existente (se houver)
        $curriculoExistente = $CurriculumModel->getByPessoaFisicaId($id);

        if ($curriculoExistente) {
            if (!empty($curriculoExistente['curriculum_id'])) {
                    $curriculum      = $CurriculumModel->getCurriculoDetalhado($curriculoExistente['curriculum_id']);
                    $escolaridades  = $CurriculumModel->getEscolaridades($curriculoExistente['curriculum_id']);
                    $experiencias   = $CurriculumModel->getExperiencias($curriculoExistente['curriculum_id']);
                    $idiomas        = $CurriculumModel->getIdiomas($curriculoExistente['curriculum_id']);
                    $qualificacoes  = $CurriculumModel->getQualificacoes($curriculoExistente['curriculum_id']);
            }
        } else{
            return Redirect::page("curriculum", ["msgError" => "É necessário cadastrar um currículo."]);
        }

        $dados = [
            'curriculo' => $curriculum,
            'escolaridades' => $escolaridades,
            'experiencias' => $experiencias,
            'qualificacoes' => $qualificacoes,
            'idiomas' => $idiomas
        ];  

        return $this->loadView("sistema/perfil_candidato", $dados);
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
            return Redirect::page($this->controller . "/cadastro", ["msgError" => "Erro ao cadastrar."]);
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