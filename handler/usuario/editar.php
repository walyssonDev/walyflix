<?php
include("../utils/conexao.php");
include("../utils/valida.php");
include("../../assets/php/validaForm.php");

$cpf = $_POST['cpf'];
$email = $_POST['email'];
$nome = $_POST["nome"];
$nome = ucwords(strtolower($nome));
$senha = $_POST["senha"];
$cpfAnterior = $_POST["cpfAnterior"];
$cpf = mascararCPF($cpf);

$img = null;

if (isset($_FILES) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
    $img = $_FILES['img']['tmp_name'];
}

if ($img) {

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

            $_SESSION['resposta'] = "Editado com sucesso.";
            header("Location: ../../pages/user_config.php");
            $stmt->close();
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
}

$resultado = validarForm($nome, $cpf, $senha);

if ($resultado === true) {
    $sql = "UPDATE usuarios SET cpf = ?, email = ?, nome = ?, senha = ? WHERE cpf = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        $_SESSION['mensagem'] = "Erro ao editar";
        header("Location: ../../admin/usuarios.php");
        exit;
    } else {
        $stmt->bind_param("sssss", $cpf, $email, $nome, $senha, $cpfAnterior);

        if (!$stmt->execute()) {
            $_SESSION['mensagem'] = "Erro ao editar";
            header("Location: ../../admin/usuarios.php");
            exit;
        } else {
            $_SESSION["cpf"] = $cpf;
            $_SESSION['email'] = $email;
            $_SESSION["senha"] = $senha;
            $_SESSION["nome"] = $nome;

            $stmt->close();

            $_SESSION['mensagem'] = "Editado com sucesso";
            header("Location: ../../admin/usuarios.php");
            exit;
        }
    }
} else {
    $_SESSION['mensagem'] = $resultado;
    header("Location: ../../admin/usuarios.php");
    exit;
}
