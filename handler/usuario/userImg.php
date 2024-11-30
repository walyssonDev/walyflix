<?php
include("../utils/conexao.php");
include("../utils/valida.php");

$cpf = $_SESSION['cpf'];

$sql = "SELECT img FROM usuarios WHERE cpf = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $cpf);
$stmt->execute();
$stmt->bind_result($imgData);
$stmt->fetch();

if (empty($imgData)) {
  $imgDefault = '<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'10\' height=\'10\' fill=\'#ffffff\' class=\'bi bi-person-circle\' viewBox=\'0 0 32 32\'>
      <path d=\'M22 12a6 6 0 1 1-12 0 6 6 0 0 1 12 0\'/>
      <path fill-rule=\'evenodd\' d=\'M0 16a16 16 0 1 1 32 0A16 16 0 0 1 0 16m16-14a14 14 0 0 0-10.937 22.74C6.484 22.452 9.61 20 16 20s9.516 2.452 10.937 4.74A14 14 0 0 0 16 2\'/>
    </svg>';
  header('Content-Type: image/svg+xml');
  echo $imgDefault;
} else {
  header('Content-Type: image/jpeg');
  echo $imgData;
}
