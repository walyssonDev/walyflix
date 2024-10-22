<?php
include("../admin/conexao.php");

$cpf = $_POST["cpf"];
$senha = $_POST["senha"];

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

        header("Location: ../pages/principal.php");
    } else {
        header("Location: ../index.php?resposta=CPF ou Senha incorretos.");
    }
}
