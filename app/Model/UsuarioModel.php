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
            "rules" => "required|min:8|max:255"
        ],
        "tipo"  => [
            "label" => 'Tipo',
            "rules" => 'required|min:1|max:2'
        ],
    ];

    public function getUserLogin($login)
    {
        return $this->db->where("login", $login)->first();
    }

    public function insertSuperUser(array $dados)
    {
        // Insere direto no banco, ignorando Validator
        return $this->db->insert($dados); // retorna true/false como o insert do ModelMain
    }

    public function getPessoaFisica($usuarioId)
    {
        return $this->db
            ->select("pessoa_fisica.nome",)
            ->join("pessoa_fisica", "pessoa_fisica.pessoa_fisica_id = usuario.pessoa_fisica_id")
            ->where("usuario.usuario_id", $usuarioId)
            ->first();
    }

    public function getEstabelecimento($usuarioId)
    {
        return $this->db
            ->select("estabelecimento.nome")
            ->join("estabelecimento", "estabelecimento.estabelecimento_id = usuario.estabelecimento_id")
            ->where("usuario.usuario_id", $usuarioId)
            ->first();
    }
}