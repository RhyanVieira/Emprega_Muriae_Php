<?php
use Core\Library\Session;
$tipoUsuario = Session::get('userTipo'); // 'PF' ou 'E'
$tituloChat = ($tipoUsuario === 'PF')
    ? ($dados['mensagens'][0]['empresa_nome'] ?? 'Empresa')
    : ($dados['mensagens'][0]['candidato_nome'] ?? 'Candidato');
?>
<div class="chat-container">
    <div class="chat-header text-center">
        <h5> <?= $tituloChat ?> </h5>
    </div>
    <div class="chat-body">
        <?php if (!empty($dados['mensagens'])): ?>
            <?php foreach ($dados['mensagens'] as $msg): ?>
                <?php
                    $isPf = ($msg['remetente_tipo'] ?? '') === 'PF';
                    $classeMsg = $isPf ? 'msg-pf' : 'msg-empresa';
                    $foto = $msg['remetente_foto'] ?? '';
                    $nome = $msg['remetente_nome'] ?? 'Usuário';
                    $imgSrc = !empty($foto) ? baseUrl() . 'imagem.php?file=' . ($isPf ? 'fotos_curriculos/' : 'estabelecimento/') . $foto: baseUrl();
                ?>
                <div class="chat-message <?= $classeMsg ?>">
                    <div class="msg-avatar"><img src="<?= $imgSrc ?>" alt="<?= $nome ?>"></div>
                    <div class="msg-bubble">
                        <div class="msg-header">
                            <span class="msg-name"><?= $nome ?></span>
                            <span class="msg-time"><?= date('d/m/Y H:i', strtotime($msg['data_envio'])) ?></span>
                        </div>
                        <p><?= $msg['mensagem'] ?? '' ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center text-muted">💬 Nenhuma mensagem ainda. Comece a conversa!</p>
        <?php endif; ?>
    </div>
    <form method="POST" action="<?= baseUrl() ?>vagaMensagem/enviar/<?= (int)$dados['vaga_id'] ?>/<?= (int)$dados['curriculum_id'] ?>" class="chat-form">
        <textarea name="mensagem" class="form-control" placeholder="Escreva sua mensagem..." maxlength="1000" required></textarea>
        <button type="submit" class="site-button"><i class="fa fa-paper-plane"></i> Enviar</button>
    </form>
</div>
