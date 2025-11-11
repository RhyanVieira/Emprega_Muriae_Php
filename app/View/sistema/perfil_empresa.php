<?php 

use Core\Library\Session;

$tipoUsuario = Session::get('userTipo');
$idEstab = Session::get('userEstabId');

?>
<div class="page-wraper">
    <div class="page-content bg-white m-b40">
        <div class="content-block">
            <div class="section-full content-inner-1">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="sticky-top">
                                <div class="row">
                                    <div class="col-lg-12 col-md-6">
                                        <div class="m-b30">
                                            <img src="<?= baseUrl() . 'imagem.php?file=estabelecimento/' . $dados['estabelecimento']['logo'] ?>" class="radius-sm w-100">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-6">
                                        <div class="widget bg-white p-lr20 p-t20 widget_getintuch radius-sm">
                                            <h4 class="text-black font-weight-700 p-t10 m-b15">Informações da Empresa</h4>
                                            <ul>
                                                <li class="m-t5">
                                                    <i class="ti-home" style="color:#0177c1;"></i>
                                                    <strong class="font-weight-700 text-black">Nome:</strong>
                                                    <span class="text-black-light"><?= $dados['estabelecimento']['nome'] ?></span>
                                                </li>
                                                <li class="m-t5">
                                                    <i class="ti-briefcase" style="color:#e67e22;"></i>
                                                    <strong class="font-weight-700 text-black">Razão Social:</strong>
                                                    <span class="text-black-light"><?= $dados['estabelecimento']['razao_social'] ?></span>
                                                </li>
                                                <li class="m-t5">
                                                    <i class="ti-id-badge" style="color:#6f42c1;"></i>
                                                    <strong class="font-weight-700 text-black">CNPJ:</strong>
                                                    <span class="text-black-light"><?= $dados['estabelecimento']['cnpj'] ?></span>
                                                </li>
                                                <li class="m-t5">
                                                    <i class="ti-location-pin" style="color:#28a745;"></i>
                                                    <strong class="font-weight-700 text-black">Endereço:</strong>
                                                    <span class="text-black-light"><?= $dados['estabelecimento']['endereco'] ?></span>
                                                </li>
                                                <li class="m-t5">
                                                    <i class="ti-location-arrow" style="color:#f39c12;"></i>
                                                    <strong class="font-weight-700 text-black">CEP:</strong>
                                                    <span class="text-black-light"><?= $dados['estabelecimento']['cep'] ?></span>
                                                </li>
                                                <li class="m-t5">
                                                    <i class="ti-world" style="color:#007bff;"></i>
                                                    <strong class="font-weight-700 text-black">Website:</strong>
                                                    <a href="<?= $dados['estabelecimento']['website'] ?>" target="_blank">
                                                        <span class="text-black-light"><?= $dados['estabelecimento']['website'] ?></span>
                                                    </a>
                                                </li>
                                                <li class="m-t5">
                                                    <i class="ti-email" style="color:#17a2b8;"></i>
                                                    <strong class="font-weight-700 text-black">E-mail:</strong>
                                                    <span class="text-black-light"><?= $dados['estabelecimento']['email'] ?></span>
                                                </li>
                                                <li class="m-t5">
                                                    <i class="ti-timer" style="color:#9b59b6;"></i>
                                                    <strong class="font-weight-700 text-black">Cadastrado em:</strong>
                                                    <span class="text-black-light">
                                                        <?= date('d/m/Y', strtotime($dados['estabelecimento']['data_criacao'])) ?>
                                                    </span>
                                                </li>
												<li class="m-t5">
													<?php if (empty($tipoUsuario) && $tipoUsuario === 'E' && $dados['estabelecimento']['estabelecimento_id']): ?>
														<a href="#" class="site-button m-t10">Editar Perfil</a>
													<?php endif; ?>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="job-info-box">
								<h3 class="m-t0 m-b10 font-weight-700 title-head">
									<?= exibeAlerta() ?>
									<?= $dados['estabelecimento']['nome'] ?>
								</h3>
								<h5 class="font-weight-600">Descrição da Empresa</h5>
								<div class="dez-divider divider-2px bg-gray-dark mb-4 mt-0"></div>
								<p class="text-black-light">
									<?= $dados['estabelecimento']['descricao'] ?>
								</p>
								<h5 class="font-weight-600">Localização no Mapa</h5>
								<div class="dez-divider divider-2px bg-gray-dark mb-4 mt-0"></div>
								<div id="map" class="radius-sm" style="height: 300px; border-radius: 8px; border: 1px solid #dee2e6;"></div>
								<p id="map-msg" class="text-center text-black-light m-t10"></p>
								<div class="dez-divider divider-2px bg-gray-dark mb-4 mt-0"></div>
								<h5 class="font-weight-600">Total de Vagas em Aberto: <?= $dados['totalAberta'] ?></h5>
								<a href="<?= baseUrl()?>vaga/vagas_empresa/1/<?= $dados['estabelecimento']['estabelecimento_id'] ?>" class="site-button m-t10">Ver vagas</a>
								<div class="dez-divider divider-2px bg-gray-dark mb-4 mt-10"></div>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Leaflet CSS e JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const latStr = "<?= $dados['estabelecimento']['latitude'] ?? '' ?>";
    const lngStr = "<?= $dados['estabelecimento']['longitude'] ?? '' ?>";
    const nome = "<?= addslashes($dados['estabelecimento']['nome']) ?>";
    const endereco = "<?= addslashes($dados['estabelecimento']['endereco'] ?? '') ?>";

    // Converte para float
    const lat = parseFloat(latStr);
    const lng = parseFloat(lngStr);

    // Define coordenadas padrão se inválidas
    let coordenadas = [-21.1305, -42.3664]; // Muriaé-MG
    let temCoordenadas = false;

    if (!isNaN(lat) && !isNaN(lng) && lat !== 0 && lng !== 0) {
        coordenadas = [lat, lng];
        temCoordenadas = true;
    }

    // Inicializa mapa
    const map = L.map('map').setView(coordenadas, temCoordenadas ? 15 : 12);

    // Camada base
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Adiciona marcador se coordenadas válidas
    if (temCoordenadas) {
        L.marker(coordenadas)
            .addTo(map)
            .bindPopup(`<strong>${nome}</strong><br>${endereco}`)
            .openPopup();
    } else {
        document.getElementById('map-msg').textContent = '📍 Localização não informada pela empresa.';
    }

    // Corrige renderização caso o container tenha sido carregado escondido
    setTimeout(() => { map.invalidateSize(); }, 300);
});
</script>