<?php
	require_once("../models/Sessao.php");
	require_once("../models/Paginacao.php");
	
	$oSessao = new Sessao();
	
	if(!$oSessao->estaLogado()){	
		$oSessao->efetuarLogout();
		require_once("../models/AreaRestrita.php");
	}
	
	$iIdUsuario = $oSessao->getVariavelSessao("iIdUsuario");
	$sNivelAcesso = $oSessao->getVariavelSessao("nivelAcesso");
	$sNomeUsuario = $oSessao->getVariavelSessao("sNomeUsuario");
	
	$opcao = @$_GET['opcao'];

	switch($opcao){
		case 0://LISTAR TODOS AS TURMAS
			$sConsulta = "
				SELECT
					turma.idturma, turma.nome, turma.turno, turma.inicio, turma.curso_idcurso, curso.nome_curso
				FROM
					turma INNER JOIN curso 
					ON turma.curso_idcurso = curso.idcurso
				ORDER BY
					idturma ASC
				LIMIT";
			
			$sConsultaQtdRegistros = "
				SELECT COUNT(*) 
				FROM 
					turma INNER JOIN curso 
					ON turma.curso_idcurso = curso.idcurso";
			break;
			
		case 1://LISTAR RESULTADO DA BUSCA
			$sQuery = $_GET['campoBusca'];
			$parametro = $_GET['radioParametro'];
			if($parametro == 1) $sQuery = "iddisciplina = ".$sQuery;
			if($parametro == 2) $sQuery = "nome LIKE '%".$sQuery."%'";
			if($parametro == 3){
				if(is_numeric($sQuery)) $sQuery = "curso_idcurso = ".$sQuery;
				else $sQuery = "curso.nome_curso LIKE '%".$sQuery."%'";
			}
			$sConsulta = "
				SELECT
					turma.idturma, turma.nome, turma.turno, turma.inicio, turma.curso_idcurso, curso.nome_curso
				FROM
					turma INNER JOIN curso 
					ON turma.curso_idcurso = curso.idcurso
				WHERE
					".$sQuery."
				ORDER BY
					idturma ASC
				LIMIT";
			
			$sConsultaQtdRegistros = "
				SELECT COUNT(*) 
				FROM 
					turma INNER JOIN curso 
					ON turma.curso_idcurso = curso.idcurso
				WHERE
					".$sQuery;
			break;
	}
	
	$oPaginacao = new Paginacao(10,$sConsulta,$sConsultaQtdRegistros);
	
	if(!@$pagina = $_GET['pagina']){
		$oPaginacao->setINumeroPagina();
	}else{
		$oPaginacao->setINumeroPagina($pagina);
	}
	
	$oPaginacao->calculaPrimeiroRegistro();
	$oPaginacao->calculaTotalRegistros();
	$oPaginacao->calculaTotalPaginas();
	$oPaginacao->geraPainelNavegacao();
	
	$aDados = Array();
	
	$aDados = $oPaginacao->recuperaDados();
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
				<form name='formMensagem' action='excluirMensagem.php' method='post'>
				
				<div id='menu_aba'>
					<b>TURMAS CADASTRADAS</b><br/>
					Clique sobre uma turma para exibir sua descri��o
					<div id='botoes'>
						<input type='button' value='Excluir' onClick='excluirMensagem()' disabled />							
						<input type='hidden' name='campoOculto' id='campoOculto' value=''/>
					</div>
				</div>
				
				<div id='painel_exibicao_conteudo'>

					<table class='tabela'>
						<tr class='titulo'>
							<td colspan=2 class='celTituloIDCurso'>ID</td>
							<td class='celTituloNomeCurso'>Turma</td>
							<td class='celTituloNomeCurso'>Turno</td>
							<td class='celTituloNomeCurso'>Inicio</td>
							<td class='celTituloNomeCurso'>Curso</td>
						</tr>
						<?php
						if(!$oPaginacao->getIQtdTotalRegistros()){
							echo "
								<tr class='linhaDados'>
									<td colspan=5><b>NENHUMA TURMA CADASTRADA</b></td>
								</tr>";
						}else{
							while (list($idturma, $nome, $turno, $inicio, $curso_idcurso, $nome_curso) = mysql_fetch_array($aDados)) {
								echo "
									<tr class='linhaDados'>
										<td class='celCheck'><input type='checkbox' name='check$idturma' value='$idturma'/></td>
										<td class='celIDTurma'><a href='./cadTurma.php?opcao=1&idturma=$idturma'>$idturma</a></td>
										<td class='celNomeTurma'><a href='./cadTurma.php?opcao=1&idturma=$idturma'>$nome</a></td>
										<td class='celTurno'><a href='./cadTurma.php?opcao=1&idturma=$idturma'>$turno</a></td>
										<td class='celInicio'><a href='./cadTurma.php?opcao=1&idturma=$idturma'>$inicio</a></td>
										<td class='celCurso'><a href='./cadTurma.php?opcao=1&idturma=$idturma'>$nome_curso</a></td>
									</tr>";
							}
						}
						?>
					</table>
				</div>
				</form>
				
				<div id='paginacao'>
					<?php							
						// exibir painel de navega��o
						echo $oPaginacao->getSPainelNavegacao();
					?>
				</div>
			</div>
			
			<div id='menu_inferior'>
				<ul>
					<li><a href="../perfil/index.php" target="_self">PERFIL</a></li>
                                        <li><a href="../forum/index.php" target="_self">F&Oacute;RUM</a></li>
					<?php if($sNivelAcesso == "Administrador" || $sNivelAcesso == "Coordenador" || $sNivelAcesso == "Secretaria"){?>
                                        <li><a href="../noticias/index.php" target="_self">NOT&Iacute;CIAS</a></li>
					<?php }?>
					<li><a href="../portal/index.php" target="_self">SAIR</a></li>						
				</ul>
			</div>
			
		</div>
	</body>
</html>