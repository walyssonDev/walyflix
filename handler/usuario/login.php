<?php
include("../utils/conexao.php");
include("../../assets/php/validaForm.php");

$cpf = $_POST["cpf"];
$senha = $_POST["senha"];

$cpf = mascararCPF($cpf);

$resultadoSenha = validarSenha($senha);
$resultadoCpf = validarCPF($cpf);

if ($resultadoCpf === true && $resultadoSenha === true) {
    $sql = "SELECT nome, email, tipo FROM usuarios WHERE cpf = ? AND senha = ? ";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ss", $cpf, $senha);
        $stmt->execute();
        $stmt->bind_result($nome, $email, $tipo);
        $stmt->fetch();

        if (!empty($nome)) {
            session_start();
            $_SESSION["cpf"] = $cpf;
            $_SESSION['email'] = $email;
            $_SESSION["senha"] = $senha;
            $_SESSION["nome"] = $nome;
            $_SESSION["tipo"] = $tipo;

            header("Location: ../../pages/inicio.php");
            exit;
        } else {
            $resultado = "CPF ou Senha incorretos";
            header("Location: ../../index.php?resposta=$resultado");
            exit;
        }
    } else {
        $resultado = "Erro ao realizar a consulta no banco de dados.";
        header("Location: ../../index.php?resposta=$resultado");
        exit;
    }
} else {
    $resultado = "CPF ou Senha incorretos";
    header("Location: ../../index.php?resposta=$resultado");
    exit;
}
