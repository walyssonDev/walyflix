<?php
include("../utils/conexao.php");
include("../utils/valida.php");

$cpf = $_SESSION['cpf'];
$id = $_POST['id'];

$sqlFav = "SELECT * FROM lista WHERE cpf = ? AND filme_id = ?";
$stmt = $conn->prepare($sqlFav);
$stmt->bind_param("ss", $cpf, $id);
$stmt->execute();
$resultadoFav = $stmt->get_result();
$isFav = $resultadoFav->fetch_assoc();

if ($isFav) {
    $sql = "DELETE FROM lista WHERE cpf = ? AND filme_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $cpf, $id);
    $stmt->execute();
    $favoritado = false;
} else {
    $sql = "INSERT INTO lista (cpf, filme_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $cpf, $id);
    $stmt->execute();
    $favoritado = true;
}

if ($stmt->affected_rows > 0) {
    echo json_encode([
        'success' => true,
        'favoritado' => $favoritado
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Erro ao favoritar o filme.'
    ]);
}
