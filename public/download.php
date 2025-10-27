<?php
// Recebe o tipo de pasta e o nome do arquivo pela URL
$type = $_GET['type'] ?? '';
$file = $_GET['file'] ?? '';

// Garante que o tipo é seguro (apenas pastas válidas)
$allowedDirs = ['curriculos', 'fotos_curriculos'];
if (!in_array($type, $allowedDirs)) {
    http_response_code(400);
    echo "Tipo de arquivo inválido.";
    exit;
}

// Remove qualquer tentativa de travessia de diretório
$file = basename($file);

// Caminho base dinâmico
$baseDir = __DIR__ .  DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $type . DIRECTORY_SEPARATOR;

// Caminho completo do arquivo
$filePath = $baseDir . $file;

// Verifica se existe
if (!file_exists($filePath)) {
    http_response_code(404);
    echo "<h3 style='font-family:sans-serif;color:#a00'>❌ Arquivo não encontrado:</h3>";
    echo "<p style='font-family:sans-serif'>Caminho verificado: <code>$filePath</code></p>";
    exit;
}

// Se for imagem, exibe no navegador
$extensao = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
$imagens = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp', 'svg'];
if (in_array($extensao, $imagens)) {
    header('Content-Type: image/' . $extensao);
    readfile($filePath);
    exit;
}

// Caso contrário, força download
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($filePath));
readfile($filePath);
exit;
