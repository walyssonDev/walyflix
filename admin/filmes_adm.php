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
    <title>Filmes</title>
    <link rel="stylesheet" href="../assets/filmes.css?v=<?php echo time(); ?>">
</head>

<body>
    <div class="interface">
        <?php
        $sql = "SELECT * FROM filmes";
        $resultado = $conn->query($sql);

        while ($row = $resultado->fetch_assoc()) {
            echo "<a href='../pages/assistir_filme.php?id=" . $row['id'] . "'>";
            echo "
            <article class='filme'>
            <img src='" . $row['path'] . "'>
            <div class='txt-filme'>
                <p>" . $row['nome'] . "</p>
                <p id = 'genero-filme'>" . $row['genero'] . "</p>
                <div class='options'>
                    <form action = '../action/edita_filme.php' method = 'POST'>
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
    <script>
        <?php
        if (isset($_SESSION['resposta'])) {
            echo "alert('" . $_SESSION['resposta'] . "')";
            unset($_SESSION['resposta']);
        }
        ?>
    </script>
</body>

</html>