<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/index.css">
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
    <div class="container">
        <form method="post" action="action/login.php">
            <h1>Login</h1>
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
        </form>
        <a href="pages/cadastrese.php">Cadastre-se</a>
    </div>

    <script>
    <?php
        if (isset($_GET['resposta'])) {
            echo "alert('" . $_GET['resposta'] . "')";
        }
        ?>
    </script>
    <script src="assets/validaForm.js"></script>
</body>

</html>