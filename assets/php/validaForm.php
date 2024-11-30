<?php
function validarNome($nome)
{
    if (strlen($nome) < 3) {
        return false;
    }

    if (!preg_match('/^[a-zA-Z ]+$/', $nome)) {
        return false;
    }

    return true;
}

function mascararCPF($cpf)
{
    $cpf = preg_replace('/\D/', '', $cpf);
    $cpf = substr_replace($cpf, '.', 3, 0);
    $cpf = substr_replace($cpf, '.', 7, 0);
    $cpf = substr_replace($cpf, '-', 11, 0);
    return $cpf;
}

function validarCPF($cpf)
{
    $cpf = preg_replace('/\D/', '', $cpf);

    if (strlen($cpf) != 11 || preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }

    return true;
}

function validarSenha($senha)
{
    if (strlen($senha) < 6) {
        return "A senha deve ter pelo menos 6 caracteres!";
    }

    $temMaiuscula = preg_match('/[A-Z]/', $senha);
    $temMinuscula = preg_match('/[a-z]/', $senha);
    $temNumero = preg_match('/[0-9]/', $senha);
    $temEspecial = preg_match('/[@!.\%\?\&\*\$#]/', $senha);

    if (!$temEspecial) {
        return "A senha deve conter ao menos um caractere especial!";
    }
    if (!$temMaiuscula) {
        return "A senha deve conter ao menos uma letra maiúscula!";
    }
    if (!$temMinuscula) {
        return "A senha deve conter ao menos uma letra minúscula!";
    }
    if (!$temNumero) {
        return "A senha deve conter ao menos um número!";
    }

    return true;
}

function validarForm($nome, $cpf, $senha)
{
    if (!validarNome($nome)) {
        return "Nome inválido.";
    }

    if (!validarCPF($cpf)) {
        return "CPF inválido.";
    }

    $validaSenha = validarSenha($senha);
    if ($validaSenha !== true) {
        return $validaSenha;
    }

    return true;
}
