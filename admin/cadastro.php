<?php
include("../handler/utils/valida.php");
include("../handler/utils/conexao.php");

verificarPermissao(['adm']);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="shortcut icon" href="../assets/img/icon.png" type="image/x-icon">
    <title>Cadastro usuarios</title>
    <link rel="stylesheet" href="../assets/css/form.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php include("../includes/load.php") ?>
    <?php include("../includes/header.php") ?>
    <div class="conteudo">
        <?php include("../includes/nav.php") ?>
        <div class="container">
            <form method="post" action="../handler/usuario/cadastrar.php">
                <h1>Cadastrar</h1>
                <div class="img-principal">
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
                    <input type="text" name="cpf" id="cpf" placeholder="Seu CPF" required>
                </div>
                <label for="email">E-mail: </label>
                <div class="email">
                    <i class="bi bi-envelope"></i>
                    <input type="email" name="email" id="email" placeholder="Seu E-mail: " required>
                </div>
                <label for="senha">Senha: </label>
                <div class="senha">
                    <i class="bi bi-lock-fill"></i>
                    <input type="password" name="senha" id="senha" placeholder="Sua senha" required>
                </div>
                <input type="submit" value="Enviar">
            </form>
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
    <script src="../assets/js/validaForm.js"></script>
</body>

</html>