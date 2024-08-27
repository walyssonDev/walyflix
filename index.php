<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>

    </style>
</head>

<body>
    <div class="container">
        <div class="txt-form">
            <h1>Login</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti sequi harum quidem dolorum, libero eius? Eius fuga veritatis ex? Iure quas impedit beatae illo deleniti nobis perferendis recusandae magni totam.</p>
        </div>
        <form method="post" action="login.php" onSubmit="return valida();">
            <label for="cpf">CPF: </label>
            <input type="text" name="cpf" id="cpf">
            <label for="senha">Senha: </label>
            <input type="text" name="senha" id="senha">
            <input type="submit" value="Enviar">
        </form>
    </div>
</body>

</html>