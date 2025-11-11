<?php

namespace App\Model;

use Core\Library\ModelMain;

class VagaCurriculumModel extends ModelMain
{
    protected $table = "vaga_curriculum";

    public $validationRules = [
        'vaga_id' => [
            'label' => 'Vaga', 
            'rules' => 'required|int'
        ],
        'curriculum_id' => [
            'label' => 'Currículo', 
            'rules' => 'required|int'
        ],
        'mensagem' => [
            'label' => 'Mensagem',
            'rules' => 'nullable|string'
        ],
        'statusCandidatura' => [
            'label' => 'Status', 
            'rules' => 'int'
        ]
    ];

    public function existeCandidatura($vagaId, $curriculumId)
    {
        return $this->db
            ->select()
            ->where('vaga_id', $vagaId)
            ->where('curriculum_id', $curriculumId)
            ->first();
    }

    public function listarCandidatosPorVaga($vagaId)
    {
        return $this->db
            ->select("
                vaga_curriculum.curriculum_id,
                vaga_curriculum.statusCandidatura,
                vaga_curriculum.dateCandidatura,
                c.nome AS nome_candidato,
                c.foto,
                ci.cidade,
                ci.uf
            ")
            ->join("curriculum AS c", "c.curriculum_id = vaga_curriculum.curriculum_id", "INNER")
            ->join("cidade AS ci", "ci.cidade_id = c.cidade_id", "LEFT")
            ->where("vaga_curriculum.vaga_id", $vagaId)
            ->findAll();
    }
}