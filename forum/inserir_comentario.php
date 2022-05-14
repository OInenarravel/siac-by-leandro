<?php
	require_once("../models/BancoDados.php");
	require_once("../models/Sessao.php");
	
	$oSessao = new Sessao();
	
	if(!$oSessao->estaLogado()){	
		$oSessao->efetuarLogout();
		require_once("../models/AreaRestrita.php");
	}
	
	$idusuario = $oSessao->getVariavelSessao("iIdUsuario");
	$idtopico = $oSessao->getVariavelSessao("idtopico");
	$conteudo_comentario = $_POST['conteudo_comentario'];
	$nome_subcategoria = $oSessao->getVariavelSessao("idtopico");	
	$titulotopico = $oSessao->getVariavelSessao("titulotopico");
	
	$oBanco = new BancoDados();
	
	
		
	$oBanco->manipular("INSERT INTO 
						 comentario
					   VALUES(0,$idusuario,$idtopico,'$conteudo_comentario',now())");

	echo "
	<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\"
	\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
	<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"pt\" lang=\"pt\" dir=\"ltr\">
	<head>
		
		<title>..:::.. F&Oacute;RUM CEET VASCO COUTINHO - P�gina de Redirecionamento ..::..</title>
	</head>
	<body>
		<h2>Coment�rio enviado com sucesso!</h2>
		<h3>Aguarde... voc� ser� redirecionado em instantes...</h3>
		<script type='text/javascript'>
			function jump () {
				document.location = './topico.php?idtopico=$idtopico&titulotopico=$titulotopico'; 
			} setTimeout('jump()',4000);
		</script>
	</body>
	</html>";
	
	;
?>