<?php
include("../action/valida.php");
include("conexao.php");

verificarPermissao(['adm']);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="shortcut icon" href="../assets/img/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/form.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../assets/css/tabela.css?v=<?php echo time(); ?>">
    <title>Generos</title>
</head>

<body>
    <?php include("../includes/header.php") ?>
    <div class="conteudo">
        <?php include("../includes/nav.php") ?>
        <div class="container">
            <form action="../action/cadastrar_genero.php" method="post">
                <h2>Novo genero</h2>
                <div class="img">
                    <i class="bi bi-clipboard2-plus"></i>
                </div>
                <label for="novoGenero">Genero: </label>
                <div class="novo-genero">
                    <i class="bi bi-plus-circle"></i>
                    <input type="text" name="novoGenero" id="novoGenero" placeholder="Genero: " required>
                </div>
                <input type="submit" value="Enviar">
            </form>
            <table>
                <tr>
                    <th>Genero</th>
                    <th>Ação</th>
                </tr>
                <?php
                $sql = "SELECT * FROM generos";
                $resultado = $conn->query($sql);

                while ($row = $resultado->fetch_assoc()) {
                    echo "<form action='../action/editar_genero.php' method = 'post'>
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