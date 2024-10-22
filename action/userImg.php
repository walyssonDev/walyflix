<?php
include("../admin/conexao.php");
include("../action/valida.php");

$cpf = $_SESSION['cpf'];

$sql = "SELECT img FROM usuarios WHERE cpf = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $cpf);
$stmt->execute();
$stmt->bind_result($imgData);

header("Content-Type: image/jpeg");

if ($stmt->fetch()) {
    echo $imgData;
} else {
    echo file_get_contents('../uploads/user-icon-vector.jpg');
}
