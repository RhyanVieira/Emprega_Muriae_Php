<?php

namespace App\Model;

use Core\Library\ModelMain;

class CurriculumModel extends ModelMain
{
    protected $table = "curriculum";
    protected $primaryKey = "curriculum_id";
    
    public $validationRules = [
        "pessoa_fisica_id"  => [
            "label" => 'Pessoa Física Id',
            "rules" => 'required|int'
        ],
        "nome"  => [
            "label" => 'Nome',
            "rules" => 'required|min:5|max:60'
        ],
        "logradouro"  => [
            "label" => 'Logradouro',
            "rules" => 'required|min:3|max:60'
        ],
        "numero"  => [
            "label" => 'Número',
            "rules" => 'max:10'
        ],
        "complemento"  => [
            "label" => 'Complemento',
            "rules" => 'max:20'
        ],
        "bairro"  => [
            "label" => 'Bairro',
            "rules" => 'required|min:3|max:50'
        ],
        "complemento"  => [
            "label" => 'Complemento',
            "rules" => 'required|min:3|max:20'
        ],
        "cep"  => [
            "label" => 'CEP',
            "rules" => 'required|min:8|max:8'
        ],
        "cidade_id"  => [
            "label" => 'Cidade',
            "rules" => 'required|int'
        ],
        "celular"  => [
            "label" => 'Celular',
            "rules" => 'required|min:11|max:11'
        ],
        "dataNascimento"  => [
            "label" => 'Data de Nascimento',
            "rules" => 'required|date'
        ],
        "sexo"  => [
            "label" => 'Sexo',
            "rules" => 'required|min:1|max:1'
        ],
        "email"  => [
            "label" => 'Email',
            "rules" => 'required|min:3|max:120'
        ],
        "apresentacaoPessoal"  => [
            "label" => 'Apresentação Pessoal',
            "rules" => 'max:1000'
        ],
    ];

    public function getByPessoaFisicaId($pessoaFisicaId)
    {
        return $this->db
            ->select()
            ->where("pessoa_fisica_id", $pessoaFisicaId)
            ->first();
    }

