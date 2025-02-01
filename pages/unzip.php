<?php
$zipFilePath = __DIR__ . '/../vendor.zip'; // Caminho absoluto para o arquivo vendor.zip
$extractToPath = __DIR__ . '/../vendor'; // Diretório onde os arquivos serão extraídos

// Verificar se o arquivo zip existe
if (!file_exists($zipFilePath)) {
    die('Erro: O arquivo vendor.zip não foi encontrado.');
}

// Criar o diretório de extração se não existir
if (!is_dir($extractToPath)) {
    mkdir($extractToPath, 0755, true);
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
