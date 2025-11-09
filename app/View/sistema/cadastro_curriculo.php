<script src="<?= baseUrl() ?>assets/js/cadastro_curriculo.js"></script><!-- GLOBAL FUNCTIONS  -->
<?php
use Core\Library\Session;
?>

<?php $curriculoBloqueado = !Session::get('curriculo_id'); ?>
<?php $curriculo = $dados['curriculo'] ?? []; ?>
<?php $escolaridades = $dados['escolaridades'] ?? []; ?>
<?php $experiencias = $dados['experiencias'] ?? []; ?>
<?php $qualificacoes = $dados['qualificacoes'] ?? []; ?>
<?php $idiomas = $dados['idiomas'] ?? []; ?>

<div class="page-content bg-white">
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
    <div class="content-block">
        <div class="section-full bg-white content-inner-2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-12 m-b10">
                        <?= exibeAlerta() ?>
                        <!-- Navegação das abas  -->
                        <ul class="nav nav-tabs mb-4" id="tabsCurriculo" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="tab1" data-toggle="tab" href="#dados" role="tab">1. Dados Pessoais</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab2" data-toggle="tab" href="#escolaridade" role="tab">2. Escolaridade</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab3" data-toggle="tab" href="#experiencia" role="tab">3. Experiência</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab4" data-toggle="tab" href="#qualificacoes" role="tab">4. Qualificações</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab4" data-toggle="tab" href="#idiomas" role="tab">5. Idiomas</a>
                            </li>
                        </ul>
                        <!-- Conteúdo das abas -->
                        <div class="tab-content">
                            <!-- Aba 1 - Dados pessoais -->
                            <div class="tab-pane fade show active submit-resume shop-account" id="dados" role="tabpanel">
                                <form class="tab-pane-active" action="<?= baseUrl() ?>curriculum/salvar_dados" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="font-weight-700" for="nome">Nome Completo *</label>
                                        <input type="text" name="nome" id="nome" class="form-control" placeholder="Seu nome" required maxlength="60" minlength="5" value="<?= setValor('nome', $curriculo['nome'] ?? '') ?>">
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="email" class="font-weight-700">Email *</label>
                                            <input type="email" id="email" name="email" class="form-control" placeholder="seuemail@exemplo.com" required maxlength="120" minlength="3" value="<?= setValor('email', $curriculo['email'] ?? '') ?>">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="font-weight-700" for="celular">Celular *</label>
                                            <input type="text" id="celular" name="celular" class="form-control" placeholder="(32) 00000-0000" maxlength="15" minlength="15" required value="<?= setValor('celular', formatarTelefone($curriculo['celular'] ?? '')) ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="font-weight-700" for="dataNascimento">Data de Nascimento</label>
                                            <input type="date" id="dataNascimento" name="dataNascimento" class="form-control" required value="<?= setValor('dataNascimento', $curriculo['dataNascimento'] ?? '') ?>">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="font-weight-700" for="sexo" >Gênero *</label>
                                            <select name="sexo" id="sexo" required>
                                                <option value="">Selecione seu gênero</option>
                                                <option value="M" <?= (setValor('sexo', $curriculo['sexo'] ?? '') == 'M') ? 'selected' : '' ?>>Masculino</option>
                                                <option value="F" <?= (setValor('sexo', $curriculo['sexo'] ?? '') == 'F') ? 'selected' : '' ?>>Feminino</option>
                                                <option value="O" <?= (setValor('sexo', $curriculo['sexo'] ?? '') == 'O') ? 'selected' : '' ?>>Outro</option>
                                                <option value="N" <?= (setValor('sexo', $curriculo['sexo'] ?? '') == 'N') ? 'selected' : '' ?>>Prefiro não informar</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label class="font-weight-700" for="cep">CEP *</label>
                                            <input type="text" id="cep" name="cep" class="form-control" placeholder="36000-000" maxlength="9" minlength="9" required value="<?= setValor('cep', formatarCEP($curriculo['cep'] ?? '')) ?>">
                                        </div>
                                        <div class="form-group col-md-8">
                                            <label class="font-weight-700" for="cidade_id" > Cidade *</label>
                                            <select name="cidade_id" id="cidade_id" required>
                                                <option value="">Selecione a cidade</option>
                                                <?php foreach ($dados['aCidade'] as $value): ?>
                                                    <option value="<?= $value['cidade_id'] ?>" <?= (setValor("cidade_id", $curriculo['cidade_id'] ?? '') == $value['cidade_id']) ? 'selected' : ''?>><?=$value['cidade'] . ' - ' . $value['uf'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label class="font-weight-700" for="bairro">Bairro *</label>
                                            <input type="text" id="bairro" name="bairro" class="form-control" placeholder="Seu bairro" maxlength="50" minlength="3" required value="<?= setValor('bairro', $curriculo['bairro'] ?? '') ?>">
                                        </div>
                                        <div class="form-group col-md-8">
                                            <label class="font-weight-700" for="logradouro">Logradouro *</label>
                                            <input type="text" id="logradouro" name="logradouro" class="form-control" placeholder="Rua, Avenida, etc." maxlength="60" minlength="3" required value="<?= setValor('logradouro', $curriculo['logradouro'] ?? '') ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label class="font-weight-700" for="numero">Número</label>
                                            <input type="text" id="numero" name="numero" class="form-control" placeholder="Seu bairro" maxlength="10" value="<?= setValor('numero', $curriculo['numero'] ?? '') ?>">
                                        </div>
                                        <div class="form-group col-md-8">
                                            <label class="font-weight-700" for="complemento">Complemento</label>
                                            <input type="text" id="complemento" name="complemento" class="form-control" placeholder="Apto, Bloco, etc." maxlength="20" value="<?= setValor('complemento', $curriculo['complemento'] ?? '') ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-700" for="apresentacaoPessoal">Apresentação Pessoal</label>
                                        <textarea name="apresentacaoPessoal" id="apresentacaoPessoal" class="form-control" maxlength="1000"><?= setValor('apresentacaoPessoal', $curriculo['apresentacaoPessoal'] ?? '') ?></textarea>
                                        <p class="texto-dica">Descreva quem é você.</p>
                                    </div>
                                    <div class="row">
                                        <!-- Currículo em arquivo -->
                                        <?php if (!empty($curriculo['curriculo_arquivo'])): ?>
                                            <div class="col-12">
                                                <div class="dez-divider bg-gray-dark"></div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <h5>Arquivo Atual</h5>
                                                <p>
                                                    <a href="<?= baseUrl() ?>download.php?type=curriculos&file=<?= urlencode($curriculo['curriculo_arquivo']) ?>"><?= $curriculo['curriculo_arquivo'] ?></a>
                                                </p>
                                                <p class="texto-dica">Você pode substituir o arquivo atual enviando outro.</p>
                                            </div>
                                        <?php endif; ?>
                                        <div class="form-group col-md-6">
                                            <label class="font-weight-700" for="curriculo_arquivo">Currículo em Arquivo</label>
                                            <input type="file" id="curriculo_arquivo" name="curriculo_arquivo" class="form-control">
                                            <p class="texto-dica">Formatos aceitos: PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, TXT (máx. 5MB)</p>
                                        </div>
                                        <!-- Foto -->
                                        <?php if (!empty($curriculo['foto'])): ?>
                                            <div class="col-12">
                                                <div class="dez-divider bg-gray-dark"></div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <h5>Foto Atual</h5>
                                                <img src="<?= baseUrl() . 'imagem.php?file=fotos_curriculos/' . setValor('foto', $curriculo['foto']) ?>" class="img-thumbnail" height="120" width="240">
                                                <p class="texto-dica">Você pode substituir a foto atual enviando outra.</p>
                                            </div>
                                        <?php endif; ?>
                                        <div class="form-group col-md-6">
                                            <label class="font-weight-700" for="foto">Foto</label>
                                            <input type="file" id="foto" name="foto" class="form-control">
                                            <p class="texto-dica">Formatos aceitos: JPG, JPEG, PNG, GIF, BMP, WEBP, SVG+XML (máx. 5MB)</p>
                                        </div>
                                    </div>
                                    <div class="text-right m-b20">
                                        <?php if (!empty($curriculo['curriculum_id'])): ?>
                                            <button type="button" class="site-button outline red" onclick="confirmarExclusao(<?= $curriculo['curriculum_id'] ?>, '<?= baseUrl() ?>curriculum')">Excluir</button>
                                            <button type="submit" class="site-button">Salvar Edição</button>
                                        <?php else: ?>
                                            <button type="submit" class="site-button">Salvar</button>
                                        <?php endif; ?>
                                    </div>
                                </form>
                                
                            </div>
                            <!-- Aba 2 - Escolaridade -->
                            <div class="tab-pane fade show submit-resume shop-account <?= $curriculoBloqueado ? 'bloqueado' : '' ?>" id="escolaridade" role="tabpanel">
                                <?php if ($curriculoBloqueado): ?>
                                    <div class="container text-center m-t30">
                                        <i class="fa fa-lock fa-3x text-muted"></i>
                                        <h6>Finalize o cadastro do seu currículo principal<br>para desbloquear esta seção.</h6>
                                    </div>
                                <?php else: ?>
                                    <?php if (!empty($escolaridades) && is_array($escolaridades)): ?>
                                        <?php foreach ($escolaridades as $esc): ?>
                                            <form  class="tab-pane-active" action="<?= baseUrl() ?>curriculumEscolaridade/update" method="POST">
                                                <input type="hidden" name="curriculum_escolaridade_id" id="curriculum_escolaridade_id" value="<?= setValor('curriculum_escolaridade_id', $esc['curriculum_escolaridade_id'] ?? '') ?>">
                                                <div class="form-group">
                                                    <label class="font-weight-700" for="instituicao">Instituição *</label>
                                                    <input type="text" name="instituicao" id="instituicao" class="form-control" placeholder="Nome da Instituição" required minlength="3" maxlength="60" value="<?= setValor('instituicao', $esc['instituicao'] ?? '') ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-weight-700" for="descricao" >Descrição *</label>
                                                    <input type="text" name="descricao" id="descricao" placeholder="Descrição do Curso" class="form-control" required minlength="3" maxlength="60" value="<?= setValor('descricao', $esc['descricao'] ?? '') ?>">
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label class="font-weight-700" for="inicioMes" >Mês de Início *</label>
                                                        <select name="inicioMes" id="inicioMes" required>
                                                            <option value="1" <?= (setValor('inicioMes', $esc['inicioMes'] ?? '') == '1') ? 'selected' : '' ?>>Janeiro</option>
                                                            <option value="2" <?= (setValor('inicioMes', $esc['inicioMes'] ?? '') == '2') ? 'selected' : '' ?>>Fevereiro</option>
                                                            <option value="3" <?= (setValor('inicioMes', $esc['inicioMes'] ?? '') == '3') ? 'selected' : '' ?>>Março</option>
                                                            <option value="4" <?= (setValor('inicioMes', $esc['inicioMes'] ?? '') == '4') ? 'selected' : '' ?>>Abril</option>
                                                            <option value="5" <?= (setValor('inicioMes', $esc['inicioMes'] ?? '') == '5') ? 'selected' : '' ?>>Maio</option>
                                                            <option value="6" <?= (setValor('inicioMes', $esc['inicioMes'] ?? '') == '6') ? 'selected' : '' ?>>Junho</option>
                                                            <option value="7" <?= (setValor('inicioMes', $esc['inicioMes'] ?? '') == '7') ? 'selected' : '' ?>>Julho</option>
                                                            <option value="8" <?= (setValor('inicioMes', $esc['inicioMes'] ?? '') == '8') ? 'selected' : '' ?>>Agosto</option>
                                                            <option value="9" <?= (setValor('inicioMes', $esc['inicioMes'] ?? '') == '9') ? 'selected' : '' ?>>Setembro</option>
                                                            <option value="10" <?= (setValor('inicioMes', $esc['inicioMes'] ?? '') == '10') ? 'selected' : '' ?>>Outubro</option>
                                                            <option value="11" <?= (setValor('inicioMes', $esc['inicioMes'] ?? '') == '11') ? 'selected' : '' ?>>Novembro</option>
                                                            <option value="12" <?= (setValor('inicioMes', $esc['inicioMes'] ?? '') == '12') ? 'selected' : '' ?>>Dezembro</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="font-weight-700" for="inicioAno" >Ano de Início *</label>
                                                        <input type="number" name="inicioAno" id="inicioAno" placeholder="Ano de Início" class="form-control" required min="1900" max="2099" value="<?= setValor('inicioAno', $esc['inicioAno'] ?? '') ?>">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label class="font-weight-700" for="fimMes" >Mês de Conclusão *</label>
                                                        <select name="fimMes" id="fimMes" required>
                                                            <option value="1" <?= (setValor('fimMes', $esc['fimMes'] ?? '') == '1') ? 'selected' : '' ?>>Janeiro</option>
                                                            <option value="2" <?= (setValor('fimMes', $esc['fimMes'] ?? '') == '2') ? 'selected' : '' ?>>Fevereiro</option>
                                                            <option value="3" <?= (setValor('fimMes', $esc['fimMes'] ?? '') == '3') ? 'selected' : '' ?>>Março</option>
                                                            <option value="4" <?= (setValor('fimMes', $esc['fimMes'] ?? '') == '4') ? 'selected' : '' ?>>Abril</option>
                                                            <option value="5" <?= (setValor('fimMes', $esc['fimMes'] ?? '') == '5') ? 'selected' : '' ?>>Maio</option>
                                                            <option value="6" <?= (setValor('fimMes', $esc['fimMes'] ?? '') == '6') ? 'selected' : '' ?>>Junho</option>
                                                            <option value="7" <?= (setValor('fimMes', $esc['fimMes'] ?? '') == '7') ? 'selected' : '' ?>>Julho</option>
                                                            <option value="8" <?= (setValor('fimMes', $esc['fimMes'] ?? '') == '8') ? 'selected' : '' ?>>Agosto</option>
                                                            <option value="9" <?= (setValor('fimMes', $esc['fimMes'] ?? '') == '9') ? 'selected' : '' ?>>Setembro</option>
                                                            <option value="10" <?= (setValor('fimMes', $esc['fimMes'] ?? '') == '10') ? 'selected' : '' ?>>Outubro</option>
                                                            <option value="11" <?= (setValor('fimMes', $esc['fimMes'] ?? '') == '11') ? 'selected' : '' ?>>Novembro</option>
                                                            <option value="12" <?= (setValor('fimMes', $esc['fimMes'] ?? '') == '12') ? 'selected' : '' ?>>Dezembro</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="font-weight-700" for="fimAno" >Ano de Conclusão *</label>
                                                        <input type="number" name="fimAno" id="fimMes" placeholder="Ano de Conclusão" class="form-control" required min="1900" max="2099" value="<?= setValor('fimAno', $esc['fimAno'] ?? '') ?>">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label class="font-weight-700" for="cidade_id" >Cidade *</label>
                                                        <select name="cidade_id" id="cidade_id" required>
                                                            <?php foreach ($dados['aCidade'] as $valueCidade): ?>
                                                                <option value="<?= $valueCidade['cidade_id'] ?>" <?= (setValor("cidade_id", $esc['cidade_id'] ?? '') == $valueCidade['cidade_id']) ? 'selected' : '' ?>><?=$valueCidade['cidade'] . ' - ' . $valueCidade['uf'] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="font-weight-700" for="escolaridade_id" >Nível *</label>
                                                        <select name="escolaridade_id" id="escolaridade_id" required>
                                                            <?php foreach ($dados['aEscolaridade'] as $valueEscol): ?>
                                                                <option value="<?= $valueEscol['escolaridade_id'] ?>" <?= (setValor("escolaridade_id", $esc['escolaridade_id'] ?? '') == $valueEscol['escolaridade_id']) ? 'SELECTED' : '' ?>><?=$valueEscol['descricao']?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <button type="button" class="site-button outline red" onclick="confirmarExclusaoSub(<?= $esc['curriculum_escolaridade_id'] ?>, '<?= baseUrl() ?>curriculumEscolaridade', 'esta escolaridade')">Excluir</button>
                                                    <button type="submit" class="site-button">Salvar Edição</button>
                                                </div>
                                                <div class="col-12">
                                                    <div class="dez-divider bg-gray-dark"></div>
                                                </div>
                                            </form>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <form  class="tab-pane-active" action="<?= baseUrl() ?>curriculumEscolaridade/insert" method="POST">
                                            <div class="form-group">
                                                <label class="font-weight-700" for="instituicao">Instituição *</label>
                                                <input type="text" name="instituicao" id="instituicao" class="form-control" placeholder="Nome da Instituição" required minlength="3" maxlength="60">
                                            </div>
                                            <div class="form-group">
                                                <label class="font-weight-700" for="descricao" >Descrição *</label>
                                                <input type="text" name="descricao" id="descricao" placeholder="Descrição do Curso" class="form-control" required minlength="3" maxlength="60">
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label class="font-weight-700" for="inicioMes" >Mês de Início *</label>
                                                    <select name="inicioMes" id="inicioMes" required>
                                                        <option value="">Selecione o mês</option>
                                                        <option value="1">Janeiro</option>
                                                        <option value="2">Fevereiro</option>
                                                        <option value="3">Março</option>
                                                        <option value="4">Abril</option>
                                                        <option value="5">Maio</option>
                                                        <option value="6">Junho</option>
                                                        <option value="7">Julho</option>
                                                        <option value="8">Agosto</option>
                                                        <option value="9">Setembro</option>
                                                        <option value="10">Outubro</option>
                                                        <option value="11">Novembro</option>
                                                        <option value="12">Dezembro</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="font-weight-700" for="inicioAno" >Ano de Início *</label>
                                                    <input type="number" name="inicioAno" id="inicioAno" placeholder="Ano de Início" class="form-control" required min="1900" max="2099">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label class="font-weight-700" for="fimMes" >Mês de Conclusão *</label>
                                                    <select name="fimMes" id="fimMes" required>
                                                        <option value="">Selecione o mês</option>
                                                        <option value="1">Janeiro</option>
                                                        <option value="2">Fevereiro</option>
                                                        <option value="3">Março</option>
                                                        <option value="4">Abril</option>
                                                        <option value="5">Maio</option>
                                                        <option value="6">Junho</option>
                                                        <option value="7">Julho</option>
                                                        <option value="8">Agosto</option>
                                                        <option value="9">Setembro</option>
                                                        <option value="10">Outubro</option>
                                                        <option value="11">Novembro</option>
                                                        <option value="12">Dezembro</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="font-weight-700" for="fimAno" >Ano de Conclusão *</label>
                                                    <input type="number" name="fimAno" id="fimMes" placeholder="Ano de Conclusão" class="form-control" required min="1900" max="2099">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label class="font-weight-700" for="cidade_id" >Cidade *</label>
                                                    <select name="cidade_id" id="cidade_id" required>
                                                        <option value="">Selecione a cidade</option>
                                                        <?php foreach ($dados['aCidade'] as $valueCidade): ?>
                                                            <option value="<?= $valueCidade['cidade_id'] ?>" <?= ($valueCidade['cidade_id'] == setValor("cidade_id") ? 'SELECTED' : '') ?>><?=$valueCidade['cidade'] . ' - ' . $value['uf'] ?></option>
                                                        <?php endforeach; ?>                                                        
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="font-weight-700" for="escolaridade_id" >Nível *</label>
                                                    <select name="escolaridade_id" id="escolaridade_id" required>
                                                        <option value="">Selecione o nível</option>
                                                        <?php foreach ($dados['aEscolaridade'] as $valueEscol): ?>
                                                            <option value="<?= $valueEscol['escolaridade_id'] ?>" <?= ($valueEscol['escolaridade_id'] == setValor("escolaridade_id") ? 'SELECTED' : '') ?>><?=$valueEscol['descricao']?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <button type="submit" class="site-button">Salvar</button>
                                            </div>
                                        </form>
                                    <?php endif; ?>
                                    <?php if (!empty($escolaridades) && is_array($escolaridades)): ?>
                                        <div class="text-center m-t30 m-b20">
                                            <button 
                                            type="button" 
                                            id="btnAddFormacao" 
                                            class="site-button radius-xl"
                                            data-baseurl="<?= baseUrl() ?>"
                                            data-cidades='<?php foreach ($dados["aCidade"] as $valueCidade): ?><option value="<?= $valueCidade["cidade_id"] ?>"><?= $valueCidade["cidade"] ?> - <?= $valueCidade["uf"] ?></option><?php endforeach; ?>'
                                            data-escolaridades='<?php foreach ($dados["aEscolaridade"] as $valueEscol): ?><option value="<?= $valueEscol["escolaridade_id"] ?>"><?= $valueEscol["descricao"] ?></option><?php endforeach; ?>'
                                            >+ Adicionar outra formação</button>
                                        </div>
                                        <div id="novaFormacaoContainer" class="tab-pane fade show submit-resume shop-account"></div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                            <!-- Aba 3 - Exeperiência -->
                            <div class="tab-pane fade show submit-resume shop-account <?= $curriculoBloqueado ? 'bloqueado' : '' ?>" id="experiencia" role="tabpanel">
                                <?php if ($curriculoBloqueado): ?>
                                    <div class="container text-center m-t30">
                                        <i class="fa fa-lock fa-3x text-muted"></i>
                                        <h6>Finalize o cadastro do seu currículo principal<br>para desbloquear esta seção.</h6>
                                    </div>
                                <?php else: ?>
                                    <?php if (!empty($experiencias) && is_array($experiencias)): ?>
                                        <?php foreach ($experiencias as $exp): ?>
                                            <form class="tab-pane-active" action="<?= baseUrl() ?>curriculumExperiencia/update" method="POST">
                                                <input type="hidden" name="curriculum_experiencia_id" id="curriculum_experiencia_id" value="<?= setValor('curriculum_experiencia_id', $exp['curriculum_experiencia_id'] ?? '') ?>">
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label class="font-weight-700" for="estabelecimento">Empresa</label>
                                                        <input type="text" name="estabelecimento" id="estabelecimento" class="form-control" placeholder="Nome da Empresa" maxlength="60" value="<?= setValor('estabelecimento', $exp['estabelecimento'] ?? '') ?>">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="font-weight-700" for="cargo_id" >Cargo *</label>
                                                        <select name="cargo_id" id="cargo_id" required>
                                                            <option value="">Selecione seu cargo</option>
                                                            <?php foreach ($dados['aCargo'] as $valueCargo): ?>
                                                                <option value="<?= $valueCargo['cargo_id'] ?>" <?= setValor("cargo_id", $exp['cargo_id'] ?? '') == $valueCargo['cargo_id'] ? 'SELECTED' : '' ?>><?=$valueCargo['descricao']?></option>
                                                                <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-weight-700" for="cargoDescricao" >Descrição</label>
                                                    <input type="text" name="cargoDescricao" id="cargoDescricao" placeholder="Descrição" class="form-control" maxlength="60" value="<?= setValor('cargoDescricao', $exp['cargoDescricao'] ?? '') ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-weight-700" for="atividadesExercidas" >Atividades Exercidas</label>
                                                    <textarea type="text" name="atividadesExercidas" id="atividadesExercidas" class="form-control" maxlength="1000"><?= setValor('atividadesExercidas', $exp['atividadesExercidas'] ?? '') ?></textarea>
                                                    <p class="texto-dica">Descreva suas principais atividades e responsabilidades.</p>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label class="font-weight-700" for="inicioMes" >Mês de Início *</label>
                                                        <select name="inicioMes" id="inicioMes" required>
                                                            <option value="">Selecione o mês</option>
                                                            <option value="1" <?= (setValor('inicioMes', $exp['inicioMes'] ?? '') == '1') ? 'selected' : '' ?>>Janeiro</option>
                                                            <option value="2" <?= (setValor('inicioMes', $exp['inicioMes'] ?? '') == '2') ? 'selected' : '' ?>>Fevereiro</option>
                                                            <option value="3" <?= (setValor('inicioMes', $exp['inicioMes'] ?? '') == '3') ? 'selected' : '' ?>>Março</option>
                                                            <option value="4" <?= (setValor('inicioMes', $exp['inicioMes'] ?? '') == '4') ? 'selected' : '' ?>>Abril</option>
                                                            <option value="5" <?= (setValor('inicioMes', $exp['inicioMes'] ?? '') == '5') ? 'selected' : '' ?>>Maio</option>
                                                            <option value="6" <?= (setValor('inicioMes', $exp['inicioMes'] ?? '') == '6') ? 'selected' : '' ?>>Junho</option>
                                                            <option value="7" <?= (setValor('inicioMes', $exp['inicioMes'] ?? '') == '7') ? 'selected' : '' ?>>Julho</option>
                                                            <option value="8" <?= (setValor('inicioMes', $exp['inicioMes'] ?? '') == '8') ? 'selected' : '' ?>>Agosto</option>
                                                            <option value="9" <?= (setValor('inicioMes', $exp['inicioMes'] ?? '') == '9') ? 'selected' : '' ?>>Setembro</option>
                                                            <option value="10" <?= (setValor('inicioMes', $exp['inicioMes'] ?? '') == '10') ? 'selected' : '' ?>>Outubro</option>
                                                            <option value="11" <?= (setValor('inicioMes', $exp['inicioMes'] ?? '') == '11') ? 'selected' : '' ?>>Novembro</option>
                                                            <option value="12" <?= (setValor('inicioMes', $exp['inicioMes'] ?? '') == '12') ? 'selected' : '' ?>>Dezembro</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="font-weight-700" for="inicioAno" >Ano de Início *</label>
                                                        <input type="number" name="inicioAno" id="inicioAno" placeholder="Ano de Início" class="form-control" required min="1900" max="2099" value="<?= setValor('inicioAno', $exp['inicioAno'] ?? '') ?>">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label class="font-weight-700" for="fimMes" >Mês de Término</label>
                                                        <select name="fimMes" id="fimMes">
                                                            <option value="">Selecione o mês</option>
                                                            <option value="1" <?= (setValor('fimMes', $exp['fimMes'] ?? '') == '1') ? 'selected' : '' ?>>Janeiro</option>
                                                            <option value="2" <?= (setValor('fimMes', $exp['fimMes'] ?? '') == '2') ? 'selected' : '' ?>>Fevereiro</option>
                                                            <option value="3" <?= (setValor('fimMes', $exp['fimMes'] ?? '') == '3') ? 'selected' : '' ?>>Março</option>
                                                            <option value="4" <?= (setValor('fimMes', $exp['fimMes'] ?? '') == '4') ? 'selected' : '' ?>>Abril</option>
                                                            <option value="5" <?= (setValor('fimMes', $exp['fimMes'] ?? '') == '5') ? 'selected' : '' ?>>Maio</option>
                                                            <option value="6" <?= (setValor('fimMes', $exp['fimMes'] ?? '') == '6') ? 'selected' : '' ?>>Junho</option>
                                                            <option value="7" <?= (setValor('fimMes', $exp['fimMes'] ?? '') == '7') ? 'selected' : '' ?>>Julho</option>
                                                            <option value="8" <?= (setValor('fimMes', $exp['fimMes'] ?? '') == '8') ? 'selected' : '' ?>>Agosto</option>
                                                            <option value="9" <?= (setValor('fimMes', $exp['fimMes'] ?? '') == '9') ? 'selected' : '' ?>>Setembro</option>
                                                            <option value="10" <?= (setValor('fimMes', $exp['fimMes'] ?? '') == '10') ? 'selected' : '' ?>>Outubro</option>
                                                            <option value="11" <?= (setValor('fimMes', $exp['fimMes'] ?? '') == '11') ? 'selected' : '' ?>>Novembro</option>
                                                            <option value="12" <?= (setValor('fimMes', $exp['fimMes'] ?? '') == '12') ? 'selected' : '' ?>>Dezembro</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="font-weight-700" for="fimAno" >Ano de Término</label>
                                                        <input type="number" name="fimAno" id="fimAno" placeholder="Ano de Conclusão" class="form-control" min="1900" max="2099" value="<?= setValor('fimAno', $exp['fimAno'] ?? '') ?>">
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <button type="button" class="site-button outline red" onclick="confirmarExclusaoSub(<?= $exp['curriculum_experiencia_id'] ?>, '<?= baseUrl() ?>curriculumExperiencia', 'esta experiência')">Excluir</button>
                                                    <button type="submit" class="site-button">Salvar Edição</button>
                                                </div>
                                                <div class="col-12">
                                                    <div class="dez-divider bg-gray-dark"></div>
                                                </div>
                                            </form>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <form class="tab-pane-active" action="<?= baseUrl() ?>curriculumExperiencia/insert" method="POST">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label class="font-weight-700" for="estabelecimento">Empresa</label>
                                                    <input type="text" name="estabelecimento" id="estabelecimento" class="form-control" placeholder="Nome da Empresa" maxlength="60">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="font-weight-700" for="cargo_id" >Cargo *</label>
                                                    <select name="cargo_id" id="cargo_id" required>
                                                        <option value="">Selecione seu cargo</option>
                                                        <?php foreach ($dados['aCargo'] as $valueCargo): ?>
                                                            <option value="<?= $valueCargo['cargo_id'] ?>" <?= ($valueCargo['cargo_id'] == setValor("cargo_id") ? 'SELECTED' : '') ?>><?=$valueCargo['descricao']?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="font-weight-700" for="cargoDescricao" >Descrição</label>
                                                <input type="text" name="cargoDescricao" id="cargoDescricao" placeholder="Descrição" class="form-control" maxlength="60">
                                            </div>
                                            <div class="form-group">
                                                <label class="font-weight-700" for="atividadesExercidas" >Atividades Exercidas</label>
                                                <textarea type="text" name="atividadesExercidas" id="atividadesExercidas" class="form-control" maxlength="1000"></textarea>
                                                <p class="texto-dica">Descreva suas principais atividades e responsabilidades.</p>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label class="font-weight-700" for="inicioMes" >Mês de Início *</label>
                                                    <select name="inicioMes" id="inicioMes" required>
                                                        <option value="">Selecione o mês</option>
                                                        <option value="1">Janeiro</option>
                                                        <option value="2">Fevereiro</option>
                                                        <option value="3">Março</option>
                                                        <option value="4">Abril</option>
                                                        <option value="5">Maio</option>
                                                        <option value="6">Junho</option>
                                                        <option value="7">Julho</option>
                                                        <option value="8">Agosto</option>
                                                        <option value="9">Setembro</option>
                                                        <option value="10">Outubro</option>
                                                        <option value="11">Novembro</option>
                                                        <option value="12">Dezembro</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="font-weight-700" for="inicioAno" >Ano de Início *</label>
                                                    <input type="number" name="inicioAno" id="inicioAno" placeholder="Ano de Início" class="form-control" required min="1900" max="2099">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label class="font-weight-700" for="fimMes" >Mês de Saída</label>
                                                    <select name="fimMes" id="fimMes">
                                                        <option value="">Selecione o mês</option>
                                                        <option value="1">Janeiro</option>
                                                        <option value="2">Fevereiro</option>
                                                        <option value="3">Março</option>
                                                        <option value="4">Abril</option>
                                                        <option value="5">Maio</option>
                                                        <option value="6">Junho</option>
                                                        <option value="7">Julho</option>
                                                        <option value="8">Agosto</option>
                                                        <option value="9">Setembro</option>
                                                        <option value="10">Outubro</option>
                                                        <option value="11">Novembro</option>
                                                        <option value="12">Dezembro</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="font-weight-700" for="fimAno" >Ano de Saída</label>
                                                    <input type="number" name="fimAno" id="fimMes" placeholder="Ano de Saída" class="form-control" min="1900" max="2099">
                                                    <p class="texto-dica">Deixe em branco se ainda estiver no trabalho atual.</p>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <button type="submit" class="site-button">Salvar</button>
                                            </div>
                                        </form>
                                    <?php endif; ?>
                                    <?php if (!empty($experiencias) && is_array($experiencias)): ?>
                                        <div class="text-center m-t30 m-b20">
                                            <button 
                                                type="button" 
                                                id="btnAddExperiencia" 
                                                class="site-button radius-xl"
                                                data-baseurl="<?= baseUrl() ?>"
                                                data-cargos='<?php foreach ($dados["aCargo"] as $valueCargo): ?><option value="<?= $valueCargo["cargo_id"] ?>"><?= $valueCargo["descricao"] ?></option><?php endforeach; ?>'
                                                >+ Adicionar outra experiência</button>
                                        </div>
                                        <div id="novaExperienciaContainer" class="tab-pane fade show submit-resume shop-account"></div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                            <!-- Aba 4 - Qualificações -->
                            <div class="tab-pane fade show submit-resume shop-account <?= $curriculoBloqueado ? 'bloqueado' : '' ?>" id="qualificacoes" role="tabpanel">
                                <?php if ($curriculoBloqueado): ?>
                                    <div class="container text-center m-t30">
                                        <i class="fa fa-lock fa-3x text-muted"></i>
                                        <h6>Finalize o cadastro do seu currículo principal<br>para desbloquear esta seção.</h6>
                                    </div>
                                <?php else: ?>
                                    <?php if (!empty($qualificacoes) && is_array($qualificacoes)): ?>
                                        <?php foreach ($qualificacoes as $qua): ?>
                                            <form class="tab-pane-active" action="<?= baseUrl() ?>curriculumQualificacao/update" method="POST">
                                                <input type="hidden" name="curriculum_qualificacao_id" id="curriculum_qualificacao_id" value="<?= setValor('curriculum_qualificacao_id', $qua['curriculum_qualificacao_id'] ?? '') ?>">
                                                <div class="form-group">
                                                    <label class="font-weight-700" for="instituicao">Instituição *</label>
                                                    <input type="text" name="instituicao" id="instituicao" class="form-control" placeholder="Nome da Instituição" minlength="3" maxlength="60" required value="<?= setValor('instituicao', $qua['instituicao'] ?? '') ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-weight-700" for="descricao" >Descrição *</label>
                                                    <input type="text" name="descricao" id="descricao" placeholder="Descrição da qualificação" class="form-control" minlength="3" maxlength="60" required value="<?= setValor('descricao', $qua['descricao'] ?? '') ?>">
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label class="font-weight-700" for="mes" >Mês *</label>
                                                        <select name="mes" id="mes" required>
                                                            <option value="1" <?= (setValor('mes', $qua['mes'] ?? '') == '1') ? 'selected' : '' ?>>Janeiro</option>
                                                            <option value="2" <?= (setValor('mes', $qua['mes'] ?? '') == '2') ? 'selected' : '' ?>>Fevereiro</option>
                                                            <option value="3" <?= (setValor('mes', $qua['mes'] ?? '') == '3') ? 'selected' : '' ?>>Março</option>
                                                            <option value="4" <?= (setValor('mes', $qua['mes'] ?? '') == '4') ? 'selected' : '' ?>>Abril</option>
                                                            <option value="5" <?= (setValor('mes', $qua['mes'] ?? '') == '5') ? 'selected' : '' ?>>Maio</option>
                                                            <option value="6" <?= (setValor('mes', $qua['mes'] ?? '') == '6') ? 'selected' : '' ?>>Junho</option>
                                                            <option value="7" <?= (setValor('mes', $qua['mes'] ?? '') == '7') ? 'selected' : '' ?>>Julho</option>
                                                            <option value="8" <?= (setValor('mes', $qua['mes'] ?? '') == '8') ? 'selected' : '' ?>>Agosto</option>
                                                            <option value="9" <?= (setValor('mes', $qua['mes'] ?? '') == '9') ? 'selected' : '' ?>>Setembro</option>
                                                            <option value="10" <?= (setValor('mes', $qua['mes'] ?? '') == '10') ? 'selected' : '' ?>>Outubro</option>
                                                            <option value="11" <?= (setValor('mes', $qua['mes'] ?? '') == '11') ? 'selected' : '' ?>>Novembro</option>
                                                            <option value="12" <?= (setValor('mes', $qua['mes'] ?? '') == '12') ? 'selected' : '' ?>>Dezembro</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="font-weight-700" for="ano" >Ano *</label>
                                                        <input type="number" name="ano" id="ano" placeholder="Ano" class="form-control" required min="1900" max="2099" value="<?= setValor('ano', $qua['ano'] ?? '') ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                        <label class="font-weight-700" for="cargaHoraria" >Carga Horária *</label>
                                                        <input type="number" name="cargaHoraria" id="cargaHoraria" placeholder="Carga Horária Total" class="form-control" required min="0" max="5000" value="<?= setValor('cargaHoraria', $qua['cargaHoraria'] ?? '') ?>">
                                                    </div>
                                                <div class="text-right">
                                                    <button type="button" class="site-button outline red" onclick="confirmarExclusaoSub(<?= $qua['curriculum_qualificacao_id'] ?>, '<?= baseUrl() ?>curriculumQualificacao', 'esta qualificação')">Excluir</button>
                                                    <button type="submit" class="site-button">Salvar Edição</button>
                                                </div>
                                                <div class="col-12">
                                                    <div class="dez-divider bg-gray-dark"></div>
                                                </div>
                                            </form>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <form class="tab-pane-active" action="<?= baseUrl() ?>curriculumQualificacao/insert" method="POST">
                                            <div class="form-group">
                                                <label class="font-weight-700" for="instituicao">Instituição *</label>
                                                <input type="text" name="instituicao" id="instituicao" class="form-control" placeholder="Nome da Instituição" minlength="3" maxlength="60" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="font-weight-700" for="descricao" >Descrição *</label>
                                                <input type="text" name="descricao" id="descricao" placeholder="Descrição da qualificação" class="form-control" minlength="3" maxlength="60" required>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label class="font-weight-700" for="mes" >Mês *</label>
                                                    <select name="mes" id="mes" required>
                                                        <option value="">Selecione o mês</option>
                                                        <option value="1">Janeiro</option>
                                                        <option value="2">Fevereiro</option>
                                                        <option value="3">Março</option>
                                                        <option value="4">Abril</option>
                                                        <option value="5">Maio</option>
                                                        <option value="6">Junho</option>
                                                        <option value="7">Julho</option>
                                                        <option value="8">Agosto</option>
                                                        <option value="9">Setembro</option>
                                                        <option value="10">Outubro</option>
                                                        <option value="11">Novembro</option>
                                                        <option value="12">Dezembro</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="font-weight-700" for="ano" >Ano *</label>
                                                    <input type="number" name="ano" id="ano" placeholder="Ano" class="form-control" required min="1900" max="2099">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                    <label class="font-weight-700" for="cargaHoraria" >Carga Horária *</label>
                                                    <input type="number" name="cargaHoraria" id="cargaHoraria" placeholder="Carga Horária Total" class="form-control" required min="0" max="5000">
                                                </div>
                                            <div class="text-right">
                                                <button type="submit" class="site-button">Salvar</button>
                                            </div>
                                        </form>
                                    <?php endif; ?>
                                    <?php if (!empty($qualificacoes) && is_array($qualificacoes)): ?>
                                        <div class="text-center m-t30 m-b20">
                                            <button 
                                                type="button" 
                                                id="btnAddQualificacao" 
                                                class="site-button radius-xl"
                                                data-baseurl="<?= baseUrl() ?>"
                                                >+ Adicionar outra qualificação</button>
                                        </div>
                                        <div id="novaQualificacaoContainer" class="tab-pane fade show submit-resume shop-account"></div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                            <!-- Aba 5 - Idiomas -->
                            <div class="tab-pane fade show submit-resume shop-account <?= $curriculoBloqueado ? 'bloqueado' : '' ?>" id="idiomas" role="tabpanel">
                                <?php if ($curriculoBloqueado): ?>
                                    <div class="container text-center m-t30">
                                        <i class="fa fa-lock fa-3x text-muted"></i>
                                        <h6>Finalize o cadastro do seu currículo principal<br>para desbloquear esta seção.</h6>
                                    </div>
                                <?php else: ?>
                                    <?php if (!empty($idiomas) && is_array($idiomas)): ?>
                                        <?php foreach ($idiomas as $idi): ?>
                                            <form class="tab-pane-active" action="<?= baseUrl() ?>curriculumIdioma/update" method="POST">
                                                <input type="hidden" name="curriculum_idioma_id" id="curriculum_idioma_id" value="<?= setValor('curriculum_idioma_id', $idi['curriculum_idioma_id'] ?? '') ?>">
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label class="font-weight-700" for="idioma_id" >Idioma *</label>
                                                        <select name="idioma_id" id="idioma_id" required>
                                                            <?php foreach ($dados['aIdioma'] as $valueIdioma): ?>
                                                                <option value="<?= $valueIdioma['idioma_id'] ?>" <?= setValor("idioma_id", $idi['idioma_id'] ?? '') == $valueIdioma['idioma_id'] ? 'SELECTED' : '' ?>><?=$valueIdioma['descricao']?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="font-weight-700" for="nivel" >Nível</label>
                                                        <select name="nivel" id="nivel">
                                                            <option value="1" <?= (setValor('nivel', $idi['nivel'] ?? '') == '1') ? 'selected' : '' ?>>Básico</option>
                                                            <option value="2" <?= (setValor('nivel', $idi['nivel'] ?? '') == '2') ? 'selected' : '' ?>>Intermediário</option>
                                                            <option value="3" <?= (setValor('nivel', $idi['nivel'] ?? '') == '3') ? 'selected' : '' ?>>Avançado</option>
                                                            <option value="4" <?= (setValor('nivel', $idi['nivel'] ?? '') == '4') ? 'selected' : '' ?>>Fluente</option>
                                                            <option value="5" <?= (setValor('nivel', $idi['nivel'] ?? '') == '5') ? 'selected' : '' ?>>Nativo</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <button type="button" class="site-button outline red" onclick="confirmarExclusaoSub(<?= $idi['curriculum_idioma_id'] ?>, '<?= baseUrl() ?>curriculumIdioma', 'este idioma')">Excluir</button>
                                                    <button type="submit" class="site-button">Salvar Edição</button>
                                                </div>
                                                <div class="col-12">
                                                    <div class="dez-divider bg-gray-dark"></div>
                                                </div>
                                            </form>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <form class="tab-pane-active" action="<?= baseUrl() ?>curriculumIdioma/insert" method="POST">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label class="font-weight-700" for="idioma_id" >Idioma *</label>
                                                    <select name="idioma_id" id="idioma_id" required>
                                                        <option value="">Selecione o idioma</option>
                                                        <?php foreach ($dados['aIdioma'] as $valueIdioma): ?>
                                                            <option value="<?= $valueIdioma['idioma_id'] ?>" <?= ($valueIdioma['idioma_id'] == setValor("idioma_id") ? 'SELECTED' : '') ?>><?=$valueIdioma['descricao']?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="font-weight-700" for="nivel" >Nível</label>
                                                    <select name="nivel" id="nivel">
                                                        <option value="">Selecione o nível</option>
                                                        <option value="1">Básico</option>
                                                        <option value="2">Intermediário</option>
                                                        <option value="3">Avançado</option>
                                                        <option value="4">Fluente</option>
                                                        <option value="5">Nativo</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <button type="submit" class="site-button">Salvar</button>
                                            </div>
                                        </form>
                                    <?php endif; ?>
                                    <?php if (!empty($idiomas) && is_array($idiomas)): ?>
                                        <div class="text-center m-t30 m-b20">
                                            <button 
                                                type="button" 
                                                id="btnAddIdioma" 
                                                class="site-button radius-xl" 
                                                data-baseurl="<?= baseUrl() ?>"
                                                data-idiomas='<?php foreach ($dados["aIdioma"] as $valueIdioma): ?><option value="<?= $valueIdioma["idioma_id"] ?>"><?= $valueIdioma["descricao"] ?></option><?php endforeach; ?>'
                                                >+ Adicionar outro idioma</button>
                                        </div>
                                        <div id="novaIdiomaContainer" class="tab-pane fade show submit-resume shop-account"></div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div> <!-- Fim das Abas -->
                    </div>
                    <div class="col-lg-3 col-md-12 sticky-top">
                        <aside  class="side-bar">
                            <div class="widget widget-newslatter">
                                <h6 class="widget-title style-1">Dicas para o Currículo</h6>
                                <div class="news-box">
									<h6 class="m-b5">Seja Objetivo</h6>
									<p>Mantenha seu currículo conciso e focado nas informações mais relevantes.</p>
                                    <h6 class="m-b5">Destaque Conquistas</h6>
									<p>Ao descrever experiências, foque em resultados e conquistas, não apenas responsabilidades.</p>
                                    <h6 class="m-b5">Seja Honesto</h6>
									<p>Nunca inclua informações falsas ou exageradas em seu currículo.</p>
                                    <h6 class="m-b5">Revise Cuidadosamente</h6>
									<p>Verifique erros de ortografia e gramática antes de finalizar seu currículo.</p>
                                    <h6 class="m-b5">Mantenha Atualizado</h6>
									<p>Atualize seu currículo regularmente com novas experiências e qualificações.</p>
                                </div> 
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    aplicarMascaraCelular(document.getElementById("celular"));
    aplicarMascaraCEP(document.getElementById("cep"));
    addIdioma();
    addExperiencia();
    addQualificacao();
    addEscolaridade();
});
</script>
