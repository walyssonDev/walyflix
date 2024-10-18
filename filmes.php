        <?php
        include("conexao.php");
        include("valida.php");

        ?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Filmes</title>
            <link rel="stylesheet"
                href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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

                .interface a {
                    text-decoration: none;
                    color: white;
                }

                .filme {
                    display: flex;
                    align-items: center;
                    width: 17em;
                    justify-content: center;
                    flex-direction: column;
                    background-color: #023047;
                    color: white;
                    border-radius: .5em;
                    box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
                    cursor: pointer;
                    position: relative;
                    overflow: hidden;
                }

                .fav button {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    position: absolute;
                    top: 0;
                    right: 0;
                    padding: 1%;
                    border: none;
                    border-radius: 0 0 0 50%;
                    background-color: black;
                    cursor: pointer;
                }

                .fav i {

                    color: #FFD100;
                    font-size: 30px;
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

                input[type="submit"] {
                    padding: .7em 1em;
                    border-radius: .5em;
                    border: none;
                    background-color: #bf0603;
                    color: white;
                    cursor: pointer;
                    margin-top: 1em;
                }

                input[type="submit"]:hover {
                    background-color: #780000;
                }

                @media screen and (max-width: 1020px) {
                    .interface {
                        justify-content: center;
                        align-items: center;
                    }

                    .filme,
                    .interface a {
                        width: 13em;
                    }
                }
            </style>
        </head>

        <body>
            <div class="interface">
                <?php
                $cpf = $_SESSION['cpf'];

                $sql = "SELECT * FROM filmes";
                $resultado = $conn->query($sql);

                while ($row = $resultado->fetch_assoc()) {
                    $id = $row['id'];

                    $sqlFav = "SELECT * FROM favoritos WHERE cpf = '$cpf' AND filme_id = '$id'";
                    $resultadoFav = $conn->query($sqlFav);
                    $isFav = $resultadoFav->fetch_assoc();

                    echo "<a href='assistir_filme.php?id=" . $id . "'>";
                    echo "
                    <article class='filme'>";
                    echo "
                    <div class='fav'>
                    <form method='post' action='favoritar.php'>
                    <input type='hidden' name='id' value='" . $id . "'>
                    <button type='submit'>";
                    if ($isFav) {
                        echo "<i class='bi bi-star-fill'></i>";
                    } else {
                        echo "<i class='bi bi-star'></i>";
                    }
                    echo "</button>
                    </form>
                    </div>
                    ";
                    echo "
                    <img src='" . $row['path'] . "'>
                    <div class='txt-filme'>
                        <p>" . $row['nome'] . "</p>
                    </div>
                    </article>
                    ";
                    echo "</a>";
                }
                ?>
            </div>

        </body>

        </html>