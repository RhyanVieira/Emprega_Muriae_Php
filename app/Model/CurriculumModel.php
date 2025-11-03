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

    public function listarCurriculosPublicos()
    {
        return $this->db
        ->select("
                c.curriculum_id,
                c.nome,
                c.foto,
                c.dataNascimento,
                TIMESTAMPDIFF(YEAR, c.dataNascimento, CURDATE()) AS idade,
                ci.cidade,
                ci.uf,
                GROUP_CONCAT(DISTINCT(cq.descricao) ORDER BY cq.descricao SEPARATOR ', ') AS qualificacoes,
                GROUP_CONCAT(DISTINCT(i.descricao) ORDER BY i.descricao SEPARATOR ', ') AS idiomas,
                GROUP_CONCAT(DISTINCT(cg.descricao) ORDER BY cg.descricao SEPARATOR ', ') AS cargos
            FROM curriculum AS c
            INNER JOIN pessoa_fisica AS pf 
                ON pf.pessoa_fisica_id = c.pessoa_fisica_id
            LEFT JOIN cidade AS ci 
                ON ci.cidade_id = c.cidade_id
            LEFT JOIN curriculum_qualificacao AS cq 
                ON cq.curriculum_id = c.curriculum_id
            LEFT JOIN curriculum_idioma AS ci2 
                ON ci2.curriculum_id = c.curriculum_id
            LEFT JOIN idioma AS i 
                ON i.idioma_id = ci2.idioma_id
            LEFT JOIN curriculum_experiencia AS ce 
                ON ce.curriculum_id = c.curriculum_id
            LEFT JOIN cargo AS cg 
                ON cg.cargo_id = ce.cargo_id
            WHERE pf.perfil_publico = 1
            GROUP BY 
                c.curriculum_id, c.nome, c.foto, c.dataNascimento, ci.cidade
            ORDER BY 
                c.nome ASC;
            "
        )
        ->findAll();
    }
}