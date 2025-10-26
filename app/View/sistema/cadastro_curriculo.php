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
                </ul>
                <!-- Conteúdo das abas -->
                <div class="tab-content">
                    <!-- Aba 1 - Dados pessoais -->
                    <div class="tab-pane fade show active submit-resume shop-account" id="dados" role="tabpanel">
                        <form class="tab-pane-active" action="<?= baseUrl() ?>curriculum/salvar_dados" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="font-weight-700" for="nome">Nome Completo *</label>
                                <input type="text" name="nome" id="nome" class="form-control" placeholder="Seu nome" required maxlength="60" minlength="5">
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="email" class="font-weight-700">Email *</label>
                                    <input type="email" id="email" name="email" class="form-control" placeholder="seu.email@exemplo.com" required maxlength="120" minlength="3">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="font-weight-700" for="celular">Celular *</label>
                                    <input type="text" id="celular" name="celular" class="form-control" placeholder="32123456789" maxlength="11" minlength="11" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="font-weight-700" for="dataNascimento">Data de Nascimento</label>
                                    <input type="date" id="dataNascimento" name="dataNascimento" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="font-weight-700" for="sexo" >Gênero *</label>
                                    <select name="sexo" id="sexo" required>
                                        <option value="">Selecione seu gênero</option>
                                        <option value="M">Masculino</option>
                                        <option value="F">Feminino</option>
                                        <option value="O">Outro</option>
                                        <option value="N">Prefiro não informar</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label class="font-weight-700" for="cep">CEP *</label>
                                    <input type="text" id="cep" name="cep" class="form-control" placeholder="36000000" maxlength="8" minlength="8" required>
                                </div>
                                <div class="form-group col-md-8">
                                    <label class="font-weight-700" for="cidade_id" > Cidade *</label>
                                    <select name="cidade_id" id="cidade_id" required>
                                        <option value="">Selecione a cidade</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label class="font-weight-700" for="bairro">Bairro *</label>
                                    <input type="text" id="bairro" name="bairro" class="form-control" placeholder="Seu bairro" maxlength="50" minlength="3" required>
                                </div>
                                <div class="form-group col-md-8">
                                    <label class="font-weight-700" for="logradouro">Logradouro *</label>
                                    <input type="text" id="logradouro" name="logradouro" class="form-control" placeholder="Rua, Avenida, etc." maxlength="60" minlength="3" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label class="font-weight-700" for="numero">Número</label>
                                    <input type="text" id="numero" name="numero" class="form-control" placeholder="Seu bairro" maxlength="10">
                                </div>
                                <div class="form-group col-md-8">
                                    <label class="font-weight-700" for="complemento">Complemento</label>
                                    <input type="text" id="complemento" name="complemento" class="form-control" placeholder="Apto, Bloco, etc." maxlength="20">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-700" for="apresentacaoPessoal">Apresentação Pessoal</label>
                                <textarea name="apresentacaoPessoal" id="apresentacaoPessoal" class="form-control" placeholder="Descreva quem é você" maxlength="1000"></textarea>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="font-weight-700" for="curriculo_arquivo">Currículo em Arquivo</label>
                                    <input type="file" id="curriculo_arquivo" name="curriculo_arquivo" class="form-control">
                                    <p class="font-weight-600">Formatos aceitos: JPG, JEPG, PNG, GIF, BMP, WEBP, SVG+XML (máx. 5MB)</p>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="font-weight-700" for="foto">Foto</label>
                                    <input type="file" id="foto" name="foto" class="form-control">
                                    <p class="font-weight-600">Formatos aceitos: DOC, DOCX, XLS, XLSX, PPT, PPTX, TXT (máx. 5MB)</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="site-button">Salvar</button>
                            </div>
                        </form>
                    </div>
                    <!-- Aba 2 - Escolaridade -->
                    <div class="tab-pane fade show submit-resume shop-account" id="escolaridade" role="tabpanel">
                        <form  class="tab-pane-active" action="<?= baseUrl() ?>curriculum/salvar_escolaridade" method="POST">
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
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="font-weight-700" for="escolaridade_id" >Nível *</label>
                                    <select name="escolaridade_id" id="escolaridade_id" required>
                                        <option value="">Selecione o nível</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="site-button">Salvar</button>
                            </div>
                            <div class="text-center m-t30">
                                <button class="site-button radius-xl">+ Adicionar outra formação</button>
                            </div>
                        </form>

                    </div>
                    <!-- Aba 3 - Exeperiência -->
                    <div class="tab-pane fade show submit-resume shop-account" id="experiencia" role="tabpanel">
                        <form class="tab-pane-active" action="<?= baseUrl() ?>curriculum/salvar_experiencia" method="POST">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="font-weight-700" for="estabelecimento">Estabelecimento ou Empresa</label>
                                    <input type="text" name="estabelcimento" id="estabelecimento" class="form-control" placeholder="Nome do Estabelecimento ou Empresa" minlength="3" maxlength="60">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="font-weight-700" for="cargo_id" >Cargo *</label>
                                    <select name="cargo_id" id="cargo_id" required>
                                        <option value="">Selecione seu cargo</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-700" for="cargoDescricao" >Descrição</label>
                                <input type="text" name="cargoDescricao" id="cargoDescricao" placeholder="Descrição" class="form-control" minlength="3" maxlength="60">
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
                                    <label class="font-weight-700" for="fimMes" >Mês de Término</label>
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
                                    <label class="font-weight-700" for="fimAno" >Ano de Término</label>
                                    <input type="number" name="fimAno" id="fimMes" placeholder="Ano de Conclusão" class="form-control" min="1900" max="2099">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="font-weight-700" for="cidade_id" >Cidade *</label>
                                    <select name="cidade_id" id="cidade_id" required>
                                        <option value="">Selecione a cidade</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="font-weight-700" for="escolaridade_id" >Nível *</label>
                                    <select name="escolaridade_id" id="escolaridade_id" required>
                                        <option value="">Selecione o nível</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="site-button">Salvar</button>
                            </div>
                            <div class="text-center m-t30">
                                <button class="site-button radius-xl">+ Adicionar outra experiência</button>
                            </div>
                        </form>
                    </div>
                    <!-- Aba 4 - Qualificações -->
                    <div class="tab-pane fade" id="qualificacoes" role="tabpanel">
                        <form action="<?= baseUrl() ?>curriculum/salvar_qualificacao" method="POST">
                            <div class="form-group">
                                <label class="font-weight-700">Idioma</label>
                                <select name="idioma" class="form-control">
                                <option value="">Selecione</option>
                                <option value="Inglês">Inglês</option>
                                <option value="Espanhol">Espanhol</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-700">Nível</label>
                                <input type="text" name="nivel" class="form-control" placeholder="Ex: Básico, Intermediário, Avançado">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-700">Qualificações Adicionais</label>
                                <input type="text" name="descricao_qualificacao" class="form-control" placeholder="Digite suas qualificações">
                            </div>
                            <div class="text-right">
                                <button type="submit" class="site-button">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div> <!-- Fim das Abas -->
            </div>
        </div>
    </div>
</div>


