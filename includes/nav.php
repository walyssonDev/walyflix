<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/nav.css">
    <title>nav</title>
</head>

<body>
    <nav id="menu" onclick="menu()">
        <ul id="itens">
            <?php
            if ($_SESSION["tipo"] == "comum") {
                echo "
                        <li><a href='inicio.php'>Inicio</a></li>
                        <li><a href='filmes.php'>Filmes</a></li>
                        <li><a href='favoritos.php'>Favoritos</a></li>
                    ";
            } elseif ($_SESSION["tipo"] == "adm") {
                echo "
                        <li><a href='../admin/usuarios.php'>Inicio</a></li>
                        <li><a href='../admin/cadastro.php'>Cadastro</a></li>
                        <li><a href='../admin/busca.php'>Busca</a></li>
                        <li><a href='../admin/edita.php'>Edição</a></li>
                        <li><a href='../admin/deleta.php'>Deletar</a></li>
                        <li><a href='../admin/cadastro_filme.php'>Cadastrar Filme</a></li>
                        <li><a href='../admin/generos.php'>Generos</a></li>
                        <li><a href='../admin/filmes_adm.php'>Filmes</a></li>
                        <li><a href='../admin/phpinfo.php'>Info PHP</a></li>
                ";
            }
            ?>
        </ul>
    </nav>
</body>

</html>