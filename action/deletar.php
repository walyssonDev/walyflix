<?php
include("../admin/conexao.php");

$cpf = $_POST["cpf"];

$sql = ("DELETE FROM usuarios WHERE cpf = ?");
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $cpf);
$stmt->execute();
$stmt->close();

header("Location: ../admin/deleta.php");
