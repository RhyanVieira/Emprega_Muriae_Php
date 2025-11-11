<?php

namespace App\Controller;

use Core\Library\ControllerMain;
use Core\Library\Files;
use Core\Library\Redirect;
use Core\Library\Session;
use Core\Library\Validator;
use App\Model\EstabelecimentoModel;
use App\Model\CidadeModel;
use App\Model\VagaModel;
use App\Model\CategoriaEstabelecimentoModel;
use App\Model\EstabelecimentoCategoriaModel;

class Estabelecimento extends ControllerMain
{
    protected $files;

    public function __construct()
    {   
        $this->auxiliarconstruct();
        $this->loadHelper('formHelper');
        $this->files = new Files();
        $this->model = new EstabelecimentoModel();
    }

    public function index($pagina = 1)
    {   
        $aParametros = Self::getRotaParametros();
        $filtros = $aParametros['get'];
        unset($filtros['parametros']);
        
        $CidadeModel = new CidadeModel();
        $CategoriaEstabelecimentoModel = new CategoriaEstabelecimentoModel();

        $limite = 6; // número de estabelecimentos por página
        $offset = ((int)$pagina - 1) * $limite;

        $totalRegistros = $this->model->countEstabelecimentos($filtros); // retorna total de estabelecimentos no banco
        $totalPaginas = ceil($totalRegistros / $limite);

        $estabelecimentos = $this->model->listaEstabelecimentos($filtros, $limite, $offset);

        $dados = [
            'aCidade' => $CidadeModel->lista("cidade"),
            'aCategoriaEstabelecimento' => $CategoriaEstabelecimentoModel->lista("descricao"),
            'estabelecimentos' => $estabelecimentos,
            'paginaAtual' => (int)$pagina,
            'totalPaginas' => (int)$totalPaginas,
            'filtros' => $filtros,
            'totalRegistros' => $totalRegistros
        ];

        return $this->loadView("sistema/estabelecimentos", $dados);
    }

    public function cadastro(){
        $CidadeModel = new CidadeModel();
        $CategoriaEstabelecimentoModel = new CategoriaEstabelecimentoModel();

        $dados = [
            'aCidade' => $CidadeModel->lista("cidade"),
            'aCategoriaEstabelecimento' => $CategoriaEstabelecimentoModel->lista("descricao")
        ];

        return $this->loadView("sistema/cadastro_estabelecimento", $dados);
    }

    public function perfil($id = 0){


        $estabelecimentos = $this->model->getInfoCompleta($id);
        $VagaModel = new VagaModel();

        $dados = [
            'estabelecimento' => $estabelecimentos,
            'totalAberta' => $VagaModel->countVagasAbertasPorEmpresa($id)
        ];

        
        return $this->loadView("sistema/perfil_empresa", $dados);
    }

    public function cadastroParaUsuario()
    {
        $post = $this->request->getPost();

        // Guardas as categorias para salvar e remove do $post
        $categoriasSelecionadas = $post['categorias'] ?? [];
        unset($post['categorias']);

        if (!empty($post['cep'])) {
            // Remove a máscara antes de salvar
            $post['cep'] = preg_replace('/\D/', '', $post['cep']); 
        }

        if (!empty($_FILES['logo']['name'])) {
            $nomeRetornado = $this->files->upload(['logo' => $_FILES['logo']], 'estabelecimento');
            // se for boolean, significa que o upload falhou
            if (is_bool($nomeRetornado)) {
                Session::set('inputs', $post);
                return Redirect::page($this->controller, ["msgError" => "Erro ao fazer upload da imagem."]);
            } else {
                $post['logo'] = $nomeRetornado[0];
            }
        } else {
            $post['logo'] = $nomeRetornado[0] ?? null;
        }

        // Inserção via insertGetId() que retorna o ID real
        $idEstab = $this->model->insertGetId($post);

        if ($idEstab > 0) {
            if (!empty($categoriasSelecionadas)) {
                $EstabCatModel = new EstabelecimentoCategoriaModel();

                foreach ($categoriasSelecionadas as $idCat) {
                    $arrayCat = [];
                    $arrayCat['categoria_estabelecimento_id'] = $idCat;
                    $arrayCat['estabelecimento_id'] = $idEstab;

                    $EstabCatModel->insert($arrayCat);
                }
            }
            Session::set('ultimo_id_estab', $idEstab);
            return Redirect::page("usuario/cadastroUsuarioFinal");
        } else {
            Session::set('inputs', $post);
            return Redirect::page($this->controller . "/cadastro", ["msgError" => "Erro ao cadastrar Empresa."]);
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