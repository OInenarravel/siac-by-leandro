<?php
require_once("./models/Curso.php");
require_once("./models/Noticia.php");
require_once("./models/Funcionario.php");
require_once("./service/rodape.php");

$oCurso = new Curso();
$oNoticia = new Noticia();
$oFuncionario = new Funcionario();

if (!@$idnoticia = $_GET['idnoticia']) {
    $idnoticia = null;
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
            function validar(){
                var login = document.formulario.login.value;
                var senha = document.formulario.senha.value;

                if(login=='' || senha==''){
                    alert('Login e senha necessarios para acesso!\nVerifique os dados informados e tente novamente');
                    return false;
                }
                else{
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
                    <form name='formSearch' class='formSearch' action='./pesquisarNoticia.php' method='get'>
                        <input type='text' class='campoTexto' name='campoTexto' value='Digite sua busca aqui...' onClick='value=""'/>&nbsp;
                        <input type='submit' class='botaoProcurar' value='Procurar' src='./Imagens/search.png'/>
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
                                <td><input class='campo_login' type='text' name='login'  onClick='value=""'/></td>
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


                    Principal
                    <ul>
                        <li><a href='./index.php'>Home</a></li>
                        <li><a href=''>Sobre</a></li>
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
                    <a href='http://www.educacao.es.gov.br/'><img alt="" src='img/sedu.jpg'/></a><br/>
                </div>

            </div>

            <div id='noticias'>
                <?php
                $oNoticia->setIdnoticia($idnoticia);

                if ($oNoticia->listar()) {
                    $idnoticia = $oNoticia->getIdnoticia();
                    $titulo = $oNoticia->getTitulo();
                    $data = date("d/m/Y H:i", strtotime($oNoticia->getData_noticia()));
                    $oFuncionario->setFuncionario_idusuario($oNoticia->getFuncionario_idusuario());
                    $oFuncionario->listar();
                    echo "
                    <div id='conteudoNoticia'>
                        <h1 class='tituloNoticia'>{$oNoticia->getTitulo()}</h1>
                        Postada em {$data} - por {$oFuncionario->getNome()}<br/><br/>
                        {$oNoticia->getNoticia_completa()}
                    </div>";
                } else {
                    echo "<h2>ERRO AO EXIBIR NOT&IacuteCIA</h2>";
                }
                ?>

            </div>

            <div id="rodape">
                <?php
                exibeRodape();
                ?>
            </div>
        </div>
    </body>
</html>
