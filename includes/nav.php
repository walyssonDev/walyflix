<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/nav.css?v=<?php echo time(); ?>">
    <title>Menu</title>
</head>

<body>
    <nav id="menu" onclick="menu()">
        <ul id="itens">
            <?php
            if ($_SESSION["tipo"] == "comum") {
                echo "
                        <li><a href='inicio.php'><i class='bi bi-house-fill'></i><span>Inicio</span></a></li>
                        <li><a href='filmes.php'><i class='bi bi-film'></i><span>Filmes</span></a></li>
                        <li><a href='favoritos.php'><i class='bi bi-star-fill'></i><span>Favoritos</span></a></li>
                    ";
            } elseif ($_SESSION["tipo"] == "adm") {
                echo "
                        <li><a href='../admin/usuarios.php'><i class='bi bi-people-fill'></i><span>Usuarios</span></a></li>
                        <li><a href='../admin/cadastro.php'><i class='bi bi-person-plus-fill'></i><span>Cadastro</span></a></li>
                        <li><a href='../admin/cadastro_filme.php'><i class='bi bi-cloud-plus-fill'></i><span>Cadastrar Filme</span></a></li>
                        <li><a href='../admin/generos.php'><i class='bi bi-tags-fill'></i><span>Generos</span></a></li>
                        <li><a href='../admin/filmes_adm.php'><i class='bi bi-film'></i><span>Filmes ADM</span></a></li>
                ";
            }
            ?>
        </ul>
    </nav>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var loader = document.getElementById('loader');

            // Mostrar o loader ao clicar em links do menu
            document.querySelectorAll('#menu a').forEach(function(link) {
                link.addEventListener('click', function() {
                    loader.style.display = 'flex';
                });
            });
        });
    </script>
</body>

</html>