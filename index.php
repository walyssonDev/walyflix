<?php
session_start();

// Se o usuário já estiver logado, redireciona para inicio.php
if (isset($_SESSION['cpf'])) {
    header("Location: pages/inicio.php");
    exit;
}

// Se não houver sessão, mas existir um cookie, restaura os dados do usuário
if (!isset($_SESSION['cpf']) && isset($_COOKIE['cpf_usuario'])) {
    include("utils/conexao.php"); // Ajuste o caminho se necessário

    $cpf = $_COOKIE['cpf_usuario'];
    $sql = "SELECT nome, email, tipo FROM usuarios WHERE cpf = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $cpf);
    $stmt->execute();
    $stmt->bind_result($nome, $email, $tipo);
    $stmt->fetch();

    if (!empty($nome)) {
        $_SESSION["cpf"] = $cpf;
        $_SESSION["email"] = $email;
        $_SESSION["nome"] = $nome;
        $_SESSION["tipo"] = $tipo;

        header("Location: pages/inicio.php");
        exit;
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="shortcut icon" href="assets/img/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/form.css?v=<?php echo time(); ?>">
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
    <div class="container" id="index">
        <h1>WalyFlix</h1>
        <form method="post" action="handler/usuario/login.php">
            <h2>Login</h2>
            <div class="img">
                <i class="bi bi-person-circle"></i>
            </div>
            <label for="cpf">CPF: </label>
            <div class="cpf">
                <i class="bi bi-person-fill"></i>
                <input type="text" name="cpf" id="cpf" placeholder="Seu CPF" required>
            </div>
            <label for="senha">Senha: </label>
            <div class="senha">
                <i class="bi bi-lock-fill"></i>
                <input type="password" name="senha" id="senha" placeholder="Sua senha" required>
            </div>
            <input type="submit" value="Enviar">
            <a href="pages/cadastrese.php">Cadastre-se</a>
            <a href="pages/rec_senha.php">Esqueceu a senha?</a>
        </form>
    </div>

    <script>
        <?php
        if (isset($_GET['resposta'])) {
            echo "alert('" . $_GET['resposta'] . "')";
        }
        ?>
    </script>
    <script src="assets/js/validaForm.js"></script>
</body>

</html>