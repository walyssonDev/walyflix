<?php
include("../handler/utils/conexao.php");
include("../handler/utils/valida.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WalyFlix</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
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
    <script async src="https://polyfill.io/v3/polyfill.min.js?features=IntersectionObserver"></script>
</head>

<body>
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
                    <h1><?= htmlspecialchars($row['nome']) ?></h1>
                    <div class="btn-destaque">
                        <a href='assistir_filme.php?id=<?= htmlspecialchars($row['id']) ?>'>
                            <i class="bi bi-play-fill"></i>
                            <p>Assistir</p>
                        </a>
                        <div class='fav'>
                            <form id="fav-form" class='favoritarForm' method='post'
                                action='../handler/filme/listar.php'>
                                <?php
                                $sqlFav = "SELECT * FROM lista WHERE cpf = '" . $_SESSION['cpf'] . "' AND filme_id = '" . $row['id'] . "'";
                                $resultadoFav = $conn->query($sqlFav);
                                $isFav = $resultadoFav->num_rows > 0;
                                ?>
                                <input type='hidden' name='id' value='<?= htmlspecialchars($row['id']) ?>'>
                                <button type='submit' class='btn-favoritar'>
                                    <i class='<?= $isFav ? "bi bi-check2" : "bi bi-plus-lg" ?>'></i>
                                    <p>Salvar</p>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="loading-gif">
                </div>
                <video id="video-destaque" autoplay>
                    <source data-src="<?= htmlspecialchars($row['filme']) ?>" type="video/mp4">
                    Seu navegador não suporta o elemento de vídeo.
                </video>
                <div id="overlay"></div>
            </div>
            <div class="filmes">
                <?php
                $cpf = $_SESSION['cpf'];

                $sql = "SELECT filmes.*, generos.genero AS nome_genero, 
                        (SELECT COUNT(*) FROM lista WHERE cpf = '$cpf' AND filme_id = filmes.id) AS isFav 
                        FROM filmes 
                        INNER JOIN generos ON filmes.genero = generos.id";

                $resultado = $conn->query($sql);

                $filmesPorGenero = [];
                while ($row = $resultado->fetch_assoc()) {
                    $filmesPorGenero[$row['nome_genero']][] = $row;
                }
                $count = 0;
                foreach ($filmesPorGenero as $genero => $filmes) {
                    echo "<h2>$genero</h2>";
                    echo "<div class='filmes-por-genero-container'>";
                    echo "<button class='scroll-btn left' onclick='scrollParaEsquerda(this)'><i class='bi bi-chevron-left'></i></button>";
                    echo "<div class='filmes-por-genero'>";
                    foreach ($filmes as $row) {
                        $id = htmlspecialchars($row['id']);
                        $isFav = $row['isFav'] > 0;

                        echo "<a href='assistir_filme.php?id=" . $id . "'>";
                        echo "
                        <article class='filme'>
                            <img src='https://cdn.dribbble.com/users/546766/screenshots/4044977/bluecircle.gif' data-src='" . htmlspecialchars($row['img']) . "' class='lazy'>
                            <div class='txt-filme'>
                                <p>" . htmlspecialchars($row['nome']) . "</p>
                            </div>
                        </article>";
                        if ($_SESSION['tipo'] == "adm") {
                            echo "
                            <div class='options'>
                                <form action='../admin/edita_filme.php' method='POST'>
                                    <input type='hidden' name='id' value='" . $id . "'>
                                    <input type='submit' value='Editar' id='editar'>
                                </form>
                                <form action='../handler/filme/deletar_filme.php' method='POST'>
                                    <input type='hidden' name='id' value='" . $id . "'>
                                    <input type='submit' value='Deletar' id='deletar'>
                                </form>
                            </div>";
                        }
                        echo "</a>";
                    }
                    echo "</div>";
                    echo "<button class='scroll-btn right' onclick='scrollParaDireita(this)'><i class='bi bi-chevron-right'></i></button>";
                    echo "</div>";
                    $count++;
                    if ($count == 3) {
                ?>
                        <h2>Top 10 filmes</h2>
                        <div class="top-10-container">
                            <button class='scroll-btn left' onclick='scrollParaEsquerdaTop10(this)'>
                                <i class='bi bi-chevron-left'></i>
                            </button>
                            <div class="top-10">
                                <?php
                                $sqlTop10 = "SELECT filmes.*, COUNT(lista.filme_id) AS count 
                                            FROM filmes 
                                            INNER JOIN lista ON filmes.id = lista.filme_id 
                                            GROUP BY lista.filme_id 
                                            ORDER BY count DESC, filmes.nome ASC 
                                            LIMIT 10";
                                $resultadoTop10 = $conn->query($sqlTop10);
                                $ordem = 1;
                                while ($row = $resultadoTop10->fetch_assoc()) {
                                    echo "<a href='assistir_filme.php?id=" . htmlspecialchars($row['id']) . "'>";
                                    echo "<div class='top-10-item'>
                                            <p>$ordem</p>
                                        </div>";
                                    echo "
                                    <article class='filme'>
                                        <img src='https://cdn.dribbble.com/users/546766/screenshots/4044977/bluecircle.gif' data-src='" . htmlspecialchars($row['img']) . "' class='lazy'>
                                        <div class='txt-filme'>
                                            <p>" . htmlspecialchars($row['nome']) . "</p>
                                        </div>
                                    </article>";
                                    echo "</a>";
                                    $ordem++;
                                }
                                ?>
                            </div>
                            <button class='scroll-btn right' onclick='scrollParaDireitaTop10(this)'>
                                <i class='bi bi-chevron-right'></i>
                            </button>
                        </div>
                <?php
                    }
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

        document.querySelectorAll('.favoritarForm').forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                const form = event.target;
                const formData = new FormData(form);
                const xhr = new XMLHttpRequest();
                xhr.open('POST', form.action, true);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        const resposta = JSON.parse(xhr.responseText);
                        if (resposta.success) {
                            const button = form.querySelector('.btn-favoritar i');
                            if (resposta.favoritado) {
                                button.className = 'bi bi-check2';
                            } else {
                                button.className = 'bi bi-plus-lg';
                            }
                        } else {
                            alert(resposta.message);
                        }
                    } else {
                        alert('Erro ao listar o filme');
                    }
                };
                xhr.send(formData);
            });
        });

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

        function scrollParaEsquerdaTop10(button) {
            const container = button.parentElement.querySelector('.top-10');
            if (!container) {
                console.error("Elemento top-10 não encontrado!");
                return;
            }
            console.log("Scroll antes:", container.scrollLeft);
            container.scrollBy({
                left: -300,
                behavior: 'smooth'
            });
            console.log("Scroll depois:", container.scrollLeft);
        }

        function scrollParaDireitaTop10(button) {
            const container = button.parentElement.querySelector('.top-10');
            if (!container) {
                console.error("Elemento top-10 não encontrado!");
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

        document.addEventListener("DOMContentLoaded", function() {
            const lazyImages = document.querySelectorAll('img.lazy');
            const video = document.getElementById("video-destaque");
            const videoSource = video.querySelector('source');

            if ("IntersectionObserver" in window) {
                let lazyImageObserver = new IntersectionObserver(function(entries, observer) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            let lazyImage = entry.target;
                            lazyImage.src = lazyImage.dataset.src;
                            lazyImage.classList.remove("lazy");
                            lazyImageObserver.unobserve(lazyImage);
                        }
                    });
                });

                lazyImages.forEach(function(lazyImage) {
                    lazyImageObserver.observe(lazyImage);
                });

                let lazyVideoObserver = new IntersectionObserver(function(entries, observer) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            videoSource.src = videoSource.dataset.src;
                            video.load();
                            lazyVideoObserver.unobserve(video);
                        }
                    });
                });

                lazyVideoObserver.observe(video);
            } else {
                // Fallback for browsers that don't support IntersectionObserver
                let lazyLoad = function() {
                    lazyImages.forEach(function(lazyImage) {
                        if (lazyImage.getBoundingClientRect().top < window.innerHeight && lazyImage
                            .getBoundingClientRect().bottom > 0 && getComputedStyle(lazyImage)
                            .display !== "none") {
                            lazyImage.src = lazyImage.dataset.src;
                            lazyImage.classList.remove("lazy");
                        }
                    });

                    if (lazyImages.length == 0) {
                        document.removeEventListener("scroll", lazyLoad);
                        window.removeEventListener("resize", lazyLoad);
                        window.removeEventListener("orientationchange", lazyLoad);
                    }

                    if (video.getBoundingClientRect().top < window.innerHeight && video.getBoundingClientRect()
                        .bottom > 0 && getComputedStyle(video).display !== "none") {
                        videoSource.src = videoSource.dataset.src;
                        video.load();
                        document.removeEventListener("scroll", lazyLoad);
                        window.removeEventListener("resize", lazyLoad);
                        window.removeEventListener("orientationchange", lazyLoad);
                    }
                };

                document.addEventListener("scroll", lazyLoad);
                window.addEventListener("resize", lazyLoad);
                window.addEventListener("orientationchange", lazyLoad);
            }
        });
        const loadingGif = document.getElementById("loading-gif");

        video.addEventListener("loadeddata", () => {
            loadingGif.style.display = "none";
            video.style.display = "block";
        });

        video.addEventListener("loadedmetadata", () => {
            video.currentTime = video.duration / 2;
        });
    </script>
</body>

</html>