<?php
include("valida.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>BEM VINDO USUARIO <?php if ($_SESSION['tipo'] == "comum") {
                                echo "PADRÃO";
                            } elseif ($_SESSION['tipo'] == "adm") {
                                echo "ADMINISTRADOR";
                            } ?></h1>
</body>

</html>