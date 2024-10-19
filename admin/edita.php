<?php
include("conexao.php");
include("../action/valida.php");

verificarPermissao(['adm']);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Editar</title>
    <link rel="stylesheet" href="../assets/tabela.css">
</head>

<body>
    <div class="container">
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
                echo "<form action = '../action/editar.php' method = 'POST'>";
                echo "<tr>";
                echo "<td> <input type = 'text' name = 'cpf' required value = '" . $row["cpf"] . "'> </td>";
                echo "<td> <input type = 'text' name = 'nome' required value = '" . $row["nome"] . "'> </td>";
                echo "<td> <input type = 'text' name = 'senha' required value = '" . $row["senha"] . "'> </td>";
                echo "<td> 
                        <input type = 'hidden' name = 'cpfAnterior' value = '" . $row["cpf"] . "'>
                        <button id = 'edita' type = 'submit'>Editar</button>";
                echo "</tr>";
                echo "</form>";
            }

            ?>
        </table>
    </div>
    <script>
    <?php
        if (isset($_SESSION['mensagem'])) {
            echo "alert('" . $_SESSION['mensagem'] . "')";
            unset($_SESSION['mensagem']);
        }
        ?>
    </script>
</body>

</html>