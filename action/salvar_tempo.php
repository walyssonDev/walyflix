<?php
include("valida.php");
include("../admin/conexao.php");

$data = json_decode(file_get_contents("php://input"));
$cpf = $_SESSION['cpf'];

if (isset($data->tempo)) {
    $tempo = $data->tempo;
    $id = $data->id;

    $sqlVerificar = "SELECT * FROM minutagem WHERE cpf = ? AND filme_id = ?";
    $stmtVerificar = $conn->prepare($sqlVerificar);
    $stmtVerificar->bind_param("si", $cpf, $id);
    $stmtVerificar->execute();
    $resultado = $stmtVerificar->get_result();

    if ($resultado->num_rows > 0) {
        $sql = "UPDATE minutagem SET tempo = ? WHERE cpf = ? AND filme_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $tempo, $cpf, $id);
        $stmt->execute();
    } else {
        $sql = "INSERT INTO minutagem (cpf, filme_id, tempo) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sis", $cpf, $id, $tempo);
        $stmt->execute();
    }

    $stmt->close();
    $stmtVerificar->close();
}
