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
}