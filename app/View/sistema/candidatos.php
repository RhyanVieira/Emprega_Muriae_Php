<?php
$queryString = http_build_query($_GET);
?>

<div class="page-content bg-white">
    <!-- inner page banner -->
    <div class="dez-bnr-inr overlay-black-middle" style="background-image:url(/assets/img/banner/Banner_Candidatos.jpg);">
        <div class="container">
            <div class="dez-bnr-inr-entry">
                <h1 class="text-white">Encontre Candidatos</h1>
				<!-- Breadcrumb row -->
				<div class="breadcrumb-row">
					<ul class="list-inline">
						<li>Encontre o talento ideal para sua empresa</li>
					</ul>
				</div>
				<!-- Breadcrumb row END -->
            </div>
        </div>
    </div>
    <!-- inner page banner END -->
	<div class="content-block">
        <div class="section-full bg-white browse-job content-inner-2">
			<div class="container">
				<div class="row">
					<div class="col-xl-9 col-lg-8">
						<h4>Total: <?= ($dados['totalRegistros']) ?> <?= ((int)$dados['totalRegistros'] === 1) ? 'candidato encontrado' : 'candidatos encontrados' ?></h4>
						<ul class="post-job-bx">
							<?php foreach ($dados['aCurriculos'] as $curriculos): ?>
								<li>
									<a href="#">
										<div class="d-flex m-b20">
											<div class="job-post-company">
												<span><img src="<?= baseUrl() . 'imagem.php?file=fotos_curriculos/' . $curriculos['foto'] ?>"/></span>
											</div>
											<div class="job-post-info">
												<h4><?= ($curriculos['nome']) ?></h4>
												<ul>
													<li><i class="fa fa-map-marker" style="color: #0177c1;"></i> <?= ($curriculos['cidade']) ?> - <?= ($curriculos['uf']) ?></li>
													<li><i class="fa fa-birthday-cake" style="color: #ffc107"></i> <?= ($curriculos['idade']) ?> anos</li>
													<li><i class="fa fa-clock-o" style="color: #6f42c1"></i> Cadastrado há <?= tempoCadastrado($curriculos['data_criacao']) ?></li>
												</ul>
											</div>
										</div>
										<div class="d-flex">
											<div class="job-time mr-auto">
												<?php
													$qualificacoesArr = array_filter(array_map('trim', explode(',', (string)($curriculos['qualificacoes'] ?? ''))));
													$idiomasArr       = array_filter(array_map('trim', explode(',', (string)($curriculos['idiomas'] ?? ''))));
													$experienciasArr = array_filter(array_map('trim', explode(',', (string)($curriculos['cargos'] ?? ''))));
												?>
												<h6 class="m-b0">Qualificações:</h6>
												<?php if(!empty($qualificacoesArr)) :
													foreach ($qualificacoesArr as $q): ?> 
														<span class="m-r5"><?=  htmlspecialchars($q) ?></span>
													<?php endforeach; ?>
												<?php else: ?> 
													<p class="texto-dica">Nenhuma qualificação cadastrada.</p>
												<?php endif; ?>
												<h6 class="m-b0 m-t10">Idiomas:</h6>
												<?php if(!empty($idiomasArr)) :
													foreach ($idiomasArr as $i): ?> 
														<span class="m-r5"><?=  htmlspecialchars($i) ?></span>
													<?php endforeach; ?>
												<?php else: ?> 
													<p class="texto-dica">Nenhum idioma cadastrado.</p>
												<?php endif; ?>
												<h6 class="m-b0 m-t10">Experiências:</h6>
												<?php if(!empty($experienciasArr)) :
													foreach ($experienciasArr as $e): ?> 
														<span class="m-r5"><?=  htmlspecialchars($e) ?></span>
													<?php endforeach; ?>
												<?php else: ?> 
													<p class="texto-dica">Nenhuma experiência cadastrada.</p>
												<?php endif; ?>
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
										<a href="<?= baseUrl() ?>pessoaFisica/index/<?= $dados['paginaAtual'] - 1 ?>/?<?= $queryString ?>">
											<i class="ti-arrow-left"></i> Anterior
										</a>
									</li>
								<?php endif; ?>
								<?php for ($i = 1; $i <= $dados['totalPaginas']; $i++): ?>
									<li class="<?= $i === $dados['paginaAtual'] ? 'active' : '' ?>">
										<a href="<?= baseUrl() ?>pessoaFisica/index/<?= $i ?>/?<?= $queryString ?>">
											<?= $i ?>
										</a>
									</li>
								<?php endfor; ?>
								<?php if ($dados['paginaAtual'] < $dados['totalPaginas']): ?>
									<li class="next">
										<a href="<?= baseUrl() ?>pessoaFisica/index/<?= $dados['paginaAtual'] + 1 ?>/?<?= $queryString ?>">
											Próximo <i class="ti-arrow-right"></i>
										</a>
									</li>
								<?php endif; ?>
							</ul>
						</div>
					</div>
					<div class="col-xl-3 col-lg-4">
						<div class="sticky-top">
							<form method="GET" action="<?= baseUrl() ?>pessoaFisica/index/1">
								<div class="clearfix m-b30">
									<h5 class="widget-title font-weight-700 text-uppercase">Cargo - Experiência</h5>
									<select name="cargo_id" id="cargo_id">
										<option value="">Todos os cargos</option>
										<?php foreach ($dados['aCargo'] as $valueCargo): ?>
											<option value="<?= $valueCargo['cargo_id'] ?>"
												<?= ($valueCargo['cargo_id'] == ($_GET['cargo_id'] ?? '')) ? 'selected' : '' ?>>
												<?= $valueCargo['descricao'] ?>
											</option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="clearfix m-b30">
									<h5 class="widget-title font-weight-700 text-uppercase">Cidade</h5>
									<select name="cidade_id" id="cidade_id">
										<option value="">Todas as cidades</option>
										<?php foreach ($dados['aCidade'] as $value): ?>
											<option value="<?= $value['cidade_id'] ?>"
												<?= ($value['cidade_id'] == ($_GET['cidade_id'] ?? '')) ? 'selected' : '' ?>>
												<?= $value['cidade'] . ' - ' . $value['uf'] ?>
											</option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="clearfix m-b30">
									<h5 class="widget-title font-weight-700 text-uppercase">Faixa Etária</h5>
									<select name="faixaEtaria" id="faixaEtaria">
										<option value="">Todas as idades</option>
										<?php
										$faixas = ['18-25','26-30','31-35','36-40','41-45','46-50','50+'];
										foreach ($faixas as $faixa): ?>
											<option value="<?= $faixa ?>" <?= ($faixa == ($_GET['faixaEtaria'] ?? '')) ? 'selected' : '' ?>>
												<?= $faixa ?>
											</option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="clearfix m-b30">
									<h5 class="widget-title font-weight-700 text-uppercase">Idioma</h5>
									<select name="idioma_id" id="idioma_id">
										<option value="">Qualquer idioma</option>
										<?php foreach ($dados['aIdioma'] as $valueIdioma): ?>
											<option value="<?= $valueIdioma['idioma_id'] ?>"
												<?= ($valueIdioma['idioma_id'] == ($_GET['idioma_id'] ?? '')) ? 'selected' : '' ?>>
												<?= $valueIdioma['descricao'] ?>
											</option>
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
