<?php

namespace App\Model;

use Core\Library\ModelMain;
use Core\Library\Validator;

class PessoaFisicaModel extends ModelMain
{
    protected $table = "pessoa_fisica";
    
    public $validationRules = [
        "nome"  => [
            "label" => 'Nome',
            "rules" => 'required|min:3|max:60'
        ],
        "cpf"  => [
            "label" => 'CPF',
            "rules" => 'required|min:11|max:11'
        ],
        "data_nascimento"  => [
            "label" => 'Data de Nascimento',
            "rules" => 'required|date'
        ],
        "resumo_profissional"  => [
            "label" => 'Resumo Profissional',
            "rules" => 'max:1000'
        ],
        "perfil_publico"  => [
            "label" => 'Perfil Público',
            "rules" => 'required|int'
        ]
    ];


    /**
     * lista
     *  
     * @return array
     */
    public function listaPessoaFisica()
    {   
        return $this->db->select()->findAll();
    }

    /**
     * insertGetId
     * 
     * @array $dados
     * @return int
     */
    // método para inserir os dados na tabela e retorna o último id inserido
    public function insertGetId($dados)
    {
        if (Validator::make($dados, $this->validationRules)) {
            return 0;
        } else {
            return $this->db->insert($dados); 
        }
    }

}