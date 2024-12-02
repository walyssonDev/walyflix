<?php
include("../handler/utils/valida.php");
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
            background: url('data:image/svg+xml,%3Csvg%20width%3D%22100%25%22%20height%3D%22100%25%22%20viewBox%3D%220%200%201024%201024%22%20xmlns%3D%22http%3A//www.w3.org/2000/svg%22%3E%3Crect%20width%3D%22100%25%22%20height%3D%22100%25%22%20fill%3D%22%230f172a%22%20/%3E%3Cpath%20d%3D%22M0,0L1024,1024M1024,0L0,1024%22%20stroke%3D%22%232563eb%22%20stroke-width%3D%2210%22/%3E%3C/svg%3E');
        }

        h1 {
            margin: 1em;
            color: #fff;
            filter: drop-shadow(0 0 0.75rem black);
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