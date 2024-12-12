<?php
include("../utils/conexao.php");
require_once("../../libs/PHPMailer/PHPMailer.php");
require_once("../../libs/PHPMailer/Exception.php");
require_once("../../libs/PHPMailer/SMTP.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$cpf = $_POST['cpf'];
$email = $_POST['email'];

function gerarSenha($tamanho = 12)
{
    $letrasMaisculas = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $letrasMinusculas = "abcdefghijklmnopqrstuvwxyz";
    $numeros = "0123456789";
    $caractereEspecial = "@!%#*?_$";

    $senha = $letrasMaisculas[random_int(0, strlen($letrasMaisculas) - 1)];
    $senha .= $letrasMinusculas[random_int(0, strlen($letrasMinusculas) - 1)];
    $senha .= $numeros[random_int(0, strlen($numeros) - 1)];
    $senha .= $caractereEspecial[random_int(0, strlen($caractereEspecial) - 1)];

    $todosCaracteres = $letrasMaisculas . $letrasMinusculas . $numeros . $caractereEspecial;
    for ($i = 4; $i < $tamanho; $i++) {
        $senha .= $todosCaracteres[random_int(0, strlen($todosCaracteres) - 1)];
    }

    return str_shuffle($senha);
}

$sqlVerificar = "SELECT * FROM usuarios WHERE cpf = ?";
$stmt = $conn->prepare($sqlVerificar);
$stmt->bind_param("s", $cpf);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado = $resultado->fetch_assoc()) {

    $senha = gerarSenha();

    $sql = "UPDATE usuarios SET senha = ? WHERE cpf = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $senha, $cpf);
    $stmt->execute();

    $mail = new PHPMailer(true);
    $mail->CharSet = PHPMailer::CHARSET_UTF8;

    try {

        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Port = 587;
        $mail->Username = "walyssonribeiro3@gmail.com";
        $mail->Password = "ajrs rmaw yeoa iyje";

        $mail->setFrom('walyflix@gmail.com', "WalyFlix");
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = "Recuperação de senha!";
        $mail->Body = "Essa é a sua senha de recuperação, altere ela o mais rápido possivel: <strong>$senha</strong>";
        $mail->AltBody = "Essa é a sua senha de recuperação, altere ela o mais rápido possivel: $senha";

        if ($mail->send()) {
            $resposta = "Email enviado com sucesso!";
            header("Location: ../../index.php?resposta=$resposta");
            exit;
        } else {
            $resposta = "Falha ao enviar o email!";
            header("Location: ../../index.php?resposta=$resposta");
            exit;
        }
    } catch (Exception $e) {
        $resposta = "Erro ao recuperar senha! {$mail->ErrorInfo}";
        header("Location: ../../index.php?resposta=$resposta");
        exit;
    }
} else {
    $resposta = "Erro ao recuperar senha!";
    header("Location: ../../index.php?resposta=$resposta");
    exit;
}
