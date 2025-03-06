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
    <title>Filme de Destaque</title>
    <link rel="stylesheet" href="../assets/css/tabela.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php include("../includes/load.php") ?>
    <?php include("../includes/header.php") ?>
    <div class="conteudo">
        <?php include("../includes/nav.php") ?>
        <div class="container">
            <div class="top">
                <h2>Filmes</h2>
            </div>
            <table>
                <tr>
                    <th>Nome</th>
                    <th>Ação</th>
                </tr>
                <?php
                $sql = "SELECT * FROM filmes";
                $resultado = $conn->query($sql);

                while ($row = $resultado->fetch_assoc()) {
                    if (strpos($row['filme'], 'dropbox.com') !== false) {
                        echo "<tr " . (($row['destaque'] == 1) ? "id='destacado'" : '') . ">";
                        echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
                        echo "<td " . (($row['destaque'] == 1) ? "style='background-color:#1a8f2d'" : '') . ">";
                        if ($row['destaque'] != 1) {
                            echo "<form action='../handler/filme/destacar.php' method='post'>
                                    <input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "'>
                                    <button id='destacar' type='submit'>Destacar</button>
                                  </form>";
                        }
                        echo "</td></tr>";
                    }
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
    <script src="../assets/js/validaForm.js"></script>
</body>

</html>