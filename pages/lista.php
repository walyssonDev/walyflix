<?php
include("../handler/utils/conexao.php");
include("../handler/utils/valida.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favoritos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="shortcut icon" href="../assets/img/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/lista.css?v=<?php echo time(); ?>">
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
            <div class="titulo">
                <h1><i class="bi bi-bookmark-fill"></i> Sua Lista</h1>
            </div>
            <div class="filmes">
                <?php
                $cpf = $_SESSION['cpf'];

                $sql = "SELECT * FROM favoritos WHERE cpf = '$cpf'";
                $resultado = $conn->query($sql);

                if ($resultado->num_rows == 0) {
                    echo "Você não tem filmes favoritos!";
                } else {
                    while ($row = $resultado->fetch_assoc()) {
                        $sqlFilme = "SELECT * FROM filmes WHERE id = " . $row['filme_id'];
                        $resultadoFilme = $conn->query($sqlFilme);
                        $rowFilme = $resultadoFilme->fetch_assoc();
                        $nome = $rowFilme['nome'];
                        $img = $rowFilme['path'];
                        $filme = $rowFilme['filme'];
                        $genero_id = $rowFilme['genero'];
                        $id = $rowFilme['id'];

                        $sqlGenero = "SELECT genero FROM generos WHERE id = '$genero_id'";
                        $resultadoGenero = $conn->query($sqlGenero);
                        $rowGenero = $resultadoGenero->fetch_assoc();
                        $genero = $rowGenero['genero'];
                ?>
                        <a href='assistir_filme.php?id=<?php echo $id ?>'>
                            <div class='filme-container'>
                                <article class='filme'>
                                    <img src='<?php echo $img ?>'>
                                </article>
                                <div class="info">
                                    <div class="txt">
                                        <h2><?php echo $nome ?></h2>
                                        <p><?php echo $genero ?></p>
                                    </div>

                                    <div class='botoes'>
                                        <form class='favoritarForm' method='post' action='../handler/filme/favoritar.php'>
                                            <input type='hidden' name='pgfav' value='favoritos'>
                                            <input type='hidden' name='id' value='<?php echo $id ?>'>
                                            <button type='submit' class='btn-favoritar'>
                                                <i class="bi bi-x-circle"></i>
                                            </button>
                                        </form>
                                        <button>
                                            <i class="bi bi-play-circle"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </a>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <script>
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
                            form.closest('.filme-container').remove();
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
    </script>
</body>

</html>