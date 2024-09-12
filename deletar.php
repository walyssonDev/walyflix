<?php
include("conexao.php");

$cpf = $_POST["cpf"];

$sql = ("DELETE FROM usuarios WHERE cpf = '$cpf'");
$resultado = $conn->query($sql);

header("Location: deleta.php");

?>