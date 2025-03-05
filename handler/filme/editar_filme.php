<?php
include("../utils/conexao.php");
include("../utils/valida.php");

$nome = $_POST['nome'];
$img = $_POST['img'];
$filme = $_POST['link'];
$id = $_POST['id'];
$genero = $_POST['genero'];

if (strpos($filme, 'dropbox.com') !== false) {
    $filme = str_replace('dl=0', 'raw=1', $filme);
} else if (strpos($filme, 'drive.google.com') !== false) {
    preg_match('/\/d\/([a-zA-Z0-9_-]+)/', $filme, $matches);

    if (!empty($matches[1])) {
        $file_id = $matches[1];
        $filme = "https://drive.google.com/file/d/$file_id/preview";
    }
} else {
    $filme = null;
}

if ($filme == null) {
    $_SESSION['resposta'] = "Erro ao editar filme formato invalido";
    header("Location: ../../admin/filmes_adm.php");
    exit;
}

$sql = "UPDATE filmes SET nome = ?, img = ?, filme = ?, genero = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssi", $nome, $img, $filme, $genero, $id);

if ($stmt->execute()) {
    $_SESSION['resposta'] = "Filme editado com sucesso";
    $stmt->close();
} else {
    $_SESSION['resposta'] = "Erro ao editar filme: " . $conn->error;
    $stmt->close();
}

header("Location: ../../admin/filmes_adm.php");
