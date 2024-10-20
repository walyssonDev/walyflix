<?php
include("../admin/conexao.php");
include("valida.php");

$nome = $_POST['nome'];
$path = $_POST['path'];
$filme = $_POST['link'];

if (strpos($filme, 'dropbox.com') !== false) {
    $filme = str_replace('dl=0', 'raw=1', $filme);
}

$sql = "INSERT INTO `filmes` (`nome`, `path`, `filme`) VALUES ('$nome', '$path', '$filme');";
$resultado = $conn->query($sql);

if ($resultado) {
    $_SESSION['resposta'] = "Filme cadastrado com sucesso";
} else {
    $_SESSION['resposta'] = "Erro ao cadastrar filme: " . $conn->error;
}

header("Location: ../admin/cadastro_filme.php");