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
						<ul class="post-job-bx">
							<?php foreach ($dados['estabelecimentos'] as $estabelecimentos): ?>
								<li>
									<a href="#">
										<div class="d-flex m-b10">
											<div class="job-post-company">
												<span><img src="<?= baseUrl() . 'imagem.php?file=estabelecimento/' . $estabelecimentos['logo'] ?>"/></span>
											</div>
											<div class="job-post-info">
												<h4>MaquiMinas - Equipamentos</h4>
												<ul>
													<li><i class="fa fa-map-marker" style="color: #0177c1;"></i> <?= ($estabelecimentos['cidade']) ?> - <?= ($estabelecimentos['uf']) ?></li>
													<li><i class="fa fa-clock-o" style="color: #6f42c1"></i>Cadastrada há <?= tempoCadastrado($estabelecimentos['data_criacao']) ?></li>
													<li><i class="fa fa-briefcase" style="color: #198754;"></i> <?= ($estabelecimentos['total_vagas']) ?> <?= ((int)$estabelecimentos['total_vagas'] === 1) ? 'vaga cadastrada' : 'vagas cadastradas' ?></li>
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
								<li class="previous"><a href="#"><i class="ti-arrow-left"></i> Anterior</a></li>
								<li class="active"><a href="#">1</a></li>
								<li><a href="#">2</a></li>
								<li><a href="#">3</a></li>
								<li class="next"><a href="#">Próxima <i class="ti-arrow-right"></i></a></li>
							</ul>
						</div>
					</div>
					<div class="col-xl-3 col-lg-4">
						<div class="sticky-top">
							<form method="GET" action="<?= baseUrl() ?>pessoafisica/filtrar">
								<div class="clearfix m-b30">
									<h5 class="widget-title font-weight-700 text-uppercase">Pesquisar Empresa</h5>
									<div class="">
										<input type="text" class="form-control" placeholder="Digite o nome da empresa" maxlength="30" minlength="3">
									</div>
								</div>
								<div class="clearfix m-b30">
									<h5 class="widget-title font-weight-700 text-uppercase">Cidade</h5>
									<select>
										<option valueCidade="">Todas as cidade</option>
										<?php foreach ($dados['aCidade'] as $valueCidade): ?>
											<option valueCidade="<?= $valueCidade['cidade_id'] ?>" <?= ($valueCidade['cidade_id'] == setValor("cidade_id") ? 'SELECTED' : '') ?>><?=$valueCidade['cidade'] . ' - ' . $valueCidade['uf'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="clearfix m-b30">
									<h5 class="widget-title font-weight-700 text-uppercase">Categoria</h5>
									<select>
										<option valueCidade="">Todas as categorias</option>
										<?php foreach ($dados['aCategoriaEstabelecimento'] as $valueCatEstab): ?>
											<option valueCatEstab="<?= $valueCatEstab['categoria_estabelecimento_id'] ?>" <?= ($valueCatEstab['categoria_estabelecimento_id'] == setValor("categoria_estabelecimento_id") ? 'SELECTED' : '') ?>><?=$valueCatEstab['descricao'] ?></option>
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