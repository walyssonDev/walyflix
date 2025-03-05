<?php
include("../handler/utils/conexao.php");
include("../handler/utils/valida.php");

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WalyFlix - Filmes</title>
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
    <?php include("../includes/load.php") ?>
    <?php include("../includes/header.php") ?>
    <div class="conteudo">
        <?php include("../includes/nav.php") ?>
        <div class="interface">
            <div class="destaque">
                <?php
                $sqlDestaque = "SELECT * FROM filmes WHERE destaque = 1";
                $resultadoDestaque = $conn->query($sqlDestaque);
                $row = $resultadoDestaque->fetch_assoc();
                ?>
                <div class="info-destaque">
                    <h1><?= $row['nome'] ?></h1>
                    <a href='assistir_filme.php?id=<?= $row['id'] ?>'>Assistir filme</a>
                </div>
                <video id="video-destaque" autoplay>
                    <source src="<?= htmlspecialchars($row['filme']) ?>" type="video/mp4">
                    Seu navegador não suporta o elemento de vídeo.
                </video>
            </div>
            <div class="filmes">
                <?php
                $cpf = $_SESSION['cpf'];

                $sql = "SELECT filmes.*, generos.genero AS nome_genero 
                        FROM filmes 
                        INNER JOIN generos
                        ON filmes.genero = generos.id";

                $resultado = $conn->query($sql);

                $filmesPorGenero = [];
                while ($row = $resultado->fetch_assoc()) {
                    $filmesPorGenero[$row['nome_genero']][] = $row;
                }

                foreach ($filmesPorGenero as $genero => $filmes) {
                    echo "<h2>$genero</h2>";
                    echo "<div class='filmes-por-genero-container'>";
                    echo "<button class='scroll-btn left' onclick='scrollParaEsquerda(this)'><i class='bi bi-chevron-left'></i></button>";
                    echo "<div class='filmes-por-genero'>";
                    foreach ($filmes as $row) {
                        $id = $row['id'];
                        $sqlFav = "SELECT * FROM lista WHERE cpf = '$cpf' AND filme_id = '$id'";
                        $resultadoFav = $conn->query($sqlFav);
                        $isFav = $resultadoFav->fetch_assoc();

                        echo "<a href='assistir_filme.php?id=" . $id . "'>";
                        echo "
                        <article class='filme'>
                            <img src='" . $row['img'] . "'>
                            <div class='txt-filme'>
                                <p>" . $row['nome'] . "</p>
                            </div>
                        </article>";
                        if ($_SESSION['tipo'] == "adm") {
                            echo "
                            <div class='options'>
                                <form action='../admin/edita_filme.php' method='POST'>
                                    <input type='hidden' name='id' value='" . $row["id"] . "'>
                                    <input type='submit' value='Editar' id='editar'>
                                </form>
                                <form action='../handler/filme/deletar_filme.php' method='POST'>
                                    <input type='hidden' name='id' value='" . $row["id"] . "'>
                                    <input type='submit' value='Deletar' id='deletar'>
                                </form>
                            </div>";
                        }
                        echo "</a>";
                    }
                    echo "</div>";
                    echo "<button class='scroll-btn right' onclick='scrollParaDireita(this)'><i class='bi bi-chevron-right'></i></button>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </div>
    <script>
        <?php
        if (isset($_SESSION['resposta'])) {
            echo "alert('" . $_SESSION['resposta'] . "')";
            unset($_SESSION['resposta']);
        }
        if (isset($_SESSION['mensagem'])) {
            echo "alert('" . $_SESSION['mensagem'] . "')";
            unset($_SESSION['mensagem']);
        }
        ?>

        function scrollParaEsquerda(button) {
            const container = button.parentElement.querySelector('.filmes-por-genero');
            if (!container) {
                console.error("Elemento filmes-por-genero não encontrado!");
                return;
            }
            console.log("Scroll antes:", container.scrollLeft);
            container.scrollBy({
                left: -300,
                behavior: 'smooth'
            });
            console.log("Scroll depois:", container.scrollLeft);
        }

        function scrollParaDireita(button) {
            const container = button.parentElement.querySelector('.filmes-por-genero');
            if (!container) {
                console.error("Elemento filmes-por-genero não encontrado!");
                return;
            }
            console.log("Scroll antes:", container.scrollLeft);
            container.scrollBy({
                left: 300,
                behavior: 'smooth'
            });
            console.log("Scroll depois:", container.scrollLeft);
        }

        setInterval(() => {
            fetch("../handler/usuario/atualiza_status.php");
        }, 30000);

        const video = document.getElementById("video-destaque");

        video.addEventListener("loadedmetadata", () => {
            video.currentTime = video.duration / 2;
        });
    </script>
</body>

</html>