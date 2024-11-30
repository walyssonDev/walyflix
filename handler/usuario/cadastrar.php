<?php
include("../../assets/php/validaForm.php");
include("../utils/conexao.php");
include("../utils/valida.php");

$cpf = $_POST["cpf"];
$nome = $_POST["nome"];
$senha = $_POST["senha"];

if ($nome == "ADM" || $nome == "Administrador") {
    $nome = "123";
}

$cpf = mascararCPF($cpf);
$resultado = validarForm($nome, $cpf, $senha);

if ($resultado === true) {
    $nome = ucwords(strtolower($nome));

    $sqlVerificar = "SELECT * FROM usuarios WHERE cpf = '$cpf'";
    $resultadoVerificar = $conn->query($sqlVerificar);

    if ($resultadoVerificar->num_rows > 0) {
        header("Location: ../../index.php?resposta=CPF%20já%20cadastrado.");
    } else {
        $sql = ("INSERT INTO `usuarios` (`cpf`, `nome`, `senha`) VALUES ('$cpf', '$nome', '$senha')");
        $resultado = $conn->query($sql);

        $_SESSION['resposta'] = "Usuario cadastrado com sucesso";

        if ($_POST['cadastro'] == 'cadastro') {
            header("Location: ../../index.php");
        } else {
            header("Location: ../../admin/cadastro.php");
        }
    }
} else {
    if ($_POST['cadastro'] == 'cadastro') {
        header("Location: ../../index.php?resposta=$resultado");
    } else {
        $_SESSION['resposta'] = $resultado;
        header("Location: ../../admin/cadastro.php");
    }
}
