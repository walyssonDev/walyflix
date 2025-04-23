<?php
include("../handler/utils/conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="shortcut icon" href="../assets/img/icon.png" type="image/x-icon">
    <link rel="shortcut icon" href="../assets/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/form.css?v=<?php echo time(); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Rochester&display=swap"
        rel="stylesheet">
    <title>Recuperar senha</title>
</head>

<body>
    <div class="container" id="index">
        <h1>WalyFlix</h1>
        <form action="../handler/usuario/recuperar_senha.php" method="post">
            <h2>Recuperar senha</h2>
            <p>Uma mensagem chegara no seu email.</p>
            <label for="cpf">CPF: </label>
            <div class="cpf">
                <i class="bi bi-person-vcard"></i>
                <input type="text" name="cpf" id="cpf" placeholder="Seu CPF: " required>
            </div>
            <label for="email">E-mail: </label>
            <div class="email">
                <i class="bi bi-envelope"></i>
                <input type="email" name="email" id="email" placeholder="Seu email: " required>
            </div>
            <input type="submit" value="Enviar">
            <a href="login.php">Voltar</a>
        </form>
    </div>
    <script>
    <?php
        if (isset($_GET['resposta'])) {
            echo "alert('" . $_GET['resposta'] . "')";
        }
        ?>
    </script>
    <script src="../assets/js/validaForm.js"></script>
</body>

</html>