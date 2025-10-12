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
        return $this->loadView("login/cadastro");
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
        
        Session::set('dados_usuario_temp', $post);

        if (isset($post['tipo'])) {
            if ($post['tipo'] === 'PF') {
                return Redirect::page('PessoaFisica/cadastro');
            } else {
                return Redirect::page('Estabelecimento/cadastro');
            }
        }

    }

    public function cadastroUsuarioFinal()
    {
        $dadosUsuario = Session::get('dados_usuario_temp');
            
        $ultimoId = null;
        if ($dadosUsuario['tipo'] === 'PF') {
            $ultimoId = Session::get('ultimo_id_pf');
            $dadosUsuario['pessoa_fisica_id'] = $ultimoId;
        } else {
            $ultimoId = Session::get('ultimo_id_estab');
            $dadosUsuario['estabelecimento_id'] = $ultimoId;
        };

        if (!$dadosUsuario || !$ultimoId) {
            return Redirect::page('usuario/index', ["msgError" => "Erro no cadastro."]);
        }

        // Adiciona a foreign key
        if ($dadosUsuario['tipo'] === 'PF') {
            $dadosUsuario['pessoa_fisica_id'] = $ultimoId;
            $dadosUsuario['estabelecimento_id'] = null;
        } else {
            $dadosUsuario['estabelecimento_id'] = $ultimoId;
            $dadosUsuario['pessoa_fisica_id'] = null;
        }

        // Hash da senha
        if (isset($dadosUsuario['senha']) && !empty($dadosUsuario['senha'])) {
            $dadosUsuario['senha'] = password_hash($dadosUsuario['senha'], PASSWORD_DEFAULT);
        }

        if ($this->model->insert($dadosUsuario)) {
            // Limpa sessões temporárias
            Session::destroy('dados_usuario_temp');
            Session::destroy('ultimo_id_pf');
            Session::destroy('ultimo_id_estab');

            return Redirect::page('login', ["msgSucesso" => "Usuário cadastrado com sucesso."]);
        } else {
            return Redirect::page('usuario/index', ["msgError" => "Erro ao cadastrar usuário."]);
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
