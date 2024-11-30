<?php
include("../utils/conexao.php");
include("../utils/valida.php");
include("../../assets/php/validaForm.php");

$cpf = $_POST["cpf"];
$nome = $_POST["nome"];
$senha = $_POST["senha"];
$cpfAnterior = $_POST["cpfAnterior"];

$cpf = mascararCPF($cpf);
$resultado = validarForm($nome, $cpf, $senha);

if ($resultado === true) {
    $sql = "UPDATE usuarios SET cpf = ?, nome = ?, senha = ? WHERE cpf = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $cpf, $nome, $senha, $cpfAnterior);
    $stmt->execute();

    $_SESSION['mensagem'] = "Editado com sucesso";
    header("Location: ../../admin/usuarios.php");
} else {
    $_SESSION['mensagem'] = $resultado;
    header("Location: ../../admin/usuarios.php");
}
