<?php

use Core\Library\Session;

$tipoUsuario = Session::get('userTipo');
$idEstab = Session::get('userEstabId');
$idPf = Session::get('userPfId');

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

?>
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
											<img src="<?= baseUrl() . 'imagem.php?file=estabelecimento/' . $dados['vaga']['logo'] ?>">
										</div>
									</div>
									<div class="col-lg-12 col-md-6">
										<div class="widget bg-white p-lr20 p-t20 widget_getintuch radius-sm">
											<h4 class="text-black font-weight-700 p-t10 m-b15">Detalhes da Vaga</h4>
											<ul>
												<li><i class="ti-home" style="color: #0177c1;"></i>
													<strong class="font-weight-700 text-black">Empresa:</strong>
													<a href="<?= baseUrl()?>estabelecimento/perfil/<?= $dados['vaga']['estabelecimento_id'] ?>"><span class="text-black-light"><?= $dados['vaga']['empresa'] ?></span></a>
												</li>
												<li class="m-t5"><i class="ti-location-pin" style="color: #f39c12;"></i>
													<strong class="font-weight-700 text-black">Localização:</strong>
													<span class="text-black-light"><?= $dados['vaga']['cidade'] ?> - <?= $dados['vaga']['uf'] ?></span>
												</li>
												<li class="m-t5"><i class="ti-money" style="color: #28a745;"></i>
													<strong class="font-weight-700 text-black">Salário:</strong>
													<?php $faixaSal = $dados['vaga']['faixaSal'] ?? '';
														if (strtolower(trim($faixaSal)) === 'a combinar') {
															echo "<span>A combinar</span>";
														} elseif (!empty($faixaSal)) {
															echo "<span>R$ " . number_format((float)$faixaSal, 2, ',', '.') . "</span>";
														} else {
															echo "<span>Não informado</span>";
														}
													?>
												</li>
												<li class="m-t5"><i class="ti-medall" style="color: #9b59b6;"></i>
													<strong class="font-weight-700 text-black">Nível de Experiência:</strong>
													<?= $nivelExperiencia[$dados['vaga']['nivelExperiencia']] ?>
												</li>
												<li class="m-t5"><i class="ti-briefcase" style="color: #007bff;"></i>
													<strong class="font-weight-700 text-black">Tipo de Contrato:</strong>
													<?= $vinculos[$dados['vaga']['vinculo']] ?>
												</li>
												<li class="m-t5"><i class="ti-desktop" style="color: #17a2b8;"></i>
													<strong class="font-weight-700 text-black">Modalidade:</strong>
													<?= $modalidades[$dados['vaga']['modalidade']] ?>
												</li>
												<li class="m-t5"><i class="ti-calendar" style="color: #dc3545;"></i>
													<strong class="font-weight-700 text-black">Término:</strong>
													<?= date('d/m/Y', strtotime($dados['vaga']['dtFim'])) ?>
												</li>
												<li class="m-t5"><i class="ti-layers-alt" style="color: #e67e22;"></i>
													<strong class="font-weight-700 text-black">Área:</strong>
													<?= $dados['vaga']['categoria'] ?>
												</li>
												<li class="m-t5"><i class="ti-id-badge" style="color: #6f42c1;"></i>
													<strong class="font-weight-700 text-black">Cargo:</strong>
													<?= $dados['vaga']['cargo'] ?>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-8">
							<div class="job-info-box">
								<?= exibeAlerta() ?>
								<h3 class="m-t0 m-b10 font-weight-700 title-head">
									<?= $dados['vaga']['descricao'] ?>
								</h3>
								<p class="p-t20">
									<?= $dados['vaga']['sobreaVaga'] ?>
								</p>
								<h5 class="font-weight-600">Responsabilidades</h5>
								<div class="dez-divider divider-2px bg-gray-dark mb-4 mt-0"></div>
								<p>
									<?= $dados['vaga']['responsabilidades'] ?>
								</p>
								<h5 class="font-weight-600">Requisitos</h5>
								<div class="dez-divider divider-2px bg-gray-dark mb-4 mt-0"></div>
								<p>
									<?= $dados['vaga']['requisitos'] ?>
								</p>
								<h5 class="font-weight-600">Benefícios</h5>
								<div class="dez-divider divider-2px bg-gray-dark mb-4 mt-0"></div>
								<p>
									<?= $dados['vaga']['beneficios'] ?>
								</p>
								<?php if (empty($tipoUsuario)): ?>
									<a href="<?= baseUrl() ?>login" class="site-button m-t20 m-b20">Candidatar-se à Vaga</a>
								<?php elseif ($tipoUsuario === 'PF'): ?>
									<form class="tab-pane fade show submit-resume shop-account" method="POST" action="<?= baseUrl() ?>vagaCurriculum/candidatar/<?= $dados['vaga']['vaga_id'] ?>">
										<div class="form-group">
											<label for="mensagem">Mensagem para o recrutador (opcional):</label>
											<textarea class="form-control" name="mensagem" id="mensagem" rows="6"></textarea>
											<p class="texto-dica">Ex.: Tenho experiência na área e disponibilidade imediata...</p>
										</div>
										<button type="submit" class="site-button m-t20">Enviar candidatura</button>
									</form>
								<?php elseif ($tipoUsuario === 'E' &&  $dados['vaga']['estabelecimento_id']  == $idEstab ): ?>
									<a href="<?= baseUrl() ?>vaga/form/update/<?= $dados['vaga']['vaga_id'] ?>" class="site-button m-t20 m-b20">Editar Vaga</a>
								<?php endif; ?>
								<div class="vaga-actions m-t20">
									<?php if ($userTipo === 'PF'): ?>
										<!-- Para candidato -->
										<a href="<?= baseUrl() ?>vagaMensagem/listar/<?= $dados['vaga']['vaga_id'] ?>/<?= $dados['curriculum']['curriculum_id'] ?>" class="site-button-outline m-r10"><i class="fa fa-comments"></i> Ver mensagens</a>
									<?php elseif ($userTipo === 'E' && $idEstab == $dados['vaga']['estabelecimento_id']): ?>
										<a href="<?= baseUrl() ?>vagaCurriculum/candidatos/<?= $dados['vaga']['vaga_id'] ?>" class="site-button"><i class="fa fa-comments"></i> Ver candidatos</a>
										<a href="<?= baseUrl() ?>vagaMensagem/listarEmpresa/<?= $dados['vaga']['vaga_id'] ?>" class="site-button"><i class="fa fa-comments"></i> Mensagens dos candidatos</a>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>