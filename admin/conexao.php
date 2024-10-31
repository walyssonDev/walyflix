<?php

/*$servidor = "localhost";
$usuario = "root";
$senha = "";
$dbname = "cadastro_filmes";*/

$servidor = "sql305.infinityfree.com";
$usuario = "if0_37334546";
$senha = "8zVebj7zkBN";
$dbname = "if0_37334546_cadastro_filmes";

$conn = new mysqli($servidor, $usuario, $senha, $dbname);
if ($conn->connect_error) {
    die("Falha na conexão" . $conn->connect_error);
}