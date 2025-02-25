<?php
include("../handler/utils/conexao.php");

$sqlStatus = "UPDATE usuarios SET status = 0 WHERE TIMESTAMPDIFF(MINUTE, ultima_atualizacao, NOW()) >= 1";
$conn->query($sqlStatus);

$sql = "SELECT cpf, status FROM usuarios";
$result = $conn->query($sql);
$usuarios = array();

while ($row = $result->fetch_assoc()) {
    $usuarios[] = $row;
}

header('Content-Type: application/json');
echo json_encode($usuarios);
