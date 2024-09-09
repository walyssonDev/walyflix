<?php
include("conexao.php");
include("valida.php");

$cpf = $_POST["cpf"];
$nome = $_POST["nome"];
$senha = $_POST["senha"];

$sql = "INSERT INTO  'usuarios' ('cpf', 'nome', 'senha') VALUES ('$cpf', '$nome', '$senha')";
$resultado = $conn->query($sql);

header("Location: cadastro.php");
?>