<div class="chat-container">
    <div class="chat-header">
        <h5>Troca de Mensagens</h5>
        <?= exibeAlerta() ?>
    </div>
    <div class="chat-body">
        <?php if (!empty($dados['mensagens'])): ?>
            <?php foreach ($dados['mensagens'] as $msg): ?>
                <div class="chat-message <?= ($msg['remetente_tipo'] ?? '') === 'PF' ? 'msg-pf' : 'msg-empresa' ?>">
                    <div class="msg-bubble">
                        <p><?= $msg['mensagem'] ?? '' ?></p>
                        <span class="msg-time">
                            <?= !empty($msg['data_envio']) ? date('d/m/Y H:i', strtotime($msg['data_envio'])) : '' ?>
                        </span>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center text-muted">Nenhuma mensagem ainda. Comece a conversa!</p>
        <?php endif; ?>
    </div>

    <form 
        method="POST" 
        action="<?= baseUrl() ?>vagaMensagem/enviar/<?= $dados['vaga_id'] ?>/<?= $dados['curriculum_id'] ?>" 
        class="chat-form"
    >
        <textarea 
            name="mensagem" 
            class="form-control" 
            placeholder="Escreva sua mensagem..." 
            required
        ></textarea>
        <button type="submit" class="site-button">
            <i class="fa fa-paper-plane"></i> Enviar
        </button>
    </form>
</div>

<script>
    const chatBody = document.querySelector('.chat-body');
    if (chatBody) {
        chatBody.scrollTop = chatBody.scrollHeight;
    }
</script>
