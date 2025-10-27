<?php

namespace App\Controller;

use App\Model\CidadeModel;
use App\Model\EscolaridadeModel;
use App\Model\CargoModel;
use App\Model\IdiomaModel;
use App\Model\IdiomaModelModel;
use Core\Library\ControllerMain;
use Core\Library\Files;
use Core\Library\Redirect;
use Core\Library\Session;
use Core\Library\Validator;

class Curriculum extends ControllerMain
{
    protected $files;

    public function __construct()
    {
        $this->auxiliarconstruct();
        $this->loadHelper('formHelper');
        $this->files = new Files();
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $CidadeModel = new CidadeModel();
        $EscolaridadeModel = new EscolaridadeModel();
        $CargoModel = new CargoModel();
        $IdiomaModel = new IdiomaModel();

        $idPessoaFisica = Session::get('userPfId');

        // Busca o currículo existente (se houver)
        $curriculoExistente = null;
        if ($idPessoaFisica) {
            $curriculoExistente = $this->model->getByPessoaFisicaId($idPessoaFisica);
        }

        $dados = [
            'aCidade' => $CidadeModel->lista("cidade"),
            'aEscolaridade' => $EscolaridadeModel->lista("descricao"),
            'aCargo' => $CargoModel->lista('descricao'),
            'aIdioma' => $IdiomaModel->lista('descricao'),
            'curriculo' => $curriculoExistente,
        ];

        // Envia os dados para a view
        return $this->loadView("sistema/cadastro_curriculo", $dados);
    }

    /**
     * insert
     *
     * @return void
     */
    public function salvar_dados()
    {
        $post = $this->request->getPost();

        // Recupera o ID da pessoa física logada
        $idPessoaFisica = Session::get('userPfId');

        if (!$idPessoaFisica) {
            // Evita inserção sem vínculo com um usuário
            return Redirect::page("login", ["msgError" => "Você precisa estar logado para cadastrar um currículo."]);
        }

        // Adiciona o vínculo no array de dados
        $post['pessoa_fisica_id'] = $idPessoaFisica;

        // Verifica se já existe currículo para esta pessoa física
        $curriculoExistente = $this->model->getByPessoaFisicaId($idPessoaFisica);

        // Validação dos campos obrigatórios do currículo
        if (Validator::make($post, $this->model->validationRules)) {
            Session::set('inputs', $post);
            return Redirect::page($this->controller . "/index", ["msgError" => "Preencha os campos obrigatórios corretamente."]);
        }

        if (!empty($_FILES['curriculo_arquivo']['name'])) {
            $nomeRetornado = $this->files->upload(['curriculo_arquivo' => $_FILES['curriculo_arquivo']], 'curriculos');

            if (is_bool($nomeRetornado)) {
                Session::set('inputs', $post);
                return Redirect::page($this->controller . "/index", ["msgError" => "Erro ao fazer upload do currículo."]);
            } else {

            $post['curriculo_arquivo'] = $nomeRetornado[0];

            if (!empty($curriculoExistente['nomeImagem'])) {
                $this->files->delete($post['nomeImagem'], "curriculoss");
            }
        }
        } else {
            $post['curriculo_arquivo'] = $curriculoExistente['curriculo_arquivo'];
        }

        if (!empty($_FILES['foto']['name'])) {

            $nomeRetornado = $this->files->upload(['foto' => $_FILES['foto']], 'fotos_curriculos');

            // se for boolean, significa que o upload falhou
            if (is_bool($nomeRetornado)) {
                Session::set('inputs', $post);
                return Redirect::page($this->controller . "/index" . $post['id'], ["msgError" => "Erro ao fazer upload da imagem."]);
            } else {
                $post['foto'] = $nomeRetornado[0];

                if (!empty($post['nomeImagem'])) {
                    $this->files->delete($post['nomeImagem'], "fotos_curriculos");
                }
            }
        } else {
            $post['foto'] = $post['nomeImagem'] ?? null;
        }

        if ($curriculoExistente) {

            $post['curriculum_id'] = $curriculoExistente['curriculum_id'];

            // Atualiza o registro existente
            if($this->model->update($post)) {
                return Redirect::page($this->controller, ["msgSucesso" => "Currículo alterado com sucesso!"]);
            } else {
                return Redirect::page($this->controller, ["msgError" => "Erro ao alterar curriculo!"]);
            }
        } else {
            // Cria um novo registro
            $idCurriculo = $this->model->insertGetId($post);
            
            if ($idCurriculo > 0) {
            Session::set('curriculo_id', $idCurriculo);
            return Redirect::page($this->controller, ["msgSucesso" => "Currículo cadastrado com sucesso!"]);
            } else {
                Session::set('inputs', $post);
                return Redirect::page($this->controller . "/index", ["msgError" => "Erro ao cadastrar o currículo."]);
            }
        }
    }

    /**
     * update
     *
     * @return void
     */
    public function update()
    {
        $post = $this->request->getPost();

        if (Validator::make($post, $this->model->validationRules)) {
            return Redirect::page($this->controller . "/form/update/" . $post['id']);    // error
        } else {
            if ($this->model->update($post)) {
                return Redirect::page($this->controller, ["msgSucesso" => "Registro alterado com sucesso."]);
            } else {
                return Redirect::page($this->controller . "/form/update/" . $post['id']);
            }
        }
    }

    /**
     * delete
     *
     * @return void
     */
    public function delete()
    {
        $post = $this->request->getPost();

        if ($this->model->delete($post)) {
            return Redirect::page($this->controller, ["msgSucesso" => "Registro Excluído com sucesso."]);
        } else {
            return Redirect::page($this->controller);
        }
    }
}