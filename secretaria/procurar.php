<?php
require_once("../models/Sessao.php");
require_once("../models/Turma.php");
require_once("../models/Curso.php");

$oSessao = new Sessao();

if (!$oSessao->estaLogado()) {
    $oSessao->efetuarLogout();
}

$iIdUsuario = $oSessao->getVariavelSessao("iIdUsuario");
$sNivelAcesso = $oSessao->getVariavelSessao("nivelAcesso");
$sNomeUsuario = $oSessao->getVariavelSessao("sNomeUsuario");

$opcao = $_GET["opcao"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <title>..: SECRETARIA ON-LINE :..</title>
        <link rel='stylesheet' href='../css/estilo_secretaria.css' type='text/css' media='screen'/>
        <link rel="stylesheet" href="../css/menu_style.css" type="text/css" media='screen'/>
        <script src="../js/secretaria.js" type="text/javascript"></script>
        <script type="text/javascript" language='javascript' src="http://jqueryjs.googlecode.com/files/jquery-1.3.2.min.js"></script>
        <script src="../js/accordion.js" type="text/javascript" language='javascript'></script>
    </head>	

    <body>		
        <div id='geral'>

            <div id='menu_superior'>
                <div id='text_menu_esquerda'>Seja bem-vindo(a) <?php echo $sNomeUsuario; ?></div>
                <div id='text_menu_direita'><a href='../portal/index.php' class='link_sair'>SAIR</a></div>
            </div>

            <?php
            require_once("painel.php");
            $sPainelSecretaria = gerarPainel($sNivelAcesso);
            echo $sPainelSecretaria;
            ?>

            <div id='painel_exibicao'>

                <fieldset>
                    <legend>Informe o par&acirc;metro para busca:</legend>
                    <?php
                    switch ($opcao) {
                        case 1: {//USUARIO
                                echo "
						<form name='searchForm' action='usuarios.php' method='get' onSubmit='return validarBuscaUsuario()'>
                            <input type='text' name='campoBusca' id='campoBusca' class='campoBusca' style='width:540px'/>&nbsp;
                            <input type='submit' name='botaoProcurar' id='botaoProcurar' value='Procurar'/><br/>
                            <input type='radio' name='radioParametro' id='radioParametro1' value='1'><b>ID</b>&nbsp;
                            <input type='radio' name='radioParametro' id='radioParametro2' value='2' checked><b>NOME</b>&nbsp;
                            <input type='radio' name='radioParametro' id='radioParametro3' value='3'><b>CPF (Informe somente os numeros)</b>&nbsp;
                            <input type='radio' name='radioParametro' id='radioParametro4' value='4'><b>RG (Informe somente os numeros)</b>&nbsp;
                            <input type='hidden' name='opcao' value='1'>
                        </form>";
                                break;
                            }

                        case 2: {//ALUNO
                                $oTurma = new Turma();
                                $oCurso = new Curso();
                                $aListaDeTurmas = $oTurma->listarTodos();
                                $aListaDeCursos = $oCurso->listarTodos();
                                $sListaDeTurmas = "";
                                $sListaDeCursos = "";
                                foreach ($aListaDeTurmas as $turma) {
                                    list($idturma,,,,,, $nomeTurma) = $turma;
                                    $sListaDeTurmas .= "<option value='" . $idturma . "'>" . $nomeTurma . "</option>";
                                }
                                foreach ($aListaDeCursos as $curso) {
                                    list($idcurso, $nomeCurso) = $curso;
                                    $sListaDeCursos .= "<option value='" . $idcurso . "'>" . $nomeCurso . "</option>";
                                }
                                echo "
						<form name='searchForm' action='alunos.php' method='get' onSubmit='return validarBuscaUsuario()'>
                            <input type='text' name='campoBusca' id='campoBusca' class='campoBusca' style='width:540px'/>&nbsp;
                            <input type='submit' name='botaoProcurar' id='botaoProcurar' value='Procurar'/><br/>
                            <input type='radio' name='radioParametro' id='radioParametro1' value='1' checked/><b>ID</b>&nbsp;
                            <input type='radio' name='radioParametro' id='radioParametro1' value='2'/><b>MATRICULA</b>&nbsp;
                            <input type='radio' name='radioParametro' id='radioParametro2' value='3'/><b>NOME</b>&nbsp;
                            <input type='radio' name='radioParametro' id='radioParametro3' value='4'/><b>CPF (Informe somente os n&uacute;meros)</b>&nbsp;
                            <input type='radio' name='radioParametro' id='radioParametro4' value='5'/><b>RG (Informe somente os n&uacute;meros)</b><br/><br/>
                            <input type='radio' name='radioParametro' id='radioParametro5' value='6'/>
                                <b>Turma:&nbsp;</b>
                                <select id='selectTurma'>
                                    " . $sListaDeTurmas . "
                                </select>
                            <input type='radio' name='radioParametro' id='radioParametro6' value='7'/>
                                <b>Curso:&nbsp;</b>
                                <select id='selectCurso'>
                                    " . $sListaDeCursos . "
                                </select>
                            <input type='hidden' name='opcao' value='1'>
                        </form>";
                                break;
                            }

                        case 3: {//FUNCIONARIO
                                echo "
							";
                                break;
                            }

                        case 4: {//PROFESSOR
                                echo "
							";
                                break;
                            }

                        case 5: {//CURSO
                                echo "
						<form name='searchForm' action='listarCurso.php' method='get' onSubmit='return validarBuscaCurso()'>
                            <input type='text' name='campoBusca' id='campoBusca' class='campoBusca' style='width:540px'/>&nbsp;
                            <input type='submit' name='botaoProcurar' id='botaoProcurar' value='Procurar'/><br/>
                            <input type='radio' name='radioParametro' id='radioParametro1' value='1'><b>ID</b>&nbsp;
                            <input type='radio' name='radioParametro' id='radioParametro2' value='2' checked><b>NOME</b>&nbsp;
                            <input type='radio' name='radioParametro' id='radioParametro3' value='3'><b>TURNO (matutino, vespertino ou noturno)</b>&nbsp;
                            <input type='radio' name='radioParametro' id='radioParametro4' value='4'><b>QUANTIDADE DE MODULOS</b>&nbsp;
                            <input type='hidden' name='opcao' value='1'>
                        </form>";
                                break;
                            }

                        case 6: {//DISCIPLINA
                                echo "
						<form name='searchForm' action='listarDisciplina.php' method='get' onSubmit='return validarBuscaDisciplina()'>
                            <input type='text' name='campoBusca' id='campoBusca' class='campoBusca' style='width:540px'/>&nbsp;
                            <input type='submit' name='botaoProcurar' id='botaoProcurar' value='Procurar'/><br/>
                            <input type='radio' name='radioParametro' id='radioParametro1' value='1'><b>ID</b>&nbsp;
                            <input type='radio' name='radioParametro' id='radioParametro2' value='2' checked><b>NOME</b>&nbsp;
                            <input type='radio' name='radioParametro' id='radioParametro3' value='3'><b>CURSO (ID ou NOME)</b>&nbsp;
                            <input type='hidden' name='opcao' value='1'>
                        </form>";
                                break;
                            }

                        case 7: {//TURMA
                                echo "
							";
                                break;
                            }

                        default: {
                                break;
                            }
                    }
                    ?>

                </fieldset>
            </div>
            <div id='menu_inferior'>
                <ul>
                    <li><a href="../perfil/index.php" target="_self">PERFIL</a></li>
                    <li><a href="../forum/index.php" target="_self">F&Oacute;RUM</a></li>
                    <?php if ($sNivelAcesso == "Administrador" || $sNivelAcesso == "Professor" || $sNivelAcesso == "Secretaria") { ?>
                        <li><a href="../noticias/index.php" target="_self">NOT&Iacute;CIAS</a></li>
                    <?php } ?>			
                    <li><a href="../portal/index.php" target="_self">SAIR</a></li>						
                </ul>
            </div>

        </div>
    </body>
</html>