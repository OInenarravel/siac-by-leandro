<?php
    require_once("../models/Sessao.php");
    require_once("../models/Curso.php");
    require_once("../models/Turma.php");

    $oSessao = new Sessao();
    $oCurso = new Curso();

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
    $inicio = null;
    $encerramento = null;
    $turno = null;
    $modulo = null;

    $opcao = @$_GET['opcao'];
    $erro = null;

    $resultado = $oCurso->listarTodos();

    if($resultado){
            switch($opcao){
                    case 0://inserir novo cadastro de turma

                            break;

                    case 1://alterar cadastro de turma
                            $idturma = @$_GET['idturma'];
                            if(!$idturma){
                                    $erro = "ERRO AO EXIBIR TURMA!<BR/>ID TURMA N&Atilde;O INFORMADO!";
                            }else{
                                    $oTurma = new Turma();
                                    $oTurma->setIdturma($idturma);

                                    if($oTurma->listar()){
                                            $nome = $oTurma->getNome();
                                            $curso_idcurso = $oTurma->getCurso_idcurso();
                                            $inicio = $oTurma->getInicio();
                                            $encerramento = $oTurma->getEncerramento();
                                            $turno = $oTurma->getTurno();
                                            $modulo = $oTurma->getModulo();

                                    }else{
                                            $erro = "ERRO AO EXIBIR TURMA! A TURMA N&Atilde;O FOI ENCONTRADA!";
                                    }
                            }
                            break;
            }
    }else{
            $erro = "ERRO AO RECUPERAR LISTA DE CURSOS!<br/>TENTE NOVAMENTE OU ENTRE EM CONTATO COM O ADMINISTRADOR";
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
				<div id='text_menu_esquerda'>Seja bem-vindo(a) <?php echo $sNomeUsuario;?></div>
				<div id='text_menu_direita'><a href='../portal/index.php' class='link_sair'>SAIR</a></div>
			</div>
			
			<?php 
				require_once("painel.php");
				$sPainelSecretaria = gerarPainel($sNivelAcesso);
				echo $sPainelSecretaria;
			?>
			
			<div id='painel_exibicao'>
				<?php if($erro == null){?>
				<form name='formUsuario' action='inserirTurma.php' method='post'>
					<center><b>Cadastro de Turma</b></center>
					
					<fieldset>
						<legend>Nome:</legend>
						<input type='text' name='campoNomeTurma' id='campoNomeTurma' class='campoNomeTurma' value='' disabled />
						<input type='hidden' name='ocultoNomeTurma' id='ocultoNomeTurma'/>
					</fieldset>
					
					<fieldset>
						<legend>Curso:</legend>
						<?php
						echo "
						<select class='selectCurso' name='selectCurso' id='selectCurso' onClick='gerarNomeTurma()'>\n";
						while($linha = mysql_fetch_array($resultado)){
							echo "
							<option value='$linha[idcurso]' name='$linha[nome_curso]'>$linha[nome_curso]</option>\n";
						}
						echo "
						</select>";
						?>
					</fieldset>

					<fieldset>
						<legend>Turno:</legend>
						<select name='selectTurno' id='selectTurno' onClick='gerarNomeTurma()'>
							<option value='MATUTINO'>MATUTINO</option>
							<option value='VESPERTINO'>VESPERTINO</option>
							<option value='NOTURNO'>NOTURNO</option>
						</select>
					</fieldset>
					
					<fieldset>
						<legend>Inicio:</legend>
						<select name='selectInicio' id='selectInicio' onClick='gerarNomeTurma()'>
						<?php
							$date = date("Y");
							$x = 1;
							for($i=0;$i<14;$i++){
								echo "<option>$date/$x</option>";
								if($x == 1){
									$x++;
								}else{
									$x = 1;
									$date++;
								}
							}
						?>
						</select>
					</fieldset>
					
					<fieldset>
						<legend>Encerramento:</legend>
						<select name='selectEncerramento' id='selectEncerramento'>
						<?php
							$date = date("Y");
							$date++;
							$x = 1;
							for($i=0;$i<14;$i++){
								echo "<option>$date/$x</option>";
								if($x == 1){
									$x++;
								}else{
									$x = 1;
									$date++;
								}
							}
						?>
						</select>
					</fieldset>
					
					<input type='hidden' name='opcao' value='<?php echo $opcao ? "1" : "0";?>'/>
					<?php echo $opcao ? "<input type='hidden' name='idTurma' value='$idturma'/>" : "";?>
					<center><input type='submit' value='Salvar' id='botaoCadastrar' disabled />&nbsp;<input type='reset' id='botaoLimpar' value='Limpar' disabled /></center>
				</form>
				<?php } else { echo "<center><h1>".$erro."</h1></center>";}?>
			</div>
			
			<div id='menu_inferior'>
				<ul>
					<li><a href="../perfil/index.php" target="_self">PERFIL</a></li>
                                        <li><a href="../forum/index.php" target="_self">F&Oacute;RUM</a></li>
					<?php if($sNivelAcesso == "Administrador" || $sNivelAcesso == "Secretaria" || $sNivelAcesso == "Professor"){?>
                                        <li><a href="../noticias/index.php" target="_self">NOT&Iacute;CIAS</a></li>
					<?php }?>			
					<li><a href="../portal/index.php" target="_self">SAIR</a></li>						
				</ul>
			</div>
			
		</div>
	</body>
</html>