
    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dez-bnr-inr overlay-black-dark" style="background-image:url(/assets/img/banner/Banner_Publicar_Vaga.jpg);">
            <div class="container">
                <div class="dez-bnr-inr-entry">
                    <h1 class="text-white">Publicar Vaga</h1>
					<!-- Breadcrumb row -->
					<div class="breadcrumb-row">
						<ul class="list-inline">
							<li>Divulgue sua oportunidade de forma rápida e eficiente</li>
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

                        <!-- Informações da Vaga -->
                        <p class="bold-text">1. Informações da Vaga</p>

                        <div class="form-group">
                            <label>Título da Vaga</label>
                            <input type="text" class="form-control" name="titulo" required>
                        </div>

                        <div class="form-group">
                            <label>Descrição</label>
                            <textarea class="form-control" name="descricao" rows="6" required></textarea>
                        </div>

                        <div class="form-group">
                            <label>Cidade</label>
                            <select name="cidade_id" class="form-control" required>
                                <option value="">Selecione a cidade</option>
                                <!-- opções preenchidas dinamicamente -->
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Categoria</label>
                            <select name="categoria_id" class="form-control" required>
                                <option value="">Selecione a categoria</option>
                                <!-- opções preenchidas dinamicamente -->
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Tipo de Contrato</label>
                            <select name="tipo_contrato_id" class="form-control" required>
                                <option value="">Selecione o tipo de contrato</option>
                                <!-- opções preenchidas dinamicamente -->
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Modalidade de Trabalho</label>
                            <select name="modalidade_trabalho_id" class="form-control" required>
                                <option value="">Selecione a modalidade</option>
                                <!-- opções preenchidas dinamicamente -->
                            </select>
                        </div>

                        <div class="dez-divider bg-gray-dark"></div>
                        <!-- Datas de Publicação -->
                        <p class="bold-text">2. Período de Divulgação da Vaga</p>

                        <div class="form-group">
                            <label>Data de Início da Publicação</label>
                            <input type="date" class="form-control" name="dtInicio" required>
                        </div>

                        <div class="form-group">
                            <label>Data de Encerramento da Publicação</label>
                            <input type="date" class="form-control" name="dtFim" required>
                        </div>

                        <button type="submit" class="site-button mt-3">Cadastrar Vaga</button>
                    </form>
                </div>
            </div>
        </div>
    </div>    
</div>
