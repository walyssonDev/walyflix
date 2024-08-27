<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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