<?php
include("../utils/conexao.php");
include("../utils/valida.php");

ini_set("display_errors", true);

$id = $_POST['id'];
$cpf = $_SESSION['cpf'];

$sql = "DELETE FROM generos WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $id);
$stmt->execute();
$resposta = "Genero deletado com sucesso!";

$_SESSION['resposta'] = $resposta;
header("Location: ../../admin/generos.php");
