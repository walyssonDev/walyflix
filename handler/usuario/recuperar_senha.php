<?php
include("../utils/conexao.php");
include("../utils/valida.php");

$cpf = $_POST['cpf'];
$email = $_POST['email'];

function gerarSenha($tamanho = 12)
{
    $letrasMaisculas = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $letrasMinusculas = "abcdefghijklmnopqrstuvwxyz";
    $numeros = "0123456789";
    $caractereEspecial = "@!.%#*?_";

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

    $mensagem = "Sua nova senha temporária" . ".\n\n";
    $mensagem .= "Senha temporária: " . $senha . ".\n\n";

    mail($email, "Recuperação de senha", $mensagem);

    header("Location: ../../index.php");
    exit;
} else {
    $resposta = "Erro ao recuperar senha!";
    header("Location: ../../index.php?resposta=$resposta");
    exit;
}
