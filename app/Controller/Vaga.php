<?php

namespace App\Controller;

use App\Model\CidadeModel;
use App\Model\CargoModel;
use App\Model\CategoriaVagaModel;
use App\Model\EstabelecimentoModel;
use App\Model\CurriculumModel;
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
    public function index($pagina = 1)
    {    
        $aParametros        = Self::getRotaParametros();
        $filtros = $aParametros['get'];
        unset($filtros['parametros']);

        $CidadeModel = new CidadeModel();
        $CategoriaVagaModel = new CategoriaVagaModel();

        $limite = 6; // número de vagas por página
        $offset = ((int)$pagina - 1) * $limite;

        $totalRegistros = $this->model->countVagas($filtros); // retorna total de vagas no banco
        $totalPaginas = ceil($totalRegistros / $limite);

        $aVagas = $this->model->listarVagas($filtros, $limite, $offset);

        $dados = [
            'aVagas' => $aVagas,
            'paginaAtual' => (int)$pagina,
            'totalPaginas' => (int)$totalPaginas,
            'aCidade' => $CidadeModel->lista('cidade'),
            'aCategoriaVaga' => $CategoriaVagaModel->lista('descricao'),
            'filtros' => $filtros,
            'totalRegistros' => $totalRegistros
        ];

        return $this->loadView("sistema/vagas", $dados);
    }

    public function vaga_detalhada($id)
    {   
        $CurriculumModel = new CurriculumModel();

        $vaga = $this->model->getVagaPorId($id);

        $idPf = Session::get('userPfId');

        $curriculum = $CurriculumModel->getByPessoaFisicaId($idPf);

        if (!$vaga) {
            return Redirect::page('vaga/index');
        }

        $dados = [
            'vaga' => $vaga,
            'curriculum' => $curriculum
        ];

        return $this->loadView("sistema/vaga_detalhada", $dados);
    }

    public function minhas_vagas($pagina = 1)
    {   
        $usuario = Session::get('userEstabId');

        if (empty($usuario)) {
            return Redirect::page('login', ['msgError' => 'É necessário estar logado como empresa para acessar suas vagas.']);
        }

        $EstabelecimentoModel = new EstabelecimentoModel();
        $EstabelecimentoInfo = $EstabelecimentoModel->getInfoCompleta($usuario);

        $limite = 6; // número de vagas por página
        $offset = ((int)$pagina - 1) * $limite;

        $totalRegistros = $EstabelecimentoInfo['total_vagas'];// retorna total de vagas no banco
        $totalPaginas = ceil($totalRegistros / $limite);

        $vagas = $this->model->listarVagasPorEmpresa($usuario, $limite, $offset);

        $dados = [
            'vagas' => $vagas,
            'estabelecimento' => $EstabelecimentoInfo,
            'paginaAtual' => (int)$pagina,
            'totalPaginas' => (int)$totalPaginas,
            'totalRegistros' => $totalRegistros
        ];

        return $this->loadView("sistema/minhas_vagas", $dados);
    }

    public function vagas_empresa($pagina = 1, $idEstab = 0)
    {   

        $EstabelecimentoModel = new EstabelecimentoModel();
        $EstabelecimentoInfo = $EstabelecimentoModel->getInfoCompleta($idEstab);

        $limite = 6; // número de vagas por página
        $offset = ((int)$pagina - 1) * $limite;

        $totalRegistros = $this->model->countVagasAbertasPorEmpresa($idEstab);// retorna total de vagas no banco
        $totalPaginas = ceil($totalRegistros / $limite);

        $vagas = $this->model->listarVagasAbertasPorEmpresa($idEstab, $limite, $offset);

        $dados = [
            'vagas' => $vagas,
            'estabelecimento' => $EstabelecimentoInfo,
            'paginaAtual' => (int)$pagina,
            'totalPaginas' => (int)$totalPaginas,
            'totalRegistros' => $totalRegistros
        ];

        return $this->loadView("sistema/vagas_empresa", $dados);
    }

    public function form($modo = 'insert', $vagaId = 0)
    {   
        if (!Session::get('userEstabId')) {
            return Redirect::page('login', ['msgError' => 'Faça login para continuar.']);
        }

        $CargoModel = new CargoModel();
        $CidadeModel = new CidadeModel();
        $CategoriaVagaModel = new CategoriaVagaModel();

        if ($modo === 'update' && $vagaId > 0) {
            $vaga = $this->model->getVagaPorId($vagaId);

            if (empty($vaga)) {
                return Redirect::page('vaga/minhas_vagas', ['msgError' => 'Vaga não encontrada.']);
            }
        } else{
            $vaga = [];
        }

        $dados = [
            'aCidade' => $CidadeModel->lista('cidade'),
            'aCargo' => $CargoModel->lista('descricao'),
            'aCategoriaVaga' => $CategoriaVagaModel->lista('descricao'),
            'vaga' => $vaga,
            'modo' => $modo
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
                return Redirect::page($this->controller . "/minhas_vagas/1", ["msgSucesso" => "Vaga cadastrada com sucesso."]);
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
            return Redirect::page($this->controller . "/form/update/" . $post['vaga_id'], ["msgError" => "Preencha os campos obrigatórios corretamente."]);    // error
        } else {
            if ($this->model->update($post)) {
                return Redirect::page($this->controller . "/minhas_vagas/1", ["msgSucesso" => "Registro alterado com sucesso."]);
            } else {
                return Redirect::page($this->controller . "/form/update/" . $post['vaga_id'], ["msgError" => "Erro ao atualizar vaga"]);
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