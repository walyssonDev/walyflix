<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 30%;
            background-color: #0a100d;
            padding: 1em;
            color: white;
            border-radius: 1em;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        }

        form {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        form input {
            margin-bottom: 1em;
            border-radius: 1em;
            border: none;
            padding: .5em;
        }

        form input[type="submit"] {
            background-color: #bf0603;
            color: white;
            width: 100%;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
        }

        form input[type="submit"]:hover {
            opacity: .7;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="txt-form">
            <h1>Login</h1>
        </div>
        <form method="post" action="login.php">
            <label for="cpf">CPF: </label>
            <input type="text" name="cpf" id="cpf" placeholder="Seu CPF" required>
            <label for="senha">Senha: </label>
            <input type="password" name="senha" id="senha" placeholder="Sua senha" required>
            <input type="submit" value="Enviar">
        </form>
    </div>
</body>

</html>