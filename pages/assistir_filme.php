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

                    $sqlNome = "SELECT nome FROM usuarios WHERE cpf = '$cpfComentario'";
                    $resultadoNome = $conn->query($sqlNome);

                    if ($resultadoNome->num_rows > 0) {
                        $rowNome = $resultadoNome->fetch_assoc();
                        $nome = $rowNome['nome'];
                    } else {
                        $nome = "Anonimo";
                    }

                    if ($cpfComentario == $_SESSION['cpf']) {
                        echo "
                        <div class='comment'>
                        <div class='txt'>
                        <i class='bi bi-person-circle'></i>
                        <p class='nome'>" . $nome . ": </p>
                        <p>" . $comentario . "</p>
                        </div>
                        <form id='deletar' action='../action/deletarComentario.php?id=$id' method='post'>
                        <input type='hidden' name='comentario' id='comentario' value='$comentario'>
                        <input type='submit' value='Deletar'>
                        </form>
                        </div>
                        ";
                    } else {
                        echo "
                        <div class='comment'>
                        <div class='txt'>
                        <i class='bi bi-person-circle'></i>
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