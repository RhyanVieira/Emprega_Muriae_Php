function confirmarExclusao(id, rotaBase) {
    if (confirm("Tem certeza que deseja excluir este currículo?\n\n⚠️ Atenção: Todos os currículos dependentes (escolaridade, experiência, qualificações e idiomas) também serão apagados.\n\nEsta ação não poderá ser desfeita.")) {
        window.location.href = `${rotaBase}/delete/${id}`;
    }
}

function confirmarExclusaoSub(id, rotaBase, tipo) {
    if (confirm(`Tem certeza que deseja excluir ${tipo}?\n\n⚠️ Esta ação não poderá ser desfeita.`)) {
        window.location.href = `${rotaBase}/delete/${id}`;
    }
}

function addIdioma(baseUrl){
    const botao = document.getElementById("btnAddIdioma");
    const container = document.getElementById("novaIdiomaContainer");

    if (!botao) return; // evita erro caso o botão não exista

    botao.addEventListener("click", function() {
        const baseUrl = botao.dataset.baseurl;
        const idiomasOptions = botao.dataset.idiomas;

        // Cria o HTML do novo formulário
        const novoForm = `
                                    <form class="tab-pane-active" action="${baseUrl}curriculumIdioma/insert" method="POST">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label class="font-weight-700" for="idioma_id" >Idioma *</label>
                                                    <select name="idioma_id" id="idioma_id" required class="selectpicker" data-live-search="true">
                                                        <option value="">Selecione o idioma</option>
                                                        ${idiomasOptions}
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="font-weight-700" for="nivel">Nível</label>
                                                    <select name="nivel" id="nivel" class="selectpicker" data-live-search="true">
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
        `;

        // Insere no DOM
        container.innerHTML = novoForm;
        $('.selectpicker').selectpicker('refresh');

        // Esconde o botão principal
        botao.style.display = "none";
    });
}

function addExperiencia() {
    const botao = document.getElementById("btnAddExperiencia");
    const container = document.getElementById("novaExperienciaContainer");

    if (!botao || !container) return; // não faz nada se não houver o botão

    botao.addEventListener("click", function () {
        const baseUrl = botao.dataset.baseurl;
        const cargosOptions = botao.dataset.cargos;

        const novoForm = `
            <form class="tab-pane-active" action="${baseUrl}curriculumExperiencia/insert" method="POST">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="font-weight-700" for="estabelecimento">Empresa</label>
                        <input type="text" name="estabelecimento" id="estabelecimento" class="form-control" placeholder="Nome da Empresa" maxlength="60">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="font-weight-700" for="cargo_id">Cargo *</label>
                        <select name="cargo_id" id="cargo_id" class="selectpicker" data-live-search="true" required>
                            <option value="">Selecione seu cargo</option>
                            ${cargosOptions}
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="font-weight-700" for="cargoDescricao">Descrição</label>
                    <input type="text" name="cargoDescricao" id="cargoDescricao" placeholder="Descrição" class="form-control" maxlength="60">
                </div>
                <div class="form-group">
                    <label class="font-weight-700" for="atividadesExercidas">Atividades Exercidas</label>
                    <textarea name="atividadesExercidas" id="atividadesExercidas" class="form-control" maxlength="1000"></textarea>
                    <p class="texto-dica">Descreva suas principais atividades e responsabilidades.</p>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="font-weight-700" for="inicioMes">Mês de Início *</label>
                        <select name="inicioMes" id="inicioMes" class="selectpicker" required>
                            <option value="">Selecione o mês</option>
                            ${gerarMesesOptions()}
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="font-weight-700" for="inicioAno">Ano de Início *</label>
                        <input type="number" name="inicioAno" id="inicioAno" placeholder="Ano de Início" class="form-control" required min="1900" max="2099">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="font-weight-700" for="fimMes">Mês de Término</label>
                        <select name="fimMes" id="fimMes" class="selectpicker">
                            <option value="">Selecione o mês</option>
                            ${gerarMesesOptions()}
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="font-weight-700" for="fimAno">Ano de Término</label>
                        <input type="number" name="fimAno" id="fimAno" placeholder="Ano de Conclusão" class="form-control" min="1900" max="2099">
                    </div>
                    <div class="col-12 m-b0"><p class="texto-dica">Deixe em branco se ainda estiver no trabalho atual.</p></div>
                </div>
                <div class="text-right">
                    <button type="submit" class="site-button">Salvar</button>
                </div>
            </form>
        `;

        container.innerHTML = novoForm;
        $('.selectpicker').selectpicker('refresh');
        botao.style.display = "none";
    });
}

function addQualificacao(){
    const botao = document.getElementById("btnAddQualificacao");
    const container = document.getElementById("novaQualificacaoContainer");

    if (!botao) return; // evita erro caso o botão não exista

    botao.addEventListener("click", function() {
        const baseUrl = botao.dataset.baseurl;
        // Cria o HTML do novo formulário
        const novoForm = `
                                    <form class="tab-pane-active" action="${baseUrl}curriculumQualificacao/insert" method="POST">
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
                                                    <select name="mes" id="mes" required class="selectpicker" data-live-search="true">
                                                        <option value="">Selecione o mês</option>
                                                        ${gerarMesesOptions()}
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
        `;

        // Insere no DOM
        container.innerHTML = novoForm;
        $('.selectpicker').selectpicker('refresh');

        // Esconde o botão principal
        botao.style.display = "none";
    });
}

function addEscolaridade() {
    const botao = document.getElementById("btnAddFormacao");
    const container = document.getElementById("novaFormacaoContainer");

    if (!botao) return; // evita erro caso o botão não exista

    botao.addEventListener("click", function() {
        const baseUrl = botao.dataset.baseurl;
        const cidadesOptions = botao.dataset.cidades;
        const escolaridadesOptions = botao.dataset.escolaridades;

        // Cria o HTML do novo formulário
        const novoForm = `
                                    <form  class="tab-pane-active" action="${baseUrl}curriculumEscolaridade/insert" method="POST">
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
                                                <select name="inicioMes" id="inicioMes" class="selectpicker" data-live-search="true" required>
                                                    <option value="">Selecione o mês</option>
                                                    ${gerarMesesOptions()}
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
                                                <select name="fimMes" id="fimMes" class="selectpicker" data-live-search="true" required>
                                                    <option value="">Selecione o mês</option>
                                                    ${gerarMesesOptions()}
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
                                                <select name="cidade_id" id="cidade_id" class="selectpicker" data-live-search="true" required>
                                                    <option value="">Selecione a cidade</option>
                                                    ${cidadesOptions}
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="font-weight-700" for="escolaridade_id" >Nível *</label>
                                                <select name="escolaridade_id" id="escolaridade_id" class="selectpicker" data-live-search="true" required>
                                                    <option value="">Selecione o nível</option>
                                                    ${escolaridadesOptions}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" class="site-button">Salvar</button>
                                        </div>
                                    </form>
        `;

        // Insere no DOM
        container.innerHTML = novoForm;
        $('.selectpicker').selectpicker('refresh');

        // Esconde o botão principal
        botao.style.display = "none";
    });
}
function gerarMesesOptions() {
    const meses = [
        "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho",
        "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"
    ];
    return meses.map((m, i) => `<option value="${i + 1}">${m}</option>`).join('');
}