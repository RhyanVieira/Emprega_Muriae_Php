<?php

namespace App\Model;

use Core\Library\ModelMain;

class CurriculumQualificacaoModel extends ModelMain
{
    protected $table = "curriculum_qualificacao";
    protected $primaryKey = "curriculum_qualificacao_id";
    
    public $validationRules = [
        "curriculum_id"  => [
            "label" => 'Curriculum Id',
            "rules" => 'required|int'
        ],
        "mes"  => [
            "label" => 'Mês',
            "rules" => 'required|int'
        ],
        "ano"  => [
            "label" => 'Ano',
            "rules" => 'required|int'
        ],
        "cargaHoraria"  => [
            "label" => 'Carga Horária',
            "rules" => 'required|int'
        ],
        "descricao"  => [
            "label" => 'Descrição',
            "rules" => 'required|min:3|max:60'
        ],
        "instituicao"  => [
            "label" => 'Instituição',
            "rules" => 'required|min:3|max:60'
        ],
    ];

    public function existeQualificacao($idCurriculo, $instituicao, $descricao)
    {
        return $this->db
            ->select('curriculum_qualificacao_id')
            ->where('curriculum_id', $idCurriculo)
            ->where('instituicao', $instituicao)
            ->where('descricao', $descricao)
            ->findAll();
    }

    public function getByCurriculumQuaId($curriculumId)
    {
        return $this->db->select()
                        ->where('curriculum_id', $curriculumId)
                        ->findAll();
    }

    public function idExclusao($curriculumId, $curriculumQualificacaoId)
    {
        return $this->db->select()
                        ->where('curriculum_id', $curriculumId)
                        ->where('curriculum_qualificacao_id', $curriculumQualificacaoId)
                        ->findAll();
    }
}