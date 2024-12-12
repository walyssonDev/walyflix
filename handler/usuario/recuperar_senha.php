    <?php
    include("../utils/conexao.php");
    require_once("../../libs/PHPMailer/PHPMailer.php");
    require_once("../../libs/PHPMailer/Exception.php");
    require_once("../../libs/PHPMailer/SMTP.php");

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    $cpf = $_POST['cpf'];
    $email = $_POST['email'];

    function gerarSenha($tamanho = 12)
    {
        $letrasMaisculas = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $letrasMinusculas = "abcdefghijklmnopqrstuvwxyz";
        $numeros = "0123456789";
        $caractereEspecial = "@!%#*?_$";

        $senha = $letrasMaisculas[random_int(0, strlen($letrasMaisculas) - 1)];
        $senha .= $letrasMinusculas[random_int(0, strlen($letrasMinusculas) - 1)];
        $senha .= $numeros[random_int(0, strlen($numeros) - 1)];
        $senha .= $caractereEspecial[random_int(0, strlen($caractereEspecial) - 1)];

        $todosCaracteres = $letrasMaisculas . $letrasMinusculas . $numeros . $caractereEspecial;
        for ($i = 4; $i < $tamanho; $i++) {
            $senha .= $todosCaracteres[random_int(0, strlen($todosCaracteres) - 1)];
        }

        return str_shuffle($senha);
    }

    $sqlVerificar = "SELECT * FROM usuarios WHERE cpf = ?";
    $stmt = $conn->prepare($sqlVerificar);
    $stmt->bind_param("s", $cpf);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado = $resultado->fetch_assoc()) {

        $senha = gerarSenha();

        $sql = "UPDATE usuarios SET senha = ? WHERE cpf = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $senha, $cpf);
        $stmt->execute();

        $mail = new PHPMailer(true);
        $mail->CharSet = PHPMailer::CHARSET_UTF8;

        try {

            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Port = 587;
            $mail->Username = "walyssonribeiro3@gmail.com";
            $mail->Password = "ajrs rmaw yeoa iyje";

            $mail->setFrom('walyflix@gmail.com', "WalyFlix");
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = "Recuperação de senha!";
            $mail->Body = "
                    <!DOCTYPE html>
                    <html lang='pt-br'>

                    <head>
                            <meta charset='UTF-8'>
                            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                            <title>Senha de Recuperação</title>
                            <style>
                            body {
                                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                                margin: 0;
                                padding: 0;
                                display: flex;
                                justify-content: center;
                                align-items: center;
                                height: 100vh;
                                background-color: #f1f5f9;
                            }

                            .container {
                                flex-direction: column;
                                justify-content: center;
                                align-items: center;
                                background-color: #1e293b;
                                padding: 2rem;
                                border-radius: 1em;
                                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.4);
                                width: 100%;
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
                                    <input type='text' id='password' value='$senha' readonly>
                                </div>

                                <div class='footer'>Lembre-se de alterar sua senha assim que possível para manter sua conta segura.</div>
                            </div>
                        </body>

                        </html>";
            $mail->AltBody = "Essa é a sua senha de recuperação, altere ela o mais rápido possivel: $senha";

            if ($mail->send()) {
                $resposta = "Email enviado com sucesso!";
                header("Location: ../../index.php?resposta=$resposta");
                exit;
            } else {
                $resposta = "Falha ao enviar o email!";
                header("Location: ../../index.php?resposta=$resposta");
                exit;
            }
        } catch (Exception $e) {
            $resposta = "Erro ao recuperar senha! {$mail->ErrorInfo}";
            header("Location: ../../index.php?resposta=$resposta");
            exit;
        }
    } else {
        $resposta = "Erro ao recuperar senha!";
        header("Location: ../../index.php?resposta=$resposta");
        exit;
    }
