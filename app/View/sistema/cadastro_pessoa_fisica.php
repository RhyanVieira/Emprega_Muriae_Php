<div class="page-content bg-white">
        <!-- contact area -->
        <div class="section-full content-inner shop-account">
            <!-- Product -->
            <div class="container">
                <div class="row">
					<div class="col-md-12 text-center">
						<h3 class="font-weight-700 m-t0 m-b20">Cadastro de Candidato</h3>
                        <h6>Encontre as melhores oportunidades de tranalho para o seu perfil</h6>
                        <?= exibeAlerta() ?>
					</div>
				</div>
                <div class="row">
					<div class="col-md-12 m-b30">
						<div class="p-a30 border-1 m-auto">
							<div class="tab-content">
								<form id="cadastroParaUsuario" class="tab-pane active" method="POST" action="<?= baseUrl() ?>pessoaFisica/cadastroParaUsuario">
									<p class="font-weight-600">Preencha seus dados pessoais e destaque-se para as empresas parceiras do Emprega Muriaé.</p>
                                    <div class="form-group">
                                            <label class="font-weight-700">Nome completo *</label>
                                            <input name="nome" required class="form-control" placeholder="Digite seu nome" type="text" value="<?= setValor('nome')?>" minlength="3" maxlength="60">
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="font-weight-700">CPF *</label>
                                            <input name="cpf" required class="form-control" placeholder="Apenas números" type="text" value="<?= setValor('cpf')?>" minlength="11" maxlength="11">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="font-weight-700">Data de Nascimento *</label>
                                            <input name="data_nascimento" required class="form-control" placeholder="Digite sua data de nascimento" type="date" value="<?= setValor('data_nascimento')?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Resumo profissional</label>
                                        <textarea class="form-control" name="resumo_profissional" rows="4" value="<?= setValor('resumo_profissional')?>" maxlength="1000"></textarea>
                                    </div>
                                    <div class="product-brand">
										<div class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" id="check1" name="perfil_publico" value="1">
											<label class="custom-control-label" for="check1">Perfil público</a></label>
										</div>
									</div>
									<div class="text-left m-t20">
										<button type="submit" class="site-button button-lg outline outline-2">Enviar informações</button>
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