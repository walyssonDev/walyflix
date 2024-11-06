<?php
include("../admin/conexao.php");
include("valida.php");

$genero = $_POST['novoGenero'];
$cpf = $_SESSION['cpf'];

$sqlVerifica = "SELECT * FROM generos WHERE nome = $genero";
$resultado = $conn->query($sqlVerifica);

if ($resultado->num_rows > 0) {
    $resposta = "Genero ja existe!";
} else {
    $sql = "INSERT INTO generos (id, genero, status) VALUES (NULL, ?, '')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $genero);
    $stmt->execute();
    $resposta = "Genero cadastrado com sucesso!";
}

$_SESSION['resposta'] = $resposta;
header("Location: ../admin/generos.php");
