<?php
include("../action/valida.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/img/icon.png" type="image/x-icon">
    <title>Document</title>
    <style>
        body {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        h1 {
            margin: 1em;
        }
    </style>
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
    <?php include("../includes/header.php") ?>
    <div class="conteudo">
        <?php include("../includes/nav.php") ?>
        <h1>BEM VINDO USUARIO <?php if ($_SESSION['tipo'] == "comum") {
                                    echo "PADRÃO";
                                } elseif ($_SESSION['tipo'] == "adm") {
                                    echo "ADMINISTRADOR";
                                } ?></h1>
    </div>
</body>

</html>