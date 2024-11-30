<?php
include("../handler/utils/valida.php");
include("../handler/utils/conexao.php");

verificarPermissao('adm');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="shortcut icon" href="../assets/img/icon.png" type="image/x-icon">
    <title>Cadastro usuarios</title>
    <link rel="stylesheet" href="../assets/css/tabela.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php include("../includes/header.php") ?>
    <div class="conteudo">
        <?php include("../includes/nav.php") ?>
        <div class="container">
            <table>
                <tr>
                    <th>CPF</th>
                    <th>Nome</th>
                    <th>Senha</th>
                    <th colspan="2">Ações</th>
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
                        <form action = '../admin/edita_usuario.php' method = 'POST'>
                        <input type = 'hidden' name = 'cpf' value = '" . $row["cpf"] . "'>
                        <button id = 'edita' type = 'submit'>Editar</button>
                        </form>
                        </td>";
                    echo "<td> 
                        <form action = '../handler/usuario/deletar.php' method = 'POST'>
                        <input type = 'hidden' name = 'cpf' value = '" . $row["cpf"] . "'>
                        <input id = 'deleta' type = 'submit' value = 'Deletar'>
                        </form>";
                    echo "</tr>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
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