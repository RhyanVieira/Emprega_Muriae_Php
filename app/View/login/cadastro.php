<div class="page-content bg-white">
    <div class="section-full content-inner shop-account">
        <div class="container">
            <div class="row">
				<div class="col-md-12 text-center">
					<h3 class="font-weight-700 m-t0 m-b20">Criar Uma Conta</h3>
				</div>
			</div>
            <div class="row">
				<div class="col-md-12 m-b30">
					<div class="p-a30 border-1  max-w500 m-auto">
						<div class="tab-content">
							<div class="tab-pane fade show active submit-resume shop-account">
								<?= exibeAlerta() ?>
								<form id="formUsuario" class="tab-pane active" method="POST" action="<?= baseUrl() ?>usuario/cadastroUsuario">
									<p class="font-weight-600">Preencha os campos abaixo para criar sua conta na plataforma.</p>
									<div class="form-group">
										<label class="font-weight-700" for="login">E-mail *</label>
										<input name="login" id="login" required class="form-control" placeholder="Digite seu e-mail" type="email" minlength="3" maxlength="100">
									</div>
									<div class="form-group">
										<label class="font-weight-700" for="senha">Senha *</label>
										<input name="senha" id="senha" required class="form-control" placeholder="Crie uma senha" type="password" minlength="8" maxlength="30">
									</div>
									<div class="form-group">
										<label class="font-weight-700" for="tipo">Tipo de Conta *</label>
										<select name="tipo" id="tipo" required>
											<option value="">Selecione...</option>
											<option value="PF">Candidato</option>
											<option value="E">Empresa</option>
										</select>
									</div>
									<div class="product-brand">
										<div class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" id="termo" name="termo" value="1" required>
											<label class="custom-control-label" for="termo">Li e Aceito os <a href="<?= baseUrl() ?>home/termo_de_uso">Termos de Uso</a></label>
										</div>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" id="politica_privacidade" name="politica_privacidade" value="1" required>
											<label class="custom-control-label" for="politica_privacidade">Li e Concordo com a <a href="<?= baseUrl() ?>home/politica_privacidade">Política de Privacidade</a></label>
										</div>
									</div>
									<div class="text-center m-t20">
										<button type="submit" class="site-button button-lg outline outline-2">Criar Conta</button>
									</div>
									<div class="dez-divider bg-gray-dark"></div>
									<div class="text-center">
										<span class="text-black">Já tem uma conta? </span><span><a href="<?= baseUrl() ?>login">Login</a></span>
									</div>
								</form>
							</div>							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
