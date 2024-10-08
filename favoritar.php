<?php
include("conexao.php");
include("valida.php");

$id = $_POST['id'];
$cpf = $_SESSION['cpf'];

$sqlVerificar = "SELECT * FROM favoritos WHERE cpf = '$cpf' AND filme_id = '$id'";
$resultado = $conn->query($sqlVerificar);

if ($resultado->num_rows == 0) {
    $sql = "INSERT INTO favoritos (cpf, filme_id) VALUES ('$cpf', '$id')";
    $conn->query($sql);
} else {
    $sqlFav = "SELECT id FROM favoritos WHERE cpf = '$cpf' AND filme_id = '$id'";
    $resultado = $conn->query($sqlFav);
    $row = $resultado->fetch_assoc();

    $idFav = $row['id'];

    $sql = "DELETE FROM favoritos WHERE id = '$idFav'";
    $conn->query($sql);
}

header("Location: filmes.php");
