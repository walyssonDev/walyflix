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
    <title>Cadastro usuarios</title>
    <link rel="stylesheet" href="../assets/form.css">
</head>

<body>
    <div class="container">
        <form method="post" action="../action/cadastrar_filme.php" enctype="multipart/form-data">
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
            <label for="file">Arquivo: </label>
            <div class="file">
                <i class="bi bi-file-earmark-fill"></i>
                <input type="file" name="filme" accept=".mp4" required>
            </div>
            <input type="submit" value="Enviar">
        </form>
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