<?php
include("../utils/conexao.php");

$id = $_POST['id'];

$sql = "DELETE FROM filmes WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $id);
$stmt->execute();

header("Location: ../../admin/filmes_adm.php");
