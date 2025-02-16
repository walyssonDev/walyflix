<?php
include("../utils/conexao.php");
include("../utils/valida.php");

$id = $_GET['id'];
$comentario = $_POST['comentario'];
$cpf = $_SESSION['cpf'];

if (strlen($comentario) >= 100) {
    echo json_encode([
        'success' => false,
        'message' => 'Máximo de 100 caracteres.'
    ]);
} else {
    $sql = "INSERT INTO comentarios (cpf, comentario, filme_id) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $cpf, $comentario, $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $sqlComentario = "SELECT nome, img FROM usuarios WHERE cpf = ?";
        $stmt = $conn->prepare($sqlComentario);
        $stmt->bind_param("s", $cpf);
        $stmt->execute();
        $stmt->bind_result($nome, $imgData);
        $stmt->fetch();
        $stmt->close();

        if (empty($nome)) {
            $nome = "Usuario Deletado";
        }

        if (!empty($imgData)) {
            $imgSrc = 'data:image/jpeg;base64,' . base64_encode($imgData);
            $img = "<img src='$imgSrc' alt='Imagem de $nome' class='perfil-imagem' loading='lazy'>";
        } else {
            $img = "<svg xmlns='http://www.w3.org/2000/svg' width='40' height='40' fill='#ffffff' class='perfil-imagem' viewBox='0 0 32 32'>
                    <path d='M22 12a6 6 0 1 1-12 0 6 6 0 0 1 12 0'/>
                    <path fill-rule='evenodd' d='M0 16a16 16 0 1 1-32 0A16 16 0 0 1 0 16m16-14a14 14 0 0 0-10.937 22.74C6.484 22.452 9.61 20 16 20s9.516 2.452 10.937 4.74A14 14 0 0 0 16 2'/>
                </svg>";
        }

        echo json_encode([
            'success' => true,
            'comentario' => $comentario,
            'nome' => $nome,
            'img' => $img,
            'cpf' => $cpf
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Erro ao inserir comentário.'
        ]);
    }
}
