<?php

namespace App\Controller;

use App\Model\UsuarioModel;
use App\Model\CurriculumModel;
use Core\Library\ControllerMain;
use Core\Library\Email;
use Core\Library\Redirect;
use Core\Library\Session;

class Login extends ControllerMain
{
    /**
     * construct
     */
    public function __construct()
    {
        $this->auxiliarConstruct();
        $this->model = new UsuarioModel();
        $this->loadHelper("formHelper");
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        return $this->loadView("login/login");
    }

    /**
     * signIn
     *
     * @return void
     */
    public function signIn()
    {

        $post   = $this->request->getPost();

        $this->criaSuperUser();

        $aUser  = $this->model->getUserLogin($post['login']);

        $curriculumModel = new CurriculumModel();

        if (count($aUser) > 0) {

            // validar a senha            
            if (!password_verify(trim($post["senha"]), trim($aUser['senha'])) ) {
                return Redirect::page("login", [
                    "msgError" => 'Login ou senha inválido.',
                    'inputs' => ["login" => $post['login']]
                ]);
            }

            //  Criar flag's de usuário logado no sistema
            
            Session::set("userId"   , $aUser['usuario_id']);
            Session::set("userTipo", $aUser['tipo']);
            Session::set("userLogin", $aUser['login']);

            if ($aUser['pessoa_fisica_id']) {
                $pf = $this->model->getPessoaFisica($aUser['usuario_id']); // método no model de usuário
                Session::set('userNome', $pf['nome']);
                Session::set('userPfId', $aUser['pessoa_fisica_id']);

                $curriculo = $curriculumModel->getByPessoaFisicaId($aUser['pessoa_fisica_id']);

                if (!empty($curriculo)) {
                    Session::set('curriculo_id', $curriculo['curriculum_id']);
                } else {
                    Session::destroy('curriculo_id'); // Garante que não herde sessão antiga
                }

            } elseif ($aUser['estabelecimento_id']) {
                $estab = $this->model->getEstabelecimento($aUser['usuario_id']); // método no model de usuário
                Session::set('userNome', $estab['nome']);
                Session::set('userEstabId', $aUser['estabelecimento_id']);
            }

            // Direcionar o usuário para página home
            return Redirect::page("home");
            
        } else {
            return Redirect::page("login", [
                "msgError" => 'Login ou senha inválido.',
                'inputs' => ["login" =>$post['login']]
            ]);
        }
    }

    /**
     * signOut
     *
     * @return void
     */
    public function signOut()
    {
        Session::destroy('userId');
        Session::destroy('userLogin');
        Session::destroy('userTipo');
        Session::destroy('userNome');
        Session::destroy('userPfId');
        Session::destroy('userEstabId');
        Session::destroy('curriculo_id');
        
        return Redirect::Page("home");
    }

    /**
     * formEsqueciASenha
     *
     * @return void
     */
    public function esqueciASenha()
    {
        return $this->loadView("login/esqueciASenha");
    }

    /**
     * esqueciASenhaEnvio
     *
     * @return void
     */
    public function esqueciASenhaEnvio()
    {
        $this->loadHelper("emailHelper");

        $post       = $this->request->getPost();
        $user       = $this->model->getUserEmail($post['email']);

        if (!$user) {

            return Redirect::page("Login/esqueciASenha", [
                "msgError" => "Não foi possivel localizar o e-mail na base de dados !"
            ]);

        } else {

            $created_at = date('Y-m-d H:i:s');
            $chave      = sha1($user['usuario_id'] . $user['senha'] . date('YmdHis', strtotime($created_at)));
            $cLink      = baseUrl() . "login/recuperarSenha/" . $chave;
            $emailTexto = emailRecuperacaoSenha($cLink);

            $lRetMail = Email::enviaEmail(
                $_ENV['MAIL.USER'],                         /* Email do Remetente*/
                $_ENV['MAIL.NOME'],                         /* Nome do Remetente */
                $emailTexto['assunto'],                     /* Assunto do e-mail */
                $emailTexto['corpo'],                       /* Corpo do E-mail */
                $user['email']                              /* Destinatário do E-mail */
            );

            if ($lRetMail) {

                // Gravar o link no banco de dados
                $usuarioRecuperaSenhaModel = $this->loadModel("UsuarioRecuperaSenha");

                // Desativando solicitações antigas
                $usuarioRecuperaSenhaModel->desativaChaveAntigas($user["usuario_id"]);

                // Inserindo nova solicitação
                $resIns = $usuarioRecuperaSenhaModel->db->table('usuariorecuperasenha')->insert([
                    "usuario_id" => $user["usuario_id"], 
                    "chave" => $chave,
                    "created_at" => $created_at
                ]);

                if ($resIns) {
                    return Redirect::page("login", [
                        "msgSucesso" => "Link para recuperação da senha enviado com sucesso! Verifique seu e-mail."
                    ]);   
                } else {
                    return Redirect::page("login/esqueciASenha");   
                }

            } else {
                return Redirect::page("login/esqueciASenha", ["inputs" => $post ]);
            }
        }
    }

