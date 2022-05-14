<?php
	require_once("../models/Sessao.php");
	require_once("../models/Paginacao.php");
	
	$oSessao = new Sessao();
	$parametro = null;

	if(!$oSessao->estaLogado()){	
		$oSessao->efetuarLogout();
		require_once("../models/AreaRestrita.php");
	}
	
	$idUsuario = $oSessao->getVariavelSessao("iIdUsuario");
	
	switch($parametro){
		case 1:
			
			break;
			
		case 2:
			
			break;
		
		case 3:
			
			break;
		
		case 4:
			
			break;
		
		case 5:
			
			break;
			
		default:
			if($oSessao->getVariavelSessao("nivelAcesso") == "Administrador" || $oSessao->getVariavelSessao("nivelAcesso") == "Funcionário - Secretaria"){
				$sConsulta = "
					SELECT
						idcurso, nome_curso
					FROM
						curso
					ORDER BY
						idcurso ASC
					LIMIT" ;
				
				$sConsultaQtdRegistros = "
					SELECT COUNT(*) 
					FROM 
						curso";
			}
			break;
	}
	
	$oPaginacao = new Paginacao(10,$sConsulta,$sConsultaQtdRegistros);
	
	if(!$pagina = $_GET['pagina']){
		$oPaginacao->setINumeroPagina();
	}else{
		$oPaginacao->setINumeroPagina($pagina);
	}
	
	$oPaginacao->calculaPrimeiroRegistro();
	$oPaginacao->calculaTotalRegistros();
	$oPaginacao->calculaTotalPaginas();
	$oPaginacao->geraPainelNavegacao();

    $oPaginacao = new Paginacao(10, sizeof($listaCursos), "cursos.php?");

    if (!$pagina = $_GET['pagina'])
        $oPaginacao->setINumeroPagina();
    else
        $oPaginacao->setINumeroPagina($pagina);
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
				<div id='text_menu_esquerda'>Seja bem-vindo(a) <?php echo $oSessao->getVariavelSessao("sNomeUsuario");?></div>
				<div id='text_menu_direita'><a href='../portal/index.php' class='link_sair'>SAIR</a></div>
			</div>
			
			<?php 
				require_once("./painelPerfil.php");
				$sPainelPerfil = gerarPainelPerfil($oSessao->getVariavelSessao("nivelAcesso"));
				echo $painel;
			?>
			
			<div id='painel_exibicao'>
					<form name='formMensagem' action='excluirMensagem.php' method='post'>
					
					<div id='menu_aba'>
						<b>CURSOS CADASTRADOS</b><br/>
						Clique sobre um curso para exibir sua descri&ccedil;&atilde;o
						<div id='botoes'>
							<input type='button' value='Excluir' onClick='excluirMensagem()' disabled />							
							<input type='hidden' name='campoOculto' id='campoOculto' value=''/>
						</div>
					</div>
					
					<div id='painel_exibicao_conteudo'>

						<table class='tabela'>
							<tr class='titulo'>
								<td colspan=2 class='celTituloIDCurso'>ID</td>
								<td class='celTituloNomeCurso'>Curso</td>
							</tr>
							<?php
								if(!$oPaginacao->getIQtdTotalRegistros()){
									echo "
										<tr class='linhaDados'>
											<td colspan=5><b>NENHUM CURSO CADASTRADO</b></td>
										</tr>";
								}else{
									while (list($idcurso, $nome_curso) = mysqli_fetch_array($aDados)) {
										echo "
											<tr class='linhaDados'>
												<td class='celCheck'><input type='checkbox' name='check$idcurso' value='$idcurso'/></td>
												<td class='celIDCurso'>$idcurso</td>
												<td class='celNomeCurso'><a href='./cadCurso.php?opcao=2&idcurso=$idcurso'>$nome_curso</a></td>
											</tr>";
									}
								}
							?>

						</table>
					</div>
					
					<div id='paginacao'>
						<?php							
							// exibir painel de navegacao
							echo $oPaginacao->getSPainelNavegacao();
						?>
					</div>
					</form>
				</div>
			
			<div id='menu_inferior'>
				<ul>
					<li><a href="../perfil/index.php" target="_self">PERFIL</a></li>
                    <li><a href="../forum/index.php" target="_self">F&Oacute;RUM</a></li>
					<?php if($oSessao->getVariavelSessao("nivelAcesso") == "Administrador" || $oSessao->getVariavelSessao("nivelAcesso") == "Professor" || $oSessao->getVariavelSessao("nivelAcesso") == "Funcion�rio - Secretaria"){?>
                    <li><a href="../noticias/index.php" target="_self">NOT&Iacute;CIAS</a></li>
					<?php }?>			
					<li><a href="../portal/index.php" target="_self">SAIR</a></li>						
				</ul>
			</div>
			
		</div>
	</body>
</html>