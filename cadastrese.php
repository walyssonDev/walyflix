<?php
include("conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Cadastro usuarios</title>
    <style>
        body {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .img i {
            font-size: 100px;
        }

        .nome,
        .cpf,
        .senha {
            background-color: #219ebc;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 1em;
        }

        .nome i,
        .cpf i,
        .senha i {
            margin: 0 1em;
        }

        form {
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: white;
            align-items: center;
            background-color: #0a100d;
            padding: 3em 4em;
            border-radius: 1em;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        }

        form h1 {
            margin: 0 0 .5em 0;
        }

        form label {
            margin-top: 1em;
        }

        form input {
            border-radius: 0 1em 1em 0;
            border: none;
            padding: .5em;
        }

        form input[type="submit"] {
            background-color: #219ebc;
            color: white;
            width: 100%;
            margin: 1em 0;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            border-radius: 1em;
        }

        form input[type="submit"]:hover {
            opacity: .7;
        }

        form a {
            color: white;
        }
    </style>
</head>

<body>
    <div class="container">
        <form method="post" action="cadastrar.php">
            <h1>Cadastrar</h1>
            <div class="img">
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
            <label for="senha">Senha: </label>
            <div class="senha">
                <i class="bi bi-lock-fill"></i>
                <input type="password" name="senha" id="senha" placeholder="Sua senha" required>
            </div>
            <input type="submit" value="Enviar">
            <input type="hidden" name="cadastro" value="cadastro">
            <a href="index.php">Login</a>
        </form>
    </div>
    <script>
        <?php
        if (isset($_SESSION['resposta'])) {
            echo "alert('" . $_SESSION['resposta'] . "')";
            unset($_SESSION['resposta']);
        }
        ?>

        function validarNome(nome) {
            if (nome.length < 3) {
                return false;
            }

            for (let i = 0; i < nome.length; i++) {
                const char = nome[i];
                if (!((char >= 'A' && char <= 'Z') || (char >= 'a' && char <= 'z') || char === ' ')) {
                    return false;
                }
            }

            return true;
        }

        function mascararCPF(cpf) {
            cpf = cpf.replace(/\D/g, '');
            cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2");
            cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2");
            cpf = cpf.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
            return cpf;
        }

        function validarCPF() {
            let cpf = document.getElementById("cpf").value;
            cpf = cpf.replace(/\D/g, '');

            if (cpf.length !== 11 || cpf.split('').every(c => c === cpf[0])) {
                return false;
            }

            let soma = 0,
                resto;

            for (let i = 1; i <= 9; i++) {
                soma += parseInt(cpf[i - 1] * (11 - i))
            }

            resto = (soma * 10) % 11;

            if (resto === 10 || resto === 11) {
                resto = 0;
            }

            if (resto !== parseInt(cpf[9])) {
                return false;
            }

            soma = 0;

            for (let i = 1; i <= 10; i++) {
                soma += parseInt(cpf[i - 1] * (12 - i));
            }

            resto = (soma * 10) % 11;

            if (resto === 10 || resto === 11) {
                resto = 0;
            }

            if (resto !== parseInt(cpf[10])) {
                return false;
            }

            return true;
        }

        document.getElementById('cpf').addEventListener('input', function() {
            let cpf = this.value.replace(/\D/g, '');
            if (cpf.length > 11) {
                cpf = cpf.slice(0, 11);
            }
            this.value = mascararCPF(cpf);
        });

        function validarSenha() {
            const senha = document.getElementById('senha').value;

            if (senha.length < 6) {
                alert("A senha deve ter pelo menos 6 caracteres!");
                return false;
            }

            let temMaiuscula = false,
                temMinuscula = false,
                temNumero = false,
                temEspecial = false;

            const especiais = ['@', '!', '.', '%', '?', '&', '*', '$', '#'];

            for (let i = 0; i < senha.length; i++) {
                const char = senha[i];

                if (char >= 'A' && char <= 'Z') {
                    temMaiuscula = true;
                }

                if (char >= 'a' && char <= 'z') {
                    temMinuscula = true;
                }

                if (char >= '0' && char <= '9') {
                    temNumero = true;
                }

                if (especiais.includes(char)) {
                    temEspecial = true;
                }
            }

            if (!temEspecial) {
                alert("A senha tem que ter um caractere especial!");
                return false;
            }

            if (!temMaiuscula) {
                alert("A senha tem que ter uma letra maiuscula!");
                return false;
            }
            if (!temMinuscula) {
                alert("A senha tem que ter uma letra minuscula!");
                return false;
            }
            if (!temNumero) {
                alert("A senha tem que ter um numero!");
                return false;
            }

            return true;
        }

        function validarForm() {
            const nome = document.getElementById("nome").value;

            if (!validarNome(nome)) {
                alert("Nome inválido");
                return false;
            }

            if (!validarCPF()) {
                alert("CPF inválido, coloque os pontos e traços.");
                return false;
            }

            if (!validarSenha()) {
                return false;
            }

            return true;
        }

        document.querySelector('form').addEventListener('submit', function(event) {
            if (!validarForm()) {
                event.preventDefault();
            }
        });
    </script>
</body>

</html>