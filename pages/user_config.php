<?php
include("../handler/utils/conexao.php");
include("../handler/utils/valida.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Imagem de Perfil</title>
    <link rel="stylesheet" href="../assets/css/form.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../assets/css/header.css?v=<?php echo time(); ?>">
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
                <img src="../handler/usuario/userImg.php" alt="Foto de Perfil">
            </a>
            <p>Olá, <?php echo $_SESSION["nome"]; ?>.</p>
        </div>
        <button><a href="../handler/usuario/sair.php">Sair</a></button>
    </header>
    <div class="container">
        <form method="post" action="../handler/usuario/uppImg.php" enctype="multipart/form-data">
            <h1>Foto de perfil</h1>
            <img src="../handler/usuario/userImg.php" alt="Imagem do Usuario" id="previewImg">
            <label for="img">Arquivo: </label>
            <div class="file">
                <i class="bi bi-file-earmark-fill"></i>
                <input type="file" name="img" id="img" accept=".jpeg, .jpg" required>
            </div>
            <p>Apenas JPG ou JPEG</p>
            <input type="submit">
        </form>
        <form action="../handler/usuario/editar.php">
            <h2>Suas informações</h2>
            <label for="nome">Seu nome:</label>
            <div class="nome">
                <i class="bi bi-person-fill"></i>
                <input type="text" name="nome" id="nome" placeholder="Seu nome:" value="<?php echo $_SESSION['nome'] ?>"
                    required>
            </div>
            <label for="cpf">Seu CPF:</label>
            <div class="cpf">
                <i class="bi bi-person-vcard-fill"></i>
                <input type="text" name="cpf" id="cpf" placeholder="Seu CPF: " value="<?php echo $_SESSION['cpf'] ?>"
                    required>
            </div>
            <label for="senha">Sua senha:</label>
            <div class="senha">
                <i class="bi bi-lock-fill"></i>
                <input type="text" name="senha" id="senha" placeholder="Sua senha:"
                    value="<?php echo $_SESSION['senha'] ?>" required>
            </div>
            <input type="submit" value="Enviar">
        </form>
    </div>
    <script src="../assets/js/validaForm.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            <?php
            if (isset($_SESSION['resposta'])) {
                echo "alert('" . $_SESSION['resposta'] . "');";
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
        });
    </script>

</body>

</html>