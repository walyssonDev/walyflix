<?php
include("../admin/conexao.php");

$id = $_POST['id'];

$sql = "DELETE FROM filmes WHERE id = '$id'";
$resultado = $conn->query($sql);

header("Location: ../admin/filmes_adm.php");