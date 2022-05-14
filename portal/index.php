<?php
require_once("../models/Sessao.php");
require_once("../models/Paginacao.php");
require_once("../models/Curso.php");
require_once("../models/Noticia.php");
require_once("../models/Funcionario.php");
require_once("../service/rodape.php");

$oSessao = new Sessao();
$oFuncionario = new Funcionario();

if ($oSessao->estaLogado() == null) {
    $oSessao->expulsar();
}

$oNoticia = new Noticia();

$oNoticia->setDestaque(1);
$oNoticia->setVisibilidade(2);
$listaNoticias = $oNoticia->listarDestaquePorVisibilidade();

$oPaginacao = new Paginacao(3, sizeof($listaNoticias), "index.php?");

if ($pagina = isset($_GET['pagina']))
    $oPaginacao->setINumeroPagina($pagina);
else
    $oPaginacao->setINumeroPagina();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <title>..:::.. PORTAL CEET VASCO COUTINHO ..:::..</title>
        <link rel='stylesheet' href='../css/estilo_portal.css' media='screen'/>
        <link rel="stylesheet" href="../css/menu_style.css" type="text/css" />
        <script type="text/javascript"  language='JavaScript'>
            function logoff(){
                if(confirm('Voce esta saindo da area restrita do Portal!\nDeseja voltar a Pagina Principal do site?')){
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
                        <img alt=""  src='../img/banner_texto_portal.png'/>
                    </div>
                </div>

                <div id='menu_superior'>
                    <ul>
                        <li><a class='menu_superior' href="../perfil/index.php" target="_self">PERFIL</a></li>
                        <li><a class='menu_superior' href="../forum/index.php" target="_self">F&Oacute;RUM</a></li>
                        <li><a class='menu_superior' href="javascript:logoff();" target="_self">SAIR</a></li>						
                    </ul>
                    <form name='formSearch' class='formSearch' action='./pesquisar.php' method='get'>
                        <input type='text' class='campoTexto' name='campoTexto' value='Digite sua busca aqui...' onClick='value=""'/>&nbsp;
                        <input type='submit' class='botaoProcurar' value='Procurar' src='../img/search.png'/>
                    </form>
                </div>

            </div>

            <div id='boxLateral'>

                <div id='menu_lateral'>
                    Principal
                    <ul>
                        <li><span><a href='./index.php'>Home</a></span></li>
                    </ul>
                    Parceiros<br/><br/>
                    <a href='http://www.educacao.es.gov.br/'><img alt="" src='../img/sedu.jpg'/></a><br/>
                </div>

            </div>

            <div id='noticias'>
                <?php
                if (sizeof($listaNoticias) > 0) {
                    $iFirstReg = $oPaginacao->getIPrimeiroRegistro();
                    $oNoticia->setDestaque(1);
                    $oNoticia->setVisibilidade(2);
                    $listaNoticias = $oNoticia->listarDestaquePorVisibilidade($iFirstReg, 3);

                    foreach ($listaNoticias as $noticia) {
                        $oFuncionario->setFuncionario_idusuario($noticia->getFuncionario_idusuario());
                        $oFuncionario->listar();
                        $autor = $oFuncionario->getNome();
                        $data = date("d/m/Y - H:i", strtotime($noticia->getData_noticia()));
                        echo "
                        <div id='conteudoNoticia'>
                            <a href='./noticia.php?idnoticia=".$noticia->getIdnoticia()."'><h1 class='tituloNoticia'>".$noticia->getTitulo()."</h1></a>
                            Postada em $data por $autor<br/><br/>".
                            $noticia->getResumo()
                            ."<br/>
                            <br/>
                            <p class='leiaMais'><a href='./noticia.php?idnoticia=".$noticia->getIdnoticia()."'>Leia mais+</a></p>
                        </div>";
                    }
                } else {
                    echo "<h2>NENHUMA NOT&Iacute;CIA DISPON&Iacute;VEL</h2>";
                }
                ?>

                <div id='paginacao'>
                    <?php
                    // exibir painel de navegacao
                    echo $oPaginacao->getSPainelNavegacao();
                    ?>
                </div>
            </div>

            <div id="rodape">
                <?php
                exibeRodape();
                ?>
            </div>
        </div>
    </body>
</html>
