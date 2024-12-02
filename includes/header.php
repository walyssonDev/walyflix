<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/header.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../assets/css/nav.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>header</title>
    <script>
        function menu() {
            var nav = document.getElementById('menu');
            nav.classList.toggle('active');
        }
    </script>
</head>

<body>
    <header>
        <button onclick="menu()" class="btn-menu"><i class="bi bi-list"></i></button>
        <div class="user">
            <a href="../pages/uparImg.php">
                <img src="../handler/usuario/userImg.php" alt="Foto de Perfil">
            </a>
            <p>Olá, <?php echo $_SESSION["nome"]; ?>.</p>
        </div>
        <button><a href="../handler/usuario/sair.php">Sair</a></button>
    </header>
</body>

</html>