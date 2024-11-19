<?php
include("../action/valida.php");
include("../admin/conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="shortcut icon" href="../assets/icon.png" type="image/x-icon">
    <title>Principal - Filmes</title>
    <link rel="stylesheet" href="../assets/principal.css?v=<?php echo time(); ?>">

    <script defer>
    function iframe(page) {
        document.getElementById('iframe').src = page;
    }

    function menu() {
        var nav = document.getElementById('menu');
        nav.classList.toggle('active');
    }
    </script>
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
            <a href="uparImg.php">
                <img src="../action/userImg.php" alt="Foto de Perfil">
            </a>
            <p>Olá, <?php echo $_SESSION["nome"]; ?>.</p>
        </div>
        <button><a href="../action/sair.php">Sair</a></button>
    </header>
    <div class="container" onclick="menu()">
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
                        <li><a onclick=" . "iframe('../admin/generos.php')" . ">Generos</a></li>
                        <li><a onclick=" . "iframe('../admin/filmes_adm.php')" . ">Filmes</a></li>
                        <li><a onclick=" . "iframe('../admin/phpinfo.php')" . ">Info PHP</a></li>
                ";
                }
                ?>
            </ul>
        </nav>
        <div class="conteudo">
            <iframe id="iframe" src="inicio.php" frameborder="0"></iframe>
        </div>
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