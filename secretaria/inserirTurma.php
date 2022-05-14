<?php
	require_once("../models/Turma.php");
	require_once("../models/BancoDados.php");
	
    $oTurma = new Turma();
	$idcurso = $_POST['selectCurso'];
	
	echo "ID Curso: ".$idcurso;
	echo "<br/>Nome Turma: ".$_POST['ocultoNomeTurma'];
	echo "<br/>Inicio: ".$_POST['selectInicio'];
	echo "<br/>Encerramento: ".$_POST['selectEncerramento'];
	echo "<br/>Turno: ".$_POST['selectTurno'];
	$oTurma->setNome($_POST['ocultoNomeTurma']);
	$oTurma->setCurso_idcurso($idcurso);
    $oTurma->setInicio($_POST['selectInicio']);
    $oTurma->setEncerramento($_POST['selectEncerramento']);
	$oTurma->setTurno($_POST['selectTurno']);
	
	switch($opcao){
		case 0:
			if(!$oTurma->inserir()){
				echo "
					<script type='text/javascript'>
						alert('Erro ao cadastrar Turma!');
						window.history.back();
					</script>";
			}else{
				echo "
					<script type='text/javascript'>
						alert('Turma cadastrada com sucesso!');
						window.top.location.href='./cadTurma.php?opcao=0';
					</script>";
			}
			break;
			
		case 1:
			$oTurma->setIdturma($_POST['idTurma']);
			if(!$oTurma->alterar()){
				echo "
					<script type='text/javascript'>
						alert('Erro ao alterar Turma!');
						window.history.back();
					</script>";
			}else{
				echo "
					<script type='text/javascript'>
						alert('Turma alterada com sucesso!');
						window.top.location.href='./cadTurma.php?opcao=0';
					</script>";
			}
			break;
	}
?>