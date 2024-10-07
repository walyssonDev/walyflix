<?php
include("conexao.php");
include("valida.php");

$id = $_POST['id'];
$cpf = $_SESSION['cpf'];

$sql = "UPDATE `usuarios` SET `favoritos` = '$id' WHERE `usuarios`.`cpf` = '$cpf'";
$resultado = $conn->query($sql);

header("Location: filmes.php");
