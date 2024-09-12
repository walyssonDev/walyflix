<?php
include("valida.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Document</title>
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
            background-color: #ccc5b9;
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
        }

        nav ul a:hover {
            opacity: .5;
        }

        .conteudo {
            border-left: 2px solid black;
            padding: 1em;
        }
    </style>
</head>

<body>
    <header>
        <div class="user">
            <i class="bi bi-person-circle"></i>
            <p>Ola <?php echo $_SESSION["nome"]; ?></p>
        </div>
        <button><a href="sair.php">Sair</a></button>
    </header>
    <div class="container">
        <nav>
            <ul>
                <li><a href="cadastro.php">Cadastro</a></li>
                <li><a href="#">Busca</a></li>
                <li><a href="#">Edição</a></li>
                <li><a href="deleta.php">Deletar</a></li>
            </ul>
        </nav>
        <div class="conteudo">
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio animi quis in culpa labore cupiditate, debitis incidunt expedita, at ipsum praesentium velit. Esse odio molestiae aperiam, error quas aut quis.
            </p>
        </div>
    </div>
</body>

</html>