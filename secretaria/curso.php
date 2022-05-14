<?php
require_once("../models/Sessao.php");
require_once("../models/Curso.php");
require_once("../Noticias/fckeditor/fckeditor.php");

$oSessao = new Sessao();

if(!$oSessao->estaLogado()){
    $oSessao->efetuarLogout();
    header("Location: ../models/AreaRestrita.php");
    exit();
}

$iIdUsuario = $oSessao->getVariavelSessao("iIdUsuario");
$sNivelAcesso = $oSessao->getVariavelSessao("nivelAcesso");
$sNomeUsuario = $oSessao->getVariavelSessao("sNomeUsuario");

$nome_curso = null;
$qtdModulos = null;
$cargaHorariaCurso = null;
$cargaHorariaEstagio = null;
$amparoLegal = null;
$sobre = null;
$perfilProfissional = null;

$opcao = @$_GET['opcao'];
$erro = null;

switch($opcao){
case 0://inserir novo cadastro de curso

break;

case 1://alterar cadastro de curso
    $idcurso = @$_GET['idcurso'];
    if(!$idcurso){
        $erro = "ERRO AO EXIBIR CURSO!<BR/>ID CURSO N&Atilde;O INFORMADO!";
    }else{
        $oCurso = new Curso();
        $oCurso->setIdcurso($idcurso);

        if($oCurso->listar()){
            $nome_curso = $oCurso->getNome_curso();
            $qtdModulos = $oCurso->getQtd_modulos();
            $turno = $oCurso->getTurno();
            $cargaHorariaCurso = $oCurso->getCarga_horaria_curso();
            $cargaHorariaEstagio = $oCurso->getCarga_horaria_estagio();
            $estagioObrigatorio = $oCurso->getEstagio_obrigatorio();
            $amparoLegal = $oCurso->getAmparo_legal();
            $sobre = $oCurso->getSobre();
            $perfilProfissional = $oCurso->getPerfil_profissional();
        }else{
            $erro = "ERRO AO EXIBIR CURSO! O CURSO N&Atilde;O FOI ENCONTRADO!";
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
                <form name='formUsuario' action='inserirCurso.php' onSubmit='return validarCadastroCurso();' method='post'>
                    <center><b>Cadastro de Curso</b></center>

                    <fieldset>
                        <legend>Nome:</legend>
                        <input type='text' name='campoNome' id='campoNome' class='campoNome' value='<?php echo $opcao ? $nome_curso : ""; ?>'/>
                    </fieldset>

                    <fieldset>
                        <legend>Quantidade de M&oacute;dulos:</legend>
                        <select id='campoQtdModulos' name='campoQtdModulos' class='campoQtdModulos'>
                            <option value='1'>1</option>
                            <option value='2'>2</option>
                            <option value='3'>3</option>
                            <option value='4'>4</option>
                        </select>
                    </fieldset>

                    <fieldset>
                        <legend>Turno:</legend>
                        <select id='campoTurno' name='campoTurno' class='campoTurno'>
                            <option value='matutino'>Matutino</option>
                            <option value='vespertino'>Vespertino</option>
                            <option value='noturno'>Noturno</option>
                        </select>
                    </fieldset>

                    <fieldset>
                        <legend>Carga Hor&aacute;ria do Curso:</legend>
                        <input type='text' name='cargaHCurso' id='cargaHCurso' class='campoHCurso' value='<?php echo $opcao ? $cargaHorariaCurso : ""; ?>'/> horas
                    </fieldset>

                    <fieldset>
                        <legend>Carga Hor&aacute;ria de Est&aacute;gio:</legend>
                        <input type='text' name='cargaHEstagio' id='cargaHEstagio' class='campoHEstagio'  value='<?php echo $opcao ? $cargaHorariaEstagio : ""; ?>'/> horas
                        <input type='checkbox' name='estagioObrigatorio' id='estagioObrigatorio' class='estagioObrigatorio' <?php if($opcao) { echo $estagioObrigatorio ? "checked" : "";
                        }else echo "cheked"; ?> />&nbsp;Est&aacute;gio Obrigat&oacute;rio
                    </fieldset>

                    <fieldset>
                        <legend>Amparo Legal:</legend>
                        <?php 
                        $editor = new FCKeditor("campoAmparoLegal"); //Nomeia a area de texto
                        $editor-> BasePath = "../Noticias/fckeditor/";  //Informa a pasta do FKC Editor
                        $editor-> Value = "$amparoLegal";               //Informa o valor inicial do campo, no exemplo esta vazio 
                        $editor-> Width = "685";                  //informa a largura do editor  
                        $editor-> Height = "500";                //informa a altura do editor
                        $editor-> Create();                        // Cria o editor 
                        ?>
                    </fieldset>

                    <fieldset>
                        <legend>Sobre:</legend>
                        <?php 
                        $editor = new FCKeditor("campoSobre"); //Nomeia a area de texto
                        $editor-> BasePath = "../Noticias/fckeditor/";  //Informa a pasta do FKC Editor
                        $editor-> Value = "$sobre";               //Informa o valor inicial do campo, no exemplo esta vazio 
                        $editor-> Width = "685";                  //informa a largura do editor  
                        $editor-> Height = "500";                //informa a altura do editor
                        $editor-> Create();                        // Cria o editor 
                        ?>
                    </fieldset>

                    <fieldset>
                        <legend>Perfil Profissional:</legend>
                        <?php 
                        $editor = new FCKeditor("campoPerfilProfissional"); //Nomeia a area de texto
                        $editor-> BasePath = "../Noticias/fckeditor/";  //Informa a pasta do FKC Editor
                        $editor-> Value = "$perfilProfissional";               //Informa o valor inicial do campo, no exemplo esta vazio 
                        $editor-> Width = "685";                  //informa a largura do editor  
                        $editor-> Height = "500";                //informa a altura do editor
                        $editor-> Create();                        // Cria o editor 
                        ?>
                    </fieldset>
                    <input type='hidden' name='opcao' value='<?php echo $opcao ? "1" : "0"; ?>'/>
                    <?php echo $opcao ? "<input type='hidden' name='idCurso' value='$idcurso'/>" : ""; ?>
                    <center><input type='submit' value='Salvar' id='botaoCadastrar' />&nbsp;<input type='reset' id='botaoLimpar' value='Limpar' /></center>

                </form>
                <?php } else { echo "<center><h1>".$erro."</h1></center>"; } ?>
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
        if($opcao == 1 && $erro == ""){
        echo "
				<script type='text/javascript' language='javascript'>
					var campoQtdModulos = document.getElementById('campoQtdModulos');
					var campoTurno = document.getElementById('campoTurno');

					for (var i=0; i < campoQtdModulos.length; i++){
						if(campoQtdModulos.options[i].value == '$qtdModulos'){
							campoQtdModulos.selectedIndex=i;
							break;
						}
					}

					for (var i=0; i < campoTurno.length; i++){
						if(campoTurno.options[i].value == '$turno'){
							campoTurno.selectedIndex=i;
							break;
						}
					}
				</script>";
        }
        ?>
    </body>
</html>