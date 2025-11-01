<?php

namespace App\Controller;

use App\Model\CurriculumEscolaridadeModel;
use App\Model\CidadeModel;
use App\Model\EscolaridadeModel;
use App\Model\CargoModel;
use App\Model\IdiomaModel;
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
        $CurriculumEscolaridadeModel = new CurriculumEscolaridadeModel();

        $idPessoaFisica = Session::get('userPfId');

        // Busca o currículo existente (se houver)
        $curriculoExistente = null;
        $escolaridades = [];

        if ($idPessoaFisica) {
            $curriculoExistente = $this->model->getByPessoaFisicaId($idPessoaFisica);

            // Se o currículo existir, busca suas escolaridades vinculadas
            if (!empty($curriculoExistente['curriculum_id'])) {
                $escolaridades = $CurriculumEscolaridadeModel
                    ->getByCurriculumId($curriculoExistente['curriculum_id']);
            }
        }

        $dados = [
            'aCidade' => $CidadeModel->lista("cidade"),
            'aEscolaridade' => $EscolaridadeModel->lista("descricao"),
            'aCargo' => $CargoModel->lista('descricao'),
            'aIdioma' => $IdiomaModel->lista('descricao'),
            'curriculo' => $curriculoExistente,
            'escolaridades' => $escolaridades,
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

        // Verifica se já existe currículo para esta pessoa física
        $curriculoExistente = $this->model->getByPessoaFisicaId($idPessoaFisica);

        if ($curriculoExistente) {
            return $this->update($post, $curriculoExistente);
        } else {
            return $this->insert($post);
        }
    }

    public function insert($post){

        $post['pessoa_fisica_id'] = Session::get('userPfId');

        if (Validator::make($post, $this->model->validationRules)) {
            Session::set('inputs', $post);
            return Redirect::page($this->controller . "/index", ["msgError" => "Preencha os campos obrigatórios corretamente."]);
        }

        if (!empty($_FILES['curriculo_arquivo']['name'])) {
            $nomeCurriculo = $this->files->upload(['curriculo_arquivo' => $_FILES['curriculo_arquivo']], 'curriculos');
            // se for boolean, significa que o upload falhou
            if (is_bool($nomeCurriculo)) {
                Session::set('inputs', $post);
                return Redirect::page($this->controller, ["msgError" => "Erro ao fazer upload do currículo."]);
            }
            $post['curriculo_arquivo'] = $nomeCurriculo[0];
        } else {
            $post['curriculo_arquivo'] = $nomeCurriculo[0] ?? null;
        }

        if (!empty($_FILES['foto']['name'])) {
            $nomeRetornado = $this->files->upload(['foto' => $_FILES['foto']], 'fotos_curriculos');
            // se for boolean, significa que o upload falhou
            if (is_bool($nomeRetornado)) {
                Session::set('inputs', $post);
                return Redirect::page($this->controller, ["msgError" => "Erro ao fazer upload da imagem."]);
            } else {
                $post['foto'] = $nomeRetornado[0];
            }
        } else {
            $post['foto'] = $nomeCurriculo[0] ?? null;
        }

        $idCurriculo = $this->model->insertGetId($post);

        if ($idCurriculo > 0) {
            Session::set('curriculo_id', $idCurriculo);
            return Redirect::page($this->controller, ["msgSucesso" => "Currículo cadastrado com sucesso!"]);
        } else {
            Session::set('inputs', $post);
            return Redirect::page($this->controller, ["msgError" => "Erro ao cadastrar o currículo."]);
        }
    }
    
    /**
     * update
     *
     * @return void
     */
    public function update($post, $curriculoExistente)
    {
        $post['pessoa_fisica_id'] = Session::get('userPfId');
        
        if (Validator::make($post, $this->model->validationRules)) {
            Session::set('inputs', $post);
            return Redirect::page($this->controller . "/index", ["msgError" => "Preencha os campos obrigatórios corretamente."]);
        }

        if (!empty($_FILES['curriculo_arquivo']['name'])) {
        $nomeCurriculo = $this->files->upload(['curriculo_arquivo' => $_FILES['curriculo_arquivo']], 'curriculos');
            if (is_bool($nomeCurriculo)) {
                return Redirect::page($this->controller, ["msgError" => "Erro ao fazer upload do currículo."]);
            }
            // Se houver um arquivo antigo, deleta
            if (!empty($curriculoExistente['curriculo_arquivo'])) {
                $this->files->delete($curriculoExistente['curriculo_arquivo'], "curriculos");
            }
            $post['curriculo_arquivo'] = $nomeCurriculo[0];
        } else {
            // Mantém o arquivo atual (ou null se não houver)
            $post['curriculo_arquivo'] = $curriculoExistente['curriculo_arquivo'] ?? null;
        }

        if (!empty($_FILES['foto']['name'])) {
            $nomeFoto = $this->files->upload(['foto' => $_FILES['foto']], 'fotos_curriculos');
            if (is_bool($nomeFoto)) {
                return Redirect::page($this->controller, ["msgError" => "Erro ao fazer upload da imagem."]);
            }
            // Se houver uma foto antiga, deleta
            if (!empty($curriculoExistente['foto'])) {
                $this->files->delete($curriculoExistente['foto'], "fotos_curriculos");
            }
            $post['foto'] = $nomeFoto[0];
        } else {
            // Mantém a imagem atual (ou null)
            $post['foto'] = $curriculoExistente['foto'] ?? null;
        }

        $post['curriculum_id'] = $curriculoExistente['curriculum_id'];

        $dadosAlterados = array_diff_assoc($post, $curriculoExistente);

        if (empty($dadosAlterados)) {
            // Nenhum campo foi modificado
            return Redirect::page($this->controller, ["msgAlerta" => "Nenhuma alteração detectada no currículo."]);
        }

        // Atualiza o registro existente
        if($this->model->update($post)) {
            return Redirect::page($this->controller, ["msgSucesso" => "Currículo alterado com sucesso!"]);
        } else {
            return Redirect::page($this->controller, ["msgError" => "Erro ao alterar curriculo!"]);
        }

    }

    /**
     * delete
     *
     * @return void
     */
    public function delete($id = null)
    {
        if (empty($id)) {
            return Redirect::page($this->controller, ["msgError" => "ID do currículo inválido."]);
        }

        $idPessoaFisica = Session::get('userPfId');
        $curriculo = $this->model->getByPessoaFisicaId($idPessoaFisica);

        if (!$curriculo || $curriculo['curriculum_id'] != $id) {
            return Redirect::page($this->controller, ["msgError" => "Currículo não encontrado ou acesso negado."]);
        }

        // Remove arquivos associados (se existirem)
        if (!empty($curriculo['curriculo_arquivo'])) {
            $this->files->delete($curriculo['curriculo_arquivo'], 'curriculos');
        }

        if (!empty($curriculo['foto'])) {
            $this->files->delete($curriculo['foto'], 'fotos_curriculos');
        }

        // Exclui o registro do banco
        if ($this->model->delete($id)) {
            Session::destroy('curriculo_id');
            return Redirect::page($this->controller, ["msgSucesso" => "Currículo excluído com sucesso!"]);
        } else {
            return Redirect::page($this->controller, ["msgError" => "Erro ao excluir currículo."]);
        }
    }
}