
    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dez-bnr-inr overlay-black-dark" style="background-image:url(/assets/img/banner/Banner_Cadastrar_Curriculo.jpg);">
            <div class="container">
                <div class="dez-bnr-inr-entry">
                    <h1 class="text-white">Cadastre seu curriculo</h1>
					<!-- Breadcrumb row -->
					<div class="breadcrumb-row">
						<ul class="list-inline">
							<li>Cadastre seu currículo e aumente suas chances de ser contratado</li>
						</ul>
					</div>
					<!-- Breadcrumb row END -->
                </div>
            </div>
        </div>
        <!-- inner page banner END -->
        <!-- contact area -->
        <div class="content-block">
			<!-- Submit Resume -->
			<div class="section-full bg-white submit-resume content-inner-2">
                <div class="container">
                    <form>

                        <!-- Dados Pessoais -->
                        <p class="bold-text">1. Dados Pessoais</p>
                        <div class="form-group">
                            <label>Nome Completo</label>
                            <input type="text" class="form-control" name="nome" required>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>

                        <div class="form-group">
                            <label>Celular</label>
                            <input type="text" class="form-control" name="celular" maxlength="11" required>
                        </div>

                        <div class="form-group">
                            <label>Data de Nascimento</label>
                            <input type="date" class="form-control" name="dataNascimento" required>
                        </div>

                        <div class="form-group">
                            <label>Sexo</label>
                            <select class="form-control" name="sexo" required>
                                <option value="">Selecione</option>
                                <option value="M">Masculino</option>
                                <option value="F">Feminino</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Foto (opcional)</label>
                            <input type="file" class="form-control" name="foto">
                        </div>

                        <div class="form-group">
                            <label>LinkedIn (opcional)</label>
                            <input type="url" class="form-control" name="linkedin">
                        </div>

                        <div class="form-group">
                            <label>Portfólio (opcional)</label>
                            <input type="url" class="form-control" name="portfolio">
                        </div>

                        <div class="form-group">
                            <label>Apresentação Pessoal</label>
                            <textarea class="form-control" name="apresentacaoPessoal" rows="4"></textarea>
                        </div>

                        <!-- Endereço -->
                        <div class="form-group">
                            <label>Logradouro</label>
                            <input type="text" class="form-control" name="logradouro" required>
                        </div>

                        <div class="form-group">
                            <label>Número</label>
                            <input type="text" class="form-control" name="numero">
                        </div>

                        <div class="form-group">
                            <label>Complemento</label>
                            <input type="text" class="form-control" name="complemento">
                        </div>

                        <div class="form-group">
                            <label>Bairro</label>
                            <input type="text" class="form-control" name="bairro" required>
                        </div>

                        <div class="form-group">
                            <label>CEP</label>
                            <input type="text" class="form-control" name="CEP" maxlength="8" required>
                        </div>

                        <div class="form-group">
                            <label>Cidade</label>
                            <select name="cidade_id" class="form-control" required>
                                <option value="">Selecione sua cidade</option>
                                <!-- popular dinamicamente -->
                            </select>
                        </div>

                        <!-- Escolaridade -->
                        <div class="dez-divider bg-gray-dark"></div>
                        <p class="bold-text">2. Escolaridade</p>

                        <div class="form-group">
                            <label>Instituição</label>
                            <input type="text" class="form-control" name="instituicao" required>
                        </div>

                        <div class="form-group">
                            <label>Cidade da Instituição</label>
                            <select name="cidade_id_escolaridade" class="form-control" required>
                                <option value="">Selecione</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Descrição do Curso</label>
                            <input type="text" class="form-control" name="descricao" required>
                        </div>

                        <div class="form-group">
                            <label>Nível de Escolaridade</label>
                            <select name="escolaridade_id" class="form-control" required>
                                <option value="">Selecione</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="1">Concluído</option>
                                <option value="2">Estudando</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Início</label>
                            <div class="d-flex">
                                <input type="number" class="form-control mr-2" name="inicioMes" placeholder="Mês" min="1" max="12" required>
                                <input type="number" class="form-control" name="inicioAno" placeholder="Ano" min="1900" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Término</label>
                            <div class="d-flex">
                                <input type="number" class="form-control mr-2" name="fimMes" placeholder="Mês" min="1" max="12" required>
                                <input type="number" class="form-control" name="fimAno" placeholder="Ano" min="1900" required>
                            </div>
                        </div>

                        <!-- Experiência -->
                        <div class="dez-divider bg-gray-dark"></div>
                        <p class="bold-text">3. Experiência Profissional</p>

                        <div class="form-group">
                            <label>Cargo</label>
                            <input type="text" class="form-control" name="cargoDescricao" required>
                        </div>

                        <div class="form-group">
                            <label>Empresa</label>
                            <input type="text" class="form-control" name="empresa">
                        </div>

                        <div class="form-group">
                            <label>Início</label>
                            <div class="d-flex">
                                <input type="number" class="form-control mr-2" name="inicioMesExp" placeholder="Mês" min="1" max="12" required>
                                <input type="number" class="form-control" name="inicioAnoExp" placeholder="Ano" min="1900" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Término</label>
                            <div class="d-flex">
                                <input type="number" class="form-control mr-2" name="fimMesExp" placeholder="Mês" min="1" max="12" required>
                                <input type="number" class="form-control" name="fimAnoExp" placeholder="Ano" min="1900" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Atividades Exercidas</label>
                            <textarea class="form-control" name="atividadesExercidas" rows="4"></textarea>
                        </div>

                        <!-- Idiomas -->
                        <div class="dez-divider bg-gray-dark"></div>
                        <p class="bold-text">4. Idiomas</p>

                        <div class="form-group">
                            <label>Idioma</label>
                            <select name="idioma_id" class="form-control">
                                <option value="">Selecione</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Nível</label>
                            <input type="text" class="form-control" name="nivel" placeholder="Ex: Básico, Intermediário, Avançado">
                        </div>

                        <!-- Qualificações -->
                        <div class="dez-divider bg-gray-dark"></div>
                        <p class="font-weight-bold">5. Qualificações</p>

                        <div class="form-group">
                            <label>Descrição</label>
                            <input type="text" class="form-control" name="descricao_qualificacao" placeholder="Digite a qualificação">
                        </div>

                        <button type="submit" class="site-button">Enviar Currículo</button>
                    </form>
                </div>
            </div>

            <!-- Submit Resume END -->
		</div>
    </div>
</div>
