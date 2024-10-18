<?php
include("valida.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Principal - Filmes</title>
    <style>
        body {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1em;
            background-color: #0a100d;
        }

        header .user {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1em;
            font-size: 20px;
            color: white;
        }

        header .user i {
            font-size: 30px;
        }

        header button {
            border: none;
            background-color: transparent;
        }

        header button a {
            padding: .5em 2em;
            text-decoration: none;
            font-size: 20px;
            background-color: #bf0603;
            border-radius: 1em;
            border: none;
            color: white;
            cursor: pointer;
        }

        header button a:hover {
            opacity: .8;
        }

        .container {
            display: flex;
            height: 90vh;
        }

        nav {
            height: 100%;
            width: 15%;
            background-color: #adb5bd;
        }

        nav ul {
            width: 100%;
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            width: 100%;
        }

        nav ul a {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 1em 0;
            border-bottom: 2px solid black;
            background-color: #edede9;
            text-decoration: none;
            color: black;
            width: 100%;
            cursor: pointer;
        }

        nav ul a:hover {
            opacity: .5;
        }

        .conteudo {
            border-left: 2px solid black;
            padding: 0;
            width: 100%;
        }

        .conteudo iframe {
            width: 100%;
            height: 100%;
        }

        .btn-menu {
            display: none;
        }

        @media screen and (max-width: 1020px) {
            nav {
                position: fixed;
                left: 0;
                width: 0%;
                z-index: 1000;
                visibility: hidden;
                height: 100%;
                transition: .5s;
                border-right: 2px solid black;
                overflow-x: auto;
            }

            nav.active {
                visibility: visible;
                left: 0;
                width: 50%;
            }

            .btn-menu {
                display: block;
                font-size: 30px;
                cursor: pointer;
                color: white;
            }
        }
    </style>
    <script defer>
        function iframe(page) {
            document.getElementById('iframe').src = page;
        }

        function menu() {
            var nav = document.getElementById('menu');
            nav.classList.toggle('active');
        }

        function closeMenu() {
            var itens = document.getElementById('itens')
            itens.classList.remove('active');
        }
    </script>
</head>

<body>
    <header>
        <button onclick="menu()" class="btn-menu"><i class="bi bi-list"></i></button>
        <div class="user">
            <i class="bi bi-person-circle"></i>
            <p>Ola <?php echo $_SESSION["nome"]; ?></p>
        </div>
        <button><a href="sair.php">Sair</a></button>
    </header>
    <div class="container">
        <nav id="menu">
            <ul id="itens">
                <?php
                if ($_SESSION["tipo"] == "comum") {
                    echo "
                        <li><a onclick=" . "iframe('inicio.php')" . ">Inicio</a></li>
                        <li><a onclick=" . "iframe('filmes.php')" . ">Filmes</a></li>
                        <li><a onclick=" . "iframe('favoritos.php')" . ">Favoritos</a></li>
                    ";
                } elseif ($_SESSION["tipo"] == "adm") {
                    echo "
                        <li><a onclick=" . "iframe('usuarios.php')" . ">Inicio</a></li>
                        <li><a onclick=" . "iframe('cadastro.php')" . ">Cadastro</a></li>
                        <li><a onclick=" . "iframe('busca.php')" . ">Busca</a></li>
                        <li><a onclick=" . "iframe('edita.php')" . ">Edição</a></li>
                        <li><a onclick=" . "iframe('deleta.php')" . ">Deletar</a></li>
                        <li><a onclick=" . "iframe('cadastro_filme.php')" . ">Cadastrar Filme</a></li>
                        <li><a onclick=" . "iframe('filmes_adm.php')" . ">Filmes</a></li>
                ";
                }
                ?>
            </ul>
        </nav>
        <div class="conteudo">
            <iframe id="iframe" src="inicio.php" frameborder="0"></iframe>
        </div>
    </div>
</body>

</html>