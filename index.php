<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
            width: 20%;
            background-color: #0a100d;
            padding: 3em;
            color: white;
            border-radius: 1em;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        }

        .container a {
            color: white;
        }

        .img i{
            font-size: 100px;
        }

        .cpf,
        .senha {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #219ebc;
            border-radius: 1em;
            font-size: 20px;
        }

        .cpf i,
        .senha i {
            margin: 0 1em;
        }

        form {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        form label {
            margin-top: 1em;
        }

        form input {
            border-radius: 0 1em 1em 0;
            border: none;
            padding: .5em;
            height: 100%;
            width: 100%;
        }

        form input[type="submit"] {
            background-color: #219ebc;
            color: white;
            border-radius: 1em;
            width: 100%;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            margin: 1em 0;
        }

        form input[type="submit"]:hover {
            opacity: .7;
        }
    </style>
</head>

<body>
    <div class="container">
        <form method="post" action="login.php">
            <h1>Login</h1>
            <div class="img">
                <i class="bi bi-person-circle"></i>
            </div>
            <label for="cpf">CPF: </label>
            <div class="cpf">
                <i class="bi bi-person-fill"></i>
                <input type="text" name="cpf" id="cpf" placeholder="Seu CPF" required>
            </div>
            <label for="senha">Senha: </label>
            <div class="senha">
                <i class="bi bi-lock-fill"></i>
                <input type="password" name="senha" id="senha" placeholder="Sua senha" required>
            </div>
            <input type="submit" value="Enviar">
        </form>
        <a href="cadastrese.php">Cadastre-se</a>
    </div>
</body>

</html>