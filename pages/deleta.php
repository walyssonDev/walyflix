<?php

function deleteFilesWithVendorInName($dirPath)
{
    if (!is_dir($dirPath)) {
        throw new InvalidArgumentException("$dirPath must be a directory");
    }

    $files = glob($dirPath . '/*vendor*');
    foreach ($files as $file) {
        if (is_file($file)) {
            unlink($file);
            echo "Arquivo removido: $file<br>";
        } elseif (is_dir($file)) {
            deleteDir($file);
            echo "Diretório removido: $file<br>";
        }
    }
}

function deleteDir($dirPath)
{
    if (!is_dir($dirPath)) {
        throw new InvalidArgumentException("$dirPath must be a directory");
    }
    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
        $dirPath .= '/';
    }
    $files = glob($dirPath . '*', GLOB_MARK);
    foreach ($files as $file) {
        if (is_dir($file)) {
            deleteDir($file);
        } else {
            unlink($file);
        }
    }
    rmdir($dirPath);
}

$rootDir = __DIR__ . '/../';
echo "Verificando o diretório: $rootDir<br>";

deleteFilesWithVendorInName($rootDir);

echo 'Remoção concluída!';
