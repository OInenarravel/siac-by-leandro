<?php
	require_once("../Classes/Mensagem.php");
	
	$oMensagem = new Mensagem();
	$opcao = $_GET['opcao'];
	if($opcao == 1){
		$mensagem = $_GET['mensagem'];
		$remetente = $_GET['remetente'];
		$destinatario = $_GET['destinatario'];
		
		echo "REMETENTE: ".$remetente;
		echo "<br/>DESTINATARIO: ".$destinatario;
		echo "<br/>MENSAGEM: ".$mensagem;
		echo "<br/>ENDERECO DE ORIGEM: ".$_SERVER['HTTP_REFERER'];
		$oMensagem->setRemetente($remetente);
		$oMensagem->setDestinatario($destinatario);
		$oMensagem->setConteudo($mensagem);
		$oMensagem->setTitulo("Voc� recebeu uma advert�ncia da Modera��o do F�rum!");
		
		if($oMensagem->inserir()){
			echo "
			<script>
				alert('Advert�ncia enviada com sucesso!');
				history.back();
			</script>";
		}else{
			$erro = "<h1>ERRO AO ENVIAR ADVERT�NCIA!</h1>";
		}
		die();
	}else{
		
	}
?>