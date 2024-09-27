<?php
include("conexao.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filmes</title>
    <style>
    body * {
        box-sizing: border-box;
        padding: 0;
        margin: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .interface {
        display: flex;
        flex-wrap: wrap;
        gap: 1em;
    }

    .filme {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        background-color: #023047;
        color: white;
        border-radius: .5em;
        box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
        cursor: pointer;
    }

    .filme img {
        width: 100%;
        height: 10em;
        border-radius: .4em .4em 0 0;
    }

    .filme .txt-filme {
        text-align: center;
        font-size: 20px;
        padding: .5em 1em;
    }

    .filme .txt-filme p {
        margin: 0;
    }
    </style>
</head>

<body>
    <div class="interface">
        <?php
        $sql = "SELECT * FROM filmes";
        $resultado = $conn->query($sql);

        while ($row = $resultado->fetch_assoc()) {
            echo "
            <article class='filme'>
            <img src='" . $row['path'] . "'>
            <div class='txt-filme'>
                <p>" . $row['nome'] . "</p>
            </div>
        </article>
            ";
        }
        ?>
        </a>
    </div>
</body>

</html>