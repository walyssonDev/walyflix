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
    <link rel="stylesheet" href="../assets/filmes_adm.css">
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
                <form action = '../action/deletar_filme.php' method = 'POST'>
                        <input type = 'hidden' name = 'id' value = '" . $row["id"] . "'>
                        <input type = 'submit' value = 'Deletar'>
                        </form>
            </div>
        </article>
            ";
            echo "</a>";
        }
        ?>
    </div>
</body>

</html>