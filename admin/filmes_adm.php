<?php
include("../handler/utils/valida.php");
include("../handler/utils/conexao.php");

verificarPermissao(['adm']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/img/icon.png" type="image/x-icon">
    <title>Filmes</title>
    <link rel="stylesheet" href="../assets/css/filmes.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php include("../includes/load.php") ?>
    <?php include("../includes/header.php") ?>
    <div class="conteudo">
        <?php include("../includes/nav.php") ?>
        <div class="interface">
            <div class="filmes">
                <?php
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
                        echo "<a href='../pages/assistir_filme.php?id=" . $row['id'] . "'>";
                        echo "
                        <article class='filme'>
                            <img src='" . $row['path'] . "'>
                            <div class='txt-filme'>
                                <p>" . $row['nome'] . "</p>
                            </div>
                        </article>
                        <div class='options'>
                            <form action='edita_filme.php' method='POST'>
                                <input type='hidden' name='id' value='" . $row["id"] . "'>
                                <input type='submit' value='Editar' id='editar'>
                            </form>
                            <form action='../handler/filme/deletar_filme.php' method='POST'>
                                <input type='hidden' name='id' value='" . $row["id"] . "'>
                                <input type='submit' value='Deletar' id='deletar'>
                            </form>
                        </div>
                        ";
                        echo "</a>";
                    }
                    echo "</div>";
                    echo "<button class='scroll-btn right' onclick='scrollParaDireita(this)'><i class='bi bi-chevron-right'></i></button>";
                    echo "</div>";
                }
                ?>
                <div class="space"></div>
            </div>
        </div>
    </div>
    <script>
        <?php
        if (isset($_SESSION['resposta'])) {
            echo "alert('" . $_SESSION['resposta'] . "')";
            unset($_SESSION['resposta']);
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
    </script>
</body>

</html>