<?php
session_start();

if (!isset($_SESSION['nome']) || $_SESSION['nome'] == '') {
    session_destroy();
    header("Location: ../index.php");
}

function verificarPermissao($tipos)
{
    if ($_SESSION['tipo'] != "adm") {
        header("Location: ../pages/inicio.php");
    }
}
