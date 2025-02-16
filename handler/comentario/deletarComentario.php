<?php
include("../utils/conexao.php");
include("../utils/valida.php");

$id = $_GET['id'];
$comentario = $_POST['comentario'];
$cpfUser = $_POST['cpfUser'];

$sql = "DELETE FROM comentarios WHERE filme_id = ? AND comentario = ? AND cpf = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $id, $comentario, $cpfUser);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo json_encode([
        'success' => true
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Erro ao deletar comentário.'
    ]);
}
