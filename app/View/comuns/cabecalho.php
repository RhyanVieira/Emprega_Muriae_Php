<?php

use Core\Library\Session;

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<!-- Suporte para acentos e carecteres especiais --> 
	<meta charset="utf-8">
	<!-- Permite que versões antigas do internet explorer consiga renderizar a página-->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Descrição curta da página -->
	<meta name="description" content="Emprega Muriaé | Vagas, Currículos e Oportuinidades" />
	<!-- Título exibido ao compartilhar a página em redes sociais -->
	<meta property="og:title" content="Emprega Muriaé | Vagas, Currículos e Oportuinidades" />
	<!-- Descrição que aperece junto do título-->
	<meta property="og:description" content="Emprega Muriaé | Vagas, Currículos e Oportuinidades" />
	<!-- Impede que navegadores trasformem números de telefone em links automaticamente a-->
	<meta name="format-detection" content="telephone=no">
	<!-- icone da página compatibilidade com todos os navegadores -->
	<link rel="icon" href="images/favicon.ico" href="<?= baseUrl() ?>assets/img/icone/favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" type="image/png" href="<?= baseUrl() ?>assets/img/icone/favicon.png"/>
	<!-- Título da página -->
	<title>Emprega Muriaé | Vagas, Currículos e Oportuinidades</title>
	<!-- Define como o site deve se comportar em dispositivos móveis -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Carregar os stylesheet e arquivos de estilização da página -->
    <link href="<?= baseUrl() ?>assets/css/plugins.css" rel="stylesheet">
    <link href="<?= baseUrl() ?>assets/css/styles.css" rel="stylesheet">

    <script src="<?= baseUrl() ?>assets/js/jquery.min.js" > </script><!-- JQUERY.MIN JS -->
    <script src="<?= baseUrl() ?>assets/plugins/wow/wow.js" ></script><!-- WOW JS -->
    <script src="<?= baseUrl() ?>assets/plugins/bootstrap/js/popper.min.js"></script><!-- BOOTSTRAP.MIN JS -->
    <script src="<?= baseUrl() ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script><!-- BOOTSTRAP.MIN JS -->
    <script src="<?= baseUrl() ?>assets/plugins/bootstrap-select/bootstrap-select.min.js"></script><!-- FORM JS -->
    <script src="<?= baseUrl() ?>assets/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script><!-- FORM JS -->
    <script src="<?= baseUrl() ?>assets/plugins/magnific-popup/magnific-popup.js"></script><!-- MAGNIFIC POPUP JS -->
    <script src="<?= baseUrl() ?>assets/plugins/imagesloaded/imagesloaded.js"></script><!-- IMAGESLOADED -->
    <script src="<?= baseUrl() ?>assets/plugins/owl-carousel/owl.carousel.js"></script><!-- OWL SLIDER -->
    <script src="<?= baseUrl() ?>assets/js/custom.js"></script><!-- CUSTOM FUCTIONS  -->
    <script src="<?= baseUrl() ?>assets/js/dz.carousel.js"></script><!-- SORTCODE FUCTIONS  -->
    <script src="<?= baseUrl() ?>assets/plugins/paroller/skrollr.min.js"></script><!-- PAROLLER --> 
	<script src="<?= baseUrl() ?>assets/js/global.js"></script><!-- GLOBAL FUNCTIONS  -->
