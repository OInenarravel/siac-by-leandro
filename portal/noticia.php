<?php
require_once("../models/Sessao.php");
require_once("../models/Noticia.php");
require_once("../models/Usuario.php");
require_once("../models/Funcionario.php");

$oSessao = new Sessao();

if ($oSessao->estaLogado() == null) {
    $oSessao->expulsar();
}

if (!@$idnoticia = $_GET['idnoticia']) {
    $idnoticia = null;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <title>..:::.. PORTAL CEET VASCO COUTINHO ..:::..</title>
        <link rel='stylesheet' href='../css/estilo_portal.css' media='screen'>
            <link rel="stylesheet" href="../css/menu_style.css" type="text/css" />
            <!--<script type='text/javascript' src='script.js'></script>-->
            <script language='JavaScript'>
                function logoff() {
                    if (confirm('Voce esta saindo da area restrita do Portal!\nDeseja voltar a Pagina Principal do site?')) {
                        document.location = './logoff.php';
                    }
                }
            </script>
    </head>
    <body>
        <div id='container'>

            <div id='cabecalho'>
                <div id='banner_superior'>
                    <div id='banner_superior_figura'>
                        <img src='../img/banner_texto_portal.png'>
                    </div>
                </div>

                <div id='menu_superior'>
                    <ul>
                        <li><a class='menu_superior' href="../perfil/index.php" target="_self">PERFIL</a></li>
                        <li><a class='menu_superior' href="../forum/index.php" target="_self">F&Oacute;RUM</a></li>
                        <li><a class='menu_superior' href="javascript:logoff();" target="_self">SAIR</a></li>						
                    </ul>
                    <form name='formSearch' class='formSearch' action='./pesquisar.php' method='get'>
                        <input type='text' class='campoTexto' name='campoTexto' value='Digite sua busca aqui...' onClick='value = ""'>&nbsp;
                        <input type='submit' class='botaoProcurar' value='Procurar' src='../Imagens/search.png'>
                    </form>
                </div>
            </div>

            <div id='boxLateral'>

                <div id='menu_lateral'>
                    Principal
                    <ul>
                        <li><span><a href='./index.php'><span>Home</span></a></span></li>
                    </ul>
                    Parceiros<br/><br/>
                    <center><a href='http://www.educacao.es.gov.br/'><img src='../img/sedu.jpg'/></a></center><br/>
                </div>

            </div>

            <div id='noticias'>
                <?php
                $oNoticia = new Noticia();

                $oNoticia->setIdnoticia($idnoticia);

                if ($oNoticia->listar()) {
                    $idnoticia = $oNoticia->getIdnoticia();
                    $titulo = $oNoticia->getTitulo();
                    $noticia_completa = $oNoticia->getNoticia_completa();
                    $data = date("d/m/Y H:i", strtotime($oNoticia->getData_noticia()));
                    $oFuncionario = new Funcionario();
                    $oFuncionario->setFuncionario_idusuario($oNoticia->getFuncionario_idusuario());
                    $oFuncionario->listar();
                    $autor = $oFuncionario->getNome();
                    echo "
                    <div id='conteudoNoticia'>
                        <h1 class='tituloNoticia'>$titulo</h1>
                        Postada em $data - por $autor<br/><br/>
                        $noticia_completa
                    </div>";
                } else {
                    echo "<center><h2>ERRO AO EXIBIR NOT&IacuteCIA</h2></center>";
                }
                ?>

            </div>

            <?php
            require_once("../models/rodape.php");
            ?>
        </div>
    </body>
</html>
