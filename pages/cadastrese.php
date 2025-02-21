<?php
include("../handler/utils/conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="shortcut icon" href="../assets/img/icon.png" type="image/x-icon">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Rochester&display=swap"
        rel="stylesheet">
    <title>Cadastro usuarios</title>
    <link rel="stylesheet" href="../assets/css/form.css?v=<?php echo time(); ?>">
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
    <div class="container" id="index">
        <h1>WalyFlix</h1>
        <form method="post" action="../handler/usuario/cadastrar.php">
            <h2>Cadastrar</h2>
            <div class="img">
                <i class="bi bi-person-plus"></i>
            </div>
            <label for="nome">Nome: </label>
            <div class="nome">
                <i class="bi bi-person-fill"></i>
                <input type="text" name="nome" id="nome" placeholder="Seu nome: " required>
            </div>
            <label for="cpf">CPF: </label>
            <div class="cpf">
                <i class="bi bi-person-vcard-fill"></i>
                <input type="text" name="cpf" id="cpf" placeholder="Seu CPF: " required>
            </div>
            <label for="email">E-mail: </label>
            <div class="email">
                <i class="bi bi-envelope"></i>
                <input type="email" name="email" id="email" placeholder="Seu E-mail: " required>
            </div>
            <label for="senha">Senha: </label>
            <div class="senha">
                <i class="bi bi-lock-fill"></i>
                <input type="password" name="senha" id="senha" placeholder="Sua senha: " required>
            </div>
            <input type="submit" value="Enviar">
            <input type="hidden" name="cadastro" value="cadastro">
            <a href="../index.php">Login</a>
        </form>
    </div>
    <script>
    <?php
        if (isset($_SESSION['resposta'])) {
            echo "alert('" . $_SESSION['resposta'] . "')";
            unset($_SESSION['resposta']);
        }
        ?>
    </script>
    <script src="../assets/js/validaForm.js"></script>
</body>

</html>