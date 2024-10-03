<?php
include("conexao.php");

$id = $_GET['id'];

$sql = "SELECT filme FROM filmes WHERE id = '$id'";
$resultado = $conn->query($sql);
$row = $resultado->fetch_assoc();

$filme = $row['filme'];

header('Content-Type: video/mp4');

echo $filme;
