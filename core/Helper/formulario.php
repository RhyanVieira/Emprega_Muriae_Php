<?php

use Core\Library\Session;

if (! function_exists('setValor')) {

    /**
     * setValor
     *
     * @param string $campo 
     * @param mixed $default 
     * @return mixed
     */
    function setValor($campo, $default = "")
    {
        if (isset($_POST[$campo])) {
            return $_POST[$campo];
        } else {
            return $default;
        }
    }

}

if (! function_exists('setMsgFilderError')) {
    /**
     * setMsgFilderError
     *
     * @param string $campo 
     * @return string
     */
    function setMsgFilderError($campo)
    {
        $cRet   = '';

        if (isset($_POST['formErrors'][$campo])) {
            $cRet .= '<div class="mt-2 text-danger">';
                $cRet .= $_POST['formErrors'][$campo];
            $cRet .= '</div>';
        }

        return $cRet;
    }
}

if (!function_exists('formatarTelefone')) {
    function formatarTelefone($numero)
    {
        $numero = preg_replace('/\D/', '', $numero); // remove tudo que não for número

        if (strlen($numero) === 11) {
            return sprintf('(%s) %s-%s',
                substr($numero, 0, 2),
                substr($numero, 2, 5),
                substr($numero, 7)
            );
        } elseif (strlen($numero) === 10) {
            return sprintf('(%s) %s-%s',
                substr($numero, 0, 2),
                substr($numero, 2, 4),
                substr($numero, 6)
            );
        }

        return $numero;
    }
}

if (!function_exists('formatarCEP')) {
    function formatarCEP($cep)
    {
        $cep = preg_replace('/\D/', '', $cep); // remove tudo que não for número

        if (strlen($cep) === 8) {
            return substr($cep, 0, 5) . '-' . substr($cep, 5);
        }

        return $cep;
    }
}

if (! function_exists('exibeAlerta')) {
    /**
     * exibeAlerta
     *
     * @return string
     */
    function exibeAlerta()
    {
        $msgSucesso = Session::getDestroy('msgSucesso');
        $msgError   = Session::getDestroy('msgError');
        $msgAlerta  = Session::getDestroy('msgAlerta');
        $mensagem   = '';
        $classAlert = '';

        if ($msgSucesso != "") {
            $mensagem   = $msgSucesso;
            $classAlert = 'success';
        } elseif ($msgError != "") {
            $mensagem   = $msgError;
            $classAlert = 'danger';
        } elseif ($msgAlerta != "") {
            $mensagem   = $msgAlerta;
            $classAlert = 'warning';
        }

        if ($mensagem == "") {
            return "";
        } else {
            return  '<div class="m-2 alert alert-' . $classAlert . ' alert-dismissible fade show" role="alert">
                        ' . $mensagem . '
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
        }
    }
}

if (! function_exists('datatables')) {
    /**
     * datatables
     *
     * @param string $idTable 
     * @return string
     */
    function datatables($idTable)
    {
        return '
            <script src="' . baseUrl() . 'assets/DataTables/datatables.min.js"></script>
            <script>
                $(document).ready(function() {
                    $("#' . $idTable . '").DataTable({
                        language:   {
                                        "sEmptyTable":      "Nenhum registro encontrado",
                                        "sInfo":            "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                                        "sInfoEmpty":       "Mostrando 0 até 0 de 0 registros",
                                        "sInfoFiltered":    "(Filtrados de _MAX_ registros)",
                                        "sInfoPostFix":     "",
                                        "sInfoThousands":   ".",
                                        "sLengthMenu":      "_MENU_ resultados por página",
                                        "sLoadingRecords":  "Carregando...",
                                        "sProcessing":      "Processando...",
                                        "sZeroRecords":     "Nenhum registro encontrado",
                                        "sSearch":          "Pesquisar",
                                        "oPaginate": {
                                            "sNext":        "Próximo",
                                            "sPrevious":    "Anterior",
                                            "sFirst":       "Primeiro",
                                            "sLast":        "Último"
                                        },
                                        "oAria": {
                                            "sSortAscending":   ": Ordenar colunas de forma ascendente",
                                            "sSortDescending":  ": Ordenar colunas de forma descendente"
                                        }
                                    }
                    });
                });
            </script>';
    }
}