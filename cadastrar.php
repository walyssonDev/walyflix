<?php
include("conexao.php");

$cpf = $_POST["cpf"];
$nome = $_POST["nome"];
$senha = $_POST["senha"];

$sql = ("INSERT INTO `usuarios` (`cpf`, `nome`, `senha`) VALUES ('$cpf', '$nome', '$senha')");
$resultado = $conn->query($sql);

if($_POST['cadastro'] == 'cadastro') {
    header("Location: index.php");
} else {
    header("Location: cadastro.php");
}

?>