<?php
include("../utils/conexao.php");
include("../utils/valida.php");

$id = $_POST['id'];
$cpf = $_SESSION['cpf'];
$pg = $_POST['pgfav'];

$sqlVerificar = "SELECT * FROM favoritos WHERE cpf = '$cpf' AND filme_id = '$id'";
$resultado = $conn->query($sqlVerificar);

if ($resultado->num_rows == 0) {
    $sql = "INSERT INTO favoritos (cpf, filme_id) VALUES ('$cpf', '$id')";
    $conn->query($sql);
} else {
    $sql = "DELETE FROM favoritos WHERE cpf = '$cpf' AND filme_id = '$id'";
    $conn->query($sql);
}

if ($pg == "favoritos") {
    header("Location: ../../pages/favoritos.php");
} else {
    header("Location: ../../pages/filmes.php");
}
