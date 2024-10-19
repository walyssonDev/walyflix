<?php
include("../action/valida.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Principal - Filmes</title>
    <link rel="stylesheet" href="../assets/principal.css">

    <script defer>
    function iframe(page) {
        document.getElementById('iframe').src = page;
    }

    function menu() {
        var nav = document.getElementById('menu');
        nav.classList.toggle('active');
    }

    function closeMenu() {
        var itens = document.getElementById('itens')
        itens.classList.remove('active');
    }
    </script>
</head>

<body>
    <header>
        <button onclick="menu()" class="btn-menu"><i class="bi bi-list"></i></button>
        <div class="user">
            <i class="bi bi-person-circle"></i>
            <p>Ola <?php echo $_SESSION["nome"]; ?></p>
        </div>
        <button><a href="../action/sair.php">Sair</a></button>
    </header>
    <div class="container">
        <nav id="menu">
            <ul id="itens">
                <?php
                if ($_SESSION["tipo"] == "comum") {
                    echo "
                        <li><a onclick=" . "iframe('inicio.php')" . ">Inicio</a></li>
                        <li><a onclick=" . "iframe('filmes.php')" . ">Filmes</a></li>
                        <li><a onclick=" . "iframe('favoritos.php')" . ">Favoritos</a></li>
                    ";
                } elseif ($_SESSION["tipo"] == "adm") {
                    echo "
                        <li><a onclick=" . "iframe('../admin/usuarios.php')" . ">Inicio</a></li>
                        <li><a onclick=" . "iframe('../admin/cadastro.php')" . ">Cadastro</a></li>
                        <li><a onclick=" . "iframe('../admin/busca.php')" . ">Busca</a></li>
                        <li><a onclick=" . "iframe('../admin/edita.php')" . ">Edição</a></li>
                        <li><a onclick=" . "iframe('../admin/deleta.php')" . ">Deletar</a></li>
                        <li><a onclick=" . "iframe('../admin/cadastro_filme.php')" . ">Cadastrar Filme</a></li>
                        <li><a onclick=" . "iframe('../admin/filmes_adm.php')" . ">Filmes</a></li>
                ";
                }
                ?>
            </ul>
        </nav>
        <div class="conteudo">
            <iframe id="iframe" src="inicio.php" frameborder="0"></iframe>
        </div>
    </div>
</body>

</html>