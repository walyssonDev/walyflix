<?php
include("../utils/valida.php");
include("../utils/conexao.php");

$cpf = $_SESSION['cpf'];
$status = $_POST['status'];

if (isset($_SESSION['cpf']) && $status == 1) {
    $sql = "UPDATE usuarios SET status = 1 WHERE cpf = ?";
} else {
    $sql = "UPDATE usuarios SET status = 0 WHERE cpf = ?";
}

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $cpf);
$stmt->execute();
?>