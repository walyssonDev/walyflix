<?php
include("../utils/conexao.php");
include("../utils/valida.php");

$id = $_POST['id'];

$sql = "UPDATE filmes SET destaque = 1 WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

$sql2 = "UPDATE filmes SET destaque = 0 WHERE id != ?";
$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param("i", $id);

if ($stmt->execute() && $stmt2->execute()) {
    $_SESSION['resposta'] = "Filme destacado com sucesso";
    $stmt->close();
} else {
    $_SESSION['resposta'] = "Erro ao destacar filme: " . $conn->error;
    $stmt->close();
}

header("Location: ../../admin/destaque.php");
