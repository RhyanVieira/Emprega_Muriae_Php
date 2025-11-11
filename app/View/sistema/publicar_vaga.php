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

$faixa = $dados['vaga']['faixaSal'] ?? '';
$isACombinar = is_string($faixa) && (mb_strtolower(trim($faixa)) === 'a combinar');

$status = isset($dados['vaga']['statusVaga']) ? (string)$dados['vaga']['statusVaga'] : '';

setlocale(LC_TIME, 'pt_BR.UTF-8', 'pt_BR', 'portuguese');
?>
    <div class="page-content bg-white">
        <div class="dez-bnr-inr overlay-black-dark" style="background-image:url(/assets/img/banner/Banner_Publicar_Vaga.jpg);">
            <div class="container">
                <div class="dez-bnr-inr-entry">
                    <h1 class="text-white">Publicar Vaga</h1>
					<div class="breadcrumb-row">
						<ul class="list-inline">
							<li>Divulgue sua oportunidade de forma rápida e eficiente</li>
						</ul>
					</div>
                </div>
            </div>
        </div>
        <div class="content-block">
			<div class="section-full bg-white submit-resume content-inner-2">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9 col-md-12 m-b10">
                            <?= exibeAlerta() ?>
                            <div class="tab-pane fade show active submit-resume shop-account">
                                <form class="tab-pane-active" id="publicar_vaga" method="POST" action="<?= $this->request->formAction() ?>">
                                    <?php if ($dados['modo'] === 'update'): ?>
                                        <input type="hidden" name="vaga_id" value="<?= $dados['vaga']['vaga_id'] ?>">
                                    <?php endif; ?>
                                    <h6>1. Informações da Vaga</h6>
                                    <div class="form-group">
                                        <label for="descricao">Título da Vaga *</label>
                                        <input type="text" class="form-control" name="descricao" id="descricao" required placeholder="Ex: Desenvolvedor Front-End Júnior" minlength="5" maxlength="60" value="<?= $dados['vaga']['descricao'] ?? '' ?>">
                                        <p class="texto-dica">Seja específico para atrair os candidatos certos.</p>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="font-weight-700" for="cargo_id">Cargo *</label>
                                            <select name="cargo_id" id="cargo_id" required>
                                                <option value="">Selecione o cargo</option>
                                                <?php foreach ($dados['aCargo'] as $valueCargo): ?>
                                                    <option value="<?= $valueCargo['cargo_id'] ?>" <?= ($valueCargo['cargo_id'] == ($dados['vaga']['cargo_id'] ?? '')) ? 'selected' : '' ?>><?= $valueCargo['descricao'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="font-weight-700" for="categoria_vaga_id">Categoria do Cargo *</label>
                                            <select name="categoria_vaga_id" id="categoria_vaga_id" required>
                                                <option value="">Selecione a categoria</option>
                                                <?php foreach ($dados['aCategoriaVaga'] as $valueCatVaga): ?>
                                                    <option value="<?= $valueCatVaga['categoria_vaga_id'] ?>" <?= ($valueCatVaga['categoria_vaga_id'] == ($dados['vaga']['categoria_vaga_id'] ?? '')) ? 'selected' : '' ?>><?= $valueCatVaga['descricao'] ?>><?=$valueCatVaga['descricao']?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="font-weight-700" for="vinculo">Vínculo *</label>
                                            <select name="vinculo" id="vinculo" required>
                                                <option value="">Selecione o vínculo</option>
                                                <?php 
                                                foreach ($vinculos as $key => $label): ?>
                                                    <option value="<?= $key ?>" <?= ($key == ($dados['vaga']['vinculo'] ?? '')) ? 'selected' : '' ?>><?= $label ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="font-weight-700" for="modalidade">Modalidade de Trabalho *</label>
                                            <select name="modalidade" id="modalidade" required>
                                                <option value="">Selecione a modalidade</option>
                                                <?php 
                                                foreach ($modalidades as $key => $label): ?>
                                                    <option value="<?= $key ?>" <?= ($key == ($dados['vaga']['modalidade'] ?? '')) ? 'selected' : '' ?>><?= $label ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="font-weight-700" for="faixaSal">Faixa Salarial *</label>
                                            <input type="number" class="form-control" id="faixaSal" name="faixaSal" step="0.01" min="0" placeholder="Ex: 2500,00" value="<?= $isACombinar ? '' : $faixa ?>"<?= $isACombinar ? 'disabled' : '' ?>>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="ACombinar" name="ACombinar" value="1" value="1"<?= $isACombinar ? 'checked' : '' ?>>
                                                <label class="custom-control-label" for="ACombinar">Salário a combinar</a></label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="font-weight-700" for="nivel_experiencia">Nível de Experiência *</label>
                                            <select name="nivelExperiencia" id="nivelExperiencia" required>
                                                <option value="">Selecione nível</option>
                                                <?php 
                                                $niveis = [1=>'Estágiário',2=>'Trainee',3=>'Júnior(1-3 anos)',4=>'Pleno(3-5 anos)',5=>'Sênior(5+ anos)',6=>'Especialista',7=>'Gerência'];
                                                foreach ($niveis as $key => $label): ?>
                                                    <option value="<?= $key ?>" <?= ($key == ($dados['vaga']['nivelExperiencia'] ?? '')) ? 'selected' : '' ?>><?= $label ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="statusVaga">Status da Vaga *</label>
                                            <select name="statusVaga" id="statusVaga" required>
                                                <option value="">Selecione o status</option>
                                                <option value="1"  <?= $status === '1'  ? 'selected' : '' ?>>Pré-Vaga</option>
                                                <option value="11" <?= $status === '11'  ? 'selected' : '' ?>>Em aberto</option>
                                                <option value="91" <?= $status === '91'  ? 'selected' : '' ?>>Supensa</option>
                                                <option value="99" <?= $status === '99'  ? 'selected' : '' ?>>Finalizada</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="cidade_id">Cidade *</label>
                                            <select name="cidade_id" id="cidade_id" required>
                                                <option value="">Selecione a cidade</option>
                                                <?php foreach ($dados['aCidade'] as $value): ?>
                                                    <option value="<?= $value['cidade_id'] ?>" 
                                                        <?= ($value['cidade_id'] == ($dados['vaga']['cidade_id'] ?? '')) ? 'selected' : '' ?>>
                                                        <?= $value['cidade'] . ' - ' . $value['uf'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-700" for="sobreaVaga">Sobre a vaga *</label>
                                        <textarea class="form-control" name="sobreaVaga" rows="6" required minlength="5" maxlength="1000" required><?= $dados['vaga']['sobreaVaga'] ?? '' ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-700" for="responsabilidades">Responsabilidades do candidato *</label>
                                        <textarea class="form-control" name="responsabilidades" rows="6" required minlength="5" maxlength="1000" required><?= $dados['vaga']['responsabilidades'] ?? '' ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-700" for="requisitos">Requisitos *</label>
                                        <textarea class="form-control" name="requisitos" rows="6" required minlength="5" maxlength="1000" required><?= $dados['vaga']['requisitos'] ?? '' ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-700" for="beneficios">Benefícios *</label>
                                        <textarea class="form-control" name="beneficios" rows="6" required minlength="5" maxlength="1000" required><?= $dados['vaga']['beneficios'] ?? '' ?></textarea>
                                    </div>
                                    <div class="dez-divider bg-gray-dark"></div>
                                    <h6>2. Período de Divulgação da Vaga</h6>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                        <label class="font-weight-700" for="dtInicio">Data de Início da Publicação</label>
                                        <input type="date" class="form-control" name="dtInicio" id="dtInicio" required value="<?= $dados['vaga']['dtInicio'] ?? '' ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="font-weight-700" for="dtFim">Data de Encerramento da Publicação</label>
                                        <input type="date" class="form-control" name="dtFim" id="dtFim" required value="<?= $dados['vaga']['dtFim'] ?? '' ?>">
                                    </div>
                                    </div>
                                    <div class="text-right">
                                        <?php if ($dados['modo'] === 'update'): ?>
                                            <button type="submit" class="site-button mt-3">Confirmar Edição</button>
                                        <?php else: ?>
                                            <button type="submit" class="site-button mt-3">Cadastrar Vaga</button>
                                        <?php endif; ?>
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

<script>
// Habilita/desabilita o input de salário conforme "A combinar"
document.addEventListener('DOMContentLoaded', function () {
    var chk = document.getElementById('ACombinar');
    var inp = document.getElementById('faixaSal');

    function toggleFaixa() {
        if (chk.checked) {
        inp.value = '';
        inp.disabled = true;
        } else {
        inp.disabled = false;
        }
    }
    chk.addEventListener('change', toggleFaixa);
    toggleFaixa(); // garante o estado correto no carregamento
});
</script>