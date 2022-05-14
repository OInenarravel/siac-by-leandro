<?php
	require_once("../models/Moderador.php");
	require_once("../models/Banido.php");
	require_once("../models/BancoDados.php");
	require_once("../models/Sessao.php");
	
	$oBanco = new BancoDados();	
	$oSessao = new Sessao();
	$oBanido = new Banido();
	
	$oBanido->setUsuario_idusuario($oSessao->getVariavelSessao("iIdUsuario"));
		
	echo $oBanido->listar() ? "<script>\nalert(\"Seu nome consta na lista de usuários banidos! Você não poderá acessar a área do fórum. Entre em contato com seu coordenador de curso para regularizar sua situação.\");\nwindow.location = \"../Portal/index.php\";\n</script>\n" : "";

	echo "ID USUARIO: ".@$_POST['check'];
	echo "<br/>ID MODERADOR: ".$oSessao->getVariavelSessao("iIdUsuario");
	echo "<br/>MOTIVO: ".@$_POST['campoMotivo'];
	echo "<br/>".print_r($_POST);
	
	switch($opcao = @$_POST['opcao']){
		case 1:
			$oModerador = new Moderador();
			
			$oModerador->setUsuario_idusuario($_POST['check']);
			
			if($oModerador->inserir()){
				echo "
				<script>
					alert('Moderador cadastrado com sucesso!');
					//window.location = './administrativoUsuario.php';
				</script>
				";
			}else{
				echo "
				<script>
					alert('Erro ao cadastrar Moderador!');
					//window.location = './administrativoUsuario.php';
				</script>
				";
			}
			
		case 2:
			$oBanido = new Banido();
			
			$oBanido->setUsuario_idusuario($_POST['check']);
			
			if($oBanido->excluir()){
				echo "
				<script>
					alert('Usuario reintegrado com sucesso!');
					//window.location = './administrativoUsuario.php';
				</script>
				";
			}else{
				echo "
				<script>
					alert('Erro ao banir usuario!');
					//window.location = './administrativoUsuario.php';
				</script>
				";
			}
			break;
			
		case 3:			
			$oBanido = new Banido();
			
			$oBanido->setUsuario_idusuario($_POST['check']);
			$oBanido->setModerador_usuario_idusuario($oSessao->getVariavelSessao("iIdUsuario"));
			$oBanido->setMotivo($_POST['campoMotivo']);
			
			if($oBanido->listar()){
				echo "
				<script>
					alert('Este usuario ja esta banido!');
					//window.location = './administrativoUsuario.php';
				</script>
				";
			}
			
			if($oBanido->inserir()){
				echo "
				<script>
					alert('Usuario banido com sucesso!');
					//window.location = './administrativoUsuario.php';
				</script>
				";
			}else{
				echo "
				<script>
					alert('Erro ao banir usuario!');
					//window.location = './administrativoUsuario.php';
				</script>
				";
			}
			break;
			
		default:
			echo "<script>alert('Erro de opção!!');</script>";
			break;
	}
	;
?>