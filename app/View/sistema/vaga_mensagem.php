<div class="chat-container">
    <div class="chat-header">
        <h5>Troca de Mensagens</h5>
    </div>

    <div class="chat-body">
        <?php foreach ($dados['mensagens'] as $msg): ?>
            <div class="chat-message <?= $msg['remetente_tipo'] === 'PF' ? 'msg-pf' : 'msg-empresa' ?>">
                <div class="msg-bubble">
                    <p><?= $msg['mensagem'] ?></p>
                    <span class="msg-time"><?= date('d/m/Y H:i', strtotime($msg['data_envio'])) ?></span>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <form method="POST" action="<?= baseUrl() ?>vagaMensagem/enviar/<?= $dados['mensagem']['vaga_id'] ?>/<?= $dados['mensagem']['curriculum_id'] ?>" class="chat-form">
        <textarea name="mensagem" class="form-control" placeholder="Escreva sua mensagem..." required></textarea>
        <button type="submit" class="site-button">
            <i class="fa fa-paper-plane"></i> Enviar
        </button>
    </form>
</div>

<script>
    const chatBody = document.querySelector('.chat-body');
    chatBody.scrollTop = chatBody.scrollHeight;
</script>