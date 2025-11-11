<?php
$queryString = http_build_query($_GET);
?>

<div class="page-content bg-white">
    <!-- inner page banner -->
    <div class="dez-bnr-inr overlay-black-middle" style="background-image:url(/assets/img/banner/Banner_Candidatos.jpg);">
        <div class="container">
            <div class="dez-bnr-inr-entry">
                <h1 class="text-white">Candidaturas</h1>
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
					<div class="col-xl-12 col-lg-12">
						<ul class="post-job-bx">
							<?php foreach ($dados['candidatos'] as $candidato): ?>
							<li>
								<a href="<?= baseUrl() ?>vagaMensagem/listar/<?=$dados['vaga']['vaga_id'] ?>/<?=$candidato['curriculum_id'] ?>">
									<div class="d-flex m-b20">
										<div class="job-post-company">
											<span>
												<img src="<?= baseUrl() . 'imagem.php?file=fotos_curriculos/' . $candidato['foto'] ?>" alt="<?= $candidato['nome_candidato'] ?>">
											</span>
										</div>
										<div class="job-post-info">
											<h4><?= htmlspecialchars($candidato['nome_candidato']) ?></h4>
											<ul>
												<li><i class="fa fa-map-marker" style="color: #0177c1;"></i> <?= $candidato['cidade'] ?> - <?= $candidato['uf'] ?></li>
												<li><i class="fa fa-clock-o" style="color: #6f42c1;"></i> Candidatou-se em <?= date('d/m/Y H:i', strtotime($candidato['dateCandidatura'])) ?></li>
												<li>
													<i class="fa fa-info-circle" style="color: #28a745;"></i> 
													Status:
													<?php
														switch ($candidato['statusCandidatura']) {
															case 1: echo '<span class="text-success">Em análise</span>'; break;
															case 2: echo '<span class="text-primary">Aprovado</span>'; break;
															case 3: echo '<span class="text-danger">Recusado</span>'; break;
															default: echo '<span class="text-muted">Indefinido</span>';
														}
													?>
												</li>
											</ul>
										</div>
									</div>
									<div class="d-flex">
										<div class="job-time mr-auto">
											<h6 class="m-b0">ID do Currículo:</h6>
											<span><?= $candidato['curriculum_id'] ?></span>
										</div>
									</div>
									<span class="post-like fa fa-heart-o"></span>
								</a>
							</li>
						<?php endforeach; ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
