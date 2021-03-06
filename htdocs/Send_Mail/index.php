
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
                <div class="background-main">
                    <header id="header_2">
                        <h2>Enviar E-mail</h2>
                    </header>
                    <form class="form_1" action="processa_envio.php" method="post">
                        <div class="group_1">
                            <label for="para">Para</label>
                            <input type="email" name="para" placeholder="email@dominio.com.br">
                        </div>
                        <div class="group_1">
                            <label for="assunto">Assunto</label>
                            <input type="text" name="assunto" placeholder="Assunto do e-mail">
                        </div>
                        <div class="group_1">
                            <label for="mensagem">Mensagem</label>
                            <textarea name="mensagem"></textarea>
                            <?
                                if(isset($_GET['envio']) && $_GET['envio'] == 'erro') {
                            ?>
                                <div style="color: #FF0000;">
                                    Preencha os campos corretamente!!!
                                </div>
                            <?
                                }
                            ?>     

                        </div>
                        <button type="submit">
                            Enviar Mensagem
                        </button>    
                    </form>
                </div> 
            </main>
        </div>
    </body>
</html>