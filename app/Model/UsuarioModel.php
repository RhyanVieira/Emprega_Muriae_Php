<?php

namespace App\Model;

use Core\Library\ModelMain;

class UsuarioModel extends ModelMain
{
    protected $table = "usuario";

    public $validationRules = [
        "pessoa_fisica_id"  => [
            "label" => 'Nome',
            "rules" => 'int'
        ],
        "login"  => [
            "label" => 'Login',
            "rules" => 'required|min:3|max:60'
        ],

        "senha" => [
            "label" => "Senha",
            "rules" => "required|min:8|max:100"
        ],
        "tipo"  => [
            "label" => 'tipo',
            "rules" => 'required|min:2|max:2'
        ],
        "estabelecimento_id"  => [
            "label" => 'Nome do Estabelecimento ou Empresa',
            "rules" => 'int'
        ],
        "email"  => [
            "label" => 'Email',
            "rules" => 'required|min:5|max:150'
        ],
    ];

    /**
     * getUserEmail
     *
     * @param string $email 
     * @return array
     */
    public function getUserEmail($email)
    {
        return $this->db->where("email", $email)->first();
    }
}