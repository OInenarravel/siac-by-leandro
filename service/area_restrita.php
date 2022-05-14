<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\"
\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html>
    <head>
        <style type='text/css'>
            a:link, a:active, a:visited, a:hover{
                text-decoration: none;
                color: white;
            }

            p {
                font-family: Tahoma, Verdana, Arial, sans-serif;
                color: white;
            }

            p.titulo{
                font-size: 24pt;
                text-align: center;
            }

            p.subtitulo{
                font-size: 18pt;
                text-align: center;
            }

            body{
                background-image: url('../img/background.png');
                background-repeat: repeat-x;
            }

            #frame{
                position: absolute;
                width: 700px;
                height: 300px;
                left: 50%;
                top: 50%;
                vertical-align: middle;
                margin-left: -350px;
                margin-top: -150px;
                padding-top: 30px;
                padding-left: 15px;
                padding-right: 15px;
                background-image: url('../img/fundo.gif');
                background-repeat: repeat-x;
                background-color: black;
                border: 1px solid black;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div id='frame'>
            <p class='titulo'>Acesso Negado!</p>
            <p class='subtitulo'>Para acessar essa p&aacute;gina voc&ecirc; precisa estar logado.<br/>
                Voc&ecirc; ser&aacute; redirecionado em instantes para a P&aacute;gina Inicial.<br/>
                Caso a p&aacute;gina n&atilde;o seja carregada automaticamente clique <br/><br/><b><a href='../index.php'>AQUI</a></b></p>
        </div>
        <script type='text/javascript'>
            function jump () {
                document.location = './index.php'; 
            } 
            setTimeout('jump()',4000);
        </script> 
    <body>
</html>
<?php die(); ?>