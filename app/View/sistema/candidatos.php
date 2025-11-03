
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
							<ul class="post-job-bx">
								<?php foreach ($dados['curriculosPublicos'] as $curriculos): ?>
									<li>
										<a href="#">
											<div class="d-flex m-b30">
												<div class="job-post-company">
													<span><img src="images/candidatos/pic1.jpg"/></span>
												</div>
												<div class="job-post-info">
													<h4><?= ($curriculos['nome']) ?></h4>
													<ul>
														<li><i class="fa fa-map-marker" style="color: #0177c1;"></i> <?= ($curriculos['cidade']) ?> - <?= ($curriculos['uf']) ?></li>
														<li><i class="fa fa-birthday-cake text-warning"></i> <?= ($curriculos['idade']) ?> anos</li>
													</ul>
												</div>
											</div>
											<div class="d-flex">
												<div class="job-time mr-auto">
													<?php
													// Quebra e normaliza as listas
													$qualificacoesArr = array_filter(array_map('trim', explode(',', (string)($curriculos['qualificacoes'] ?? ''))));
													$idiomasArr       = array_filter(array_map('trim', explode(',', (string)($curriculos['idiomas'] ?? ''))));
													// Render chips de qualificações
													foreach ($qualificacoesArr as $q): ?>
														<span><?= htmlspecialchars($q) ?></span>
													<?php endforeach; ?>
													<?php if ($qualificacoesArr && $idiomasArr): ?>
														<span style="margin:0 6px;"></span>
													<?php endif; ?>
													<!-- Render chips de idiomas -->
													<?php foreach ($idiomasArr as $i): ?>
														<span><?= htmlspecialchars($i) ?></span>
													<?php endforeach; ?>
												</div>
											</div>
											<div class="d-flex">
												<div class="job-time mr-auto">
													<h6 class="mb-0 m-t20">Experiência:</h6>
													<?php
													// Quebra e normaliza as listas
													$cargosArr = array_filter(array_map('trim', explode(',', (string)($curriculos['cargos'] ?? ''))));
													// Render chips de qualificações
													foreach ($cargosArr as $c): ?>
														<span><?= htmlspecialchars($c) ?></span>
													<?php endforeach; ?>
												</div>
											</div>
											<span class="post-like fa fa-heart-o"></span>
										</a>
									</li>
								<?php endforeach; ?>
							<div class="pagination-bx m-t30">
								<ul class="pagination">
									<li class="previous"><a href="#"><i class="ti-arrow-left"></i> Anterior</a></li>
									<li class="active"><a href="#">1</a></li>
									<li><a href="#">2</a></li>
									<li><a href="#">3</a></li>
									<li class="next"><a href="#">Próximo <i class="ti-arrow-right"></i></a></li>
								</ul>
							</div>
						</div>
						<div class="col-xl-3 col-lg-4">
							<div class="sticky-top">
								<div class="clearfix m-b30">
									<h5 class="widget-title font-weight-700 text-uppercase">Cargo - Experiência</h5>
									<select>
										<option>Qualquer</option>
										<?php foreach ($dados['aCargo'] as $valueCargo): ?>
                                            <option value="<?= $valueCargo['cargo_id'] ?>" <?= ($valueCargo['cargo_id'] == setValor("cargo_id") ? 'SELECTED' : '') ?>><?=$valueCargo['descricao']?></option>
                                        <?php endforeach; ?>
									</select>
								</div>
								<div class="clearfix m-b30">
									<h5 class="widget-title font-weight-700 text-uppercase">Cidade</h5>
									<select>
										<option>Qualquer Lugar</option>
										<?php foreach ($dados['aCidade'] as $value): ?>
											<option value="<?= $value['cidade_id'] ?>" <?= ($value['cidade_id'] == setValor("cidade_id") ? 'SELECTED' : '') ?>><?=$value['cidade'] . ' - ' . $value['uf'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="clearfix m-b30">
									<h5 class="widget-title font-weight-700 text-uppercase">Faixa Etária</h5>
									<div class="row">
										<div class="col-lg-6 col-md-6 col-sm-6 col-6">
											<div class="product-brand">
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="check1" name="example1">
													<label class="custom-control-label" for="check1">18 - 25</label>
												</div>
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="check2" name="example1">
													<label class="custom-control-label" for="check2">26 - 30</label>
												</div>
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="check3" name="example1">
													<label class="custom-control-label" for="check3">31 - 35</label>
												</div>
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="check4" name="example1">
													<label class="custom-control-label" for="check4">36 - 40</label>
												</div>
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="check5" name="example1">
													<label class="custom-control-label" for="check5">41 - 45</label>
												</div><div class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="check6" name="example1">
													<label class="custom-control-label" for="check6">46 - 50</label>
												</div>
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="check7" name="example1">
													<label class="custom-control-label" for="check7">51+</label>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="clearfix m-b30">
									<h5 class="widget-title font-weight-700 text-uppercase">Idioma</h5>
									<select>
										<option>Qualquer Idioma</option>
											<?php foreach ($dados['aIdioma'] as $valueIdioma): ?>
                                                <option value="<?= $valueIdioma['idioma_id'] ?>" <?= ($valueIdioma['idioma_id'] == setValor("idioma_id") ? 'SELECTED' : '') ?>><?=$valueIdioma['descricao']?></option>
                                            <?php endforeach; ?>
									</select>
								</div>
								<div class="clearfix m-b30">
									<a href="<?= baseUrl() ?>usuario" class="site-button">Filtrar</a>
								</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>
</div>
