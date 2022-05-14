<?php
require_once("../models/Sessao.php");
require_once("../models/Noticia.php");
require_once("../models/Funcionario.php");
require_once("../models/Paginacao.php");

$oSessao = new Sessao();
$oFuncionario = new Funcionario();

if ($oSessao->estaLogado() == null) {
    $oSessao->expulsar();
}

$pagina = @$_GET['pagina'];
$textoBusca = @$_GET['campoTexto'];
        
if (!$pagina) {
    $pagina = false;
}

if (!$textoBusca) {
    $textoBusca = null;
}

if($textoBusca != null){
    
    $oNoticia = new Noticia();
    $listaNoticias = $oNoticia->pesquisarNoticiasPortal($textoBusca);
    
    if(@sizeof($listaNoticias) != 0){
        $oPaginacao = new Paginacao(10, @sizeof($listaNoticias), "pesquisar.php?campoTexto=$textoBusca&");
        if (!$pagina = @$_GET['pagina']){
            $oPaginacao->setINumeroPagina();
        } else {
            $oPaginacao->setINumeroPagina($pagina);
        }
    } else {
        $listaNoticias = null;
    }
} else {
    $listaNoticias = null;
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
                    <center>
                        <h2>Resultado(s) da pesquisa para: '<?php echo $textoBusca;?>'.</h2>
                    </center>
                    <?php
                    // bloco 5 - exibe os registros na tela
                    if (@sizeof($listaNoticias) > 0 && $textoBusca != null) {
                        echo "<center><h2>Foram encontrados \"".@sizeof($listaNoticias)."\" resultados para o termo informado.</h2></center>";
                        $iFirstReg = $oPaginacao->getIPrimeiroRegistro();
                        $listaNoticias = $oNoticia->pesquisarNoticiasSite($textoBusca,$iFirstReg, 10);

                        foreach ($listaNoticias as $noticia) {
                            $oFuncionario->setFuncionario_idusuario($noticia->getFuncionario_idusuario());
                            $oFuncionario->listar();
                            $autor = $oFuncionario->getNome();
                            $data = date("d/m/Y H:i", strtotime($noticia->getData_noticia()));
                            echo "
                            <div id='conteudoNoticia'>
                                <a href='./exibirNoticia.php?idnoticia=".$noticia->getIdnoticia()."'><h1 class='tituloNoticia'>".$noticia->getTitulo()."</h1></a>
                                Postada em $data - por $autor<br/><br/>
                                ".$noticia->getResumo()."
                                <br/>
                                <br/>
                                <p class='leiaMais'><a href='./exibirNoticia.php?idnoticia=".$noticia->getIdnoticia()."'>Leia mais+</a></p>
                            </div>";
                        }
                    } else {
                        echo "<center><h2>NENHUMA NOT&Iacute;CIA ENCONTRADA!</h2></center>";
                    }
                    ?>
                    <div id='paginacao'>
                        <?php
                        // exibir painel de navegacao
                        if($listaNoticias != null){
                            echo $oPaginacao->getSPainelNavegacao();
                        }
                        ?>
                    </div>
                </div>
                
                <?php
                require_once("../models/rodape.php");
                ?>
            </div>
        </body>
</html>
