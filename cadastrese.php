<?php
include("conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Cadastro usuarios</title>
    <style>
    body {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .img i {
        font-size: 100px;
    }

    .nome,
    .cpf,
    .senha {
        background-color: #219ebc;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 0 1em 1em 0;
    }

    .nome i,
    .cpf i,
    .senha i {
        margin: 0 1em;
    }

    form {
        display: flex;
        flex-direction: column;
        justify-content: center;
        color: white;
        align-items: center;
        background-color: #0a100d;
        padding: 3em 4em;
        border-radius: 1em;
        box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
    }

    form h1 {
        margin: 0 0 .5em 0;
    }

    form label {
        margin-top: 1em;
    }

    form input {
        border-radius: 0 1em 1em 0;
        border: none;
        padding: .5em;
    }

    form input[type="submit"] {
        background-color: #219ebc;
        color: white;
        width: 100%;
        margin: 1em 0;
        font-weight: 600;
        font-size: 15px;
        cursor: pointer;
        border-radius: 1em;
    }

    form input[type="submit"]:hover {
        opacity: .7;
    }

    form a {
        color: white;
    }
    </style>
</head>

<body>
    <div class="container">
        <form method="post" action="cadastrar.php">
            <h1>Cadastrar</h1>
            <div class="img">
                <i class="bi bi-person-circle"></i>
            </div>
            <label for="nome">Nome: </label>
            <div class="nome">
                <i class="bi bi-person-fill"></i>
                <input type="text" name="nome" id="nome" placeholder="Seu nome: " required>
            </div>
            <label for="cpf">CPF: </label>
            <div class="cpf">
                <i class="bi bi-person-vcard-fill"></i>
                <input type="text" name="cpf" id="cpf" placeholder="Seu CPF" required>
            </div>
            <label for="senha">Senha: </label>
            <div class="senha">
                <i class="bi bi-lock-fill"></i>
                <input type="password" name="senha" id="senha" placeholder="Sua senha" required>
            </div>
            <input type="submit" value="Enviar">
            <input type="hidden" name="cadastro" value="cadastro">
            <a href="index.php">Login</a>
        </form>
    </div>
</body>

</html>