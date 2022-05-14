<?php
	require_once("../models/Sessao.php");
	require_once("../models/BancoDados.php");
	require_once("../models/Banido.php");
	require_once("../models/Moderador.php");
	
	$oSessao = new Sessao();
	$oBanido = new Banido();
	
	$nivelAcesso = $oSessao->getVariavelSessao("nivelAcesso");
	if(!$oSessao->estaLogado() || $oSessao->getVariavelSessao("nivelAcesso") != "Administrador"){
		$oSessao->efetuarLogout();
		require_once("../models/AreaRestrita.php");
	}
	
	$oBanido->setUsuario_idusuario($oSessao->getVariavelSessao("iIdUsuario"));
		
	echo $oBanido->listar() ? "<script>\nalert(\"Seu nome consta na lista de usu�rios banidos! Voc� n�o poder� acessar a �rea do f�rum. Entre em contato com seu coordenador de curso para regularizar sua situa��o.\");\nwindow.location = \"../Portal/index.php\";\n</script>\n" : "";	
	
	if(@$_POST['opcao'] == 1){
		$listaCategorias = explode(".",$_POST['listaCategorias']);
		array_pop($listaCategorias);
		
		$idusuario = @$_POST['idusuario'];
		
		print_r($_POST);
		
		$oModerador = new Moderador();
			
		$oModerador->setUsuario_idusuario($idusuario);
		
		if(!$oModerador->inserir()){
			echo "
			<script>
				alert('Erro ao cadastrar Moderador!');
				window.location = './administrativoUsuario.php';
			</script>
			";
		}else{
			foreach($listaCategorias as $categoria){
				$oModerador->setUsuario_idusuario($idusuario);
				if(!$oModerador->moderarCategoria($categoria)){
					echo "
					<script>
						alert('Erro ao cadastrar Categoria do Moderador!');
						window.location = './administrativoUsuario.php';
					</script>
					";
					die();			
				}
			}
			echo "
			<script>
				alert('Moderador cadastrado com sucesso!');
				window.location = './administrativoUsuario.php';
			</script>
			";
		}
		die();
	}else{
		$idusuario = @$_GET['idusuario'];
		$oBanco = new BancoDados();
		$oBanco->pesquisar(" SELECT DISTINCT
								idcategoria, nome_categoria
							FROM
							  categoria");
							  
		if($oBanco->getQtd() != 0){
			$resultado = $oBanco->getResultado();
		}else{
			
		}
		
		$oBanco->pesquisar(" SELECT
								nome
							FROM
							    usuario
						    WHERE
								idusuario=$idusuario");
							  
		if($oBanco->getQtd() != 0){
			$usuario = mysql_fetch_array($oBanco->getResultado());
		}else{
			
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt" lang="pt" >
	<head>
		<title>..:::.. F&Oacute;RUM CEET VASCO COUTINHO - INFORM�TICA - PROGRAMA��O ..:::..</title>
		<link rel='stylesheet' href='../css/estilo_forum.css' type='text/css' media='screen'/>
		<link rel="stylesheet" href="../css/menu_style.css" type="text/css" />
		<script src="../js/forum.js" type="text/javascript"></script>
		<style type='text/css'>
		<!--
		.linha_titulo{
			border: 1px solid black;
		}
		-->
		</style>
	</head>
	<body>
		<div id='container'>
		
			<div id='cabecalho'>
			
				<div id='banner_superior'>
					<div id='banner_superior_figura'>
						<img src='../img/banner_texto_forum.png'/>
					</div>
				</div>
				
				<div id='menu_superior'>
					<ul>
						<li><a href="./index.php" >HOME</a></li>
						<li><a href="./faq.php" >FAQ</a></li>
						<?if(($oSessao->getVariavelSessao("nivelAcesso") != "Aluno") && ($oSessao->getVariavelSessao("nivelAcesso") != "Professor" && $oSessao->getVariavelSessao("nivelAcesso") != "Usu&aacute;rio")){?>
						<li><a href="./membros.php">LISTA DE MEMBROS</a></li>
						<li>
							<a href="#">&Aacute;REA ADMINISTRATIVA</a>
							<ul>
								<li><a href="./administrativoCategoria.php">CATEGORIA</a></li>
								<li><a href="./administrativoSubCategoria.php">SUBCATEGORIA</a></li>
								<li><a href="./administrativoModerador.php">MODERADOR</a></li>
								<li><a href="./administrativoUsuario.php">USU&Aacute;RIO</a></li>
							</ul>
						</li>
						<?}?>
						<li><a href='../portal/index.php'>SAIR</a></li>
					</ul>
				</div>

			</div>
			
			<div id='conteudo'>
				<form name='formModerador' method='post' action='tornarModerador.php' onSubmit='return validarModerador()'>					
					<table>
						<tr>
							<td colspan=4><b>Nome:</b>&nbsp;
								<input type='text' size=100 name='campoNome' id='campoNome' class='campoNome' readonly value='<?echo $usuario['nome'];?>'/>
							</td>
						</tr>
						<tr>
							<td colspan=4><b>Selecione as categorias que ser�o moderadas pelo usu�rio:</b></td>
						</tr>
						<?php
							$i=1;
							$x=1;
							while($linha = mysql_fetch_array($resultado,MYSQL_ASSOC)){
								if($x == 1){
									echo "
									<tr>
										<td>
											<input type='checkbox' name='check' id='check$i' value='$linha[idcategoria]'/>&nbsp;$linha[nome_categoria]
										</td>";
									$x++;
								}
								elseif($x != 1 && $x != 4){
									echo "
									<td>
										<input type='checkbox' name='check' id='check$i' value='$linha[idcategoria]'/>&nbsp;$linha[nome_categoria]
									</td>";
									$x++;
								}
								elseif($x == 4){
									echo "
										<td>
											<input type='checkbox' name='check' id='check$i' value='$linha[idcategoria]'/>&nbsp;$linha[nome_categoria]
										</td>
									</tr>";
									$x = 1;
								}
								$i++;							
							}
						?>
						<tr>
							<td colspan=4 align='center'>
								<input type='hidden' name='listaCategorias' id='listaCategorias' value='' />
								<input type='hidden' name='idusuario' id='idusuario' value='<?echo $idusuario?>' />
								<input type='hidden' name='opcao' id='opcao' value='1' />
								<input type='submit' name='tornarModerador' value='Salvar'/>&nbsp;
								<input type='reset' name='banir' value='Limpar' />
							</td>
						</tr>
					</table>
				</form>
			</div>
			
			<?php
				require_once("../models/rodape.php");
			?>

		</div>
		
	</body>
</html>