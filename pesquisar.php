<?php
require_once("./models/Paginacao.php");
require_once("./models/Curso.php");
require_once("./models/Noticia.php");
require_once("./models/Funcionario.php");
require_once("./service/rodape.php");

$oCurso = new Curso();
$oNoticia = new Noticia();
$oFuncionario = new Funcionario();

$pagina = @$_GET['pagina'];
$textoBusca = @$_GET['campoTexto'];
        
if (!$pagina) {
    $pagina = false;
}

if (!$textoBusca) {
    $textoBusca = null;
}

if($textoBusca != null){
    $listaNoticias = $oNoticia->pesquisarNoticiasSite($textoBusca);
    
    if(@sizeof($listaNoticias) != 0){
        $oPaginacao = new Paginacao(10, @sizeof($listaNoticias), "pesquisar.php?campoTexto=$textoBusca&");
        if (!$pagina = @$_GET['pagina']){
            $oPaginacao->setINumeroPagina();
        } else {
            $oPaginacao->setINumeroPagina($pagina);
        }
    } else {
        $listaNoticias = array();
    }
} else {
    $listaNoticias = array();
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <title>..:::.. CEET VASCO COUTINHO - HOME..:::..</title>
        <link rel='stylesheet' href='css/estilo_site.css' type='text/css' media='screen'/>
        <!--<link rel="stylesheet" href="./Estilos/menu_style.css" type="text/css" media='screen'/>-->
        <!--<script language='JavaScript' src='script.js'></script>-->
        <script type='text/javascript'>
            function validar() {
                var login = document.formulario.login.value;
                var senha = document.formulario.senha.value;

                if (login == '' || senha == '') {
                    alert('Login e senha necessarios para acesso!\nVerifique os dados informados e tente novamente');
                    return false;
                } else {
                    return true;
                }
            }
        </script>
	</head>
	<body>
            <div id='container'>

                <div id='cabecalho'>

                    <div id='banner_superior'>
                        <div id='banner_superior_figura'>
                            
                        </div>
                    </div>

                    <div id='menu_superior' class="menu bubplastic horizontal orange">
                        <form name='formSearch' class='formSearch' action='./pesquisar.php' method='get'>
                            <input type='text' class='campoTexto' name='campoTexto' value='Digite sua busca aqui...' onClick='value = ""'/>&nbsp;
                            <input type='submit' class='botaoProcurar' value='Procurar' src='./img/search.png'/>
                        </form>
                    </div>

                </div>

            <div id='boxLateral'>

                <div id='menu_lateral'>
                    <center><h2>Portal da Institui&ccedil;&atilde;o</h2></center>
                    <form name='formulario' method='post' action='service/validar_login.php' onSubmit='return validar()'>
                        <table class='tabelaAcessoPortal'>
                            <tr>
                                <td>Login:</td>
                                <td><input class='campo_login' type='text' name='login'  onClick='value = ""'/></td>
                            </tr>
                            <tr>
                                <td>Senha:</td>
                                <td><input class='campo_senha' type='password' name='senha' value='' onClick='value = ""'/></td>
                            </tr>
                            <tr>
                                <td colspan=2 align='center'><input type='submit' value='Entrar'/></td>
                            </tr>
                        </table>
                    </form>

                    <br/>
                    <hr/>
                    <br/>

                    Principal
                    <ul>
                        <li><a href='./index.php'>Home</a></li>
                        <li><a href='./sobre.php'>Sobre</a></li>
                        <li><a href=''>Contato</a></li>
                    </ul>

                    Cursos
                    <?php
                    $listaDeCursos = $oCurso->listarTodos();

                    if(sizeof($listaDeCursos) > 0) {
                        echo "<ul>";
                        foreach ($listaDeCursos as $curso) {
                            echo "<li><a href='./curso.php?idcurso=".$curso->getIdcurso()."'>T&eacute;cnico em ".$curso->getNome_curso()."</a></li>";
                        }
                        echo "</ul>";
                    } else {
                        echo "<h3>ERRO AO LISTAR CURSOS</h3>";
                    }
                    ?>
                    <br/>
                    <hr/>
                    <br/>

                    Parceiros<br/><br/>
                    <center><a href='http://www.educacao.es.gov.br/'><img src='img/sedu.jpg'/></a></center><br/>
                </div>

            </div>

            <div id='noticias'>
                <center>
                    <h2>Resultado(s) da pesquisa para: '<?php echo $textoBusca;?>'</h2>
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
                            <a href='./noticia.php?idnoticia=".$noticia->getIdnoticia()."'><h1 class='tituloNoticia'>".$noticia->getTitulo()."</h1></a>
                            Postada em $data - por $autor<br/><br/>
                            ".$noticia->getResumo()."
                            <br/>
                            <br/>
                            <p class='leiaMais'><a href='./noticia.php?idnoticia=".$noticia->getIdnoticia()."'>Leia mais+</a></p>
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

            <div id="rodape">
                <?php
                exibeRodape();
                ?>
            </div>
        </div>
    </body>
</html>
