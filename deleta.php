<?php
include("conexao.php");
include("valida.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
            justify-content: center;
            align-items: center;
            flex-direction: column; 
            width: 100%;
            height: 80vh;
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

        table form {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        table input[type="submit"] {
            padding: .7em 1em;
            border-radius: .5em;
            border: none;
            background-color: #bf0603;
            color: white;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <header>
        <div class="user">
            <i class="bi bi-person-circle"></i>
            <p>Ola <?php echo $_SESSION["nome"]; ?></p>
        </div>
        <button><a href="principal.php">Voltar</a></button>
    </header>
    <div class="container">
        <h1>Usuarios</h1>
        <table>
            <tr>
                <th>CPF</th>
                <th>Nome</th>
                <th>Senha</th>
                <th>Ação</th>
            </tr>
            <?php
            $sql = "SELECT * FROM usuarios";
            $resultado = $conn->query($sql);

            while ($row = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["cpf"] . "</td>";
                echo "<td>" . $row["nome"] . "</td>";
                echo "<td>" . $row["senha"] . "</td>";
                echo "<td> 
                        <form action = 'deletar.php' method = 'POST'>
                        <input type = 'hidden' name = 'cpf' value = '" . $row["cpf"] . "'>
                        <input type = 'submit' value = 'Deletar'>
                        </form>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>