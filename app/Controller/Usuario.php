<?php

namespace App\Controller;

use Core\Library\ControllerMain;
use Core\Library\Redirect;
use Core\Library\Session;
use Core\Library\Validator;
use App\Model\UsuarioModel;
use App\Model\TermoDeUsoModel;
use App\Model\TermoDeUsoAceiteModel;

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
        Session::destroy('dados_usuario_temp');
        return $this->loadView("login/cadastro");
    }

    public function cadastroUsuario()
    {
        $post = $this->request->getPost();
        unset($post['politica_privacidade']);

        $usuarioExistente = $this->model->getUserLogin($post['login']);

        if ($usuarioExistente) {
            return Redirect::page('usuario/index', ["msgAlerta" => "Já existe uma conta cadastrada com este e-mail."]);
        }

        // Hash da senha
        if (isset($post['senha']) && !empty($post['senha'])) {
            $post['senha'] = password_hash($post['senha'], PASSWORD_DEFAULT);
        }

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
        $TermoDeUsoModel = new TermoDeUsoModel();
        $ultimoTermo = $TermoDeUsoModel->getUltimoTermoAtivo();

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
            Session::set("inputs", $dadosUsuario);
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

        if ($dadosUsuario['termo'] == '1') {
            unset($dadosUsuario['termo']);
            $id = $this->model->insertGetId($dadosUsuario);
            
            
            if ($id > 0) {
                $TermoDeUsoModel = new TermoDeUsoModel();
                $ultimoTermo = $TermoDeUsoModel->getUltimoTermoAtivo();

                if (!empty($ultimoTermo)) {
                    $TermoDeUsoAceiteModel = new TermoDeUsoAceiteModel();

                    $arrayTermo = [
                        'termodeuso_id' => $ultimoTermo['id'],
                        'usuario_id' => $id,
                        'dataHoraAceite' => date('Y-m-d H:i:s')
                    ];

                    $TermoDeUsoAceiteModel->insert($arrayTermo);
                }

                Session::destroy('dados_usuario_temp');
                Session::destroy('ultimo_id_pf');
                Session::destroy('ultimo_id_estab');
                return Redirect::page('login', ["msgSucesso" => "Usuário cadastrado com sucesso."]);
            } else {
                Session::set("inputs", $dadosUsuario);
                return Redirect::page('usuario/index', ["msgError" => "Erro ao cadastrar usuário."]);
            }
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
