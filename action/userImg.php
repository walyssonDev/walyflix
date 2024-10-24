<?php
include("../admin/conexao.php");
include("../action/valida.php");

$cpf = $_SESSION['cpf'];

$sql = "SELECT img FROM usuarios WHERE cpf = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $cpf);
$stmt->execute();
$stmt->bind_result($imgData);
$stmt->fetch();

if (empty($imgData)) {
    $imgPath = '../uploads/icon.jpg';
    $imgDefault = file_get_contents($imgPath);
    header("Content-Type: image/jpeg");
    echo $imgDefault;
} else {
    header("Content-Type: image/jpeg");
    echo $imgData;
}
