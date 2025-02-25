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
    <title>Usuarios</title>
    <link rel="stylesheet" href="../assets/css/tabela.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php include("../includes/load.php") ?>
    <?php include("../includes/header.php") ?>
    <div class="conteudo">
        <?php include("../includes/nav.php") ?>
        <div class="container">
            <table id="usuariosTable">
                <tr>
                    <th>Status</th>
                    <th>Nome</th>
                    <th colspan="2">Ações</th>
                </tr>
                <?php
                $sql = "SELECT * FROM usuarios";
                $resultado = $conn->query($sql);

                while ($row = $resultado->fetch_assoc()) {
                    echo "<tr data-cpf='" . $row["cpf"] . "'>";
                    echo "<td><i class='bi bi-circle-fill " . ($row["status"] == 1 ? 'ativo' : 'inativo') . "'></i></td>";
                    echo "<td>" . $row["nome"] . "</td>";
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
                }
                ?>
            </table>
        </div>
    </div>
    <script>
        function atualizarStatusTabela() {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "buscar_status.php", true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var usuarios = JSON.parse(xhr.responseText);
                    usuarios.forEach(function(usuario) {
                        var row = document.querySelector("tr[data-cpf='" + usuario.cpf + "']");
                        if (row) {
                            var statusIcon = row.querySelector("i");
                            if (usuario.status == 1) {
                                statusIcon.classList.remove('inativo');
                                statusIcon.classList.add('ativo');
                            } else {
                                statusIcon.classList.remove('ativo');
                                statusIcon.classList.add('inativo');
                            }
                        }
                    });
                }
            };
            xhr.send();
        }

        setInterval(atualizarStatusTabela, 500);

        <?php
        if (isset($_SESSION['mensagem'])) {
            echo "alert('" . $_SESSION['mensagem'] . "')";
            unset($_SESSION['mensagem']);
        }
        ?>
    </script>
</body>

</html>