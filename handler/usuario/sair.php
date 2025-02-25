<?php
session_start();
include("../utils/conexao.php");
setcookie("cpf_usuario", "", time() - 3600, "/");
$sqlStatus = "UPDATE usuarios SET status = 0 WHERE cpf = ?";
$stmtStatus = $conn->prepare($sqlStatus);
$stmtStatus->bind_param("s", $_SESSION["cpf"]);
$stmtStatus->execute();
session_destroy();
header("Location: ../../index.php");
exit;
