<?php
$zipFilePath = __DIR__ . '/../vendor.zip'; // Caminho do arquivo ZIP
$extractToPath = __DIR__ . '/../vendor'; // Pasta onde os arquivos serão extraídos

// Verificar se o arquivo ZIP existe
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
    for ($i = 0; $i < $zip->numFiles; $i++) {
        $filePath = $zip->getNameIndex($i);

        // Corrige barras invertidas para garantir a estrutura correta
        $filePath = str_replace('\\', '/', $filePath);

        $fullPath = $extractToPath . '/' . $filePath;

        // Se for um diretório, cria ele antes de extrair os arquivos
        if (substr($filePath, -1) === '/') {
            if (!is_dir($fullPath)) {
                mkdir($fullPath, 0755, true);
            }
        } else {
            // Criar diretório pai, se não existir
            $dir = dirname($fullPath);
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }

            // Extrair arquivo corretamente
            copy("zip://$zipFilePath#$filePath", $fullPath);
        }
    }

    $zip->close();
    echo 'Descompactação concluída com sucesso!';
} else {
    echo 'Falha ao descompactar o arquivo. Código de erro: ' . $res;
}
