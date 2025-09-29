<?php

namespace App\Model;

use Core\Library\ModelMain;

class CidadeModel extends ModelMain
{
    protected $table = "curriculum";
    
    public $validationRules = [
        "pessoa_fisica_id"  => [
            "label" => 'Pessoa Física Id',
            "rules" => 'required|int'
        ],
        "logradouro"  => [
            "label" => 'Logradouro',
            "rules" => 'required|min:3|max:60'
        ],
        "numero"  => [
            "label" => 'Número',
            "rules" => 'min:1|max:10'
        ],
        "complemento"  => [
            "label" => 'Complemento',
            "rules" => 'min:3|max:20'
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
            "rules" => 'required|min:3|max:8'
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
            "rules" => 'required'
        ],
        "sexo"  => [
            "label" => 'Sexo',
            "rules" => 'required|min:1|max:1'
        ],
        "foto"  => [
            "label" => 'Foto',
            "rules" => 'min:3|max:100'
        ],
        "email"  => [
            "label" => 'Email',
            "rules" => 'required|min:3|max:120'
        ],
        "apresentacaoPessoal"  => [
            "label" => 'Apresentação Pessoal',
            "rules" => ''
        ],
        "curriculo_arquivo"  => [
            "label" => 'Curriculo em Arquivo',
            "rules" => 'requireds|max:255'
        ],
    ];


    /**
     * lista
     *
     * @param string $orderby 
     * @return array
     */
    public function listaCurriculum()
    {   
        return $this->db->select()->findAll();
    }

}