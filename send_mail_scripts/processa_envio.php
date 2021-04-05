<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception; 

    class Mensagem {
        private $para = null;
        private $assunto = null;
        private $mensagem = null;
        public $status = ['codigo' => null, 'descricao' => ''];

        public function __set($atributo, $valor) {
            $this->$atributo = $valor;
        }

        public function __get($atributo) {
            return $this->$atributo;
        }

        public function mensagemValida() {
            if(empty($this->para) || empty($this->assunto) || empty($this->mensagem)) {
                return false;
            }
            return true;
        }
    }

    $mensagem = new Mensagem();
    
    $mensagem->__set('para', $_POST['para']);
    $mensagem->__set('assunto', $_POST['assunto']);
    $mensagem->__set('mensagem', $_POST['mensagem']);

    if(!$mensagem->mensagemValida()) {
        header('Location: index.php?envio=erro');
    } 

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = false;                                       // Enable verbose debug output
        $mail->isSMTP();                                            // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';                             // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                                     // Enable SMTP authentication
        $mail->Username = 'kloserramos@gmail.com';                  // SMTP username
        $mail->Password = '!@#123654';                              // SMTP password
        $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                          // TCP port to connect to
    
        //Recipients
        $mail->setFrom('kloserramos@gmail.com', 'E-mail Remetente');
        $mail->addAddress($mensagem->__get('para'), 'E-mail Destinatário');     // Add a recipient
        //$mail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');
    
        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');             // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');        // Optional name
    
        //Content
        $mail->isHTML(true);                                        // Set email format to HTML
        $mail->Subject = $mensagem->__get('assunto');
        $mail->Body    = $mensagem->__get('mensagem');
        $mail->AltBody = 'É necessário utilizar um client que suporte HTML para ter acesso total ao conteúdo dessa mensagem';
    
        $mail->send();
        $mensagem->status['codigo'] = 1;
        $mensagem->status['descricao'] = 'O e-mail foi enviado com sucesso';
    } catch (Exception $e) {
        $mensagem->status['codigo'] = 2;
        $mensagem->status['descricao'] = 'O e-mail não foi enviado!, porfavor tente mais tarde.<br>Detalhes do erro: ' . $mail->ErrorInfo; 
    }
?>


<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>App Send Mail</title>

        <link rel="stylesheet" type="text/css" href="css/style.css">

    </head>
    <body>
        <div class="container">
            <header id="header_1">
                <a href="#">
                    <img src="./images/logo.png" width="110" height="110" alt="Imagem Avião de papel">
                </a>
                <h1>Send Mail</h1>
                <p>Seu app de envio de e-mails particular!</p>
            </header>

            <main>
                <?
                    if($mensagem->status['codigo'] == 1) {
                ?>

                        <h2 style="color: #32CD32; font-size: 35px; margin: 15px 0;">
                            Sucesso
                        </h2>
                        <p style="margin-bottom: 25px;"><?=$mensagem->status['descricao']?></p>
                        <a href="index.php" style="
                            padding: 10px 25px; 
                            background: linear-gradient(to right, var(--azul), var(--roxo_1));
                            border-radius: 25px;
                            border: none;
                            font-weight: bold;
                            color: var(--branco);"
                        >
                            Voltar
                        </a>

                <?
                    } else {
                ?>

                        <h2 style="color: #FF0000; font-size: 35px; margin: 15px 0;">
                            Ops!
                        </h2>
                        <p style="margin-bottom: 25px;"><?=$mensagem->status['descricao']?></p>
                        <a href="index.php" style="
                            padding: 10px 25px; 
                            background: linear-gradient(to right, var(--azul), var(--roxo_1));
                            border-radius: 25px;
                            border: none;
                            font-weight: bold;
                            color: var(--branco);"
                        >
                            Voltar
                        </a>
                <?
                    } 
                ?>
            </main>
        </div>
    </body>
</html>