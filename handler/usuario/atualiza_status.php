<?php
include("../utils/valida.php");
include("../utils/conexao.php");

$cpf = $_SESSION['cpf'];

if (isset($_SESSION['cpf'])) {
    $sql = "UPDATE usuarios SET ultima_atualizacao = NOW(), status = 1 WHERE cpf = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $cpf);
    $stmt->execute();
}
