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
        'statusCandidatura' => [
            'label' => 'Status', 
            'rules' => 'int'
        ],
        'dateCandidatura' =>[
            'label' => 'Data Candidatura',
            'rules' => 'datetime'
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
                c.pessoa_fisica_id,
                c.nome AS nome_candidato,
                c.foto,
                ci.cidade,
                ci.uf,
                TIMESTAMPDIFF(YEAR, c.dataNascimento, CURDATE()) AS idade,
                pf.data_criacao,
                GROUP_CONCAT(DISTINCT cq.descricao ORDER BY cq.ano DESC SEPARATOR ', ') AS qualificacoes,
                GROUP_CONCAT(
                    DISTINCT CONCAT(
                        i.descricao,
                        CASE ci2.nivel
                            WHEN 1 THEN ' (Básico)'
                            WHEN 2 THEN ' (Intermediário)'
                            WHEN 3 THEN ' (Avançado)'
                            WHEN 4 THEN ' (Fluente)'
                            WHEN 5 THEN ' (Nativo)'
                            ELSE ''
                        END
                    ) 
                    SEPARATOR ', '
                ) AS idiomas,
                GROUP_CONCAT(
                    DISTINCT (COALESCE(ca.descricao, ce.cargoDescricao))
                    SEPARATOR ', '
                ) AS cargos
            ")
            ->join("curriculum AS c", "c.curriculum_id = vaga_curriculum.curriculum_id", "INNER")
            ->join("pessoa_fisica AS pf", "pf.pessoa_fisica_id = c.pessoa_fisica_id", "INNER")
            ->join("cidade AS ci", "ci.cidade_id = c.cidade_id", "LEFT")
            ->join("curriculum_qualificacao AS cq", "cq.curriculum_id = c.curriculum_id", "LEFT")
            ->join("curriculum_idioma AS ci2", "ci2.curriculum_id = c.curriculum_id", "LEFT")
            ->join("idioma AS i", "i.idioma_id = ci2.idioma_id", "LEFT")
            ->join("curriculum_experiencia AS ce", "ce.curriculum_id = c.curriculum_id", "LEFT")
            ->join("cargo AS ca", "ca.cargo_id = ce.cargo_id", "LEFT")
            ->where("vaga_curriculum.vaga_id", $vagaId)
            ->groupBy("
                vaga_curriculum.curriculum_id, 
                c.pessoa_fisica_id,
                pf.data_criacao, 
                c.nome, 
                c.foto, 
                ci.cidade, 
                ci.uf, 
                c.dataNascimento, 
                vaga_curriculum.statusCandidatura, 
                vaga_curriculum.dateCandidatura
            ")
            ->orderBy("vaga_curriculum.dateCandidatura", "DESC")
            ->findAll();
    }


}