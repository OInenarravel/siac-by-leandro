<?php
	require_once("../models/Sessao.php");
	require_once("../models/BancoDados.php");
	
	$oSessao = new Sessao();
	
	if(!$oSessao->estaLogado()){
		$oSessao->efetuarLogout();
		require_once("../models/AreaRestrita.php");
	}
	
	$idsubcategoria = $oSessao->getVariavelSessao("idsubcategoria");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt" lang="pt" dir="ltr">
	<head>
		
		<title>..:::.. F&Oacute;RUM CEET VASCO COUTINHO ..:::..</title>
		<link rel='stylesheet' href='../css/estilo_forum.css' type="text/css" media='screen' />
		<link rel="stylesheet" href="../css/menu_style.css" type="text/css" />
		<script type='text/javascript' src='../js/forum.js'></script>
		<script language='JavaScript'>
		<!--
			function enviarTopico(){
				var nome = document.formulario.nome_topico.value;
				var descricao = document.formulario.descricao_topico.value;
				
				if(nome != '' && descricao != ''){
					return true;
				}
				else{
					alert('Todos os campos sao de preenchimento obrigat�rio!\nPor favor confira o formulario e tente novamente.');
					return false;
				}
			}
		-->
		</script>
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
						<?if(($_SESSION["nivelAcesso"] != "aluno") && ($_SESSION["nivelAcesso"] != "professor" && $_SESSION["nivelAcesso"] != "usuario")){?>
						<li><a href="./membros.php">LISTA DE MEMBROS</a></li>
						<li>
							<a href="#">&Aacute;REA ADMINISTRATIVA</a>
							<ul>
								<li><a href="./administrativoCategoria.php">CATEGORIA</a></li>
								<li><a href="./administrativoSubCategoria.php">SUBCATEGORIA</a></li>
								<li><a href="./administrativoModerador.php">MODERADOR</a></li>
								<li><a href="./administrativoUsuario.php">USU�RIO</a></li>
							</ul>
						</li>
						<?}?>
						<li><a href='../portal/index.php'>SAIR</a></li>
					</ul>
				</div>

			</div>
			
			<div id='conteudo'>

				<form name='formulario' method='post' action='inserir_topico.php' onSubmit='return enviarTopico();'>
					<table class='categoria'>
						<tr class='linha_titulo'>
							<td class='cel_titulo_nome'>
								Nome do T�pico
							</td>
						</tr>
						<tr class='linha_dados'>
							<td class=''>
								<input type='text' name='nome_topico' size='140' value='Digite o nome do t�pico aqui' onClick="value=''" />
							</td>
						</tr>
						<tr class='linha_titulo'>
							<td class='cel_titulo_descricao'>
								Descri&ccedil;&atilde;o
							</td>
						</tr>
						<tr>
							<td class='cel_conteudo'>
								<textarea name='descricao_topico' cols=104 rows=10></textarea>
							</td>
						</tr>
							
					</table><br/>
					<input type='submit' value='Criar T�pico'/>
				</form>
				
			</div>
			
			<?php
				require_once("../models/rodape.php");
			?>

		</div>
		
	</body>
</html>