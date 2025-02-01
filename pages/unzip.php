<?php
$zipFilePath = __DIR__ . '/../vendor.zip'; // Caminho do arquivo ZIP
$extractToPath = __DIR__ . '/../vendor'; // Diretório onde será extraído

// Função para apagar a pasta e todo o conteúdo antes da extração
function deleteFolder($folder)
{
    if (!is_dir($folder)) return;
    $files = array_diff(scandir($folder), ['.', '..']);
    foreach ($files as $file) {
        $filePath = "$folder/$file";
        is_dir($filePath) ? deleteFolder($filePath) : unlink($filePath);
    }
    rmdir($folder);
}

// Apagar a pasta se já existir para evitar arquivos antigos
if (is_dir($extractToPath)) {
    deleteFolder($extractToPath);
}

// Criar a pasta vazia novamente
mkdir($extractToPath, 0755, true);

$zip = new ZipArchive;
$res = $zip->open($zipFilePath);
if ($res === TRUE) {
    for ($i = 0; $i < $zip->numFiles; $i++) {
        $filePath = $zip->getNameIndex($i);

        // Converter barras invertidas para barras normais (caso o ZIP tenha sido gerado no Windows)
        $filePath = str_replace('\\', '/', $filePath);

        // Caminho completo do arquivo a ser extraído
        $fullPath = $extractToPath . '/' . $filePath;

        // Se for um diretório, cria ele antes de extrair os arquivos
        if (substr($filePath, -1) === '/') {
            if (!is_dir($fullPath)) {
                mkdir($fullPath, 0755, true);
            }
        } else {
            // Criar diretório pai do arquivo se não existir
            $dir = dirname($fullPath);
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }

            // Extrair arquivo individualmente para garantir a estrutura correta
            copy("zip://$zipFilePath#$filePath", $fullPath);
        }
    }

    $zip->close();
    echo 'Descompactação concluída corretamente!';
} else {
    echo 'Falha ao descompactar o arquivo. Código de erro: ' . $res;
}
