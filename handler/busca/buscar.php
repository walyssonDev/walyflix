<?php
include("../utils/valida.php");
include("../utils/conexao.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $busca = $_POST['busca'];

    $sql = "SELECT * FROM filmes WHERE nome LIKE '%$busca%'";
    $resultado = mysqli_query($conn, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        while ($row = mysqli_fetch_assoc($resultado)) {
            $sqlGenero = "SELECT * FROM generos WHERE id = " . $row['genero'];
            $resultadoGenero = $conn->query($sqlGenero);
            $resultadoGenero = $resultadoGenero->fetch_assoc();
            $genero = $resultadoGenero['genero'];

            echo "<a href='assistir_filme.php?id=" . $row['id'] . "'>";
            echo "
                        <article class='filme'>
                            <img src='" . $row['path'] . "'>
                            <div class='txt-filme'>
                                <p id='nome'>" . $row['nome'] . "</p>
                                <p id='genero'>" . $genero . "</p>
                            </div>
                            <i class='bi bi-play-circle'></i>
                        </article>
                        ";
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
                        </div>
                            ";
            }
            echo "</a>";
        }
    } else {
        echo "<div class='resultado-item'>Nenhum resultado encontrado</div>";
    }
}