    public function listarCurriculos($filtros, $limite, $offset)
    {
        $query = $this->db
            ->select("
                curriculum.curriculum_id,
                curriculum.nome,
                curriculum.foto,
                curriculum.dataNascimento,
                TIMESTAMPDIFF(YEAR, curriculum.dataNascimento, CURDATE()) AS idade,
                pf.data_criacao,
                pf.pessoa_fisica_id,
                ci.cidade,
                ci.uf,
                GROUP_CONCAT(DISTINCT cq.descricao ORDER BY cq.descricao SEPARATOR ', ') AS qualificacoes,
                GROUP_CONCAT(DISTINCT i.descricao ORDER BY i.descricao SEPARATOR ', ') AS idiomas,
                GROUP_CONCAT(DISTINCT cg.descricao ORDER BY cg.descricao SEPARATOR ', ') AS cargos
            ")
            ->join("pessoa_fisica AS pf", "pf.pessoa_fisica_id = curriculum.pessoa_fisica_id", "INNER")
            ->join("cidade AS ci", "ci.cidade_id = curriculum.cidade_id", "LEFT")
            ->join("curriculum_qualificacao AS cq", "cq.curriculum_id = curriculum.curriculum_id", "LEFT")
            ->join("curriculum_idioma AS ci2", "ci2.curriculum_id = curriculum.curriculum_id", "LEFT")
            ->join("idioma AS i", "i.idioma_id = ci2.idioma_id", "LEFT")
            ->join("curriculum_experiencia AS ce", "ce.curriculum_id = curriculum.curriculum_id", "LEFT")
            ->join("cargo AS cg", "cg.cargo_id = ce.cargo_id", "LEFT")
            ->where("pf.perfil_publico", 1);

        if (!empty($filtros['cidade_id'])) {
            $query->where("curriculum.cidade_id", (int)$filtros['cidade_id']);
        }

        if (!empty($filtros['cargo_id'])) {
            $query->where("cg.cargo_id", (int)$filtros['cargo_id']);
        }

        if (!empty($filtros['idioma_id'])) {
            $query->where("i.idioma_id", (int)$filtros['idioma_id']);
        }

        if (!empty($filtros['faixaEtaria'])) {
            $faixa = $filtros['faixaEtaria'];
            if (preg_match('/(\d+)-(\d+)/', $faixa, $m)) {
                $idadeMin = (int)$m[1];
                $idadeMax = (int)$m[2];
                $query->whereRaw("TIMESTAMPDIFF(YEAR, curriculum.dataNascimento, CURDATE()) BETWEEN $idadeMin AND $idadeMax");
            } elseif ($faixa === '50+') {
                $query->whereRaw("TIMESTAMPDIFF(YEAR, curriculum.dataNascimento, CURDATE()) >= 50");
            }
        }

        return $query
            ->groupBy("
                curriculum.curriculum_id,
                curriculum.nome,
                curriculum.foto,
                curriculum.dataNascimento,
                ci.cidade,
                pf.data_criacao
            ")
            ->orderBy("
                (
                    (CASE WHEN COUNT(DISTINCT cq.descricao) > 0 THEN 1 ELSE 0 END) +
                    (CASE WHEN COUNT(DISTINCT i.descricao) > 0 THEN 1 ELSE 0 END) +
                    (CASE WHEN COUNT(DISTINCT cg.descricao) > 0 THEN 1 ELSE 0 END)
                ) DESC
            ")
            ->orderBy("RAND()")
            ->limit($limite)
            ->offset($offset)
            ->findAll();
    }

    public function countCurriculosPublicos($filtros)
    {
        $query = $this->db
            ->select("COUNT(DISTINCT curriculum.curriculum_id) AS total")
            ->join("pessoa_fisica AS pf", "pf.pessoa_fisica_id = curriculum.pessoa_fisica_id", "INNER")
            ->join("cidade AS ci", "ci.cidade_id = curriculum.cidade_id", "LEFT")
            ->join("curriculum_qualificacao AS cq", "cq.curriculum_id = curriculum.curriculum_id", "LEFT")
            ->join("curriculum_idioma AS ci2", "ci2.curriculum_id = curriculum.curriculum_id", "LEFT")
            ->join("idioma AS i", "i.idioma_id = ci2.idioma_id", "LEFT")
            ->join("curriculum_experiencia AS ce", "ce.curriculum_id = curriculum.curriculum_id", "LEFT")
            ->join("cargo AS cg", "cg.cargo_id = ce.cargo_id", "LEFT")
            ->where("pf.perfil_publico", 1);

        if (!empty($filtros['cidade_id'])) {
            $query->where("curriculum.cidade_id", (int)$filtros['cidade_id']);
        }

        if (!empty($filtros['cargo_id'])) {
            $query->where("cg.cargo_id", (int)$filtros['cargo_id']);
        }

        if (!empty($filtros['idioma_id'])) {
            $query->where("i.idioma_id", (int)$filtros['idioma_id']);
        }

        if (!empty($filtros['faixaEtaria'])) {
            $faixa = $filtros['faixaEtaria'];
            if (preg_match('/(\d+)-(\d+)/', $faixa, $m)) {
                $idadeMin = (int)$m[1];
                $idadeMax = (int)$m[2];
                $query->whereRaw("TIMESTAMPDIFF(YEAR, curriculum.dataNascimento, CURDATE()) BETWEEN $idadeMin AND $idadeMax");
            } elseif ($faixa === '50+') {
                $query->whereRaw("TIMESTAMPDIFF(YEAR, curriculum.dataNascimento, CURDATE()) >= 50");
            }
        }

        return $query
            ->first()['total'];
    }
}