<?php
include("../utils/conexao.php");

$id = $_POST['id'];

$sql = "DELETE FROM filmes WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $id);
$stmt->execute();
$stmt->close();

$sql = "DELETE FROM lista WHERE filme_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $id);
$stmt->execute();
$stmt->close();

header("Location: ../../pages/filmes.php");
