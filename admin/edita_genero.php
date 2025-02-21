<?php
include("../handler/utils/valida.php");
include("../handler/utils/conexao.php");

verificarPermissao(['adm']);

$sql = 'SELECT * FROM generos WHERE id = ' . $_POST['id'];
$resultado = $conn->query($sql);
$row = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="shortcut icon" href="../assets/img/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/form.css?v=<?php echo time(); ?>">
    <title>Editar Genero</title>
</head>

<body>
    <?php include("../includes/load.php") ?>
    <?php include("../includes/header.php") ?>
    <div class="conteudo">
        <?php include("../includes/nav.php") ?>
        <div class="container">
            <form action="../handler/genero/editar_genero.php" method="post">
                <h2>Editar <?php echo $row['genero'] ?></h2>
                <div class="img">
                    <i class="bi bi-tags-fill"></i>
                </div>
                <label for="novoGenero">Genero: </label>
                <div class="novo-genero">
                    <i class="bi bi-pencil-square"></i>
                    <input type="text" name="genero" value="<?php echo $row['genero'] ?>" id="novoGenero"
                        placeholder="Genero: " required>
                    <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                </div>
                <input type="submit" value="Editar">
            </form>
        </div>
    </div>
</body>

</html>