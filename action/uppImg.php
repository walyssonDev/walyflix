<?php
include("../admin/conexao.php");
include("../action/valida.php");

$img = $_FILES['img']['tmp_name'];
$cpf = $_SESSION['cpf'];
$fileName = $_FILES['img']['name'];
$fileInfo = pathinfo($fileName);
$extension = strtolower($fileInfo['extension']);

if ($extension === "jpg" || $extension === "jpeg") {
    $imgData = file_get_contents($img);

    $sql = "UPDATE usuarios SET img = ? WHERE cpf = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("bs", $imgData, $cpf);
    $stmt->execute();
    $_SESSION['resposta'] = "Foto atualizada com sucesso.";
    header("Location: ../pages/principal.php");
} else {
    $_SESSION['resposta'] = "Erro ao atualizar a foto.";
    header("Location: ../pages/uparImg.php");
}
