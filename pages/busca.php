<?php
include("../handler/utils/valida.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/img/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/busca.css?v=<?php echo time(); ?>">
    <title>WalyFlix</title>
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
    <?php include("../includes/load.php") ?>
    <?php include("../includes/header.php") ?>
    <?php include("../includes/nav.php") ?>
    <div class="conteudo">
        <div class="container">
            <div class="input-busca">
                <form action="" method="post">
                    <input type="text" name="busca" id="busca" placeholder="Buscar..." required>
                    <i class="bi bi-search"></i>
                </form>
            </div>
            <div id="loading" style="display: none;">Carregando...</div>
            <div id="resultados-busca"></div>
        </div>
    </div>
    <script>
        <?php
        if (isset($_SESSION['resposta'])) {
            echo "alert('" . $_SESSION['resposta'] . "')";
            unset($_SESSION['resposta']);
        }
        if (isset($_SESSION['mensagem'])) {
            echo "alert('" . $_SESSION['mensagem'] . "')";
            unset($_SESSION['mensagem']);
        }
        ?>
        document.getElementById('busca').addEventListener('input', function() {
            var query = this.value;
            var loading = document.getElementById('loading');
            var resultadosBusca = document.getElementById('resultados-busca');

            if (query.length > 0) {
                loading.style.display = 'block';
                var xhr = new XMLHttpRequest();
                xhr.open('post', '../handler/busca/buscar.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        resultadosBusca.innerHTML = xhr.responseText;
                        loading.style.display = 'none';
                    }
                };
                xhr.send('busca=' + encodeURIComponent(query));
            } else {
                resultadosBusca.innerHTML = '';
                loading.style.display = 'none';
            }
        });

        setInterval(() => {
            fetch("../handler/usuario/atualiza_status.php");
        }, 30000);
    </script>
</body>

</html>