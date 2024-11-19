<?php
include("../admin/conexao.php");
include("valida.php");

$nome = $_POST['nome'];
$path = $_POST['path'];
$filme = $_POST['link'];
$genero = $_POST['genero'];

error_reporting(E_ALL);

if (strpos($filme, 'dropbox.com') !== false) {
    $filme = str_replace('dl=0', 'raw=1', $filme);
}

$sql = "INSERT INTO filmes (nome, path, filme, genero) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $nome, $path, $filme, $genero);

if ($stmt->execute()) {
    $_SESSION['resposta'] = "Filme cadastrado com sucesso";
} else {
    $_SESSION['resposta'] = "Erro ao cadastrar filme: " . $conn->error;
}

header("Location: ../admin/cadastro_filme.php");
