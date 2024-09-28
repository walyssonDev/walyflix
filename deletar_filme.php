<?php
include("conexao.php");

$id = $_POST['id'];

$sql = "DELETE FROM filmes WHERE id = '$id'";
$resultado = $conn->query($sql);

header("Location: filmes_adm.php");
