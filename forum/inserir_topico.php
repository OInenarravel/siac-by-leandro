<?php
	require_once("../models/BancoDados.php");
	require_once("../models/Sessao.php");
	
	$oSessao = new Sessao();
	
	if(!$oSessao->estaLogado()){	
		$oSessao->efetuarLogout();
		require_once("../models/AreaRestrita.php");
	}
	
	$idusuario = $oSessao->getVariavelSessao("iIdUsuario");
	$nome_topico = $_POST['nome_topico'];
	$descricao_topico = $_POST['descricao_topico'];
	$nome_categoria = $oSessao->getVariavelSessao("nome_categoria");	
	$nome_subcategoria = $oSessao->getVariavelSessao("nome_subcategoria");	
	$idsubcategoria = $oSessao->getVariavelSessao("idsubcategoria");	
	
	$oBanco = new BancoDados();
	
	
		
	$oBanco->manipular("INSERT INTO topico VALUES(0,$idusuario,$idsubcategoria,'$nome_topico',\"$descricao_topico\",now())");
	
	echo "
	<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\"
	\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
	<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"pt\" lang=\"pt\" dir=\"ltr\">
	<head>
		
		<title>..:::.. F&Oacute;RUM CEET VASCO COUTINHO - P�gina de Redirecionamento ..::..</title>
		<script language='JavaScript'>
		<!--
			function redireciona(){
				window.top.location.href='./subcategoria.php?nome_categoria=$nome_categoria&nome_subcategoria=$nome_subcategoria&idsubcategoria=$idsubcategoria';
			}
		-->
		</script>
	</head>
	<body>
		Nome do t�pico: $nome_topico<br/>\n
		Descricao do t�pico: $descricao_topico<br/>\n
		<h2>T�pico Cadastrado com sucesso!</h2>
		<h3>Aguarde... voc� ser� redirecionado em instantes...</h3>
		<script type='text/javascript'>
			function jump () {
				document.location = './subcategoria.php?nome_categoria=$nome_categoria&nome_subcategoria=$nome_subcategoria&idsubcategoria=$idsubcategoria';
			} setTimeout('jump()',3000);
		</script>
	</body>
	</html>";
	
	;
?>