<?php
include("conexao.php");
include("valida.php");

$nome = $_POST['nome'];
$path = $_POST['path'];

$sql = "INSERT INTO `filmes` (`id`, `nome`, `path`, `data`) VALUES (NULL, '$nome', '$path', current_timestamp());";
$resultado = $conn->query($sql);

if ($resultado) {
    $_SESSION['resposta'] = "Filme cadastrado com sucesso";
} else {
    $_SESSION['resposta'] = "Erro ao cadastrar filme";
}

header("Location: cadastro_filme.php");
