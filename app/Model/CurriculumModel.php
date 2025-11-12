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

    public function getCurriculoDetalhado($curriculumId)
    {
        return $this->db
            ->select("
                curriculum.curriculum_id,
                curriculum.pessoa_fisica_id,
                curriculum.nome,
                curriculum.email,
                curriculum.celular,
                curriculum.logradouro,
                curriculum.numero,
                curriculum.complemento,
                curriculum.bairro,
                curriculum.cep,
                curriculum.foto,
                curriculum.curriculo_arquivo,
                curriculum.dataNascimento,
                cidade.cidade,
                cidade.uf,
                pessoa_fisica.data_criacao,
                curriculum.apresentacaoPessoal
            ")
            ->join("pessoa_fisica", "pessoa_fisica.pessoa_fisica_id = curriculum.pessoa_fisica_id", "INNER")
            ->join("cidade", "cidade.cidade_id = curriculum.cidade_id", "LEFT")
            ->where("curriculum.curriculum_id", $curriculumId)
            ->first();
    }

    public function getEscolaridades($curriculumId)
    {
        return $this->db
            ->select("
                curriculum_escolaridade.curriculum_escolaridade_id,
                curriculum_escolaridade.descricao,
                curriculum_escolaridade.instituicao,
                curriculum_escolaridade.inicioMes,
                curriculum_escolaridade.inicioAno,
                curriculum_escolaridade.fimMes,
                curriculum_escolaridade.fimAno,
                cidade.cidade,
                cidade.uf,
                escolaridade.descricao AS escolaridade
            ")
            ->join("escolaridade", "escolaridade.escolaridade_id = curriculum_escolaridade.escolaridade_id", "LEFT")
            ->join("cidade", "cidade.cidade_id = curriculum_escolaridade.cidade_id", "LEFT")
            ->where("curriculum_escolaridade.curriculum_id", $curriculumId)
            ->table("curriculum_escolaridade")
            ->findAll();
    }

    public function getExperiencias($curriculumId)
    {
        return $this->db
            ->select("
                curriculum_experiencia.curriculum_experiencia_id,
                curriculum_experiencia.estabelecimento,
                curriculum_experiencia.atividadesExercidas,
                curriculum_experiencia.inicioMes,
                curriculum_experiencia.inicioAno,
                curriculum_experiencia.fimMes,
                curriculum_experiencia.fimAno,
                cargo.descricao AS cargo
            ")
            ->join("cargo", "cargo.cargo_id = curriculum_experiencia.cargo_id", "LEFT")
            ->where("curriculum_experiencia.curriculum_id", $curriculumId)
            ->table("curriculum_experiencia")
            ->findAll();
    }

    public function getIdiomas($curriculumId)
    {
        return $this->db
            ->select("
                curriculum_idioma.curriculum_idioma_id,
                idioma.descricao AS idioma,
                curriculum_idioma.nivel
            ")
            ->join("idioma", "idioma.idioma_id = curriculum_idioma.idioma_id", "LEFT")
            ->where("curriculum_idioma.curriculum_id", $curriculumId)
            ->table("curriculum_idioma")
            ->findAll();
    }

    public function getQualificacoes($curriculumId)
    {
        return $this->db
            ->select("
                curriculum_qualificacao.curriculum_qualificacao_id,
                curriculum_qualificacao.descricao,
                curriculum_qualificacao.instituicao,
                curriculum_qualificacao.mes,
                curriculum_qualificacao.ano,
                curriculum_qualificacao.cargaHoraria
            ")
            ->where("curriculum_qualificacao.curriculum_id", $curriculumId)
            ->table("curriculum_qualificacao")
            ->findAll();
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