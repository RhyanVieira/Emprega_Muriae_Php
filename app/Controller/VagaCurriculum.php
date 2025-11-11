<?php

namespace App\Controller;

use Core\Library\ControllerMain;
use Core\Library\Files;
use Core\Library\Redirect;
use Core\Library\Session;
use Core\Library\Validator;
use App\Model\CurriculumModel;
use App\Model\VagaModel;

class VagaCurriculum extends ControllerMain
{
    protected $files;

    public function __construct()
    {
        $this->auxiliarconstruct();
        $this->loadHelper('formHelper');
        $this->files = new Files();
    }

    public function candidatar($vagaId)
    {
        $userId = Session::get('userPfId');
        $post = $this->request->getPost();
        $mensagem =  $post['mensagem'];

        // Se o usuário não estiver logado, redireciona para login
        if (!$userId) {
            return Redirect::page('login', ['msgError' => 'Você precisa estar logado para se candidatar.']);
        }

        // Pega o curriculum vinculado ao usuário logado
        $curriculumModel = new CurriculumModel();
        $curriculum = $curriculumModel->getByPessoaFisicaId($userId);

        if (!$curriculum) {
            return Redirect::page('curriculum/form', ['msgError' => 'Crie seu currículo antes de se candidatar.']);
        }

        // Verifica se já se candidatou
        $jaExiste = $this->model->existeCandidatura($vagaId, $curriculum['curriculum_id']);

        if ($jaExiste) {
            return Redirect::page("vaga/vaga_detalhada/$vagaId", ['msgError' => 'Você já se candidatou a esta vaga.']);
        }

        // Cria a candidatura
        $dados = [
            'vaga_id' => $vagaId,
            'curriculum_id' => $curriculum['curriculum_id'],
            'statusCandidatura' => 1,
            'mensagem' => $mensagem
        ];

        $this->model->insert($dados);

        return Redirect::page("vaga/vaga_detalhada/$vagaId", ['msgSucesso' => 'Candidatura enviada com sucesso!']);
    }

    public function candidatos($vagaId)
    {
        $empresaId = Session::get('userEstabId');

        // Verificar se a vaga realmente pertence à empresa logada
        $vagaModel = new VagaModel();
        $vaga = $vagaModel->getVagaPorId($vagaId);

        if (!$vaga || $vaga['estabelecimento_id'] != $empresaId) {
            return Redirect::page('vaga/minhas_vagas', ['msgError' => 'Acesso não autorizado.']);
        }

        $candidatos = $this->model->listarCandidatosPorVaga($vagaId);

        $dados = [
            'vaga' => $vaga,
            'candidatos' => $candidatos
        ];
        
        return $this->loadView("sistema/candidatos_vagas", $dados);
    }
}