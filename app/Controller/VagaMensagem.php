<?php

namespace App\Controller;

use Core\Library\ControllerMain;
use Core\Library\Session;
use Core\Library\Redirect;

class VagaMensagem extends ControllerMain
{
    public function __construct()
    {
        $this->auxiliarconstruct();
        $this->loadHelper('formHelper');
    }

    public function enviar($vagaId, $curriculumId)
    {   
        $post = $this->request->getPost();
        $mensagem = trim($post['mensagem'] ?? '');

        if (empty($mensagem)) {
            return Redirect::page("vaga/vaga_detalhada/$vagaId", [
                'msgError' => 'Mensagem não pode estar vazia.'
            ]);
        }

        $remetenteTipo = Session::get('userTipo'); // 'PF' ou 'EMPRESA'
        $remetenteId   = $remetenteTipo === 'PF'
            ? Session::get('userPfId')
            : Session::get('userEstabId');

        $dados = [
            'vaga_id' => $vagaId,
            'curriculum_id' => $curriculumId,
            'remetente_tipo' => $remetenteTipo,
            'remetente_id' => $remetenteId,
            'mensagem' => $mensagem
        ];

        $this->model->insert($dados);

        return Redirect::page("vagaMensagem/listar/$vagaId/$curriculumId");
    }

    public function listar($vagaId, $curriculumId)
    {
        $dadosMensagens = $this->model->listarMensagens($vagaId, $curriculumId);

        $dados = [
            'mensagens' => $dadosMensagens,
            'vaga_id' => $vagaId,
            'curriculum_id' => $curriculumId
        ];

        return $this->loadView("sistema/vaga_mensagem", $dados);
    }
}
