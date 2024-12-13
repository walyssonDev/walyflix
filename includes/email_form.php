<!DOCTYPE html>
<html lang='pt-br'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Senha de Recuperação</title>
    <style>
        * {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: #1e293b;
            padding: 2rem;
            border-radius: 1em;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.4);
            max-width: 400px;
        }

        h1 {
            font-size: 1.8rem;
            color: #3b82f6;
            margin-bottom: 1em;
            text-align: center;
        }

        .message {
            color: #e2e8f0;
            margin-bottom: 1em;
            font-size: 1.1rem;
            text-align: center;
        }

        .input-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            margin-bottom: 1em;
            border: 2px solid #94a3b8;
            border-radius: 8px;
            background-color: #0f172a;
            padding: .2rem;
        }

        input {
            font-size: 1.2rem;
            padding: 0.75rem;
            width: 100%;
            border: none;
            background-color: transparent;
            color: #e2e8f0;
            outline: none;
            text-align: center;
        }

        .footer {
            font-size: 0.9rem;
            color: #94a3b8;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class='container'>
        <h1>Senha de Recuperação</h1>
        <div class='message'>Essa é a sua senha de recuperação, troque ela o mais rápido possível:</div>

        <div class='input-container'>
            <input type='text' id='password' value='<?php echo $senha ?>' readonly>
        </div>

        <div class='footer'>Lembre-se de alterar sua senha assim que possível para manter sua conta segura.</div>
    </div>
</body>

</html>