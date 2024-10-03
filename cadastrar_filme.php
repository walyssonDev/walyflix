<?php
include("conexao.php");
include("valida.php");

$nome = $_POST['nome'];
$path = $_POST['path'];
$filme = $_FILES['filme'];

$filmeData = file_get_contents($filme['tmp_name']);
$filmeData = mysqli_real_escape_string($conn, $filmeData);

$sql = "INSERT INTO `filmes` (`nome`, `path`, `filme`) VALUES ('$nome', '$path', '$filmeData');";
$resultado = $conn->query($sql);

if ($resultado) {
    $_SESSION['resposta'] = "Filme cadastrado com sucesso";
} else {
    $_SESSION['resposta'] = "Erro ao cadastrar filme: " . $conn->error;
}

header("Location: cadastro_filme.php");
