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
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/tabela.css?v=<?php echo time(); ?>">
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
                echo "<tr>";
                echo "<td>" . $row["cpf"] . "</td>";
                echo "<td>" . $row["nome"] . "</td>";
                echo "<td>" . $row["senha"] . "</td>";
                echo "<td> 
                        <form action = '../action/deletar.php' method = 'POST'>
                        <input type = 'hidden' name = 'cpf' value = '" . $row["cpf"] . "'>
                        <input id = 'deleta' type = 'submit' value = 'Deletar'>
                        </form>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>