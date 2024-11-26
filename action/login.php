<?php
include("../admin/conexao.php");
include("../assets/validaForm.php");

$cpf = $_POST["cpf"];
$senha = $_POST["senha"];

$cpf = mascararCPF($cpf);

$resultadoSenha = validarSenha($senha);
$resultadoCpf = validarCPF($cpf);

if ($resultadoCpf === true && $resultadoSenha === true) {
    $sql = "select nome, tipo from usuarios where cpf = ? and senha = ? ";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ss", $cpf, $senha);
        $stmt->execute();
        $stmt->bind_result($nome, $tipo);
        $stmt->fetch();

        if ($nome != '') {
            session_start();
            $_SESSION["cpf"] = $cpf;
            $_SESSION["senha"] = $senha;
            $_SESSION["nome"] = $nome;
            $_SESSION["tipo"] = $tipo;

            header("Location: ../pages/inicio.php");
        } else {
            header("Location: ../index.php?resposta=CPF ou Senha incorretos.");
        }
    }
} else {
    $resultado = "CPF ou Senha incorretos";
    header("Location: ../index.php?resposta=$resultado");
}
