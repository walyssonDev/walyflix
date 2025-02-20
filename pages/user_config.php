<?php
include("../handler/utils/conexao.php");
include("../handler/utils/valida.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Configurações</title>
    <link rel="stylesheet" href="../assets/css/form.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../assets/css/header.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="../assets/img/icon.png" type="image/x-icon">
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
    <?php include("../includes/header.php") ?>
    <div class="conteudo">
        <?php include("../includes/nav.php") ?>
        <div class="container">
            <form method="post" class="config" action="../handler/usuario/editar.php" enctype="multipart/form-data">
                <h1>Editar perfil</h1>
                <div class="img-user">
                    <img src="../handler/usuario/userImg.php" alt="Imagem do Usuario" id="previewImg">
                    <div class="file">
                        <i class="bi bi-file-earmark-fill"></i>
                        <label id="input-img" for="img">Selecionar imagem</label>
                        <input type="file" name="img" id="img" accept=".jpeg, .jpg">
                    </div>
                </div>
                <div class="config-nome">
                    <label for="nome">Seu nome:</label>
                    <div class="nome">
                        <i class="bi bi-person-fill"></i>
                        <input type="text" name="nome" id="nome" placeholder="Seu nome: "
                            value="<?php echo $_SESSION['nome'] ?>" required>
                    </div>
                </div>
                <div class="config-cpf">
                    <label for="cpf">Seu CPF:</label>
                    <div class="cpf">
                        <i class="bi bi-person-vcard-fill"></i>
                        <input type="text" name="cpf" id="cpf" placeholder="Seu CPF: "
                            value="<?php echo $_SESSION['cpf'] ?>" required>
                    </div>
                </div>
                <div class="config-email">
                    <label for="email">E-mail: </label>
                    <div class="email">
                        <i class="bi bi-envelope"></i>
                        <input type="email" name="email" id="email" placeholder="Seu E-mail: "
                            value="<?php echo $_SESSION['email'] ?>" required>
                    </div>
                </div>
                <div class="config-senha">
                    <label for="senha">Sua senha:</label>
                    <div class="senha">
                        <i class="bi bi-lock-fill"></i>
                        <input type="text" name="senha" id="senha" placeholder="Sua senha:"
                            value="<?php echo $_SESSION['senha'] ?>" required>
                    </div>
                </div>
                <input type="hidden" name="cpfAnterior" id="cpfAnterior" value="<?php echo $_SESSION['cpf'] ?>">
                <input type="submit" value="Enviar">
            </form>
            <div class="space"></div>
        </div>
    </div>
    <script src="../assets/js/validaForm.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            <?php
            if (isset($_SESSION['resposta'])) {
                echo "alert('" . $_SESSION['resposta'] . "');";
                unset($_SESSION['resposta']);
            }
            ?>

            document.getElementById('img').addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('previewImg').src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>

</body>

</html>