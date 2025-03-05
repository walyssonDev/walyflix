<?php
include("../handler/utils/valida.php");
include("../handler/utils/conexao.php");

$id = $_POST['id'];

$sql = "SELECT * FROM filmes WHERE id = '$id'";
$resultado = $conn->query($sql);

while ($row = $resultado->fetch_assoc()) {
    $nome = $row['nome'];
    $img = $row['img'];
    $link = $row['filme'];
    $genero = $row['genero'];
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="shortcut icon" href="../assets/img/icon.png" type="image/x-icon">
    <title>Editar <?= $nome ?></title>
    <link rel="stylesheet" href="../assets/css/form.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php include("../includes/load.php") ?>
    <?php include("../includes/header.php") ?>
    <div class="conteudo">
        <?php include("../includes/nav.php") ?>
        <div class="container">
            <form method="post" action="../handler/filme/editar_filme.php" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <h1><?php echo $nome ?> </h1>
                <div class="img-principal">
                    <i class="bi bi-card-checklist"></i>
                </div>
                <label for="nome">Nome: </label>
                <div class="nome">
                    <i class="bi bi-pencil-square"></i>
                    <input type="text" name="nome" id="nome" value="<?php echo $nome ?>" placeholder="Nome do filme: "
                        required>
                </div>
                <label for="img">Imagem: </label>
                <div class="img">
                    <i class="bi bi-card-image"></i>
                    <input type="text" name="img" id="img" value="<?php echo $img ?>" placeholder="Link da imagem: "
                        required>
                </div>
                <label for="genero">Genero: </label>
                <div class="genero">
                    <i class="bi bi-hash"></i>
                    <select name="genero" id="genero" required>
                        <?php
                        $sql = "SELECT * FROM generos";
                        $resultado = $conn->query($sql);

                        while ($row = $resultado->fetch_assoc()) {
                            echo "<option " . (($row['id'] == $genero) ? "selected" : "") . " value='" . $row['id'] . "'>" . $row['genero'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <label for="file">Link: </label>
                <div class="link">
                    <i class="bi bi-link"></i>
                    <input type="text" name="link" id="link" value="<?php echo $link ?>" placeholder="Link do filme: "
                        required>
                </div>
                <p>DROPBOX ou Google Drive</p>
                <input type="submit" value="Editar">
            </form>
        </div>
    </div>
</body>

</html>