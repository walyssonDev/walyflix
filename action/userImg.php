<?php
include("../admin/conexao.php");
include("../action/valida.php");

$cpf = $_SESSION['cpf'];

$sql = "SELECT img FROM usuarios WHERE cpf = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $cpf);
$stmt->execute();
$stmt->bind_result($imgData);



if ($stmt->fetch()) {
    header("Content-Type: image/jpeg");
    echo $imgData;
} else {
    header("Content-Type: image/jpeg");
    echo file_get_contents('../uploads/user-icon-vector.jpg');
}
