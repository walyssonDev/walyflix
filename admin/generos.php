<?php
include("../handler/utils/valida.php");
include("../handler/utils/conexao.php");

verificarPermissao(['adm']);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="shortcut icon" href="../assets/img/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/tabela.css?v=<?php echo time(); ?>">
    <title>Generos</title>
</head>

<body>
    <?php include("../includes/load.php") ?>
    <?php include("../includes/header.php") ?>
    <div class="conteudo">
        <?php include("../includes/nav.php") ?>
        <div class="container">
            <div class="top">
                <h2>Generos</h2>
                <a href="../admin/cadastrar_genero.php"><i class="bi bi-plus-circle"> Novo genero</i></a>
            </div>
            <table>
                <tr>
                    <th>Genero</th>
                    <th colspan="2">Ação</th>
                </tr>
                <?php
                $sql = "SELECT * FROM generos";
                $resultado = $conn->query($sql);

                while ($row = $resultado->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['genero']) . "</td>";
                    echo "<td>
                        <form action='edita_genero.php' method='post'>
                            <input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "'>
                            <button  id='edita' type='submit'>Editar</button>
                        </form>
                      </td>";
                    echo "<td>
                        <form action='../handler/genero/deletar_genero.php' method='post'>
                            <input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "'>
                            <button  id='deleta' type='submit'>Deletar</button>
                        </form>
                      </td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </div>
    <script>
        <?php
        if (isset($_SESSION['resposta'])) {
            echo "alert('" . $_SESSION['resposta'] . "')";
            unset($_SESSION['resposta']);
        }
        ?>
    </script>
</body>

</html>