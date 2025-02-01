<?php
require __DIR__ . '/../../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(__DIR__, 2), 'senha.env');
$dotenv->load();

// Debugging: Verificar se as variáveis de ambiente foram carregadas
var_dump($_ENV);

if (!isset($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_NAME'])) {
    die('Erro: Variáveis de ambiente não carregadas corretamente.');
}

/*$servidor = "localhost";
$usuario = "root";
$senha = "";
$dbname = "cadastro_filmes";*/

$servidor = $_ENV['DB_HOST'];
$usuario = $_ENV['DB_USER'];
$senha = $_ENV['DB_PASS'];
$dbname = $_ENV['DB_NAME'];

// Debugging: Exibir os valores das variáveis de ambiente
echo "DB_HOST: $servidor\n";
echo "DB_USER: $usuario\n";
echo "DB_PASS: $senha\n";
echo "DB_NAME: $dbname\n";

$conn = new mysqli($servidor, $usuario, $senha, $dbname);
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Código adicional para manipulação do banco de dados pode ser adicionado aqui
