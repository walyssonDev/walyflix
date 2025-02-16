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
    <link rel="stylesheet" href="../assets/css/form.css?v=<?php echo time(); ?>">
    <title>Novo Genero</title>
</head>

<body>
    <?php include("../includes/load.php") ?>
    <?php include("../includes/header.php") ?>
    <div class="conteudo">
        <?php include("../includes/nav.php") ?>
        <div class="container">
            <form action="../handler/genero/cadastrar_genero.php" method="post">
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
        </div>
    </div>
</body>

</html>