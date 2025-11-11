<?php
$queryString = http_build_query($_GET);
?>

<div class="page-content bg-white">
    <div class="dez-bnr-inr overlay-black-middle" style="background-image:url(/assets/img/banner/Banner_Empresa.jpg);">
        <div class="container">
            <div class="dez-bnr-inr-entry">
				<h1 class="text-white">Empresas</h1>
				<div class="breadcrumb-row">
					<ul class="list-inline">
						<li>Empresas que confiam e recrutam com a nossa plataforma</li>
					</ul>
				</div>
            </div>
        </div>
    </div>
	<div class="content-block">
        <div class="section-full bg-white browse-job content-inner-2">
			<div class="container">
				<div class="row">
					<div class="col-xl-9 col-lg-8">
						<h4>Total: <?= ($dados['totalRegistros']) ?> <?= ((int)$dados['totalRegistros'] === 1) ? 'empresa encontrada' : 'empresas encontradas' ?></h4>
						<ul class="post-job-bx">
							<?php foreach ($dados['estabelecimentos'] as $estabelecimentos): ?>
								<li>
									<a href="#">
										<div class="d-flex m-b10">
											<div class="job-post-company">
												<span><img src="<?= baseUrl() . 'imagem.php?file=estabelecimento/' . $estabelecimentos['logo'] ?>"/></span>
											</div>
											<div class="job-post-info">
												<h4><?= $estabelecimentos['nome'] ?></h4>
												<ul>
													<li><i class="fa fa-map-marker" style="color: #0177c1;"></i> 
														<?= ($estabelecimentos['cidade']) ?> - <?= ($estabelecimentos['uf']) ?>
													</li>
													<li><i class="fa fa-clock-o" style="color: #6f42c1"></i>
														Cadastrada há <?= tempoCadastrado($estabelecimentos['data_criacao']) ?>
													</li>
													<li><i class="fa fa-briefcase" style="color: #198754;"></i> 
														<?= ($estabelecimentos['total_vagas']) ?> <?= ((int)$estabelecimentos['total_vagas'] === 1) ? 'vaga cadastrada' : 'vagas cadastradas' ?>
													</li>
												</ul>
												<p class="m-t10 text-gray"> <?= ($estabelecimentos['descricao']) ?> </p>
											</div>
										</div>
										<div class="d-flex">
											<div class="job-time mr-auto">
												<?php
													$categoriasArr = array_filter(array_map('trim', explode(',', (string)($estabelecimentos['categorias'] ?? ''))));
												?>
												<h6 class="m-b0">Categorias de Atuação:</h6>
												<?php if(!empty($categoriasArr)) :
													foreach ($categoriasArr as $c): ?> 
														<span class="m-r5"><?=  htmlspecialchars($c) ?></span>
													<?php endforeach; ?>
												<?php else: ?> 
													<p class="texto-dica">Nenhuma categoria cadastrada.</p>
												<?php endif; ?>
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
										<a href="<?= baseUrl() ?>estabelecimento/index/<?= $dados['paginaAtual'] - 1 ?>/?<?= $queryString ?>">
											<i class="ti-arrow-left"></i> Anterior
										</a>
									</li>
								<?php endif; ?>

								<?php for ($i = 1; $i <= $dados['totalPaginas']; $i++): ?>
									<li class="<?= $i === $dados['paginaAtual'] ? 'active' : '' ?>">
										<a href="<?= baseUrl() ?>estabelecimento/index/<?= $i ?>/?<?= $queryString ?>">
											<?= $i ?>
										</a>
									</li>
								<?php endfor; ?>

								<?php if ($dados['paginaAtual'] < $dados['totalPaginas']): ?>
									<li class="next">
										<a href="<?= baseUrl() ?>estabelecimento/index/<?= $dados['paginaAtual'] + 1 ?>/?<?= $queryString ?>">
											Próximo <i class="ti-arrow-right"></i>
										</a>
									</li>
								<?php endif; ?>
							</ul>
						</div>
					</div>
					<div class="col-xl-3 col-lg-4">
						<div class="sticky-top">
							<form method="GET" action="<?= baseUrl() ?>estabelecimento/index/1/">
								<div class="clearfix m-b30">
									<h5 class="widget-title font-weight-700 text-uppercase">Pesquisar Empresa</h5>
									<input type="text" name="nome" id="nome" class="form-control" placeholder="Digite o nome da empresa" maxlength="30" minlength="3" value="<?= htmlspecialchars($_GET['nome'] ?? '') ?>">
								</div>
								<div class="clearfix m-b30">
									<h5 class="widget-title font-weight-700 text-uppercase">Cidade</h5>
									<select name="cidade_id" id="cidade_id">
										<option value="">Todas as cidade</option>
										<?php foreach ($dados['aCidade'] as $valueCidade): ?>
											<option value="<?= $valueCidade['cidade_id'] ?>"
												<?= ($valueCidade['cidade_id'] == ($_GET['cidade_id'] ?? '')) ? 'selected' : '' ?>>
												<?= $valueCidade['cidade'] . ' - ' . $valueCidade['uf'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="clearfix m-b30">
									<h5 class="widget-title font-weight-700 text-uppercase">Categoria</h5>
									<select name="categoria_id" id="categoria_id">
										<option value="">Todas as categorias</option>
										<?php foreach ($dados['aCategoriaEstabelecimento'] as $valueCatEstab): ?>
											<option value="<?= $valueCatEstab['categoria_estabelecimento_id'] ?>"
												<?= ($valueCatEstab['categoria_estabelecimento_id'] == ($_GET['categoria_id'] ?? '')) ? 'selected' : '' ?>>
												<?= $valueCatEstab['descricao'] ?>
											</option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="clearfix">
									<button type="submit" class="site-button">Filtrar</button>
									<button type="button" class="site-button m-l5">Limpar Filtros</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>