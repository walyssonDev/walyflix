<?php
include("../admin/conexao.php");
include("valida.php");

$cpf = $_SESSION['cpf'];
$comentario = $_POST['comentario'];
$id = $_GET['id'];

$sql = "DELETE FROM comentarios WHERE cpf = ? AND comentario = ? AND filme_id = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("ERRO: " . $conn->error);
}
$stmt->bind_param("ssi", $cpf, $comentario, $id);
$stmt->execute();

header("Location: ../pages/assistir_filme.php?id=$id");
