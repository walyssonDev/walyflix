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
            <a class="novo-botao" href="../admin/cadastrar_genero.php"><i class="bi bi-plus-circle"> Novo genero</i></a>
            <table>
                <tr>
                    <th>Genero</th>
                    <th>Ação</th>
                </tr>
                <?php
                $sql = "SELECT * FROM generos";
                $resultado = $conn->query($sql);

                while ($row = $resultado->fetch_assoc()) {
                    echo "<form action='../handler/genero/editar_genero.php' method = 'post'>
                            <tr>
                                <td><input type='text' id='genero' name='genero' required value='" . $row['genero'] . "'></td>
                                <input type='hidden' name='id' id='id' value='" . $row['id'] . "'>
                                <td><button id='edita' type='submit'>Editar</button></td>
                            </tr>
                        </form>";
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