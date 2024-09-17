<?php
include("conexao.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    body {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 90vh;
        gap: 1em;
        padding-top: 3em;
    }

    form {
        display: flex;
        flex-direction: column;
        justify-content: center;
        color: white;
        align-items: center;
        background-color: #0a100d;
        padding: 2em 10em;
        border-radius: 1em;
        box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
    }

    form h1 {
        margin: 0 0 .5em 0;
    }

    form input {
        margin-bottom: 1em;
        border-radius: 1em;
        border: none;
        padding: .5em;
    }

    form input[type="submit"] {
        background-color: #bf0603;
        color: white;
        width: 100%;
        margin-bottom: 0;
        font-weight: 600;
        font-size: 15px;
        cursor: pointer;
    }

    form input[type="submit"]:hover {
        opacity: .7;
    }

    table {
        width: 50%;
        border-collapse: collapse;
        background-color: #f2f2f2;
    }

    table th,
    td {
        border: 1px solid black;
        text-align: center;
        overflow: hidden;
        padding: 1em;
    }

    table tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    </style>
</head>

<body>
    <div class="container">
        <form method="post">
            <h1>Buscar</h1>
            <label for="nome">Nome: </label>
            <input type="text" name="nome" id="nome" placeholder="Nome">
            <label for="cpf">CPF: </label>
            <input type="text" name="cpf" id="cpf" placeholder="CPF">
            <input type="submit" value="Enviar">
        </form>
        <?php

        if (isset($_POST['cpf']) || isset($_POST['nome'])) {
            $sql = "SELECT * FROM usuarios WHERE cpf = '" . $_POST['cpf'] . "' OR name = '" . $_POST['nome'] . "'";
            $resultado = $conn->query($sql);
            
            while($row = $resultado->fetch_assoc()){
                echo $row["senha"];
            }
        }
        ?>
    </div>
</body>

</html>