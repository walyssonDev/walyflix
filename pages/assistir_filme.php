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
    <style>
    body {
        box-sizing: border-box;
        padding: 0;
        margin: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .interface {
        display: flex;
        gap: 1em;
        padding: 2em 1em;
    }

    .filme {
        width: 50%;
        background-color: #023047;
        color: white;
        border-radius: 1em;
        overflow: hidden;
        text-align: center;
    }

    video {
        width: 100%;
    }

    .container {
        border-radius: 1em;
        overflow: hidden;
        width: 50%;
    }

    .comentarios {
        background-color: #023047;
        color: white;
        padding: 1em;
    }

    .comment {
        display: flex;
        gap: 1%;
    }

    .container form {
        display: flex;
        justify-content: space-between;
        width: 100%;
        margin: 0;
        padding: 0;
    }

    .container form input[type="text"] {
        width: 100%;
        padding: .5em;
    }

    .container form button[type="submit"] {
        position: relative;
        border: none;
        background-color: transparent;
        font-size: 20px;
        cursor: pointer;
        margin: 0;
        padding: 1em;
        background-color: black;
        color: white;
    }

    @media screen and (max-width: 1020px) {
        .interface {
            flex-direction: column;
        }

        .container {
            width: 100%;
        }

        .filme {
            width: 100%;
        }
    }
    </style>
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

                    echo "
                    <div class='comment'>
                    <p class='nome'>" . $nome . ": </p>
                    <p>" . $comentario . "</p>
                    </div>
                    ";
                }
                ?>
            </div>
            <form action="../action/comentar.php?id=<?php echo $id ?>" method="post">
                <input type="text" name="comentario" id="comentario" placeholder="Seu comentario">
                <button type="submit">
                    <i class="bi bi-arrow-right"></i>
                </button>
            </form>
        </div>
    </div>
</body>

</html>