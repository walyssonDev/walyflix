<?php
include("../admin/conexao.php");
include("../action/valida.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Imagem de Perfil</title>
    <link rel="stylesheet" href="../assets/form.css">
    <link rel="stylesheet" href="../assets/principal.css">
</head>

<body>
    <header>
        <button onclick="menu()" class="btn-menu"><i class="bi bi-list"></i></button>
        <div class="user">
            <a href="principal.php">
                <img src="../action/userImg.php" alt="Foto de Perfil">
            </a>
            <p>Ola <?php echo $_SESSION["nome"]; ?></p>
        </div>
        <button><a href="../action/sair.php">Sair</a></button>
    </header>
    <div class="container">
        <h1>Escolha sua foto de perfil</h1>
        <form method="post" action="../action/uppImg.php" enctype="multipart/form-data">
            <label for="img">Arquivo: </label>
            <div class="file">
                <i class="bi bi-file-earmark-fill"></i>
                <input type="file" name="img" id="img" accept=".jpeg, .jpg" required>
            </div>
            <p>Apenas JPG ou JPEG</p>
            <input type="submit">
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