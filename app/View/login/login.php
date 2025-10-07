    <!-- header END -->
    <!-- Content -->
    <div class="page-content bg-white">
        <!-- contact area -->
        <div class="section-full content-inner shop-account">
            <!-- Product -->
            <div class="container">
                <div class="row">
					<div class="col-md-12 text-center">
						<?= exibeAlerta() ?>
						<h3 class="font-weight-700 m-t0 m-b20">Login</h3>
					</div>
				</div>
                <div class="row">
					<div class="col-md-12 m-b30">
						<div class="p-a30 border-1  max-w500 m-auto">
							<div class="tab-content">
								<form class="tab-pane active" action="<?= baseUrl() ?>login/signIn" method="POST">
									<p class="font-weight-600">Preencha os campos abaixo para acessar sua conta na plataforma.</p>

									<div class="form-group">
										<label for="login" class="font-weight-700">E-mail *</label>
										<input id="login" name="login" required class="form-control" placeholder="Digite seu e-mail" type="email">
									</div>

									<div class="form-group">
										<label for="senha" class="font-weight-700">Senha *</label>
										<input id="senha" name="senha" required class="form-control" placeholder="Digite sua senha" type="password">
									</div>
									<div class="text-left m-t20">
										<button type="submit" class="site-button button-lg outline outline-2">Login</button>
									</div>
									<div class="text-left m-t20">
										<a data-toggle="tab" href="<?= baseUrl() ?>Login/esqueciASenha" class="m-l5"><i class="fa fa-unlock-alt"></i> Esqueci a Senha</a> 
									</div>
									<div class="text-left m-t20">
										<a data-toggle="tab" href="<?= baseUrl() ?>Login/esqueciASenha" class="m-l5"><i class="fa fa-user"></i> Quero criar uma conta</a>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
            <!-- Product END -->
		</div>
		<!-- contact area  END -->
    </div>

