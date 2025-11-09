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
	6 => 'Trainee',
	7 => 'Freelancer'
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

setlocale(LC_TIME, 'pt_BR.UTF-8', 'pt_BR', 'portuguese');
?>

<div class="page-content bg-white">
    <!-- Banner INÍCIO -->
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
    <!-- Banner FIM -->
    <div class="content-block">
		<!-- Vagas disponíveis INÍCIO -->
		<div class="section-full bg-white browse-job content-inner-2">
			<div class="container">
				<div class="row">
				<div class="col-lg-9">
					<ul class="post-job-bx">
						<?php foreach ($dados['aVagas'] as $vagas): ?>
							<li>
								<a href="vaga_detalhada.html">
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
							<form method="GET" action="<?= baseUrl() ?>pessoafisica/filtrar">
								<div class="clearfix m-b30">
									<h5 class="widget-title font-weight-700 text-uppercase">Palavra Chave</h5>
									<div class="">
										<input type="text" class="form-control" placeholder="Ex: vendedor, recepcionista..." maxlength="30" minlength="3">
									</div>
								</div>
								<div class="clearfix m-b30">
									<h5 class="widget-title font-weight-700 text-uppercase">Cidade</h5>
									<select>
										<option value="">Todas as cidade</option>
										<?php foreach ($dados['aCidade'] as $value): ?>
                                            <option value="<?= $value['cidade_id'] ?>" <?= ($value['cidade_id'] == setValor("cidade_id") ? 'SELECTED' : '') ?>><?=$value['cidade'] . ' - ' . $value['uf'] ?></option>
                                        <?php endforeach; ?>
									</select>
								</div>
								<div class="clearfix m-b30">
									<h5 class="widget-title font-weight-700 text-uppercase">Vínculo</h5>
									<select>
										<option value="">Todos</option>
										<option value="1">CLT</option>
										<option value="2">PJ</option>
										<option value="3">Estágio</option>
										<option value="4">Temporário</option>
										<option value="5">Autônomo</option>
										<option value="6">Trainee</option>
										<option value="7">Freelancer</option>
									</select>
								</div>
								<div class="clearfix m-b30">
									<h5 class="widget-title font-weight-700 text-uppercase">Modalidade</h5>
									<div class="row m-l5">
										<div>
											<div class="product-brand">
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="check1" name="example1">
													<label class="custom-control-label" for="check1">Presencial</label>
												</div>
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="check2" name="example1">
													<label class="custom-control-label" for="check2">Híbrido</label>
												</div>
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="check3" name="example1">
													<label class="custom-control-label" for="check3">Remoto</label>
												</div>
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="check4" name="example1">
													<label class="custom-control-label" for="check4">Parcialmente Remoto</label>
												</div>
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="check4" name="example1">
													<label class="custom-control-label" for="check4">A combinar</label>
												</div>
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="check4" name="example1">
													<label class="custom-control-label" for="check4">Em campo (Externo)</label>
												</div>
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="check4" name="example1">
													<label class="custom-control-label" for="check4">Todas</label>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="clearfix m-b30">
									<h5 class="widget-title font-weight-700 text-uppercase">Categoria</h5>
									<select>
										<option value="">Todas</option>
										<?php foreach ($dados['aCategoriaVaga'] as $valueCatVaga): ?>
                                            <option value="<?= $valueCatVaga['categoria_vaga_id'] ?>" <?= ($valueCatVaga['categoria_vaga_id'] == setValor("categoria_vaga_id") ? 'SELECTED' : '') ?>><?=$valueCatVaga['descricao']?></option>
                                        <?php endforeach; ?>
									</select>
								</div>
								<div class="clearfix m-b30">
									<h5 class="widget-title font-weight-700 text-uppercase">Faixa Salarial</h5>
									<select>
										<option value="">Todas</option>
										<option value="A combinar">A combinar</option>
										<option value="1000-2000">R$1.000 - R$2.000</option>
										<option value="2000-4000">R$2.000 - R$4.000</option>
										<option value="4000-6000">R$4.000 - R$6.000</option>
										<option value="6000+">Acima de R$6.000</option>
									</select>
								</div>
								<div class="clearfix m-b30">
									<h5 class="widget-title font-weight-700 text-uppercase">Nível</h5>
									<div class="row m-l5">
										<div>
											<div class="product-brand">
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="check1" name="example1">
													<label class="custom-control-label" for="check1">Estágio</label>
												</div>
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="check2" name="example1">
													<label class="custom-control-label" for="check2">Trainee</label>
												</div>
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="check3" name="example1">
													<label class="custom-control-label" for="check3">Júnior (1 - 3 anos)</label>
												</div>
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="check4" name="example1">
													<label class="custom-control-label" for="check4">Pleno (3 - 5 anos)</label>
												</div>
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="check4" name="example1">
													<label class="custom-control-label" for="check4">Sênior (5+ anos)</label>
												</div>
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="check4" name="example1">
													<label class="custom-control-label" for="check4">Especialista</label>
												</div>
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="check4" name="example1">
													<label class="custom-control-label" for="check4">Gerência</label>
												</div>
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="check4" name="example1">
													<label class="custom-control-label" for="check4">Todas</label>
												</div>
											</div>
										</div>
									</div>
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
        <!-- Vagas disponíveis FIM -->
	</div>
</div>

