<?php

namespace App\Model;

use Core\Library\ModelMain;

class VagaMensagemModel extends ModelMain
{
    protected $table = 'vaga_mensagem';
    protected $primaryKey = 'id';

    public $validationRules = [
        'vaga_id' => [
            'label' => 'Vaga', 
            'rules' => 'required|int'
        ],
        'curriculum_id' => [
            'label' => 'Currículo', 
            'rules' => 'required|int'
        ],
        'remetente_tipo' => [
            'label' => 'Tipo de Remetente',
            'rules' => 'required|string'
        ],
        'remetente_id' =>[
            'label' => 'Remetente', 
            'rules' => 'required|int'
        ],
        'mensagem' => [
            'label' => 'Mensagem', 
            'rules' => 'required|string'
        ]
    ];

    public function listarMensagens($vagaId, $curriculumId)
    {
        return $this->db
            ->select("
                vaga_mensagem.*,
                CASE 
                    WHEN vaga_mensagem.remetente_tipo = 'PF' THEN c.nome 
                    ELSE e.nome 
                END AS remetente_nome,
                CASE 
                    WHEN vaga_mensagem.remetente_tipo = 'PF' THEN c.foto 
                    ELSE e.logo 
                END AS remetente_foto
            ")
            ->join("curriculum AS c", "c.curriculum_id = vaga_mensagem.curriculum_id", "LEFT")
            ->join("vaga AS v", "v.vaga_id = vaga_mensagem.vaga_id", "INNER")
            ->join("estabelecimento AS e", "e.estabelecimento_id = v.estabelecimento_id", "LEFT")
            ->where("vaga_mensagem.vaga_id", $vagaId)
            ->where("vaga_mensagem.curriculum_id", $curriculumId)
            ->orderBy("vaga_mensagem.data_envio", "ASC")
            ->findAll();
    }
}