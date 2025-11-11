<?php
// ======== TRATAMENTO DOS DADOS ========

// Cidade do currículo
$cidadeCurriculo = 'Não informada';
foreach ($dados['aCidade'] as $cidade) {
	if ($cidade['cidade_id'] == $dados['curriculo']['cidade_id']) {
		$cidadeCurriculo = "{$cidade['cidade']} - {$cidade['uf']}";
		break;
	}
}

// Escolaridade — buscar descrição completa
function getEscolaridade($lista, $id) {
	foreach ($lista as $item) {
		if ($item['escolaridade_id'] == $id) return $item['descricao'];
	}
	return 'Não informada';
}

// Cargo — buscar descrição completa
function getCargo($lista, $id) {
	foreach ($lista as $item) {
		if ($item['cargo_id'] == $id) return $item['descricao'];
	}
	return 'Não informado';
}

// Idioma — buscar descrição completa
function getIdioma($lista, $id) {
	foreach ($lista as $item) {
		if ($item['idioma_id'] == $id) return $item['descricao'];
	}
	return 'Não informado';
}

// Nível de idioma
function getNivelIdioma($nivel) {
	return match ($nivel) {
		1 => 'Básico',
		2 => 'Intermediário',
		3 => 'Avançado',
		4 => 'Fluente',
		default => 'Não informado'
	};
}
?>

