<?php
include("../admin/conexao.php");
include("valida.php");

$genero = $_POST['novoGenero'];
$cpf = $_SESSION['cpf'];

$sqlVerifica = $conn->prepare("SELECT * FROM generos WHERE genero = ?");
$sqlVerifica->bind_param("s", $genero);
$sqlVerifica->execute();
$resultado = $sqlVerifica->get_result();

if ($resultado->num_rows > 0) {
    $resposta = "Genero ja existe!";
} else {
    $sql = "INSERT INTO generos (genero) VALUES (NULL, ?, '')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $genero);
    $stmt->execute();
    $resposta = "Genero cadastrado com sucesso!";
}

$_SESSION['resposta'] = $resposta;
header("Location: ../admin/generos.php");
