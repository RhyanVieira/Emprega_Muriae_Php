<div class="page-content bg-white">
    <div class="dez-bnr-inr overlay-black-middle" style="background-image:url(/assets/img/banner/Banner_Candidatos.jpg);">
        <div class="container">
            <div class="dez-bnr-inr-entry">
                <h1 class="text-white">Candidaturas para <?= $dados['vaga']['descricao'] ?? 'a vaga' ?></h1>
				<div class="breadcrumb-row">
					<ul class="list-inline">
						<li>Confira os candidatos interessados nesta vaga</li>
					</ul>
				</div>
            </div>
        </div>
    </div>
	<div class="content-block">
        <div class="section-full bg-white browse-job content-inner-2">
			<div class="container">
				<div class="row">
					<div class="col-xl-12 col-lg-12">
						<h4>Total: <?= count($dados['candidatos']) ?> <?= (count($dados['candidatos']) === 1) ? 'candidato encontrado' : 'candidatos encontrados' ?></h4>
						<ul class="post-job-bx">
							<?php if (!empty($dados['candidatos'])): ?>
								<?php foreach ($dados['candidatos'] as $candidato): ?>
									<li class="p-3" style="border: 1px solid #eee; border-radius: 8px;">
										<div class="d-flex m-b20 align-items-center">
											<div class="row m-l20">
												<div class="job-post-company">
													<img src="<?= baseUrl() . 'imagem.php?file=fotos_curriculos/' . ($candidato['foto'] ?: 'padrao.png') ?>"
														alt="<?= htmlspecialchars($candidato['nome_candidato']) ?>"
														style="width: 90px; height: 90px; object-fit: cover; border-radius: 8px;">
												</div>
												<div class="job-post-info m-l10">
													<h4 class="m-b5">
														<a href="<?= baseUrl() ?>pessoaFisica/perfil/<?= $candidato['pessoa_fisica_id'] ?>" 
														class="text-black font-weight-700">
														<?= htmlspecialchars($candidato['nome_candidato']) ?>
														</a>
													</h4>
													<ul class="m-b0">
														<li><i class="fa fa-map-marker" style="color: #0177c1;"></i> <?= htmlspecialchars($candidato['cidade']) ?> - <?= htmlspecialchars($candidato['uf']) ?></li>
														<li><i class="fa fa-birthday-cake" style="color: #ffc107;"></i> <?= $candidato['idade'] ?> anos</li>
														<li><i class="fa fa-clock-o" style="color: #6f42c1;"></i> Cadastrado há <?= tempoCadastrado($candidato['data_criacao']) ?></li>
														<li><i class="fa fa-calendar-check-o" style="color: #28a745;"></i> Candidatou-se em <?= date('d/m/Y H:i', strtotime($candidato['dateCandidatura'])) ?></li>
														<li>
															<i class="fa fa-info-circle" style="color: #007bff;"></i>
															Status:
															<?php
																switch ($candidato['statusCandidatura']) {
																	case 1: echo '<span class="text-warning">Em análise</span>'; break;
																	case 2: echo '<span class="text-success">Selecionado</span>'; break;
																	case 3: echo '<span class="text-danger">Recusado</span>'; break;
																	default: echo '<span class="text-muted">Indefinido</span>';
																}
															?>
														</li>
													</ul>
												</div>
											</div>
										</div>
										<div class="d-flex flex-wrap justify-content-between align-items-center">
											<div class="job-time m-l20 mr-auto">
												<?php
													$qualificacoesArr = array_filter(array_map('trim', explode(',', (string)($candidato['qualificacoes'] ?? ''))));
													$idiomasArr       = array_filter(array_map('trim', explode(',', (string)($candidato['idiomas'] ?? ''))));
													$experienciasArr = array_filter(array_map('trim', explode(',', (string)($candidato['cargos'] ?? ''))));
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
												<a href="<?= baseUrl() ?>vagaMensagem/listar/<?= $candidato['pessoa_fisica_id'] ?>" class="site-button outline m-t20" style="padding: 8px 16px; font-size: 14px;"><i class="fa fa-user"></i> Ver Mensagens</a>
											</div>
										</div>
									</li>
								<?php endforeach; ?>
							<?php else: ?>
								<p class="text-center text-muted">Nenhum candidato se inscreveu para esta vaga ainda.</p>
							<?php endif; ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
