<?php
require_once("./models/Curso.php");
require_once("./models/Disciplina.php");

$idcurso = $_GET['idcurso'];

$oCurso = new Curso();
$oDisciplina = new Disciplina();

$oCurso->setIdcurso($idcurso);

$idcurso = null;
$nome_curso = null;
$carga_horaria_curso = null;
$carga_horaria_estagio = null;
$turno = null;
$qtd_modulos = null;
$estagio_obrigatorio = null;
$amparo_legal = null;
$sobre = null;
$perfil_profissional = null;
$erro = null;

if ($oCurso->listar()) {
    $idcurso = $oCurso->getIdcurso();
    $nome_do_curso = $oCurso->getNome_curso();
    $carga_horaria_curso = $oCurso->getCarga_horaria_curso();
    $carga_horaria_estagio = $oCurso->getCarga_horaria_estagio();
    $turno = $oCurso->getTurno();
    $qtd_modulos = $oCurso->getQtd_modulos();
    $estagio_obrigatorio = $oCurso->getEstagio_obrigatorio();
    $amparo_legal = $oCurso->getAmparo_legal();
    $sobre = $oCurso->getSobre();
    $perfil_profissional = $oCurso->getPerfil_profissional();
} else {
    $erro = "ERRO AO RECUPERAR CURSO!";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <title>..:::.. CEET VASCO COUTINHO - HOME..:::..</title>
        <link rel='stylesheet' href='css/estilo_site.css' type='text/css' media='screen'/>
        <script type='text/javascript'>
            function validar() {
                login = document.formulario.login.value;
                senha = document.formulario.senha.value;

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
                        <li><span><a href='./index.php'><span>Home</span></a></span></li>
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
                <?php if (!$erro) { ?>
                    <div id='descricaoCurso'>
                        <h1><b>T&eacute;cnico em <?php echo $nome_do_curso; ?></b></h1>					

                        <h2><b>M&oacute;dulos: <?php echo $qtd_modulos; ?></b></h2>

                        <h2><b>Carga Hor&aacute;rio do Curso: <?php echo $carga_horaria_curso; ?> Horas</b></h2>

                        <h2><b>Carga Hor&aacute;rio de Est&aacute;gio: <?php echo $carga_horaria_estagio; ?> Horas</b></h2>

                        <h2><b>Est&aacute;gio Obrigat&oacute;rio: <?php echo ($estagio_obrigatorio) ? "Sim" : "Nao"; ?> </b></h2>

                        <h2><b>Amparo Legal:</b></h2>
                        <?php echo $amparo_legal; ?>

                        <h2><b>Sobre o Curso:</b></h2>
                        <?php echo $sobre; ?>

                        <h2><b>Perfil Profissional de Conclus&atilde;o do T&eacute;cnico em <?php echo $nome_curso; ?>:</b></h2>
                        <?php echo $perfil_profissional; ?>

                        <h2><b>Coordena&ccedil;&atilde;o:</b></h2>

                        <h2><b>Corpo Docente:</b></h2>	

                        <h2><b>Organiza&ccedil;&atilde;o Curricular: </b></h2>

                        <h3>Carga Horaria: <?php echo $carga_horaria_curso; ?> Horas - Periodo: <?php echo ucfirst($turno); ?></h3>

                        <?php
                        $oDisciplina->setCurso_idcurso($idcurso);
                        $listaDisciplinas = $oDisciplina->listarPorCurso();
                        $total = 0;
                        $nModulo = 1;
                        echo "
                        <table class='tabelaCurriculo' border='1px' width='100%'>
                            <tr class='titulo'>
                                <td class='linhaTitulo' colspan=2>MODULO $nModulo</td>
                            </tr>
                            <tr class='titulo'>
                                <td class='linhaTitulo'>COMPONENTE CURRICULAR</td>
                                <td class='linhaTitulo'>CARGA HOR&Aacute;RIA</td>
                            </tr>";
                        foreach($listaDisciplinas as $disciplina){
                            if ($nModulo == $disciplina->getModulo()) {
                                echo "
                                <tr class='conteudo'>
                                    <td class='componenteCurricular'>".$disciplina->getNome()."</td>
                                    <td class='cargaHoraria'>".$disciplina->getCarga_horaria()."</td>
                                </tr>";
                                $total += (int) $disciplina->getCarga_horaria();
                            } else {
                                $nModulo++;
                                echo "
                                <tr class='titulo'>
                                        <td>TOTAL</td>
                                        <td>$total</td>
                                </tr>
                                </table><br/><br/>
                                <table class='tabelaCurriculo' border='1px' width='100%'>
                                    <tr class='titulo'>
                                            <td class='linhaTitulo' colspan=2>MODULO $nModulo</td>
                                    </tr>
                                    <tr class='titulo'>
                                            <td class='linhaTitulo'>COMPONENTE CURRICULAR</td>
                                            <td class='linhaTitulo'>CARGA HOR&Aacute;RIA</td>
                                    </tr>
                                    <tr class='conteudo'>
                                            <td class='componenteCurricular'>".$disciplina->getNome()."</td>
                                            <td class='cargaHoraria'>".$disciplina->getCarga_horaria()."</td>
                                    </tr>";
                            }
                        }
                        ?>
                        <tr class='titulo'>
                            <td>TOTAL</td>
                            <td><?php echo $total; ?></td>
                        </tr>
                        </table>
                    <?php } else {
                        echo "<center><h1>" . $erro . "</h1></center>";
                    }
                    ?>
                </div>

            </div>

            <?php
            require_once("./service/rodape.php");
            ?>
        </div>
    </body>
</html>