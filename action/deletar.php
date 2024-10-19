<?php
include("../admin/conexao.php");

$cpf = $_POST["cpf"];

$sql = ("DELETE FROM usuarios WHERE cpf = '$cpf'");


$resultado = $conn->query($sql);

header("Location: ../admin/deleta.php");