    /**
     * recuperarSenha
     *
     * @param string $chave 
     * @return void
     */
    public function recuperarSenha($chave)
    {
        $usuarioRecuperaSenhaModel  = $this->loadModel('UsuarioRecuperaSenha');
        $userChave                  = $usuarioRecuperaSenhaModel->getRecuperaSenhaChave($chave);

        if ($userChave) {

            if (date("Y-m-d H:i:s") <= date("Y-m-d H:i:s" , strtotime("+1 hours" , strtotime($userChave['created_at'])))) {

                $usuarioModel = $this->loadModel('Usuario');
                $user           = $usuarioModel->getById($userChave['usuario_id']);

                if ($user) {

                    $chaveRecSenha = sha1($userChave['usuario_id'] . $user['senha'] . date("YmdHis", strtotime($userChave['created_at'])));

                    if ($chaveRecSenha == $userChave['chave']) {

                        $dbDados = [
                            "usuario_id"    => $user['usuario_id'],
                            'nome_usuario'  => $user['nome'],
                            'usuariorecuperasenha_id' => $userChave['usuario_id']
                        ];

                        Session::destroy("msgError");

                        // chave válida
                        return $this->loadView("login/recuperarSenha", $dbDados);

                        //

                    } else {
                        // Desativa chave
                        $upd = $usuarioRecuperaSenhaModel->desativaChave($userChave['usuario_id']);

                        return Redirect::page("Login/esqueciASenha", [
                            "msgError" => "Link de recuperação da senha inválida."
                        ]); 
                    }

                } else {

                    // Desativa chave
                    $upd = $usuarioRecuperaSenhaModel->desativaChave($userChave['usuario_id']);

                    return Redirect::page("Login/esqueciASenha", [
                        "msgError" => "Usuário para o link de recuperação da senha não localizado."
                    ]); 

                }
                
            } else {

                // Desativa chave
                $upd = $usuarioRecuperaSenhaModel->desativaChave($userChave['usuario_id']);

                return Redirect::page("Login/esqueciASenha", [
                    "msgError" => "Link de recuperação da senha expirada."
                ]); 
            }

        } else {
            return Redirect::page("Login/esqueciASenha", [
                "msgError" => "Link de recuperação da senha não localizada."
            ]);             
        }
    }

    /**
     * atualizaRecuperaSenha
     *
     * @return void
     */
    public function atualizaRecuperaSenha()
    {
        $UsuarioModel = $this->loadModel("Usuario");

        $post       = $this->request->getPost();
        $userAtual  = $UsuarioModel->getById($post["usuario_id"]);

        if ($userAtual) {

            if (trim($post["NovaSenha"]) == trim($post["NovaSenha2"])) {

                if ($UsuarioModel->db
                                ->table("usuario")
                                ->where(['usuario_id' => $post['usuario_id']])
                                ->update([
                                    'senha'      => password_hash(trim($post["NovaSenha"]), PASSWORD_DEFAULT)
                                ])
                    ) {

                    // Desativa chave
                    $usuarioRecuperaSenhaModel = $this->loadModel('UsuarioRecuperaSenha');

                    $upd = $usuarioRecuperaSenhaModel->desativaChave($post['usuariorecuperasenha_id']);

                    Session::destroy("msgError");
                    return Redirect::page("Login", [
                        "msgSuccesso"    => "Senha atualizada com sucesso !"
                    ]);  

                } else {
                    return $this->loadView("login/recuperarSenha", $post);
                }

            } else {
                Session::set("msgError", "Nova senha e conferência da senha estão divergentes !");
                return $this->loadView("login/recuperarSenha", $post);
            }

        } else {
            Session::set("msgError", "Usuário inválido !");
            return $this->loadView("login/recuperarSenha", $post);
        }
    }

    /**
     * criaSuperUser
     *
     * @return void
     */
    public function criaSuperUser()
    {
        // Verifica se já existe algum usuário no banco
        $usuariosExistentes = $this->model->lista('usuario_id', 'ASC');

        if (!empty($usuariosExistentes)) {
            // Já existem usuários, não precisa criar superusuário
            return false;
        }
        $dados = [
            'pessoa_fisica_id'   => null,
            'estabelecimento_id' => null,
            "login"              => "admin@empregamuriae.com",
            "senha"              => password_hash("123456", PASSWORD_DEFAULT),
            "tipo"               => "G"
        ];

        $aSuperUser = $this->model->getUserLogin($dados['login']);

        if ($aSuperUser) {
            return false; // super usuário já existe
        }

        // Inserção direta sem passar pelo Validator
        if ($this->model->insertSuperUser($dados)) {
            return Redirect::page("login", ["msgSucesso" => "Superusuário criado com sucesso."]);
        } else {
            return Redirect::page("login", ["msgSucesso" => "Erro ao criar super usuário."]);
        }
    }
}
