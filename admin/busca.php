<?php
include("conexao.php");
include("../action/valida.php");

verificarPermissao(['adm']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busca</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/form.css">
    <link rel="stylesheet" href="../assets/tabela.css">
</head>

<body>
    <div class="container">
        <form method="post">
            <h1>Buscar</h1>
            <div class="img">
                <i class="bi bi-search"></i>
            </div>
            <label for="nome">Nome: </label>
            <div class="nome">
                <i class="bi bi-person-fill"></i>
                <input type="text" name="nome" id="nome" placeholder="Nome">
            </div>
            <label for="cpf">CPF: </label>
            <div class="cpf">
                <i class="bi bi-lock-fill"></i>
                <input type="text" name="cpf" id="cpf" placeholder="CPF">
            </div>
            <input type="submit" value="Enviar">
        </form>
        <?php

        if (isset($_POST['cpf']) || isset($_POST['nome'])) {

            $cpf = $_POST["cpf"];
            $nome = $_POST["nome"];

            $sqlCPF = "SELECT * FROM usuarios WHERE cpf = '$cpf'";
            $sqlNome = "SELECT * FROM usuarios WHERE nome LIKE '%$nome%'";

            if (!empty($_POST['cpf']) && empty($_POST['nome'])) {
                $sql = $sqlCPF;
            } elseif (!empty($_POST['nome']) && empty($_POST['cpf'])) {
                $sql = $sqlNome;
            } else {
                echo "Pesquise apenas pelo nome ou pelo CPF";
            }

            if (isset($sql)) {
                $resultado = $conn->query($sql);

                echo "<table>";
                echo "<tr>";
                echo "<th>CPF</th>";
                echo "<th>Nome</th>";
                echo "<th>Senha</th>";
                echo "</tr>";
                echo "<tr>";

                if ($resultado->num_rows > 0) {

                    while ($row = $resultado->fetch_assoc()) {

                        echo "<td>" . $row['cpf'] . "</td>";
                        echo "<td>" . $row['nome'] . "</td>";
                        echo "<td>" . $row['senha'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<td>Usuario</td>";
                    echo "<td>Não</td>";
                    echo "<td>Encontrado</td>";
                    echo "</tr>";
                }
                echo "</table>";
                echo "</table>";
            }
        }

        ?>
    </div>
</body>

</html>