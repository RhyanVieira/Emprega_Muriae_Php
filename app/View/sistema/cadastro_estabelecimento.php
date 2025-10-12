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
								<form id="cadastroParaUsuario" class="tab-pane active" method="POST" action="<?= baseUrl() ?>estabelecimento/cadastroParaUsuario" enctype="multipart/form-data">
									<p class="font-weight-600">Preencha as informações abaixo para divulgar vagas e gerenciar seus processos seletivos.</p>
                                    
                                    <div class="form-group">
                                        <label class="font-weight-700">Nome da Empresa *</label>
                                        <input name="nome" id="nome" required class="form-control" placeholder="Digite o nome da empresa" type="text" minlength="3" maxlength="60" value="<?= setValor('nome')?>">
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label class="font-weight-700">CNPJ *</label>
                                            <input name="cnpj" id="cnpj" required class="form-control" placeholder="Apenas números" type="text" minlength="18" maxlength="18" value="<?= setValor('cnpj')?>">
                                        </div>
                                        <div class="form-group col-md-8">
                                            <label class="font-weight-700">Razão social *</label>
                                            <input name="razao_social" id="razao_social" required class="form-control" placeholder="Digite a razão social" type="text" minlength="3" maxlength="255" value="<?= setValor('razao_social')?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="font-weight-700">E-mail corporativo (opcional)</label>
                                            <input name="email" id="email" class="form-control" placeholder="contato@empresa.com.br" type="email" maxlength="150" value="<?= setValor('email')?>">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="font-weight-700">Website (opcional)</label>
                                            <input name="website" id="website" class="form-control" placeholder="https://www.empresa.com.br" type="text" maxlength="255" value="<?= setValor('website')?>"> 
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Endereço completo (opcional)</label>
                                        <input class="form-control" name="endereco" id="endereco" placeholder="Rua, número, bairro, cidade, CEP" type="text" maxlength="200" value="<?= setValor('endereco')?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Descrição da Empresa (opcional)</label>
                                        <textarea class="form-control" name="descricao" id="descricao" placeholder="Descreva sua empresa, área de atuação, missão, valores e diferencias..." rows="4" maxlength="1000" value="<?= setValor('descricao')?>"></textarea>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="font-weight-700" for="latitude">Latitude *</label>
                                            <input name="latitude" id="latitude" required class="form-control" type="text" minlength="11" maxlength="12" value="<?= setValor('latitude')?>">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="font-weight-700" for="longitude" >Longitude *</label>
                                            <input name="longitude" id="longitude" required class="form-control" type="text" minlength="11" maxlength="12" value="<?= setValor('longitude')?>">
                                        </div>
                                    </div>
                                    <p class="font-weight-600">Clique no mapa abaixo para definir a localização da empresa.</p>
                                    <div class="form-group mb-4">
                                            <div id="map" style="height: 300px; border-radius: 8px; border: 1px solid #dee2e6;"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="logo" class="font-weight-700">Logo da Empresa (opcional)</label>
                                        <input type="file" class="form-control" name="logo" id="logo" value="<?= setValor('logo')?>">
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
            <!-- Product END -->
		</div>
		<!-- contact area  END -->
    </div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    
<script>
        // Inicialização do mapa
    let map;
    let marker;
    
    function initMap() {
        // Coordenadas de Muriaé, MG
        const muriaeCoords = [-21.1305, -42.3664];
        
        map = L.map('map').setView(muriaeCoords, 13);
        
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

        // Animações de entrada
        const formCard = document.querySelector('.form-card');
        formCard.style.opacity = '0';
        formCard.style.transform = 'translateY(20px)';

        setTimeout(() => {
            formCard.style.transition = 'all 0.6s ease';
            formCard.style.opacity = '1';
            formCard.style.transform = 'translateY(0)';
        }, 100);
    });
</script>