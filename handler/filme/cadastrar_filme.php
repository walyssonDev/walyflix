<?php
include("../utils/conexao.php");
include("../utils/valida.php");

$nome = $_POST['nome'];
$img = $_POST['img'];
$filme = $_POST['link'];
$genero = $_POST['genero'];

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (strpos($filme, 'dropbox.com') !== false) {
    $filme = str_replace('dl=0', 'raw=1', $filme);
} else if (strpos($filme, 'drive.google.com') !== false) {
    preg_match('/\/d\/([a-zA-Z0-9_-]+)/', $filme, $matches);

    if (!empty($matches[1])) {
        $file_id = $matches[1];
        $filme = "https://drive.google.com/file/d/$file_id/preview";
    }
} else {
    $filme = null;
}

if ($filme == null) {
    $_SESSION['resposta'] = "Erro ao cadastrar filme formato invalido";
    header("Location: ../../admin/cadastro_filme.php");
    die;
}

$sql = "INSERT INTO filmes (nome, img, filme, genero) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $nome, $img, $filme, $genero);

if ($stmt->execute()) {
    $_SESSION['resposta'] = "Filme cadastrado com sucesso";
} else {
    $_SESSION['resposta'] = "Erro ao cadastrar filme: " . $conn->error;
}

header("Location: ../../admin/cadastro_filme.php");
