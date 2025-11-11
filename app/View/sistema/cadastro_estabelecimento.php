<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
<div class="page-content bg-white">
    <!-- contact area -->
    <div class="section-full content-inner shop-account">
        <!-- Product -->
        <div class="container">
            <div class="row">
				<div class="col-md-12 text-center">
					<h3 class="font-weight-700 m-t0 m-b20">Cadastro de Estabelecimento</h3>
                    <h6>Conecte sua empresa aos melhores profissionais da região</h6>
                    <?= exibeAlerta() ?>
				</div>
			</div>
            <div class="row">
				<div class="col-md-12 m-b30">
					<div class="p-a30 border-1 m-auto">
						<div class="tab-content">
                            <div class="tab-pane fade show active submit-resume shop-account">
                                <form id="cadastroParaUsuario" class="tab-pane active" method="POST" action="<?= baseUrl() ?>estabelecimento/cadastroParaUsuario" enctype="multipart/form-data">
                                    <p class="font-weight-600">Preencha as informações abaixo para divulgar vagas e gerenciar seus processos seletivos.</p>
                                    
                                    <div class="form-group">
                                        <label class="font-weight-700">Nome da Empresa *</label>
                                        <input name="nome" id="nome" class="form-control" placeholder="Digite o nome da empresa" type="text" minlength="3" maxlength="60" required>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label class="font-weight-700">CNPJ *</label>
                                            <input name="cnpj" id="cnpj" class="form-control" placeholder="00.000.000/0001-00" type="text" minlength="18" maxlength="18" required>
                                        </div>
                                        <div class="form-group col-md-8">
                                            <label class="font-weight-700">Razão social *</label>
                                            <input name="razao_social" id="razao_social" class="form-control" placeholder="Digite a razão social" type="text" minlength="3" maxlength="255" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="font-weight-700">E-mail corporativo (opcional)</label>
                                            <input name="email" id="email" class="form-control" placeholder="contato@empresa.com.br" type="email" maxlength="150">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="font-weight-700">Website (opcional)</label>
                                            <input name="website" id="website" class="form-control" placeholder="https://www.empresa.com.br" type="text" maxlength="255"> 
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Endereço (opcional)</label>
                                            <input class="form-control" name="endereco" id="endereco" placeholder="Rua, número, bairro" type="text" maxlength="200">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label class="font-weight-700" for="cep">CEP *</label>
                                            <input type="text" id="cep" name="cep" class="form-control" placeholder="36000-000" maxlength="9" minlength="9" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label class="font-weight-700" for="cidade_id" > Cidade *</label>
                                            <select name="cidade_id" id="cidade_id" required>
                                                <option value="">Selecione a cidade</option>
                                                <?php foreach ($dados['aCidade'] as $value): ?>
                                                    <option value="<?= $value['cidade_id'] ?>"><?=$value['cidade'] . ' - ' . $value['uf'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-700" for="categorias">Categorias de Atuação *</label>
                                        <select name="categorias[]" id="categorias" class="selectpicker" multiple data-live-search="true" title="Selecione uma ou mais categorias" required>
                                            <?php foreach ($dados['aCategoriaEstabelecimento'] as $cat): ?>
                                                <option value="<?= $cat['categoria_estabelecimento_id'] ?>">
                                                    <?= $cat['descricao'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <p class="texto-dica">Selecione até 5 categorias. <span class="bold-text">Selecione novamente a categoria para desmarca-la.</span></p>
                                    </div>
                                    <div class="form-group">
                                        <label>Descrição da Empresa (opcional)</label>
                                        <textarea class="form-control" name="descricao" id="descricao" maxlength="1000"></textarea>
                                        <p class="texto-dica">Descreva sua empresa, área de atuação, missão, valores e diferencias...</p>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="font-weight-700" for="latitude">Latitude *</label>
                                            <input name="latitude" id="latitude" class="form-control" type="text" minlength="12" maxlength="12" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="font-weight-700" for="longitude" >Longitude *</label>
                                            <input name="longitude" id="longitude" class="form-control" type="text" minlength="12" maxlength="12" required>
                                        </div>
                                    </div>
                                    <p class="texto-dica">Clique no mapa abaixo para definir a localização da empresa.</p>
                                    <div class="form-group mb-4">
                                        <div id="map" style="height: 300px; border-radius: 8px; border: 1px solid #dee2e6;"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="logo" class="font-weight-700">Logo da Empresa (opcional)</label>
                                        <input type="file" class="form-control" name="logo" id="logo">
                                        <p class="font-weight-600">Formatos aceitos: JPG, JEPG, PNG, GIF, BMP, WEBP, SVG+XML (máx. 5MB)</p>
                                    </div>
                                    <div class="text-left m-t20">
                                        <button type="submit" class="site-button button-lg outline outline-2">Cadastrar Empresa</button>
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

<script>
document.addEventListener("DOMContentLoaded", function() {
    aplicarMascaraCEP(document.getElementById("cep"));
});
</script>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    
<script>
    // Inicialização do mapa
    let map;
    let marker;
    
    function initMap() {
        // Coordenadas de Muriaé, MG
        const muriaeCoords = [-21.1305, -42.3664];
        
        const limitesBrasil = L.latLngBounds(
        L.latLng(-34.0, -74.0), // sudoeste (extremo sul)
        L.latLng(5.5, -34.0)    // nordeste (extremo norte)
        );

        // Inicializa o mapa com restrições
        map = L.map('map', {
            center: muriaeCoords,
            zoom: 13,
            maxBounds: limitesBrasil,   // limita visualização
            maxBoundsViscosity: 1.0,    // impede sair da área
            worldCopyJump: false,       // evita “vários globos”
            minZoom: 4,                 // não deixa afastar demais
            maxZoom: 18                 // nem aproximar demais
        })
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);
            
        // Evento de clique no mapa
        map.on('click', function(e) {
            const lat = e.latlng.lat.toFixed(7);
            const lng = e.latlng.lng.toFixed(7);
                
            // Remove marcador anterior
            if (marker) {
                map.removeLayer(marker);
            }
                
            // Adiciona novo marcador
            marker = L.marker([lat, lng]).addTo(map);
            
            // Atualiza campos de coordenadas
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
                
            // Remove validação de erro
            document.getElementById('latitude').setCustomValidity('');
            document.getElementById('longitude').setCustomValidity('');
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        initMap();
    });
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const limite = 5;

    $('#categorias').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
        const selecionadas = $(this).val() || [];

        if (selecionadas.length > limite) {
            // Desmarca o item selecionado por último
            const option = $(this).find('option').eq(clickedIndex);
            option.prop('selected', false);
            $(this).selectpicker('refresh');

            // Alerta visual
            alert("Você pode selecionar no máximo " + limite + " categorias.");
        }
    });
});
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
    const camposGeo = ["latitude", "longitude"];

    camposGeo.forEach(id => {
        const campo = document.getElementById(id);
        if (!campo) return;

        // Impede digitação manual
        campo.addEventListener("keydown", function (e) {
            e.preventDefault();
        });

        // Impede colar valor manualmente
        campo.addEventListener("paste", function (e) {
            e.preventDefault();
        });

        // Impede arrastar texto para dentro
        campo.addEventListener("drop", function (e) {
            e.preventDefault();
        });
    });
});
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const cnpjInput = document.getElementById("cnpj");

    cnpjInput.addEventListener("input", function () {
        let value = cnpjInput.value.replace(/\D/g, ""); // remove tudo que não for número
        if (value.length > 14) value = value.slice(0, 14); // limita a 14 dígitos

        // aplica a máscara CNPJ: 00.000.000/0000-00
        value = value.replace(/^(\d{2})(\d)/, "$1.$2");
        value = value.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3");
        value = value.replace(/\.(\d{3})(\d)/, ".$1/$2");
        value = value.replace(/(\d{4})(\d)/, "$1-$2");

        cnpjInput.value = value;
    });
});
</script>