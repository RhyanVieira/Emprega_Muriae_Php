<?php

namespace App\Controller;

use Core\Library\ControllerMain;
use Core\Library\Redirect;
use Core\Library\Session;
use Core\Library\Validator;
use App\Model\UsuarioModel;

class Usuario extends ControllerMain
{
    public function __construct()
    {
        $this->auxiliarconstruct();
        $this->loadHelper('formHelper');
        $this->model = new UsuarioModel();
    }

    public function index()
    {
        $this->validaNivelAcesso();
        return $this->loadView("sistema/listaUsuario", $this->model->listaUsuario());
    }

    public function lista()
    {
        $this->validaNivelAcesso();   
        return $this->loadView("sistema/listaUsuario", $this->model->listaUsuario());
    }

    public function form($action, $id)
    {
        $this->validaNivelAcesso();
        return $this->loadView("sistema/formUsuario", $this->model->getById($id));
    }

    public function cadastro($action, $id)
    {
        return $this->loadView("login/cadastro", $this->model->getById($id));
    }

    public function insert()
    {
        $post = $this->request->getPost();

        if (Validator::make($post, $this->model->validationRules)) {
            Session::set('inputs', $post);
            return Redirect::page($this->controller . "/form/insert/0");
        }

        // Faz o hash da senha antes de inserir
        if (isset($post['senha']) && !empty($post['senha'])) {
            $post['senha'] = password_hash($post['senha'], PASSWORD_DEFAULT);
        }

        if ($this->model->insert($post)) {
            return Redirect::page($this->controller . "/lista", ["msgSucesso" => "Usuário cadastrado com sucesso."]);
        } else {
            Session::set('inputs', $post);
            return Redirect::page($this->controller . "/form/insert/0", ["msgError" => "Erro ao cadastrar usuário."]);
        }
    }

    public function cadastroUsuario()
    {
        $post = $this->request->getPost();
        
        if (isset($post['tipo'])) {
            if ($post['tipo'] === 'empresa') {
                $post['nivel'] = 31; // nível para empresa
            } elseif ($post['tipo'] === 'candidato') {
                $post['nivel'] = 21; // nível para candidato
            }
            // Remove a variável 'tipo' do array para não ser salva no banco
            unset($post['tipo']);
        }

        if (Validator::make($post, $this->model->validationRules)) {
            Session::set('inputs', $post);
            return Redirect::page("login");
        }

        // Hash da senha
        if (!empty($post['senha'])) {
            $post['senha'] = password_hash($post['senha'], PASSWORD_DEFAULT);
        }

        if ($this->model->insert($post)) {
            return Redirect::page("login", ["msgSucesso" => "Usuário cadastrado com sucesso."]);
        } else {
            Session::set('inputs', $post);
            return Redirect::page("usuario/cadastro", ["msgError" => "Erro ao cadastrar usuário."]);
        }
    }

    public function update()
    {
        $post = $this->request->getPost();
        $lError = false;

        unset($post['confSenha']);

        if (empty($post['senha'])) {
            unset($post['senha']);
        } else {
            $post['senha'] = password_hash($post['senha'], PASSWORD_DEFAULT);
        }

        $updated = $this->model->update($post);

        if ($updated || $updated === 0) {
            if (Session::get("userId") == $post["id"]) {
                $usuarioAtualizado = $this->model->getById($post["id"]);

                Session::set("userId",    $usuarioAtualizado["id"]);
                Session::set("userNome",  $usuarioAtualizado["nome_completo"]);
                Session::set("userEmail", $usuarioAtualizado["email"]);
                Session::set("userNivel", $usuarioAtualizado["nivel"]);
                Session::set("userSenha", $usuarioAtualizado["senha"]);
            }
            return Redirect::page($this->controller, ["msgSucesso" => "Registro atualizado com sucesso."]);
        } else {
            Session::set("inputs", $post);
            return Redirect::page($this->controller . '/form/update/' . $post['id'], ["msgError" => "Erro ao atulizar"]);
        }
    }

    public function delete()
    {
        $post = $this->request->getPost();

        if ($this->model->delete($post)) {
            return Redirect::page($this->controller . "/lista", ["msgSucesso" => "Usuário excluído com sucesso."]);
        } else {
            return Redirect::page($this->controller . "/lista", ["msgError" => "Erro ao excluir usuário."]);
        }
    }
}
