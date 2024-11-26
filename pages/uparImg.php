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
    <link rel="stylesheet" href="../assets/css/form.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="shortcut icon" href="../assets/img/icon.png" type="image/x-icon">
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-VX1YBC3426"></script>
    <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-VX1YBC3426');
    </script>
</head>

<body>
    <header>
        <button onclick="menu()" class="btn-menu"><i class="bi bi-list"></i></button>
        <div class="user">
            <a href="inicio.php">
                <img src="../action/userImg.php" alt="Foto de Perfil">
            </a>
            <p>Olá, <?php echo $_SESSION["nome"]; ?>.</p>
        </div>
        <button><a href="../action/sair.php">Sair</a></button>
    </header>
    <div class="container">
        <form method="post" action="../action/uppImg.php" enctype="multipart/form-data">
            <h1>Escolha sua foto de perfil</h1>
            <img src="../action/userImg.php" alt="Imagem do Usuario" id="previewImg">
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
    document.getElementById('img').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImg').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
    </script>
</body>

</html>