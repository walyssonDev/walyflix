<?php
include("../admin/conexao.php");
include("../action/valida.php");

$cpf = $_SESSION['cpf'];

$sql = "SELECT img FROM usuarios WHERE cpf = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $cpf);
$stmt->execute();
$stmt->bind_result($imgData);

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($stmt->fetch()) {
    header("Content-Type: image/jpeg");
    echo $imgData;
} else {
    $imgPath = '../uploads/icon.jpg';
    $imgDefault = file_get_contents($imgPath);
    header("Content-Type: image/jpeg");
    echo $imgDefault;
}
