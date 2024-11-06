<?php
include("../admin/conexao.php");
include("valida.php");

$nome = $_POST['nome'];
$path = $_POST['path'];
$filme = $_POST['link'];
$id = $_POST['id'];
$genero = $_POST['genero'];

if (strpos($filme, 'dropbox.com') !== false) {
    $filme = str_replace('dl=0', 'raw=1', $filme);
}

$sql = "UPDATE filmes SET nome = ?, path = ?, filme = ?, genero = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssi", $nome, $path, $filme, $genero, $id);

if ($stmt->execute()) {
    $_SESSION['resposta'] = "Filme editado com sucesso";
    $stmt->close();
} else {
    $_SESSION['resposta'] = "Erro ao editar filme: " . $conn->error;
    $stmt->close();
}

header("Location: ../admin/filmes_adm.php");
