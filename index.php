<html>
    <title>Aula PHP</title>
    <head>
        <script>
            function valida() {
                nome = document.getElementById("nome").value;
                if (nome == "") {
                    alert ("Digite um nome");
                    document.getElementById("nome").focus();
                    return false;
                }
                return true;
            }
        </script>
    </head>
    <body>
        <form method="post" action="login.php" onSubmit="return valida();">
            <input type="text" name="cpf" id="cpf">
            <input type="text" name="senha" id="senha">
        </form>
    </body>
</html>