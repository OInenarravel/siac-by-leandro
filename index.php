<?php
require_once("./models/Paginacao.php");
require_once("./models/Curso.php");
require_once("./models/Noticia.php");
require_once("./models/Funcionario.php");
require_once("./service/rodape.php");

$oNoticia = new Noticia();
$oFuncionario = new Funcionario();
$oCurso = new Curso();
$pagina = null;

$oNoticia->setDestaque(1);
$oNoticia->setVisibilidade(1);
$listaNoticias = $oNoticia->listarDestaquePorVisibilidade();

$oPaginacao = new Paginacao(3, sizeof($listaNoticias), "index.php?");

if(isset($_GET['pagina'])) {
    $pagina = $_GET['pagina'];
}

if (!$pagina)
    $oPaginacao->setINumeroPagina();
else
    $oPaginacao->setINumeroPagina($pagina);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>..:::.. CEET VASCO COUTINHO - HOME ..:::..</title>
        <link rel="stylesheet" href="css/estilo_site.css" type="text/css" media='screen'/>
        <script type='text/javascript'>
            function validar(){
                var login = document.formulario.login.value;
                var senha = document.formulario.senha.value;

                if(login == '' || senha == ''){
                    alert('Login e senha necessarios para acesso!\nVerifique os dados informados e tente novamente');
                    return false;
                }else{
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

                <div id='menu_superior'>
                    <form name='formSearch' class='formSearch' action='./pesquisar.php' method='get'>
                        <input type='text' class='campoTexto' name='campoTexto' value='Digite sua busca aqui...' onClick='value=""'/>&nbsp;
                        <input type='submit' class='botaoProcurar' value='Procurar' src='./img/search.png'/>
                    </form>
                </div>

            </div>

            <div id='boxLateral'>

                <div id='menu_lateral'>
                    <h2>Portal da Institui&ccedil;&atilde;o</h2>
                    <form name='formulario' method='post' action='service/validar_login.php' onSubmit='return validar()'>
                        <table class='tabelaAcessoPortal'>
                            <tr>
                                <td>Login:</td>
                                <td><input class='campo_login' type='text' name='login' onClick='value=""'/></td>
                            </tr>
                            <tr>
                                <td>Senha:</td>
                                <td><input class='campo_senha' type='password' name='senha' value='' onClick='value=""'/></td>
                            </tr>
                            <tr>
                                <td colspan=2 align='center'><input type='submit' value='Entrar'/></td>
                            </tr>
                        </table>
                    </form>

                    <br/>
                    <hr/>
                    <br/>

                    <h3>Principal</h3>
                    <ul>
                        <li><span><a href='./index.php'><span>Home</span></a></span></li>
                        <li><a href='./sobre.php'>Sobre</a></li>
                        <li><a href=''>Contato</a></li>
                    </ul>

                    <h3>Cursos</h3>
                    <?php
                    $listaDeCursos = $oCurso->listarTodos();

                    if(sizeof($listaDeCursos) > 0) {
                        echo "<ul>";
                        foreach ($listaDeCursos as $curso) {
                            echo "<li><a href='./curso.php?idcurso={$curso->getIdcurso()}'>T&eacute;cnico em {$curso->getNome_curso()}</a></li>";
                        }
                        echo "</ul>";
                    } else {
                        echo "<h3>ERRO AO LISTAR CURSOS</h3>";
                    }
                    ?>
                    <br/>
                    <hr/>
                    <br/>

                    <h3>Parceiros</h3>
                    <br/>
                    <a href='http://www.educacao.es.gov.br/'>
                        <img alt=""  src='img/sedu.jpg'/>
                    </a>
                    <br/>
                </div>

            </div>

            <div id='noticias'>
                <?php
                if (sizeof($listaNoticias) > 0) {
                    $iFirstReg = $oPaginacao->getIPrimeiroRegistro();
                    $oNoticia->setDestaque(1);
                    $oNoticia->setVisibilidade(1);
                    $listaNoticias = $oNoticia->listarDestaquePorVisibilidade($iFirstReg, 3);

                    foreach ($listaNoticias as $noticia) {
                        $oFuncionario->setFuncionario_idusuario($noticia->getFuncionario_idusuario());
                        $oFuncionario->listar();
                        $autor = $oFuncionario->getNome();
                        $data = date("d/m/Y - H:i", strtotime($noticia->getData_noticia()));
                        echo "
                        <div id='conteudoNoticia'>
                            <a href='./noticia.php?idnoticia={$noticia->getIdnoticia()}'>
                                <h1 class='tituloNoticia'>{$noticia->getTitulo()}</h1>
                            </a>
                            <h3>Postada em {$data} por {$autor}</h3>
                            
                            <h2>{$noticia->getResumo()}</h2>
                            
                            <p class='leiaMais'>
                                <a href='./noticia.php?idnoticia={$noticia->getIdnoticia()}'>Leia mais+</a>
                            </p>
                        </div>";
                    }
                } else {
                    echo "<h1>NENHUMA NOT&Iacute;CIA DISPON&Iacute;VEL</h1>";
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