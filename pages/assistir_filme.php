<?php
include("../handler/utils/conexao.php");
include("../handler/utils/valida.php");

$id = $_GET['id'];
$cpfLogado = $_SESSION['cpf'];
$nomeLogado = $_SESSION['nome'];

$sql = "SELECT * FROM filmes WHERE id = '$id'";
$resultado = $conn->query($sql);

while ($row = $resultado->fetch_assoc()) {
    $link = $row['filme'];
    $nomeFilme = $row['nome'];
    $genero_id = $row['genero'];
}

$sqlGenero = "SELECT genero FROM generos WHERE id = $genero_id";
$resultadoGenero = $conn->query($sqlGenero);

while ($row = $resultadoGenero->fetch_assoc()) {
    $genero = $row['genero'];
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
    <link rel="shortcut icon" href="../assets/img/icon.png" type="image/x-icon">
    <title><?php echo $nomeFilme ?></title>
    <link rel="stylesheet" href="../assets/css/assistir_filme.css?v=<?php echo time(); ?>">
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
    <div class="conteudo">
        <div class="interface">
            <div class="left">
                <div class="filme">
                    <button id="btn-voltar"><i class="bi bi-arrow-left-short"></i></button>
                    <?php
                    if (strpos($link, 'dropbox.com') !== false) {
                        echo "
                    <video id='video' controls autoplay>
                    <source type='video/mp4' src='" . $link . "'>
                    </video>";
                    } else if (strpos($link, 'drive.google.com') !== false) {
                        echo "<iframe src='$link' allowfullscreen></iframe>";
                    }
                    ?>
                </div>

                <div class="info">
                    <div class="top">
                        <h1><?php echo $nomeFilme ?></h1>
                        <div class='fav'>
                            <form id="fav-form" class='favoritarForm' method='post'
                                action='../handler/filme/favoritar.php'>
                                <?php
                                $sqlFav = "SELECT * FROM favoritos WHERE cpf = '$cpfLogado' AND filme_id = '$id'";
                                $resultadoFav = $conn->query($sqlFav);
                                $isFav = $resultadoFav->num_rows > 0;
                                echo "
                                <input type='hidden' name='id' value='" . $id . "'>
                                <button type='submit' class='btn-favoritar'>";
                                if ($isFav) {
                                    echo "<i class='bi bi-bookmark-fill'></i>";
                                } else {
                                    echo "<i class='bi bi-bookmark'></i>";
                                }
                                echo "</button>
                            " ?>
                            </form>
                        </div>
                    </div>
                    <p><?php echo $genero ?></p>
                </div>
            </div>

            <div class="container">
                <div id="comentarios" class="comentarios">
                    <?php
                    $sql = "SELECT * FROM comentarios WHERE filme_id = $id ORDER BY id";
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

                        $commentClass = ($nome == "ADM" || $nome == "Adm") ? 'commentADM' : 'comment';

                        echo "
                        <div class='$commentClass'>
                        <div class='txt'>
                        $img
                        <p class='nome'>" . $nome . ": </p>
                        <p>" . $comentario . "</p>
                        </div>";

                        if ($nomeLogado == "ADM" || $nomeLogado == "Adm" || $cpfComentario == $cpfLogado) {
                            echo "
                            <form class='deletarForm' action='../handler/comentario/deletarComentario.php?id=$id' method='post'>
                            <input type='hidden' name='comentario' id='comentario' value='$comentario'>
                            <input type='hidden' name='cpfUser' id='cpfUser' value='$cpfComentario'>
                            <input type='submit' value='Deletar'>
                            </form>";
                        }

                        echo "</div>";
                    }
                    ?>
                </div>
                <form id="comentarioForm" action="../handler/comentario/comentar.php?id=<?php echo $id ?>"
                    method="post">
                    <input type="text" name="comentario" id="comentario" placeholder="Seu comentario: (Max: 100)"
                        required>
                    <button type="submit">
                        <i class="bi bi-arrow-right"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.querySelector("video").requestFullscreen();
        document.querySelector("iframe").requestFullscreen();

        document.getElementById('btn-voltar').addEventListener('click', function() {
            window.history.back();
        });
        <?php
        if (isset($_GET['resposta'])) {
            echo "alert('" . $_GET['resposta'] . "')";
        }
        ?>
        const filme_id = <?php echo $id ?>;
        const isIframe = <?php echo (strpos($link, 'drive.google.com') !== false) ? 'true' : 'false'; ?>;

        document.getElementById('comentarioForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const form = event.target;
            const formData = new FormData(form);
            const xhr = new XMLHttpRequest();
            xhr.open('POST', form.action, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    const resposta = JSON.parse(xhr.responseText);
                    if (resposta.success) {
                        const div = document.createElement('div');
                        div.classList.add(resposta.nome.toLowerCase() === 'adm' ? 'commentADM' : 'comment');
                        div.innerHTML = `
                        <div class='txt'>
                            ${resposta.img}
                            <p class='nome'>${resposta.nome}: </p>
                            <p>${resposta.comentario}</p>
                        </div>`;

                        if (resposta.nome.toLowerCase() === 'adm' || resposta.cpf ===
                            '<?php echo $cpfLogado ?>') {
                            div.innerHTML += `
                            <form class='deletarForm' action='../handler/comentario/deletarComentario.php?id=${filme_id}' method='post'>
                                <input type='hidden' name='comentario' value='${resposta.comentario}'> 
                                <input type='hidden' name='cpfUser' value='${resposta.cpf}'>
                                <input type='submit' value='Deletar' class='btn-deletar'>
                            </form>`;
                        }

                        document.getElementById('comentarios').appendChild(div);
                        form.reset();
                        addDeleteEvent(div.querySelector('.deletarForm'));
                    } else {
                        alert(resposta.message);
                    }
                } else {
                    alert('Erro ao enviar o comentário');
                }
            };
            xhr.send(formData);
        });

        function addDeleteEvent(form) {
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
                            form.parentElement.remove();
                        } else {
                            alert(resposta.message);
                        }
                    } else {
                        alert('Erro ao deletar o comentário');
                    }
                };
                xhr.send(formData);
            });
        }

        document.querySelectorAll('.deletarForm').forEach(addDeleteEvent);

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
                            const button = form.querySelector('.btn-favoritar');
                            if (resposta.favoritado) {
                                button.innerHTML = "<i class='bi bi-bookmark-fill'></i>";
                            } else {
                                button.innerHTML = "<i class='bi bi-bookmark'></i>";
                            }
                        } else {
                            alert(resposta.message);
                        }
                    } else {
                        alert('Erro ao favoritar o filme');
                    }
                };
                xhr.send(formData);
            });
        });

        setInterval(() => {
            fetch("../handler/usuario/atualiza_status.php");
        }, 30000);
    </script>
</body>

</html>