</head>
<body id="bg">
<div id="loading-area"></div>
<div class="page-wraper">
	<!-- início do cabeçalgo (Header) -->
    <header class="site-header mo-left header fullwidth">
		<!-- Cabeçalho fixo com barra principal de navegação -->
        <div class="sticky-header main-bar-wraper navbar-expand-lg">
            <div class="main-bar clearfix">
                <div class="container clearfix">
                    <!-- Logo do site -->
                    <div class="logo-header mostion">
						<a href="<?= baseUrl() ?>home"><img src="<?= baseUrl() ?>assets/img/logo/logo_navbar.png" class="logo" alt=""></a>
					</div>
                    <!-- Botão de menu responsivo (hambúrguer)-->
                    <button class="navbar-toggler collapsed navicon justify-content-end" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
						<span></span>
						<span></span>
						<span></span>
					</button>
                    <!-- Menu de navegação principal -->
                    <div class="header-nav navbar-collapse collapse justify-content-start" id="navbarNavDropdown">
                        <ul class="nav navbar-nav">
							<!-- Link: Página Inicial -->
							<li class="active">
								<a href="<?= baseUrl() ?>home">Home</a>		
							</li>
							<!-- Menu: Sou Candidato -->
							<?php
							$userId = Session::get('userId');
							$userTipo = Session::get('userTipo');
							$userEstabId = Session::get('userEstabId')
							?>

							<?php if (!$userId || $userTipo == 'PF'): ?>
								<li>
									<a href="#">Candidato <i class="fa fa-chevron-down"></i></a>
									<ul class="sub-menu">
										<li>
											<a href="<?= baseUrl() ?>vaga/index/1" class="dez-page">Vagas</a>
										</li>
										<li>
											<a href="<?= baseUrl() ?>estabelecimento/index/1" class="dez-page">Empresas</a>
										</li>
										<li>
											<a href="<?= $userId ? baseUrl() . 'curriculum' : baseUrl() . 'login' ?>" class="dez-page">
												Cadastrar Currículo
											</a>
										</li>
									</ul>
								</li>
							<?php endif; ?>
							<!-- Menu: Sou Empresa -->
							<?php
							$userId = Session::get('userId');
							$userTipo = Session::get('userTipo');
							?>
							<?php if (!$userId || $userTipo == 'E'): ?>
								<li>
									<a href="#">Empresa <i class="fa fa-chevron-down"></i></a>
									<ul class="sub-menu">
										<li>
											<a href=<?= $userId ? baseUrl() . 'vaga/form/insert' : baseUrl() . 'login' ?> class="dez-page">Publicar Vaga</a>
										</li>
										<li>
											<a href="<?= baseUrl() ?>pessoaFisica/index/1" class="dez-page">Encontrar Candidatos</a>
										</li>
									</ul>
								</li>
							<?php endif; ?>
							<!-- Link: Blog -->
							<?php if (!$userId || $userTipo == 'A'): ?>
								<li>
									<a href="<?= baseUrl() ?>sistema/blog">Autônomo <i class="fa fa-chevron-down"></i></a>
									<ul class="sub-menu">
											<li>
												<a href=<?= $userId ? baseUrl() . 'vaga/form' : baseUrl() . 'login' ?> class="dez-page">Divulgar</a>
											</li>
											<li>
												<a href="<?= baseUrl() ?>pessoaFisica/index/1" class="dez-page">Encontrar Serviços</a>
											</li>
									</ul>
								</li>
							<?php endif; ?>
							<!-- Menu: Institucional -->
							<li>
								<a href="#">Institucional <i class="fa fa-chevron-down"></i></a>
								<ul class="sub-menu">
									<li>
										<a href="<?= baseUrl() ?>home/sobre_nos" class="dez-page">Sobre Nós</a>
									</li>
									<li>
										<a href="<?= baseUrl() ?>home/contato" class="dez-page">Contato</a>
									</li>
									<li>
										<a href="<?= baseUrl() ?>home/politica_privacidade" class="dez-page">Política de Privacidade</a>
									</li>
									<li>
										<a href="<?= baseUrl() ?>home/termo_de_uso" class="dez-page">Termos de Uso</a>
									</li>
								</ul>
							</li>
							<?php if (Session::get("userId")):
								$nomeUser = (Session::get("userNome"));
								$userTipo = (Session::get("userTipo"));
							?>
								<?php if ($userTipo == 'PF'): ?>
									<li>
										<a href="#" class="text-green">Área do Candidato <i class="fa fa-chevron-down"></i></a>
										<ul class="sub-menu">
											<li>
												<a href="<?= baseUrl() ?>sistema/contato" class="dez-page">Meu currículo</a>
											</li>
											<li>
												<a href="<?= baseUrl() ?>vagaCurriculum" class="dez-page">Minhas Candidaturas</a>
											</li>
											<li>
												<a href="<?= baseUrl() ?>sistema/contato" class="dez-page">Editar Perfil</a>
											</li>
										</ul>
									</li>
									<li>
										<a href="<?= baseUrl() ?>login/signOut" class="btn-logout"><i class="fa fa-sign-out"></i> Sair</a>		
									</li>
								<?php else: ?>
									<li>
										<a href="#">Área da Empresa <i class="fa fa-chevron-down"></i></a>
										<ul class="sub-menu">
											<li>
												<a href="<?= baseUrl() ?>sistema/sobre_nos" class="dez-page">Painel da Empresa</a>
											</li>
											<li>
												<a href="<?= baseUrl() ?>vaga/minhas_vagas/1" class="dez-page">Minhas Vagas</a>
											</li>
											<li>
												<a href="<?= baseUrl() ?>estabelecimento/perfil/<?= $userEstabId ?>"  class="dez-page">Editar Perfil</a>
											</li>
										</ul>
									</li>
									<li>
										<a href="<?= baseUrl() ?>login/signOut" class="btn-logout"><i class="fa fa-sign-out"></i> Sair</a>		
									</li>
								<?php endif; ?>	
							<?php else: ?>
								<li>
									<a href="<?= baseUrl() ?>usuario" class="site-button botao-login"><i class="fa fa-user"></i> Criar Conta</a>		
								</li>
								<li>
									<a href="<?= baseUrl() ?>login" class="site-button botao-login"><i class="fa fa-lock"></i> Login</a>		
								</li>
							<?php endif; ?>
						</ul>			
                    </div>
					<!-- Fim da navegação principal -->
                </div>
            </div>
        </div>
    </header>
    <div class="page-content">