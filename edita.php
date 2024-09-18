<?php
include("conexao.php");
include("valida.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Editar</title>
    <style>
    body {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
        background-color: #118ab2;
        color: white;
        cursor: pointer;
    }

    table input[type="submit"]:hover {
        background-color: #073b4c;
    }
    </style>
</head>

<body>
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
                echo "<form action = 'editar.php' method = 'POST'>";
                echo "<tr>";
                echo "<td> <input type = 'text' name = 'cpf' required value = '" . $row["cpf"] . "'> </td>";
                echo "<td> <input type = 'text' name = 'nome' required value = '" . $row["nome"] . "'> </td>";
                echo "<td> <input type = 'text' name = 'senha' required value = '" . $row["senha"] . "'> </td>";

                echo "<td> 
                        <input type = 'hidden' name = 'cpfAnterior' value = '" . $row["cpf"] . "'>
                        <input type = 'submit' value = 'Editar'>";
                echo "</tr>";
                echo "</form>";
            }
            ?>
        </table>
    </div>
</body>

</html>