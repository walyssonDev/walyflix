<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filmes</title>
    <style>
    .interface {
        display: flex;
        flex-wrap: wrap;
        gap: 1em;
    }

    .filme {
        background-color: #023047;
        width: 25%;
        height: 20em;
        color: white;
        border-radius: .5em;
        overflow: hidden;
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        cursor: pointer;
    }

    .filme img {
        width: 100%;
        height: 10em;
    }

    .filme p {
        padding: 0 1em;
    }
    </style>
</head>

<body>
    <div class="interface">
        <article class="filme">
            <img src="https://eivfina4wt8.exactdn.com/wp-content/uploads/2023/11/12112433/divertidamente-2-capa.jpg">
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos distinctio voluptas laboriosam
                similique ex natus laborum suscipit.
            </p>
        </article>
    </div>
</body>

</html>