<?php
include("../handler/utils/conexao.php");
include("../handler/utils/valida.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="shortcut icon" href="../assets/img/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/filmes.css?v=<?php echo time(); ?>">
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
    <?php include("../includes/header.php") ?>
    <div class="conteudo">
        <?php include("../includes/nav.php") ?>
        <div class="filmes">
            <?php
            $cpf = $_SESSION['cpf'];

            $sql = "SELECT * FROM favoritos WHERE cpf = '$cpf'";
            $resultado = $conn->query($sql);

            if ($resultado->num_rows == 0) {
                echo "Você não tem filmes favoritos!";
            }

            while ($row = $resultado->fetch_assoc()) {
                $id = $row['filme_id'];
                $sqlFilme = "SELECT * FROM filmes WHERE id = '$id'";
                $resultadoFilme = $conn->query($sqlFilme);

                $rowFilme = $resultadoFilme->fetch_assoc();
                $idGenero = $rowFilme['genero'];

                $sqlGenero = "SELECT genero FROM generos WHERE id = $idGenero";
                $resultadoGenero = $conn->query($sqlGenero);
                $rowGenero = $resultadoGenero->fetch_assoc();
                $genero  = $rowGenero['genero'];

                echo "<a href='assistir_filme.php?id=" . $rowFilme['id'] . "'>";
                echo "
                    <article class='filme'>";
                echo "
                    <div class='fav'>
                    <form method='post' action='../handler/filme/favoritar.php'>
                    <input type='hidden' name='pgfav' value='favoritos'>
                    <input type='hidden' name='id' value='" . $rowFilme['id'] . "'>
                    <button type='submit'>
                        <i class='bi bi-star-fill'></i>
                    </button>
                    </form>
                    </div>
                    ";
                echo "
                    <img src='" . $rowFilme['path'] . "'>
                    <div class='txt-filme'>
                        <p>" . $rowFilme['nome'] . "</p>
                        <p id = 'genero-filme'>" . $genero . "</p>
                    </div>
                </article>
                    ";
                echo "</a>";
            }
            ?>
        </div>
    </div>
</body>

</html>