
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
                    <div class="row">
                        <div class="col-lg-9 col-md-12 m-b10">
                            <?= exibeAlerta() ?>
                            <div class="tab-pane fade show active submit-resume shop-account">
                                <form class="tab-pane-active" id="publicar_vaga" method="POST" action="<?= baseUrl() ?>vaga/insert">
                                    <!-- Informações da Vaga -->
                                    <h6>1. Informações da Vaga</h6>
                                    <div class="form-group">
                                        <label for="descricao">Título da Vaga *</label>
                                        <input type="text" class="form-control" name="descricao" id="descricao" required placeholder="Ex: Desenvolvedor Front-End Júnior" minlength="5" maxlength="60">
                                        <p class="texto-dica">Seja específico para atrair os candidatos certos.</p>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="font-weight-700" for="cargo_id">Cargo *</label>
                                            <select name="cargo_id" id="cargo_id" required>
                                                <option value="">Selecione o cargo</option>
                                                <?php foreach ($dados['aCargo'] as $valueCargo): ?>
                                                    <option value="<?= $valueCargo['cargo_id'] ?>" <?= ($valueCargo['cargo_id'] == setValor("cargo_id") ? 'SELECTED' : '') ?>><?=$valueCargo['descricao']?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="font-weight-700" for="categoria_vaga_id">Categoria do Cargo *</label>
                                            <select name="categoria_vaga_id" id="categoria_vaga_id" required>
                                                <option value="">Selecione a categoria</option>
                                                <?php foreach ($dados['aCategoriaVaga'] as $valueCatVaga): ?>
                                                    <option value="<?= $valueCatVaga['categoria_vaga_id'] ?>" <?= ($valueCatVaga['categoria_vaga_id'] == setValor("categoria_vaga_id") ? 'SELECTED' : '') ?>><?=$valueCatVaga['descricao']?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="font-weight-700" for="vinculo">Vínculo *</label>
                                            <select name="vinculo" id="vinculo" required>
                                                <option value="">Selecione o vínculo</option>
                                                        <option value="1">CLT</option>
                                                        <option value="2">PJ</option>
                                                        <option value="3">Estágio</option>
                                                        <option value="4">Temporário</option>
                                                        <option value="5">Autônomo</option>
                                                        <option value="6">Trainee</option>
                                                        <option value="7">Freelancer</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="font-weight-700" for="modalidade">Modalidade de Trabalho *</label>
                                            <select name="modalidade" id="modalidade" required>
                                                <option value="">Selecione a modalidade</option>
                                                <option value="1">Presencial</option>
                                                <option value="2">Híbrido</option>
                                                <option value="3">Remoto</option>
                                                <option value="4">Parcialmente remoto</option>
                                                <option value="5">Em campo (externo)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="font-weight-700" for="faixaSal">Faixa Salarial *</label>
                                            <input type="number" class="form-control" id="faixaSal" name="faixaSal" step="0.01" min="0" placeholder="Ex: 2500,00">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="ACombinar" name="ACombinar" value="1">
                                                <label class="custom-control-label" for="ACombinar">Salário a combinar</a></label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="font-weight-700" for="nivel_experiencia">Nível de Experiência *</label>
                                            <select name="nivelExperiencia" id="nivelExperiencia" required>
                                                <option value="">Selecione nível</option>
                                                <option value="1">Estágio</option>
                                                <option value="2">Trainee</option>
                                                <option value="3">Júnior(1-3 anos)</option>
                                                <option value="4">Pleno(3-5 anos)</option>
                                                <option value="5">Sênior(5+ anos)</option>
                                                <option value="6">Especialista</option>
                                                <option value="7">Gerência</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="statusVaga">Status da Vaga *</label>
                                            <select name="statusVaga" id="statusVaga" required>
                                                <option value="">Selecione o status</option>
                                                <option value="1">Pré-Vaga</option>
                                                <option value="11">Em aberto</option>
                                                <option value="91">Supensa</option>
                                                <option value="99">Finalizada</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="cidade_id">Cidade *</label>
                                            <select name="cidade_id" id="cidade_id" required>
                                                <option value="">Selecione a cidade</option>
                                                <?php foreach ($dados['aCidade'] as $value): ?>
                                                    <option value="<?= $value['cidade_id'] ?>" <?= ($value['cidade_id'] == setValor("cidade_id") ? 'SELECTED' : '') ?>><?=$value['cidade'] . ' - ' . $value['uf'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-700" for="sobreaVaga">Sobre a Vaga *</label>
                                        <textarea class="form-control" name="sobreaVaga" rows="6" required minlength="5" maxlength="1000" required></textarea>
                                    </div>
                                    <div class="dez-divider bg-gray-dark"></div>
                                    <!-- Datas de Publicação -->
                                    <h6>2. Período de Divulgação da Vaga</h6>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                        <label class="font-weight-700" for="dtInicio">Data de Início da Publicação</label>
                                        <input type="date" class="form-control" name="dtInicio" id="dtInicio" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="font-weight-700" for="dtFim">Data de Encerramento da Publicação</label>
                                        <input type="date" class="form-control" name="dtFim" id="dtFim" required>
                                    </div>
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" class="site-button mt-3">Cadastrar Vaga</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-12 sticky-top">
                        <aside  class="side-bar">
                            <div class="widget widget-newslatter">
                                <h6 class="widget-title style-1">Dicas para Publicação</h6>
                                <div class="news-box">
									<h6 class="m-b5">Título Atrativo</h6>
									<p>Use um título claro e específico que descreva exatamente a posição</p>
                                    <h6 class="m-b5">Descrição Detalhada</h6>
									<p>Forneça informação completas sobre as responsabilidades e o dia a dia da função.</p>
                                    <h6 class="m-b5">Requisitos Claros</h6>
									<p>Especifique as qualificações necessárias e desejáveis para a posição.</p>
                                    <h6 class="m-b5">Destaque os benefícios</h6>
									<p>Liste todos os benefícios oferecidos para atrair mais candidatos.</p>
                                    <h6 class="m-b5">Seja Transparente</h6>
									<p>Informe a faixa salarial sempre que possível para atrair candidatos alinhados às suas possibilidades.</p>
                                </div> 
                            </div>
                        </aside>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const faixaSal = document.getElementById("faixaSal");
    const aCombinar = document.getElementById("ACombinar");

    // Quando o checkbox é marcado
    aCombinar.addEventListener("change", function () {
        if (this.checked) {
        faixaSal.value = "A combinar";
        faixaSal.disabled = true; // desativa o input
        } else {
        faixaSal.value = "";
        faixaSal.disabled = false;
        }
    });

    // Quando o usuário digita manualmente, desmarca o checkbox
    faixaSal.addEventListener("input", function () {
        if (faixaSal.value.trim() !== "" && aCombinar.checked) {
        aCombinar.checked = false;
        faixaSal.disabled = false;
        }
    });
});
</script>