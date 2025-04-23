<?php
session_start();

if (isset($_SESSION['cpf'])) {
    header("Location: pages/inicio.php");
    exit;
}

if (!isset($_SESSION['cpf']) && isset($_COOKIE['cpf_usuario'])) {
    include("handler/utils/conexao.php");

    $cpf = $_COOKIE['cpf_usuario'];
    $sql = "SELECT nome, email, tipo, senha FROM usuarios WHERE cpf = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $cpf);
    $stmt->execute();
    $stmt->bind_result($nome, $email, $tipo, $senha);
    $stmt->fetch();

    if (!empty($nome)) {
        $_SESSION["cpf"] = $cpf;
        $_SESSION["email"] = $email;
        $_SESSION["nome"] = $nome;
        $_SESSION["tipo"] = $tipo;
        $_SESSION['senha'] = $senha;

        header("Location: pages/inicio.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WalyFlix</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="shortcut icon" href="assets/img/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/index.css?v=<?php echo time(); ?>">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Rochester&display=swap"
        rel="stylesheet">
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
    <style>
        .container {
            padding: 0;
        }
    </style>
</head>

<body>
    <header>
        <h1>WalyFlix</h1>
        <div class="btn-header">
            <a href="pages/login.php">Login</a>
            <a id="cadastro" href="pages/cadastrese.php">Crie sua conta</a>
        </div>

    </header>
    <section id="hero">
        <h2>Filmes, séries e muito mais, sem limites </h2>
        <p>Assista filmes e séries sem anuncios, temos varios preços para melhor atender seu gosto e preferencia,
            aproveite</p>
        <form action="pages/cadastrese.php" method="post">
            <p>Quer assistir? Informe seu email para criar uma conta!</p>
            <div class="input-container">
                <input type="email" name="email" id="email" placeholder="Seu email" required>
                <button type="submit">Vamos lá <i class="bi bi-chevron-right"></i></button>
            </div>
        </form>
    </section>
    <section id="motivos">
        <h2>Nossos diferenciais</h2>
        <div class="card-container">
            <div class="card">
                <h3>Aproveite na TV</h3>
                <p>
                    Assista em Smart TVs, PlayStation, Xbox, Chromecast, Apple TV, aparelhos de Blu-ray e outros
                    dispositivos.
                </p>
                <i class="bi bi-tv"></i>
            </div>
            <div class="card">
                <h3>Baixe séries para assistir offline</h3>
                <p>
                    Salve seus títulos favoritos e sempre tenha algo para assistir.
                </p>
                <i class="bi bi-cloud-download-fill"></i>
            </div>
            <div class="card">
                <h3>Assista onde quiser</h3>
                <p>
                    Assista a quantos filmes e séries quiser no celular, tablet, laptop e TV.
                </p>
                <i class="bi bi-binoculars-fill"></i>
            </div>
            <div class="card">
                <h3>Crie perfis para crianças</h3>
                <p>
                    Deixe as crianças se aventurarem com seus personagens favoritos em um espaço feito só para elas, sem
                    pagar a mais por isso.
                </p>
                <i class="bi bi-people-fill"></i>
            </div>
        </div>
    </section>
    <section id="diferenciais">
        <h2>Por que escolher o WalyFlix?</h2>
        <ul class="diferenciais-lista">
            <li>
                <i class="bi bi-tv"></i>
                <span><strong>Variedade de Dispositivos:</strong> Assista em qualquer lugar, seja na TV, celular, tablet
                    ou computador.</span>
            </li>
            <li>
                <i class="bi bi-cloud-download-fill"></i>
                <span><strong>Download Offline:</strong> Baixe seus filmes e séries favoritos para assistir sem
                    internet.</span>
            </li>
            <li>
                <i class="bi bi-people-fill"></i>
                <span><strong>Perfis Personalizados:</strong> Crie perfis para cada membro da família, incluindo um
                    espaço seguro para crianças.</span>
            </li>
            <li>
                <i class="bi bi-film"></i>
                <span><strong>Catálogo Exclusivo:</strong> Tenha acesso a filmes e séries exclusivos que você só
                    encontra aqui.</span>
            </li>
            <li>
                <i class="bi bi-cash-stack"></i>
                <span><strong>Preços Acessíveis:</strong> Planos que cabem no seu bolso, sem comprometer a
                    qualidade.</span>
            </li>
        </ul>
    </section>
    <footer>
        <div class="footer-container">
            <p>&copy; 2025 WalyFlix. Todos os direitos reservados.</p>
            <ul class="footer-links">
                <li><a href="#">Termos de Uso</a></li>
                <li><a href="#">Política de Privacidade</a></li>
                <li><a href="#">Ajuda</a></li>
            </ul>
        </div>
    </footer>
    <script>
        <?php
        if (isset($_GET['resposta'])) {
            echo "alert('" . $_GET['resposta'] . "')";
        }
        ?>
    </script>
</body>

</html>