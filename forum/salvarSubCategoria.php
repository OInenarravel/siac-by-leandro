<?php
	require_once("../models/SubCategoria.php");
	require_once("../models/BancoDados.php");
	
	$oBanco = new BancoDados();
	$oSubCategoria = new SubCategoria();	
	
	echo "ID SUBCATEGORIA: ".@$_POST['campoID'];
	echo "<br/>ID CATEGORIA: ".@$_POST['selectCategoria'];
	echo "<br/>NOME: ".@$_POST['campoNome'];
	echo "<br/>DESCRICAO: ".@$_POST['campoDescricao'];
	
	if($idsubcategoria = @$_POST['campoID']){
		$nomeSubCategoria = $_POST['campoNome'];
		$descricao = $_POST['campoDescricao'];
		$idcategoria = $_POST['selectCategoria'];
		
		$oSubCategoria->setIdSubCategoria($idsubcategoria);
		$oSubCategoria->setIdCategoria($idcategoria);
		$oSubCategoria->setNomeSubCategoria($nomeSubCategoria);
		$oSubCategoria->setDescricao($descricao);
		
		$x = $oSubCategoria->alterar();
		if($x){
			echo "
			<script>
				alert('Sub-Categoria atualizada com sucesso!');
				window.location = './administrativoSubCategoria.php';
			</script>";
		}else{
			echo "<h1>ERRO AO ALTERAR SUBCATEGORIA!</h1>";
		}
	}else{		
		$descricao = @$_POST['campoNome'];
		if(!$idsubcategoria && $descricao){
			$nomeSubCategoria = $_POST['campoNome'];
			$idcategoria = $_POST['selectCategoria'];
			
			$oSubCategoria->setNomeSubCategoria($nomeSubCategoria);
			$oSubCategoria->setIdCategoria($idcategoria);
			$oSubCategoria->setDescricao($descricao);
		
			$x = $oSubCategoria->inserir();
			if($x){
				echo "
				<script>
					alert('Sub-Categoria cadastrada com sucesso!');
					window.location = './administrativoSubCategoria.php';
				</script>";
			}else{
				$erro = "<h1>ERRO AO INSERIR SUBCATEGORIA!</h1>";
			}
		}
	}
	;
?>