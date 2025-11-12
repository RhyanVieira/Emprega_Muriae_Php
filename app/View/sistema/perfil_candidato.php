<div class="page-wraper">
    <div class="page-content bg-white m-b40">
        <div class="content-block">
            <div class="section-full content-inner-1">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="sticky-top">
                                <div class="row">
                                    <div class="col-lg-12 col-md-6">
                                        <div class="m-b30">
                                            <?php 
                                                $foto = $dados['curriculo']['foto'] ?? '';
                                                $nome = $dados['curriculo']['nome'] ?? 'Sem nome';
                                                $imgSrc = !empty($foto)
                                                    ? baseUrl() . 'imagem.php?file=fotos_curriculos/' . htmlspecialchars($foto)
                                                    : baseUrl() . 'assets/img/user-placeholder.png';
                                            ?>
                                            <img src="<?= $imgSrc ?>" 
                                                class="radius-sm w-100" 
                                                style="height: 260px; object-fit: cover; border-radius: 10px;">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-6">
                                        <div class="widget bg-white p-lr20 p-t20 widget_getintuch radius-sm">
                                            <h4 class="text-black font-weight-700 p-t10 m-b15">Informações do Candidato</h4>
                                            <ul>
                                                <li class="m-t5">
                                                    <i class="ti-user" style="color:#0177c1;"></i>
                                                    <strong class="font-weight-700 text-black">Nome:</strong>
                                                    <p class="text-black-light"><?= $dados['curriculo']['nome'] ?? 'Não informado' ?></p>
                                                </li>
                                                <li class="m-t5">
                                                    <i class="ti-calendar" style="color:#e67e22;"></i>
                                                    <strong class="font-weight-700 text-black">Nascimento:</strong>
                                                    <p class="text-black-light">
                                                        <?= !empty($dados['curriculo']['dataNascimento']) 
                                                            ? date('Y/m/d', strtotime($dados['curriculo']['dataNascimento'])) 
                                                            : 'Não informado' ?>
                                                    </p>
                                                </li>
                                                <li class="m-t5">
                                                    <i class="ti-email" style="color:#17a2b8;"></i>
                                                    <strong class="font-weight-700 text-black">E-mail:</strong>
                                                    <p class="text-black-light"><?= $dados['curriculo']['email'] ?? 'Não informado' ?></p>
                                                </li>
                                                <li class="m-t5">
                                                    <i class="ti-mobile" style="color:#6f42c1;"></i>
                                                    <strong class="font-weight-700 text-black">Celular:</strong>
                                                    <p class="text-black-light"><?= $dados['curriculo']['celular'] ?? 'Não informado' ?></p>
                                                </li>
                                                <li class="m-t5">
                                                    <i class="ti-location-pin" style="color:#28a745;"></i>
                                                    <strong class="font-weight-700 text-black">Endereço:</strong>
                                                    <p class="text-black-light">
                                                        <?= $dados['curriculo']['logradouro'] ?? '' ?>, 
                                                        <?= $dados['curriculo']['numero'] ?? '' ?> 
                                                        <?= $dados['curriculo']['complemento'] ?? '' ?> 
                                                        - <?= $dados['curriculo']['bairro'] ?? '' ?>
                                                    </p>
                                                </li>
                                                <li class="m-t5">
                                                    <i class="ti-world" style="color:#007bff;"></i>
                                                    <strong class="font-weight-700 text-black">Cidade:</strong>
                                                    <p class="text-black-light">
                                                        <?= ($dados['curriculo']['cidade'] ?? 'Não informada') . (!empty($dados['curriculo']['uf']) ? ' - ' . $dados['curriculo']['uf'] : '') ?>
                                                    </p>
                                                </li>
                                                <li class="m-t5">
                                                    <i class="ti-location-arrow" style="color:#f39c12;"></i>
                                                    <strong class="font-weight-700 text-black">CEP:</strong>
                                                    <p class="text-black-light"><?= $dados['curriculo']['cep'] ?? 'Não informado' ?></p>
                                                </li>
                                                <li class="m-t5">
                                                    <i class="ti-timer" style="color:#9b59b6;"></i>
                                                    <strong class="font-weight-700 text-black">Cadastrado em:</strong>
                                                    <p class="text-black-light">
                                                        <?= !empty($dados['curriculo']['data_criacao']) 
                                                            ? date('Y/m/d', strtotime($dados['curriculo']['data_criacao'])) 
                                                            : 'Não informado' ?>
                                                    </p>
                                                </li>
                                                <li class="m-t5">
                                                    <?php if (!empty($dados['curriculo']['curriculo_arquivo'])): ?>
                                                        <a href="<?= baseUrl() ?>download.php?type=curriculos&file=<?= urlencode($dados['curriculo']['curriculo_arquivo']) ?>" class="site-button m-t10 w-100 text-center"><i class="ti-download" style="margin-right:5px;"></i> Baixar Currículo</a>
                                                    <?php endif; ?>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="job-info-box">
                                <h3 class="m-t0 m-b10 font-weight-700 title-head">
                                    <?= exibeAlerta() ?>
                                    <?= $dados['curriculo']['nome'] ?? 'Candidato' ?>
                                </h3>
                                <?php if (!empty($dados['curriculo']['apresentacaoPessoal'])): ?>
                                    <h5 class="font-weight-600">Apresentação Pessoal</h5>
                                    <div class="dez-divider divider-2px bg-gray-dark mb-4 mt-0"></div>
                                    <p class="text-black-light"><?= $dados['curriculo']['apresentacaoPessoal'] ?></p>
                                <?php endif; ?>
                                <h5 class="font-weight-600">Formação Acadêmica</h5>
                                <div class="dez-divider divider-2px bg-gray-dark mb-4 mt-0"></div>
                                <?php if (!empty($dados['escolaridades'])): ?>
                                    <?php foreach ($dados['escolaridades'] as $esc): ?>
                                        <p class="text-black-light">
                                            <strong><?= $esc['descricao'] ?></strong> — <?= $esc['instituicao'] ?><br>
                                            <small><?= $esc['escolaridade'] ?> — <?= $esc['cidade'] . ' - ' . $esc['uf'] ?></small><br>
                                            <small>Período: <?= $esc['inicioAno'] ?>/<?= str_pad($esc['inicioMes'], 2, '0', STR_PAD_LEFT) ?> a <?= $esc['fimAno'] ?>/<?= str_pad($esc['fimMes'], 2, '0', STR_PAD_LEFT) ?></small>
                                        </p>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p class="text-muted">Nenhuma formação cadastrada.</p>
                                <?php endif; ?>
                                <h5 class="font-weight-600">Experiências Profissionais</h5>
                                <div class="dez-divider divider-2px bg-gray-dark mb-4 mt-0"></div>
                                <?php if (!empty($dados['experiencias'])): ?>
                                    <?php foreach ($dados['experiencias'] as $exp): ?>
                                        <p class="text-black-light">
                                            <strong><?= $exp['cargo'] ?></strong> — <?= $exp['estabelecimento'] ?><br>
                                            <small>Período: <?= $exp['inicioAno'] ?>/<?= str_pad($exp['inicioMes'], 2, '0', STR_PAD_LEFT) ?> a <?= $exp['fimAno'] ?>/<?= str_pad($exp['fimMes'], 2, '0', STR_PAD_LEFT) ?></small><br>
                                            <em><?= $exp['atividadesExercidas'] ?></em>
                                        </p>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p class="text-muted">Nenhuma experiência profissional cadastrada.</p>
                                <?php endif; ?>
                                <h5 class="font-weight-600">Qualificações</h5>
                                <div class="dez-divider divider-2px bg-gray-dark mb-4 mt-0"></div>
                                <?php if (!empty($dados['qualificacoes'])): ?>
                                    <?php foreach ($dados['qualificacoes'] as $q): ?>
                                        <p class="text-black-light">
                                            <strong><?= $q['descricao'] ?></strong> — <?= $q['instituicao'] ?><br>
                                            <small><?= $q['ano'] ?>/<?= str_pad($q['mes'], 2, '0', STR_PAD_LEFT) ?> — <?= $q['cargaHoraria'] ?>h</small>
                                        </p>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p class="text-muted">Nenhuma qualificação cadastrada.</p>
                                <?php endif; ?>
                                <h5 class="font-weight-600">Idiomas</h5>
                                <div class="dez-divider divider-2px bg-gray-dark mb-4 mt-0"></div>
                                <?php if (!empty($dados['idiomas'])): ?>
                                    <ul class="text-black-light">
                                        <?php foreach ($dados['idiomas'] as $i): ?>
                                            <?php
                                                $nivelNome = match ($i['nivel']) {
                                                    1 => 'Básico',
                                                    2 => 'Intermediário',
                                                    3 => 'Avançado',
                                                    4 => 'Fluente',
                                                    default => 'Não informado'
                                                };
                                            ?>
                                            <li>
                                                <i class="ti-comment" style="color:#0177c1;"></i>
                                                <strong><?= $i['idioma'] ?></strong> — <?= $nivelNome ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php else: ?>
                                    <p class="text-muted">Nenhum idioma cadastrado.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
