<?php

require __DIR__ . '/../../../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../../..');
$dotenv->load();

/*$servidor = "localhost";
$usuario = "root";
$senha = "";
$dbname = "cadastro_filmes";*/

$servidor = $_ENV['DB_HOST'];
$usuario = $_ENV['DB_USER'];
$senha = $_ENV['DB_PASS'];
$dbname = $_ENV['DB_NAME'];

$conn = new mysqli($servidor, $usuario, $senha, $dbname);
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
