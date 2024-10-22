<?php
include("../admin/conexao.php");
include("../action/valida.php");

$id = $_GET['id'];

$sql = "SELECT * FROM filmes WHERE id = '$id'";
$resultado = $conn->query($sql);

$link = ""; // Initialize $link
while ($row = $resultado->fetch_assoc()) {
    $link = $row['filme'];
}

$extensao = pathinfo($link, PATHINFO_EXTENSION);

// Debug: Check the video link
if (empty($link)) {
    echo "No video link found.";
    exit; // Stop further execution
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
    }
    </style>
</head>

<body>
    <video autoplay controls>
        <?php
        if ($extensao === "mp4") {
            echo "<source type='video/mp4' src='" . $link . "'>";
        } elseif ($extensao === "mkv") {
            echo "<source type='video/x-matroska' src='" . $link . "'>";
        } else {
            echo "<p>Formato de vídeo não suportado.</p>";
        }
        ?>
    </video>
</body>

</html>