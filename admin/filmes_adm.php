<?php
include("conexao.php");
include("../action/valida.php");

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
    <?php include("../includes/header.php") ?>
    <div class="conteudo">
        <?php include("../includes/nav.php") ?>
        <div class="interface">
            <input type="search" name="busca" id="busca" placeholder="Buscar filme" oninput="buscarFilme()">
            <div class="filmes">
                <?php
                $sql = "SELECT filmes.*, generos.genero AS nome_genero 
                    FROM filmes 
                    INNER JOIN generos
                    ON filmes.genero = generos.id";
                $resultado = $conn->query($sql);

                while ($row = $resultado->fetch_assoc()) {
                    $genero = $row['nome_genero'];

                    echo "<a href='../pages/assistir_filme.php?id=" . $row['id'] . "'>";
                    echo "
            <article class='filme'>
            <img src='" . $row['path'] . "'>
            <div class='txt-filme'>
                <p>" . $row['nome'] . "</p>
                <p id = 'genero-filme'>" . $genero . "</p>
                <div class='options'>
                    <form action = 'edita_filme.php' method = 'POST'>
                        <input type = 'hidden' name = 'id' value = '" . $row["id"] . "'>
                        <input type='submit' value='Editar' id='editar'>
                    </form>
                    <form action = '../action/deletar_filme.php' method = 'POST'>
                        <input type = 'hidden' name = 'id' value = '" . $row["id"] . "'>
                        <input type = 'submit' value = 'Deletar' id='deletar'>
                    </form>
                </div>
            </div>
            </article>
            ";
                    echo "</a>";
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
        ?>

        function buscarFilme() {
            const input = document.getElementById('busca').value.toLowerCase();
            const filmes = document.getElementsByClassName('filme');

            for (let i = 0; i < filmes.length; i++) {
                const nomeFilme = filmes[i].querySelector('.txt-filme p').textContent.toLowerCase();

                if (nomeFilme.includes(input)) {
                    filmes[i].style.display = "";
                } else {
                    filmes[i].style.display = "none";
                }
            }
        }
    </script>
</body>

</html>