<div class="page-wraper">
    <div class="page-content bg-white m-b40">
        <div class="content-block">
            <div class="section-full content-inner-1">
                <div class="container">
                    <div class="row">

                        <!-- COLUNA ESQUERDA -->
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
                                                    : baseUrl() . 'assets/img/user-placeholder.png'; // caminho da imagem padrão
                                                ?>
                                                <img src="<?= $imgSrc ?>" alt="<?= htmlspecialchars($nome) ?>" class="radius-sm w-100">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-6">
                                        <div class="widget bg-white p-lr20 p-t20 widget_getintuch radius-sm">
                                            <h4 class="text-black font-weight-700 p-t10 m-b15">Informações Pessoais</h4>
                                            <ul>
                                                <li class="m-t5">
                                                    <i class="ti-user" style="color:#0177c1;"></i>
                                                    <strong class="font-weight-700 text-black">Nome:</strong>
                                                    <span class="text-black-light"><?= htmlspecialchars($dados['curriculo']['nome']) ?></span>
                                                </li>
                                                <li class="m-t5">
                                                    <i class="ti-calendar" style="color:#e67e22;"></i>
                                                    <strong class="font-weight-700 text-black">Nascimento:</strong>
                                                    <span class="text-black-light"><?= date('d/m/Y', strtotime($dados['curriculo']['dataNascimento'])) ?></span>
                                                </li>
                                                <li class="m-t5">
                                                    <i class="ti-email" style="color:#17a2b8;"></i>
                                                    <strong class="font-weight-700 text-black">E-mail:</strong>
                                                    <span class="text-black-light"><?= htmlspecialchars($dados['curriculo']['email']) ?></span>
                                                </li>
                                                <li class="m-t5">
                                                    <i class="ti-mobile" style="color:#6f42c1;"></i>
                                                    <strong class="font-weight-700 text-black">Celular:</strong>
                                                    <span class="text-black-light"><?= htmlspecialchars($dados['curriculo']['celular']) ?></span>
                                                </li>
                                                <li class="m-t5">
                                                    <i class="ti-location-pin" style="color:#28a745;"></i>
                                                    <strong class="font-weight-700 text-black">Endereço:</strong>
                                                    <span class="text-black-light">
                                                        <?= htmlspecialchars($dados['curriculo']['logradouro']) ?>, 
                                                        <?= htmlspecialchars($dados['curriculo']['numero']) ?> 
                                                        <?= htmlspecialchars($dados['curriculo']['complemento']) ?> 
                                                        - <?= htmlspecialchars($dados['curriculo']['bairro']) ?>
                                                    </span>
                                                </li>
                                                <li class="m-t5">
                                                    <i class="ti-world" style="color:#007bff;"></i>
                                                    <strong class="font-weight-700 text-black">Cidade:</strong>
                                                    <span class="text-black-light"><?= $cidadeCurriculo ?></span>
                                                </li>
                                                <li class="m-t5">
                                                    <i class="ti-location-arrow" style="color:#f39c12;"></i>
                                                    <strong class="font-weight-700 text-black">CEP:</strong>
                                                    <span class="text-black-light"><?= htmlspecialchars($dados['curriculo']['cep']) ?></span>
                                                </li>
                                            </ul>

                                            <?php if (!empty($dados['curriculo']['curriculo_arquivo'])): ?>
                                                <a class="site-button m-t10" href="<?= baseUrl() ?>download.php?type=curriculos&file=<?= urlencode($dados['curriculo']['curriculo_arquivo']) ?>"><i class="ti-download" style="margin-right:5px;"></i> Baixar Currículo</a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- COLUNA DIREITA -->
                        <div class="col-lg-8">
                            <div class="job-info-box">

                                <!-- ESCOLARIDADE -->
                                <h5 class="font-weight-600">Formação Acadêmica</h5>
                                <div class="dez-divider divider-2px bg-gray-dark mb-4 mt-0"></div>
                                <?php if (!empty($dados['escolaridades'])): ?>
                                    <?php foreach ($dados['escolaridades'] as $esc): ?>
                                        <?php 
                                            $cidadeEsc = '';
                                            foreach ($dados['aCidade'] as $c) {
                                                if ($c['cidade_id'] == $esc['cidade_id']) {
                                                    $cidadeEsc = "{$c['cidade']} - {$c['uf']}";
                                                    break;
                                                }
                                            }
                                            $nivel = getEscolaridade($dados['aEscolaridade'], $esc['escolaridade_id']);
                                        ?>
                                        <p class="text-black-light">
                                            <strong><?= htmlspecialchars($esc['descricao']) ?></strong> — <?= htmlspecialchars($esc['instituicao']) ?><br>
                                            <small><?= $nivel ?> — <?= $cidadeEsc ?></small><br>
                                            <small>Período: <?= $esc['inicioMes'] ?>/<?= $esc['inicioAno'] ?> a <?= $esc['fimMes'] ?>/<?= $esc['fimAno'] ?></small>
                                        </p>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p class="text-black-light">Nenhuma formação cadastrada.</p>
                                <?php endif; ?>

                                <!-- EXPERIÊNCIAS -->
                                <h5 class="font-weight-600 m-t20">Experiências Profissionais</h5>
                                <div class="dez-divider divider-2px bg-gray-dark mb-4 mt-0"></div>
                                <?php if (!empty($dados['experiencias'])): ?>
                                    <?php foreach ($dados['experiencias'] as $exp): ?>
                                        <?php $cargoNome = getCargo($dados['aCargo'], $exp['cargo_id']); ?>
                                        <p class="text-black-light">
                                            <strong><?= htmlspecialchars($cargoNome) ?></strong> — <?= htmlspecialchars($exp['estabelecimento']) ?><br>
                                            <small>Período: <?= $exp['inicioMes'] ?>/<?= $exp['inicioAno'] ?> a <?= $exp['fimMes'] ?>/<?= $exp['fimAno'] ?></small><br>
                                            <em><?= htmlspecialchars($exp['atividadesExercidas']) ?></em>
                                        </p>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p class="text-black-light">Nenhuma experiência profissional cadastrada.</p>
                                <?php endif; ?>

                                <!-- QUALIFICAÇÕES -->
                                <h5 class="font-weight-600 m-t20">Qualificações</h5>
                                <div class="dez-divider divider-2px bg-gray-dark mb-4 mt-0"></div>
                                <?php if (!empty($dados['qualificacoes'])): ?>
                                    <?php foreach ($dados['qualificacoes'] as $q): ?>
                                        <p class="text-black-light">
                                            <strong><?= htmlspecialchars($q['descricao']) ?></strong> — <?= htmlspecialchars($q['instituicao']) ?><br>
                                            <small><?= $q['mes'] ?>/<?= $q['ano'] ?> — <?= $q['cargaHoraria'] ?>h</small>
                                        </p>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p class="text-black-light">Nenhuma qualificação cadastrada.</p>
                                <?php endif; ?>

                                <!-- IDIOMAS -->
                                <h5 class="font-weight-600 m-t20">Idiomas</h5>
                                <div class="dez-divider divider-2px bg-gray-dark mb-4 mt-0"></div>
                                <?php if (!empty($dados['idiomas'])): ?>
                                    <ul class="text-black-light">
                                        <?php foreach ($dados['idiomas'] as $i): ?>
                                            <?php 
                                                $idiomaNome = getIdioma($dados['aIdioma'], $i['idioma_id']); 
                                                $nivelNome = getNivelIdioma($i['nivel']);
                                            ?>
                                            <li><i class="ti-comment" style="color:#0177c1;"></i>
                                                <strong><?= htmlspecialchars($idiomaNome) ?></strong> — <?= $nivelNome ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php else: ?>
                                    <p class="text-black-light">Nenhum idioma cadastrado.</p>
                                <?php endif; ?>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
