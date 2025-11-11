<?

namespace App\Model;

use Core\Library\ModelMain;

class VagaMensagemModel extends ModelMain
{
    protected $table = 'vaga_mensagem';
    protected $primaryKey = 'id';

    public $validationRules = [
        'vaga_id' => [
            'label' => 'Vaga', 
            'rules' => 'required|int'
        ],
        'curriculum_id' => [
            'label' => 'Currículo', 
            'rules' => 'required|int'
        ],
        'remetente_tipo' => [
            'label' => 'Tipo de Remetente',
            'rules' => 'required|string'
        ],
        'remetente_id' =>[
            'label' => 'Remetente', 
            'rules' => 'required|int'
        ],
        'mensagem' => [
            'label' => 'Mensagem', 
            'rules' => 'required|string'
        ]
    ];

    public function listarMensagens($vagaId, $curriculumId)
    {
        return $this->db
            ->select()
            ->where('vaga_id', $vagaId)
            ->where('curriculum_id', $curriculumId)
            ->orderBy("data_envio", "ASC")
            ->findAll();
    }
}