<?php
include("../admin/conexao.php");
include("../action/valida.php");

$id = $_GET['id'];

$sql = "SELECT * FROM filmes WHERE id = '$id'";
$resultado = $conn->query($sql);

while ($row = $resultado->fetch_assoc()) {
    $link = $row['filme'];
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    body {
        height: 100vh;
    }

    video {
        width: 100%;
        height: 100%;
    }
    </style>
</head>

<body>
    <video autoplay controls>
        <source type="video/mp4" src="<?php echo $link ?>">
    </video>
</body>

</html>