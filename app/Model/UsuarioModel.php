<?php

namespace App\Model;

use Core\Library\ModelMain;

class UsuarioModel extends ModelMain
{
    protected $table = "usuario";

    public $validationRules = [
        "login"  => [
            "label" => 'Login',
            "rules" => 'required|min:3|max:100'
        ],
        "senha" => [
            "label" => "Senha",
            "rules" => "required|min:8|max:30"
        ],
        "tipo"  => [
            "label" => 'Tipo',
            "rules" => 'required|min:2|max:2'
        ],
    ];

    /**
     * getUserLogin
     *
     * @param string $login 
     * @return array
     */
    public function getUserLogin($login)
    {
        return $this->db->where("login", $login)->first();
    }
    public function insertSuperUser(array $dados)
    {
        // Insere direto no banco, ignorando Validator
        return $this->db->insert($dados); // retorna true/false como o insert do ModelMain
    }
}