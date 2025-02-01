<?php
$zipFilePath = __DIR__ . '/../vendor.zip'; // Caminho absoluto para o arquivo vendor.zip
$extractToPath = __DIR__ . '/../'; // Diretório onde os arquivos serão extraídos

// Verificar se o arquivo zip existe
if (!file_exists($zipFilePath)) {
    die('Erro: O arquivo vendor.zip não foi encontrado.');
}

$zip = new ZipArchive;
$res = $zip->open($zipFilePath);
if ($res === TRUE) {
    $zip->extractTo($extractToPath);
    $zip->close();
    echo 'Descompactação concluída com sucesso!';
} else {
    echo 'Falha ao descompactar o arquivo. Código de erro: ' . $res;
}
