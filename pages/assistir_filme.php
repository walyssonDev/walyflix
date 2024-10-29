<?php
include("../admin/conexao.php");
include("../action/valida.php");

$id = $_GET['id'];

$sql = "SELECT * FROM filmes WHERE id = '$id'";
$resultado = $conn->query($sql);

while ($row = $resultado->fetch_assoc()) {
    $link = $row['filme'];
    $nomeFilme = $row['nome'];
}

$link_limpo = parse_url($link, PHP_URL_PATH);
$extensao = pathinfo($link_limpo, PATHINFO_EXTENSION);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/assistir_filme.css">
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-VX1YBC3426"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-VX1YBC3426');
    </script>
</head>

<body>
    <div class="interface">
        <div class="filme">
            <video controls autoplay>
                <source type='video/mp4' src='<?php echo $link ?>'>
            </video>
            <h1><?php echo $nomeFilme ?></h1>
        </div>
        <div class="container">
            <div class="comentarios">
                <?php
                $sql = "SELECT * FROM comentarios WHERE filme_id = $id";
                $resultado = $conn->query($sql);
                while ($row = $resultado->fetch_assoc()) {
                    $cpfComentario = $row['cpf'];
                    $comentario = $row['comentario'];

                    $sqlComentario = "SELECT nome, img FROM usuarios WHERE cpf = ? ";
                    $stmt = $conn->prepare($sqlComentario);
                    $stmt->bind_param("s", $cpfComentario);
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
                                    <path fill-rule='evenodd' d='M0 16a16 16 0 1 1 32 0A16 16 0 0 1 0 16m16-14a14 14 0 0 0-10.937 22.74C6.484 22.452 9.61 20 16 20s9.516 2.452 10.937 4.74A14 14 0 0 0 16 2'/>
                                </svg>";
                    }

                    if ($_SESSION['tipo'] == "adm") {
                        echo "
                        <div class='comment'>
                        <div class='txt'>
                        $img
                        <p class='nome'>" . $nome . ": </p>
                        <p>" . $comentario . "</p>
                        </div>
                        <form id='deletar' action='../action/deletarComentario.php?id=$id' method='post'>
                        <input type='hidden' name='comentario' id='comentario' value='$comentario'>
                        <input type='hidden' name='cpfUser' id='cpfUser' value='$cpfComentario'>
                        <input type='submit' value='Deletar'>
                        </form>
                        </div>
                        ";
                    } elseif ($cpfComentario == $_SESSION['cpf']) {
                        echo "
                        <div class='comment'>
                        <div class='txt'>
                        $img
                        <p class='nome'>" . $nome . ": </p>
                        <p>" . $comentario . "</p>
                        </div>
                        <form id='deletar' action='../action/deletarComentario.php?id=$id' method='post'>
                        <input type='hidden' name='comentario' id='comentario' value='$comentario'>
                        <input type='hidden' name='cpfUser' id='cpfUser' value='$cpfComentario'>
                        <input type='submit' value='Deletar'>
                        </form>
                        </div>
                        ";
                    } else {
                        echo "
                        <div class='comment'>
                        <div class='txt'>
                        $img
                        <p class='nome'>" . $nome . ": </p>
                        <p>" . $comentario . "</p>
                        </div>
                        </div>
                        ";
                    }
                }
                ?>
            </div>
            <form action="../action/comentar.php?id=<?php echo $id ?>" method="post">
                <input type="text" name="comentario" id="comentario" placeholder="Seu comentario: (Max: 100)" required>
                <button type="submit">
                    <i class="bi bi-arrow-right"></i>
                </button>
            </form>
        </div>
    </div>
    <script>
        <?php
        if (isset($_GET['resposta'])) {
            echo "alert('" . $_GET['resposta'] . "')";
        }
        ?>
    </script>
</body>

</html>