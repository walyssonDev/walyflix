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
            <label for="cpf">CPF: </label>
            <input type="text" name="cpf" id="cpf">
            <label for="senha">Senha: </label>
            <input type="text" name="senha" id="senha">
            <input type="submit" value="Enviar">
        </form>
    </body>
</html>