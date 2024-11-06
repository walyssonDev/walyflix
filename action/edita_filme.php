<?php
include("../admin/conexao.php");
include("valida.php");

$id = $_POST['id'];

$sql = "SELECT * FROM filmes WHERE id = '$id'";
$resultado = $conn->query($sql);

while ($row = $resultado->fetch_assoc()) {
    $nome = $row['nome'];
    $path = $row['path'];
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
    <title>Editar filme</title>
    <link rel="stylesheet" href="../assets/form.css?v=<?php echo time(); ?>">
</head>

<body>
    <div class="container">
        <form method="post" action="../action/editar_filme.php" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <h1>Editar <?php echo $nome ?> </h1>
            <div class="img">
                <i class="bi bi-card-checklist"></i>
            </div>
            <label for="nome">Nome: </label>
            <div class="nome">
                <i class="bi bi-pencil-square"></i>
                <input type="text" name="nome" id="nome" value="<?php echo $nome ?>" placeholder="Nome do filme: "
                    required>
            </div>
            <label for="path">Path: </label>
            <div class="path">
                <i class="bi bi-card-image"></i>
                <input type="text" name="path" id="path" value="<?php echo $path ?>" placeholder="Path da imagem: "
                    required>
            </div>
            <label for="genero">Genero: </label>
            <div class="genero">
                <i class="bi bi-hash"></i>
                <select name="genero" id="genero" required>
                    <option value="<?php echo $genero ?>"><?php echo $genero ?></option>
                    <?php
                    $sql = "SELECT * FROM generos";
                    $resultado = $conn->query($sql);

                    while ($row = $resultado->fetch_assoc()) {
                        echo "<option value='" . $row['genero'] . "'>" . $row['genero'] . "</option>";
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
            <p>Apenas DROPBOX</p>
            <input type="submit" value="Editar">
        </form>
    </div>
</body>

</html>