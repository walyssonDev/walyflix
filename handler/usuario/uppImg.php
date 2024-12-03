<?php
include("../utils/conexao.php");
include("../utils/valida.php");

$img = $_FILES['img']['tmp_name'];
$cpf = $_SESSION['cpf'];
$fileName = $_FILES['img']['name'];
$fileInfo = pathinfo($fileName);
$extension = strtolower($fileInfo['extension']);
$fileType = $_FILES['img']['type'];
$imgInfo = getimagesize($img);
$imgType = $imgInfo[2];

if (($imgType === IMAGETYPE_JPEG)) {
    if (($extension === "jpg" || $extension === "jpeg") &&  $fileType === 'image/jpeg') {
        $imagemOriginal = imagecreatefromjpeg($img);

        ob_start();
        imagejpeg($imagemOriginal, null, 20);
        $imgData = ob_get_clean();

        imagedestroy($imagemOriginal);

        $sql = "UPDATE usuarios SET img = ? WHERE cpf = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("bs", $imgData, $cpf);
        $stmt->send_long_data(0, $imgData);
        $stmt->execute();
        $_SESSION['resposta'] = "Foto atualizada com sucesso.";
        header("Location: ../../pages/user_config.php");
        exit;
    } else {
        $_SESSION['resposta'] = "Erro ao atualizar a foto.";
        header("Location: ../../pages/user_config.php");
        exit;
    }
} else {
    $_SESSION['resposta'] = "Erro ao atualizar a foto.";
    header("Location: ../../pages/user_config.php");
    exit;
}
