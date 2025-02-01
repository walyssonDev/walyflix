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
    // Extrair o conteúdo do zip para um diretório temporário
    $tempDir = __DIR__ . '/../temp_vendor';
    if (!is_dir($tempDir)) {
        mkdir($tempDir, 0755, true);
    }
    $zip->extractTo($tempDir);
    $zip->close();

    // Criar a pasta vendor se não existir
    $vendorDir = $extractToPath . 'vendor';
    if (!is_dir($vendorDir)) {
        mkdir($vendorDir, 0755, true);
    }

    // Mover o conteúdo extraído para a pasta vendor, preservando a estrutura de diretórios
    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($tempDir, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    );

    foreach ($files as $fileinfo) {
        $targetPath = $extractToPath . DIRECTORY_SEPARATOR . $files->getSubPathName();
        if ($fileinfo->isDir()) {
            if (!is_dir($targetPath)) {
                mkdir($targetPath, 0755, true);
            }
        } else {
            rename($fileinfo->getRealPath(), $targetPath);
        }
    }

    // Remover o diretório temporário
    $files = array_diff(scandir($tempDir), array('.', '..'));
    foreach ($files as $file) {
        (is_dir("$tempDir/$file")) ? rmdir("$tempDir/$file") : unlink("$tempDir/$file");
    }
    rmdir($tempDir);

    echo 'Descompactação concluída com sucesso!';
} else {
    echo 'Falha ao descompactar o arquivo. Código de erro: ' . $res;
}
