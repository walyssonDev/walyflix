<?php
include("../handler/utils/valida.php");
include("../handler/utils/conexao.php");

$sql = "SELECT cpf, status FROM usuarios";
$resultado = $conn->query($sql);

$usuarios = array();
while ($row = $resultado->fetch_assoc()) {
    $usuarios[] = $row;
}

echo json_encode($usuarios);
?>