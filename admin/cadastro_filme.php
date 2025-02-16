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
    <title>Cadastro filmes</title>
    <link rel="stylesheet" href="../assets/css/form.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php include("../includes/load.php") ?>
    <?php include("../includes/header.php") ?>
    <div class="conteudo">
        <?php include("../includes/nav.php") ?>
        <div class="container">
            <form method="post" action="../handler/filme/cadastrar_filme.php" enctype="multipart/form-data">
                <h1>Cadastrar Filme</h1>
                <div class="img">
                    <i class="bi bi-card-checklist"></i>
                </div>
                <label for="nome">Nome: </label>
                <div class="nome">
                    <i class="bi bi-pencil-square"></i>
                    <input type="text" name="nome" id="nome" placeholder="Nome do filme: " required>
                </div>
                <label for="path">Path: </label>
                <div class="path">
                    <i class="bi bi-card-image"></i>
                    <input type="text" name="path" id="path" placeholder="Path da imagem: " required>
                </div>
                <label for="genero">Genero: </label>
                <div class="genero">
                    <i class="bi bi-hash"></i>
                    <select name="genero" id="genero" required>
                        <option value="" disabled selected>Escolha um genero</option>
                        <?php
                        $sql = "SELECT * FROM generos";
                        $resultado = $conn->query($sql);

                        while ($row = $resultado->fetch_assoc()) {
                            echo "<option value='" . $row['id'] . "'>" . $row['genero'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <label for="file">Link: </label>
                <div class="link">
                    <i class="bi bi-link"></i>
                    <input type="text" name="link" placeholder="Link do filme: " required>
                </div>
                <p>DROPBOX ou Google Drive</p>
                <input type="submit" value="Enviar">
            </form>
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