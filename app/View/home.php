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

setlocale(LC_TIME, 'pt_BR.UTF-8', 'pt_BR', 'portuguese');
?>
		<div class="dez-bnr-inr dez-bnr-inr-md overlay-black-dark" style="background-image:url(/assets/img/main-slider/estatua_slider.jpg);">
			<div class="container">
                <div class="dez-bnr-inr-entry align-m text-white">
					<div class="find-job-bx">
						<h2>Seu futuro começa com uma busca. <br/> <span class="span-banner">Encontre</span> a vaga ideal perto de você.</h2>
						<form class="dezPlaceAni" method="GET" action="<?= baseUrl() ?>vaga/index/1/">
							<div class="row">
								<div class="col-lg-4 col-md-6">
									<div class="form-group">
										<div class="input-group">
											<input type="text" name="descricao" id="descricao" class="form-control" placeholder="Ex: vendedor, recepcionista, pacote Office...">
											<div class="input-group-append">
												<span class="input-group-text"><i class="fa fa-search"></i></span>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-3 col-md-6">
									<div class="form-group">
										<select name="cidade_id" id="cidade_id">
											<option value="">Selecione a cidade</option>
											<?php foreach ($dados['aCidade'] as $value): ?>
												<option value="<?= $value['cidade_id'] ?>"><?=$value['cidade'] . ' - ' . $value['uf'] ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
								<div class="col-lg-3 col-md-6">
									<div class="form-group">
										<select name="categoria_vaga_id" id="categoria_vaga_id">
											<option value="">Selecione uma categoria</option>
                                            <?php foreach ($dados['aCategoriaVaga'] as $valueCatVaga): ?>
                                                <option value="<?= $valueCatVaga['categoria_vaga_id'] ?>"><?=$valueCatVaga['descricao']?></option>
                                            <?php endforeach; ?>
										</select>
									</div>
								</div>
								<div class="col-lg-2 col-md-6">
									<button type="submit" class="site-button btn-block">Encontrar Vaga</button>
								</div>
							</div>
						</form>
					</div>
				</div>
            </div>
        </div>
		<div class="section-full bg-white content-inner-2">
			<div class="container">
				<div class="d-flex job-title-bx section-head">
					<div class="mr-auto">
						<h2 class="m-b5">Vagas Recentes</h2>
						<h6 class="fw4 m-b0">Confira as 5 vagas adicionadas recentemente</h6>
					</div>
					<div class="align-self-end">
						<a href="<?= baseUrl() ?>vaga/index/1" class="site-button button-sm">Veja Todas as Vagas <i class="fa fa-long-arrow-right"></i></a>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-9">
						<ul class="post-job-bx">
							<?php foreach ($dados['VagaHome'] as $vagaHome): ?>
								<li>
									<a href="<?= baseUrl() ?>vaga/vaga_detalhada/<?= $vagaHome['vaga_id'] ?>">
										<div class="d-flex m-b30">
											<div class="job-post-company">
												<span><img src="<?= baseUrl() . 'imagem.php?file=estabelecimento/' . $vagaHome['logo'] ?>"/></span>
											</div>
											<div class="job-post-info">
												<h4><?= ($vagaHome['descricao']) ?></h4>
												<ul>
													<li><i class="fa fa-map-marker text-alert" style="color: #0177c1;"></i> <?= ($vagaHome['cidade']) ?> - <?= ($vagaHome['uf']) ?></li>
													<li><i class="fa fa-calendar-times-o" style="color: #dc3545"></i>Término - <?= date('d/m/Y', strtotime($vagaHome['dtFim'])) ?></li>
													<li><i class="fa fa-clock-o" style="color: #6f42c1"></i><?= tempoPublicacao($vagaHome['dtInicio']) ?></li>
												</ul>
											</div>
										</div>
										<div class="d-flex">
											<div class="job-time mr-auto">
												<span><?= $modalidades[$vagaHome['modalidade']] ?></span>
												<span class="m-l5"><?= $vinculos[$vagaHome['vinculo']] ?></span>
												<span class="m-l5"><?= $nivelExperiencia[$vagaHome['nivelExperiencia']] ?></span>
											</div>
											<div class="salary-bx">
												<span>
													<?php $faixaSal = $vagaHome['faixaSal'] ?? '';
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
					</div>
					<div class="col-lg-3">
						<div class="sticky-top">
							<div class="candidates-are-sys m-b30">
								<div class="candidates-bx">
									<div class="testimonial-pic radius"><img src="<?= baseUrl() ?>assets/img/proposito/emprega_muriae_proposito.jpg" alt="" width="100" height="100"></div>
									<div class="testimonial-text">
										<p>Nosso compromisso é fortalecer os laços entre empresas e talentos da região de Muriaé. Acreditamos que grandes oportunidades podem nascer perto de casa e estamos aqui para facilitar essa conexão.</p>
									</div>
									<div class="testimonial-detail"> <strong class="testimonial-name">Emprega Muriaé</strong></div>
								</div>
							</div>
							<div class="quote-bx">
								<div class="quote-info">
									<h4>Encontre os melhores talentos para sua empresa!</h4>
									<p>Cadastre sua empresa e publique vagas gratuitamente no Emprega Muriaé</p>
									<a href="<?= baseUrl() ?>usuario" class="site-button">Cadastre-se Agora</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="section-full content-inner-2 call-to-action overlay-black-dark text-white text-center bg-img-fix" style="background-image: url(/assets/img/background/bg_prefeitura.jpg);">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<h2 class="m-b10">Destaque-se com seu currículo online!</h2>
						<p class="m-b0">Cadastre seu currículo, encontre vagas locais e conquiste a oportunidade que você merece.</p>
						<a href="<?= baseUrl() ?>login" class="site-button m-t20 outline outline-2 radius-xl">Crie Sua Conta Agora</a>
					</div>
				</div>
			</div>
		</div>
		<div class="section-full job-categories content-inner-2 bg-white">
			<div class="container">
				<div class="section-head text-center">
					<h2 class="m-b5">Categorias Populares</h2>
					<h5 class="fw4">Mais de 20 categorias de trabalho esperando por você</h5>
				</div>
				<div class="row sp20">
					<?php foreach ($dados['vagaTotal'] as $VagaT): ?>
                        <div class="col-lg-3 col-md-6 col-sm-6">
							<div class="icon-bx-wraper">
								<div class="icon-content">
									<div class="icon-md text-blue m-b20"><i class="<?= ($VagaT['icone']) ?>"></i></div>
									<a href="#" class="dez-tilte"><?= ($VagaT['descricao']) ?></a>
									<p class="m-a0"><?= ($VagaT['total_vagas']) ?> Vagas Abertas</p>
									<div class="rotate-icon"><i class="<?= ($VagaT['icone']) ?>"></i></div> 
								</div>
							</div>				
						</div>
                    <?php endforeach; ?>
				</div>
			</div>
		</div>
		<div class="section-full p-tb70 overlay-black-dark text-white text-center bg-img-fix" style="background-image: url(/assets/img/background/bg_prefeitura.jpg);">
			<div class="container">
				<div class="section-head text-center text-white">
					<h2 class="m-b5">Nosso Propósito</h2>
					<h5 class="fw4">Construindo pontes entre talentos e oportunidades</h5>
				</div>
				<div class="blog-carousel-center owl-carousel owl-none">
					<div class="item">
						<div class="testimonial-5">
							<div class="testimonial-text">
								<p>Acreditamos que todo talento merece uma chance. Nossa missão é aproximar empresas locais de candidatos que buscam crescer profissionalmente em Muriaé e região.</p>
							</div>
							<div class="testimonial-detail clearfix">
								<div class="testimonial-pic radius shadow">
									<img src="<?= baseUrl() ?>/assets/img/proposito/emprega_muriae_proposito.jpg" width="100" height="100" alt="">
								</div>
								<strong class="testimonial-name">Conectando pessoas</strong> 
								<span class="testimonial-position">Emprega Muriaé</span> 
							</div>
						</div>
					</div>
					<div class="item">
						<div class="testimonial-5">
							<div class="testimonial-text">
								<p>Desenvolvida por estudantes e profissionais da região, a plataforma nasceu com o objetivo de facilitar o acesso ao mercado de trabalho para todos.</p>
							</div>
							<div class="testimonial-detail clearfix">
								<div class="testimonial-pic radius shadow">
									<img src="<?= baseUrl() ?>/assets/img/proposito/logo_santa_marcelina_proposito.jpg" width="100" height="100" alt="">
								</div>
								<strong class="testimonial-name">Projeto de Extensão</strong> 
								<span class="testimonial-position">Faculdade Santa Marcelina</span> 
							</div>
						</div>
					</div>
					<div class="item">
						<div class="testimonial-5">
							<div class="testimonial-text">
								<p>Acreditamos que cada jovem merece a chance de construir um futuro com dignidade. Nossa plataforma é um passo para tornar oportunidades mais acessíveis e transformar realidades.</p>
							</div>
							<div class="testimonial-detail clearfix">
								<div class="testimonial-pic radius shadow">
									<img src="<?= baseUrl() ?>/assets/img/proposito/emprega_muriae_proposito.jpg" width="100" height="100" alt="">
								</div>
								<strong class="testimonial-name">Transformando vidas</strong> 
								<span class="testimonial-position">Emprega Muriaé</span> 
							</div>
						</div>
					</div>
					<div class="item">
						<div class="testimonial-5">
							<div class="testimonial-text">
								<p>Encontrar profissionais comprometidos e com vontade de crescer tem sido mais fácil com o apoio da plataforma. É uma iniciativa que valoriza os talentos da nossa própria comunidade.</p>
							</div>
							<div class="testimonial-detail clearfix">
								<div class="testimonial-pic radius shadow">
									<img src="<?= baseUrl() ?>/assets/img/proposito/silviane_proposito.jpg"  width="100" height="100" alt="">
								</div>
								<strong class="testimonial-name">Silviane Lima</strong> 
								<span class="testimonial-position">Gerente, Loja CentralTech</span> 
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="section-full content-inner-2 overlay-white-middle">
			<div class="container">
				<div class="section-head text-black text-center">
					<h2 class="text-uppercase m-b0">Últimas Postagens</h2>
					<p>Confira dicas, notícias e conteúdos exclusivos para te ajudar a se destacar no mercado de trabalho da nossa região.</p>
				</div>
				<div class="blog-carousel owl-carousel owl-btn-center-lr owl-btn-3 owl-theme owl-btn-center-lr owl-btn-1">
					<div class="item">
						<div class="blog-post blog-grid blog-style-1">
							<div class="dez-post-media dez-img-effect radius-sm">
								<a href="#"><img src="images/blog/grid/pic1.jpg" alt=""></a>
							</div>
							<div class="dez-info">
								<div class="dez-post-meta">
									<ul class="d-flex align-items-center">
										<li class="post-date"><i class="fa fa-calendar"></i>Maio 20, 2025</li>
										<li class="post-comment"><i class="fa fa-comments-o"></i><a href="#">12</a></li>
									</ul>
								</div>
								<div class="dez-post-title">
									<h5 class="post-title font-20"><a href="#">Como montar um currículo eficiente e atrativo</a></h5>
								</div>
								<div class="dez-post-text">
									<p>Descubra os principais elementos de um bom currículo e veja dicas simples para aumentar suas chances de ser chamado para entrevistas.</p>
								</div>
								<div class="dez-post-readmore blog-share">
									<a href="#" title="LER MAIS" rel="bookmark" class="site-button outline">LER MAIS</a>
								</div>
							</div>
						</div>
					</div>
					<div class="item">
						<div class="blog-post blog-grid blog-style-1">
							<div class="dez-post-media dez-img-effect radius-sm">
								<a href="#"><img src="images/blog/grid/pic2.jpg" alt=""></a>
							</div>
							<div class="dez-info">
								<div class="dez-post-meta">
									<ul class="d-flex align-items-center">
										<li class="post-date"><i class="fa fa-calendar"></i>Maio 15, 2025</li>
										<li class="post-comment"><i class="fa fa-comments-o"></i><a href="#">8</a></li>
									</ul>
								</div>
								<div class="dez-post-title">
									<h5 class="post-title font-20"><a href="#">Plataforma regional conecta talentos e empresas locais</a></h5>
								</div>
								<div class="dez-post-text">
									<p>Conheça o propósito da nossa plataforma e entenda como estamos aproximando empresas de candidatos na região de Muriaé e arredores.</p>
								</div>
								<div class="dez-post-readmore blog-share">
									<a href="#" title="LER MAIS" rel="bookmark" class="site-button outline">LER MAIS</a>
								</div>
							</div>
						</div>
					</div>
					<div class="item">
						<div class="blog-post blog-grid blog-style-1">
							<div class="dez-post-media dez-img-effect radius-sm">
								<a href="#"><img src="images/blog/grid/pic3.jpg" alt=""></a>
							</div>
							<div class="dez-info">
								<div class="dez-post-meta">
									<ul class="d-flex align-items-center">
										<li class="post-date"><i class="fa fa-calendar"></i>Abril 28, 2025</li>
										<li class="post-comment"><i class="fa fa-comments-o"></i><a href="#">3</a></li>
									</ul>
								</div>
								<div class="dez-post-title">
									<h5 class="post-title font-20"><a href="#">Dicas de entrevistas: o que evitar e como impressionar</a></h5>
								</div>
								<div class="dez-post-text">
									<p>Veja os principais erros cometidos em entrevistas de emprego e aprenda a se preparar para causar uma boa impressão desde o início.</p>
								</div>
								<div class="dez-post-readmore blog-share">
									<a href="#" title="LER MAIS" rel="bookmark" class="site-button outline">LER MAIS</a>
								</div>
							</div>
						</div>
					</div>
					<div class="item">
						<div class="blog-post blog-grid blog-style-1">
							<div class="dez-post-media dez-img-effect radius-sm">
								<a href="#"><img src="images/blog/grid/pic4.jpg" alt=""></a>
							</div>
							<div class="dez-info">
								<div class="dez-post-meta">
									<ul class="d-flex align-items-center">
										<li class="post-date"><i class="fa fa-calendar"></i>Abril 12, 2025</li>
										<li class="post-comment"><i class="fa fa-comments-o"></i><a href="#">4</a></li>
									</ul>
								</div>
								<div class="dez-post-title">
									<h5 class="post-title font-20"><a href="#">Tendências de contratação em pequenas empresas</a></h5>
								</div>
								<div class="dez-post-text">
									<p>Com a retomada econômica local, muitas micro e pequenas empresas estão em busca de novos talentos. Saiba como se posicionar.</p>
								</div>
								<div class="dez-post-readmore blog-share">
									<a href="#" title="LER MAIS" rel="bookmark" class="site-button outline">LER MAIS</a>
								</div>
							</div>
						</div>
					</div>
					<div class="item">
						<div class="blog-post blog-grid blog-style-1">
							<div class="dez-post-media dez-img-effect radius-sm">
								<a href="#"><img src="images/blog/grid/pic4.jpg" alt=""></a>
							</div>
							<div class="dez-info">
								<div class="dez-post-meta">
									<ul class="d-flex align-items-center">
										<li class="post-date"><i class="fa fa-calendar"></i>Março 30, 2025</li>
										<li class="post-comment"><i class="fa fa-comments-o"></i><a href="#">2</a></li>
									</ul>
								</div>
								<div class="dez-post-title">
									<h5 class="post-title font-20"><a href="#">Como destacar seu perfil online para recrutadores</a></h5>
								</div>
								<div class="dez-post-text">
									<p>Aprenda estratégias práticas para melhorar sua visibilidade nas plataformas de emprego e redes sociais profissionais.</p>
								</div>
								<div class="dez-post-readmore blog-share">
									<a href="#" title="LER MAIS" rel="bookmark" class="site-button outline">LER MAIS</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>