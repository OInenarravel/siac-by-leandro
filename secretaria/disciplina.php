<?php
    require_once("../models/Sessao.php");
    require_once("../models/BancoDados.php");
    require_once("../models/Disciplina.php");
    require_once("../models/Curso.php");


    $oSessao = new Sessao();

    if(!$oSessao->estaLogado()){	
        $oSessao->efetuarLogout();
        header("Location: ../models/AreaRestrita.php");
        exit();
    }	

    $oBanco = new BancoDados();

    $iIdUsuario = $oSessao->getVariavelSessao("iIdUsuario");
    $sNivelAcesso = $oSessao->getVariavelSessao("nivelAcesso");
    $sNomeUsuario = $oSessao->getVariavelSessao("sNomeUsuario");

    $nome = null;
    $curso_idcurso = null;
    $carga_horaria = null;
    $modulo = null;

    $opcao = @$_GET['opcao'];
    $erro = null;

    switch($opcao){
            case 0://inserir novo cadastro de disciplina

            break;

            case 1://alterar cadastro de disciplina
                $iddisciplina = @$_GET['iddisciplina'];
                if(!$iddisciplina){
                    $erro = "ERRO AO EXIBIR DISCIPLINA!<BR/>ID DISCIPLINA N&Atilde;O INFORMADO!";
                }else{
                    $oDisciplina = new Disciplina();
                    $oDisciplina->setIddisciplina($iddisciplina);

                    if($oDisciplina->listar()){
                        $nome = $oDisciplina->getNome();
                        $curso_idcurso = $oDisciplina->getCurso_idcurso();
                        $carga_horaria = $oDisciplina->getCarga_horaria();
                        $modulo = $oDisciplina->getModulo();
                    }else{
                        $erro = "ERRO AO EXIBIR DISCIPLINA! A DISCIPLINA N&Atilde;O FOI ENCONTRADA!";
                    }
                }
            break;
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <title>..: SECRETARIA ON-LINE :..</title>
        <link rel='stylesheet' href='../css/estilo_secretaria.css' type='text/css' media='screen'>
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
                <?php if($erro == null){?>
                <form name='formUsuario' action='inserirDisciplina.php' method='post'>
                    <center><b>Cadastro de Disciplina</b></center>
                    <fieldset>
                        <legend>Nome:</legend>
                        <input type='text' name='campoNomeDisciplina' id='campoNomeDisciplina' class='campoNomeDisciplina' value='<?php echo $opcao ? $nome : ""; ?>' onChange='disableBotao("botaoCadastrar",false); disableBotao("botaoLimpar",false);'/>
                    </fieldset>

                    <fieldset>
                        <legend>Curso:</legend>
                        <?php
                        $oCurso = new Curso();
                        $resultado = $oCurso->listarTodos();

                        if($resultado){
                        echo "Escolha o Curso ao qual a disciplina pertence: &nbsp;
								<select name='selectCurso' id='selectCurso'>
									<option value=''></option>";
                        while($linha = mysql_fetch_array($resultado)){
                        echo "
									<option value='$linha[idcurso]'>$linha[nome_curso]</option>";
                        }
                        echo "
								</select>\n";
                        }else{
                        echo "<h3>NENHUM CURSO CADASTRADO</h3>";
                        }
                        ?>
                    </fieldset>

                    <fieldset>
                        <legend>Carga Hor�ria:</legend>
                        <input type='text' name='campoCargaHoraria' id='campoCargaHoraria' class='campoCargaHoraria' value='<?php echo $opcao ? $carga_horaria : ""; ?>' onChange='disableBotao("botaoCadastrar",false); disableBotao("botaoLimpar",false);'/>
                    </fieldset>

                    <fieldset>
                        <legend>M�dulo:</legend>
                        <select name='selectModulo' id='selectModulo'>
                            <option value='1'>1� M�dulo</option>
                            <option value='2'>2� M�dulo</option>
                            <option value='3'>3� M�dulo</option>
                            <option value='4'>4� M�dulo</option>
                        </select>
                    </fieldset>

                    <input type='hidden' name='opcao' value='<?php echo $opcao ? "1" : "0"; ?>'/>
                    <?php echo $opcao ? "<input type='hidden' name='idDisciplina' value='$iddisciplina'/>" : ""; ?>
                    <center><input type='submit' value='Cadastrar' id='botaoCadastrar' />&nbsp;<input type='reset' value='Limpar' id='botaoLimpar' /></center>

                </form>
                <?php } else { echo "<center><h1>".$erro."</h1></center>";} ?>
            </div>

            <div id='menu_inferior'>
                <ul>
                    <li><a href="../perfil/index.php" target="_self">PERFIL</a></li>
                    <li><a href="../forum/index.php" target="_self">F&Oacute;RUM</a></li>
<?php if($sNivelAcesso == "Administrador" || $sNivelAcesso == "Secretaria" || $sNivelAcesso == "Professor"){ ?>
                    <li><a href="../noticias/index.php" target="_self">NOT&Iacute;CIAS</a></li>
                    <?php }?>			
                    <li><a href="../portal/index.php" target="_self">SAIR</a></li>						
                </ul>
            </div>

        </div>
        <?php
        if($opcao == 1 && $erro == "" && $resultado){
        echo "
            <script type='text/javascript' language='javascript'>
                    var selectCurso = document.getElementById('selectCurso');
                    var selectModulo = document.getElementById('selectModulo');

                    for (var i=0; i < selectCurso.length; i++){
                            if(selectCurso.options[i].value == '$curso_idcurso'){
                                    selectCurso.selectedIndex=i;
                                    break;
                            }
                    }

                    for (var i=0; i < selectModulo.length; i++){
                            if(selectCurso.options[i].value == '$modulo'){
                                    selectCurso.selectedIndex=i;
                                    break;
                            }
                    }
            </script>";
        }
        ?>
    </body>
</html>