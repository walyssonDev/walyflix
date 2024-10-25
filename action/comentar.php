<?php
include("../admin/conexao.php");
include("valida.php");

$cpf = $_SESSION['cpf'];
$comentario = $_POST['comentario'];
$id = $_GET['id'];

$sql = "INSERT INTO comentarios (cpf, comentario, filme_id) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $cpf, $comentario, $id);
$stmt->execute();

header("Location: ../pages/assistir_filme.php?id=$id");
