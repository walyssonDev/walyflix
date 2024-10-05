<!DOCTYPE html>
<html lang="en">

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
        <source type="video/mp4" src="set_filme.php?id=<?php echo $_GET['id'] ?>">
    </video>
</body>

</html>