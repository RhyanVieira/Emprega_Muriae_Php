<?php
$modalidades = [
    1 => 'Presencial',
    2 => 'Híbrido',
    3 => 'Remoto',
	4 => 'Parcialmente remoto',
	5 => 'A combinar',
	6 => 'Em campo (Externo)'
];

$vinculos = [
    1 => 'CLT',
    2 => 'PJ',
    3 => 'Freelancer',
    4 => 'Temporário',
    5 => 'Estágio',
	6 => 'Freelancer'
];

$nivelExperiencia = [
    1 => 'Estágiário',
    2 => 'Trainee',
    3 => 'Júnior',
    4 => 'Pleno',
    5 => 'Sênior',
	6 => 'Especialista',
	7 => 'Gerência'
];

$faixas = [
	'A combinar' => 'A combinar',
	'1000-2000' => 'R$1.000 - R$2.000',
	'2000-4000' => 'R$2.000 - R$4.000',
	'4000-6000' => 'R$4.000 - R$6.000',
	'6000+' => 'Acima de R$6.000'
];

setlocale(LC_TIME, 'pt_BR.UTF-8', 'pt_BR', 'portuguese');

$queryString = http_build_query($_GET);
?>

<div class="page-content bg-white">
    <div class="dez-bnr-inr overlay-black-middle" style="background-image:url(/assets/img/banner/Banner_Vagas.jpg);">
        <div class="container">
            <div class="dez-bnr-inr-entry">
            <h1 class="text-white">Minhas Vagas</h1>
				<div class="breadcrumb-row">
					<ul class="list-inline">
						<li>Acompanhe e gerencie suas vagas cadastradas.</li>
					</ul>
				</div>
            </div>
        </div>
    </div>
    <div class="content-block">
		<div class="section-full bg-white browse-job content-inner-2">
			<div class="container">
				<div class="row">
                    <div class="col-lg-4">
						<div class="sticky-top">
							<div class="row">
								<div class="col-lg-12 col-md-6">
									<div class="m-b30">
										<img src="<?= baseUrl() . 'imagem.php?file=estabelecimento/' . $dados['estabelecimento']['logo'] ?>" class="radius-sm w-100">
									</div>
								</div>
								<div class="col-lg-12 col-md-6">
									<div class="widget bg-white p-lr20 p-t20 widget_getintuch radius-sm">
										<h4 class="text-black font-weight-700 p-t10 m-b15"><?= $dados['estabelecimento']['nome'] ?></h4>
										<ul>
											<li class="m-t5"><i class="ti-location-pin" style="color: #f39c12;"></i>
												<strong class="font-weight-700 text-black">Localização:</strong>
												<span class="text-black-light"><?= $dados['estabelecimento']['cidade'] ?> - <?= $dados['estabelecimento']['uf'] ?></span>
											</li>
                                            <li class="m-t5">
                                                <i class="ti-map" style="color:#28a745;"></i>
                                                <strong class="font-weight-700 text-black">Endereço:</strong>
                                                <span class="text-black-light"><?= $dados['estabelecimento']['endereco'] ?></span>
                                            </li>
                                            <li class="m-t5">
                                                <i class="ti-email" style="color:#17a2b8;"></i>
                                                <strong class="font-weight-700 text-black">Email:</strong>
                                                <span class="text-black-light"><?= $dados['estabelecimento']['email'] ?></span>
                                            </li>
                                            <li class="m-t5">
                                                <i class="ti-world" style="color:#6f42c1;"></i>
                                                <strong class="font-weight-700 text-black">Site:</strong>
                                                <a href="<?= $dados['estabelecimento']['website'] ?>" target="_blank">
                                                    <span class="text-black-light"><?= $dados['estabelecimento']['website'] ?></span>
                                                </a>
                                            </li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-8">
						<?= exibeAlerta() ?>
						<h4>Total: <?= ($dados['totalRegistros']) ?> <?= ((int)$dados['totalRegistros'] === 1) ? 'vaga encontrada' : 'vagas encontradas' ?></h4>
						<ul class="post-job-bx">
							<?php foreach ($dados['vagas'] as $vagas): ?>
								<li>
									<a href="<?= baseUrl() ?>vaga/vaga_detalhada/<?= $vagas['vaga_id'] ?>">
										<div class="d-flex m-b30">
											<div class="job-post-info">
												<h4><?= ($vagas['descricao']) ?></h4>
												<ul>
													<li><i class="fa fa-map-marker text-alert" style="color: #0177c1;"></i> <?= ($vagas['cidade']) ?> - <?= ($vagas['uf']) ?></li>
													<li><i class="fa fa-calendar-times-o" style="color: #dc3545"></i>Término - <?= date('d/m/Y', strtotime($vagas['dtFim'])) ?></li>
													<li><i class="fa fa-clock-o" style="color: #6f42c1"></i><?= tempoPublicacao($vagas['dtInicio']) ?></li>
												</ul>
											</div>
										</div>
										<div class="d-flex">
											<div class="job-time mr-auto">
												<span class="m-r5"><?= $modalidades[$vagas['modalidade']] ?></span>
												<span class="m-r5"><?= $vinculos[$vagas['vinculo']] ?></span>
												<span class="m-r5"><?= $nivelExperiencia[$vagas['nivelExperiencia']] ?></span>
											</div>
											<div class="salary-bx">
												<span>
													<?php $faixaSal = $vagas['faixaSal'] ?? '';
														if (strtolower(trim($faixaSal)) === 'a combinar') {
															echo "<span>A combinar</span>";
														} elseif (!empty($faixaSal)) {
															echo "<span>R$ " . number_format((float)$faixaSal, 2, ',', '.') . "</span>";
														} else {
															echo "<span>Não informado</span>";
														}
													?>
												</span>
											</div>
										</div>
									</a>
								</li>
							<?php endforeach; ?> 
						</ul>
						<div class="pagination-bx m-t30">
							<ul class="pagination">
								<?php if ($dados['paginaAtual'] > 1): ?>
									<li class="previous">
										<a href="<?= baseUrl() ?>vaga/minhas_vagas/<?= $dados['paginaAtual'] - 1 ?>/?<?= $queryString ?>">
											<i class="ti-arrow-left"></i> Anterior
										</a>
									</li>
								<?php endif; ?>
								<?php for ($i = 1; $i <= $dados['totalPaginas']; $i++): ?>
									<li class="<?= $i === $dados['paginaAtual'] ? 'active' : '' ?>">
										<a href="<?= baseUrl() ?>vaga/minhas_vagas/<?= $i ?>/?<?= $queryString ?>">
											<?= $i ?>
										</a>
									</li>
								<?php endfor; ?>
								<?php if ($dados['paginaAtual'] < $dados['totalPaginas']): ?>
									<li class="next">
										<a href="<?= baseUrl() ?>vaga/minhas_vagas/<?= $dados['paginaAtual'] + 1 ?>/?<?= $queryString ?>">
											Próximo <i class="ti-arrow-right"></i>
										</a>
									</li>
								<?php endif; ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

