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
    <link href="<?= baseUrl() ?>assets/css/styles-pagina.css" rel="stylesheet">

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
						<a href="index.html"><img src="<?= baseUrl() ?>assets/img/logo/logo_navbar.png" class="logo" alt=""></a>
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
								<a href="#">Home</a>		
							</li>
							<!-- Menu: Sou Candidato -->
							<li>
								<a href="#">Sou Candidato <i class="fa fa-chevron-down"></i></a>
								<ul class="sub-menu">
									<li><a href="vagas.html" class="dez-page">Vagas</a></li>
									<li><a href="empresas.html" class="dez-page">Empresas</a></li>
									<li><a href="cadastrar_curriculo.html" class="dez-page">Cadastrar Currículo</a></li>
								</ul>
							</li>
							<!-- Menu: Sou Empresa -->
							<li>
								<a href="#">Sou Empresa <i class="fa fa-chevron-down"></i></a>
								<ul class="sub-menu">
									<li><a href="publicar_vaga.html" class="dez-page">Publicar Vaga</a></li>
									<li><a href="candidatos.html" class="dez-page">Encontrar Candidatos</a></li>
								</ul>
							</li>
							<!-- Link: Blog -->
							<li>
								<a href="blog.html">Blog</a>
							</li>
							<!-- Menu: Institucional -->
							<li>
								<a href="#">Institucional <i class="fa fa-chevron-down"></i></a>
								<ul class="sub-menu">
									<li><a href="sobre_nos.html" class="dez-page">Sobre Nós</a></li>
									<li><a href="contato.html" class="dez-page">Contato</a></li>
									<li><a href="politica_privacidade.html" class="dez-page">Política de Privacidade</a></li>
									<li><a href="termos_uso.html" class="dez-page">Termos de Uso</a></li>
								</ul>
							</li>
							<li>
								<a href="criar_conta.html" class="site-button"><i class="fa fa-user"></i> Criar Conta</a>		
							</li>
							<li>
								<a href="login.html" class="site-button"><i class="fa fa-lock"></i> Login</a>		
							</li>
						</ul>			
                    </div>
					<!-- Fim da navegação principal -->
                </div>
            </div>
        </div>
    </header>
    <div class="page-content">