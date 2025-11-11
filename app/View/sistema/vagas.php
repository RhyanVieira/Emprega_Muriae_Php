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
            <h1 class="text-white">Vagas</h1>
				<div class="breadcrumb-row">
					<ul class="list-inline">
						<li>Encontre a vaga perfeita para você!</li>
					</ul>
				</div>
            </div>
        </div>
    </div>
    <div class="content-block">
		<div class="section-full bg-white browse-job content-inner-2">
			<div class="container">
				<div class="row">
					<div class="col-lg-9">
						<h4>Total: <?= ($dados['totalRegistros']) ?> <?= ((int)$dados['totalRegistros'] === 1) ? 'vaga encontrada' : 'vagas encontradas' ?></h4>
						<ul class="post-job-bx">
							<?php foreach ($dados['aVagas'] as $vagas): ?>
								<li>
									<a href="<?= baseUrl() ?>vaga/vaga_detalhada/<?= $vagas['vaga_id'] ?>">
										<div class="d-flex m-b30">
											<div class="job-post-company">
												<span><img src="<?= baseUrl() . 'imagem.php?file=estabelecimento/' . $vagas['logo'] ?>"/></span>
											</div>
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
										<span class="post-like fa fa-heart-o"></span>
									</a>
								</li>
							<?php endforeach; ?> 
						</ul>
						<div class="pagination-bx m-t30">
							<ul class="pagination">
								<?php if ($dados['paginaAtual'] > 1): ?>
									<li class="previous">
										<a href="<?= baseUrl() ?>vaga/index/<?= $dados['paginaAtual'] - 1 ?>/?<?= $queryString ?>">
											<i class="ti-arrow-left"></i> Anterior
										</a>
									</li>
								<?php endif; ?>
								<?php for ($i = 1; $i <= $dados['totalPaginas']; $i++): ?>
									<li class="<?= $i === $dados['paginaAtual'] ? 'active' : '' ?>">
										<a href="<?= baseUrl() ?>vaga/index/<?= $i ?>/?<?= $queryString ?>">
											<?= $i ?>
										</a>
									</li>
								<?php endfor; ?>
								<?php if ($dados['paginaAtual'] < $dados['totalPaginas']): ?>
									<li class="next">
										<a href="<?= baseUrl() ?>vaga/index/<?= $dados['paginaAtual'] + 1 ?>/?<?= $queryString ?>">
											Próximo <i class="ti-arrow-right"></i>
										</a>
									</li>
								<?php endif; ?>
							</ul>
						</div>
					</div>
					<div class="col-xl-3 col-lg-4">
						<div class="sticky-top">
							<form method="GET" action="<?= baseUrl() ?>vaga/index/1/">
								<div class="clearfix m-b30">
									<h5 class="widget-title font-weight-700 text-uppercase">Palavra Chave</h5>
									<input name="descricao" id="descricao" type="text" class="form-control"
										placeholder="Ex: vendedor, recepcionista..."
										maxlength="30" minlength="3"
										value="<?= htmlspecialchars($_GET['descricao'] ?? '') ?>">
								</div>
								<div class="clearfix m-b30">
									<h5 class="widget-title font-weight-700 text-uppercase">Cidade</h5>
									<select name="cidade_id" id="cidade_id">
										<option value="">Todas as cidades</option>
										<?php foreach ($dados['aCidade'] as $valueCidade): ?>
											<option value="<?= $valueCidade['cidade_id'] ?>"
												<?= ($valueCidade['cidade_id'] == ($_GET['cidade_id'] ?? '')) ? 'selected' : '' ?>>
												<?= $valueCidade['cidade'] . ' - ' . $valueCidade['uf'] ?>
											</option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="clearfix m-b30">
									<h5 class="widget-title font-weight-700 text-uppercase">Vínculo</h5>
									<select name="vinculo" id="vinculo">
										<option value="">Todos os vínculos</option>
										<?php foreach ($vinculos as $key => $label): ?>
											<option value="<?= $key ?>" <?= ($key == ($_GET['vinculo'] ?? '')) ? 'selected' : '' ?>><?= $label ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="clearfix m-b30">
									<h5 class="widget-title font-weight-700 text-uppercase">Modalidade</h5>
									<select name="modalidade" id="modalidade">
										<option value="">Todas as modalidades</option>
										<?php foreach ($modalidades as $key => $label): ?>
											<option value="<?= $key ?>" <?= ($key == ($_GET['modalidade'] ?? '')) ? 'selected' : '' ?>><?= $label ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="clearfix m-b30">
									<h5 class="widget-title font-weight-700 text-uppercase">Categoria</h5>
									<select name="categoria_vaga_id" id="categoria_vaga_id">
										<option value="">Todas as categorias</option>
										<?php foreach ($dados['aCategoriaVaga'] as $valueCatVaga): ?>
											<option value="<?= $valueCatVaga['categoria_vaga_id'] ?>"
												<?= ($valueCatVaga['categoria_vaga_id'] == ($_GET['categoria_vaga_id'] ?? '')) ? 'selected' : '' ?>>
												<?= $valueCatVaga['descricao'] ?>
											</option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="clearfix m-b30">
									<h5 class="widget-title font-weight-700 text-uppercase">Faixa Salarial</h5>
									<select name="faixaSal" id="faixaSal">
										<option value="">Todas</option>
										<?php foreach ($faixas as $val => $label): ?>
											<option value="<?= $val ?>" <?= ($val == ($_GET['faixaSal'] ?? '')) ? 'selected' : '' ?>><?= $label ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="clearfix m-b30">
									<h5 class="widget-title font-weight-700 text-uppercase">Nível</h5>
									<select name="nivelExperiencia" id="nivelExperiencia">
										<option value="">Todos os níveis</option>
										<?php foreach ($nivelExperiencia as $key => $label): ?>
											<option value="<?= $key ?>" <?= ($key == ($_GET['nivelExperiencia'] ?? '')) ? 'selected' : '' ?>><?= $label ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="clearfix">
									<button type="submit" class="site-button">Filtrar</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

