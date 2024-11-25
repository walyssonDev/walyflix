<?php
include("../admin/conexao.php");
include("valida.php");

ini_set("display_errors", true);

$genero = $_POST['genero'];
$id = $_POST['id'];
$cpf = $_SESSION['cpf'];

$sql = "UPDATE generos SET genero = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $genero, $id);
$stmt->execute();
$resposta = "Genero editado com sucesso!";

$_SESSION['resposta'] = $resposta;
header("Location: ../admin/generos.php");
