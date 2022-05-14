<?php
	require_once("../models/Disciplina.php");
	
    $oDisciplina = new Disciplina();
	
	$opcao = @$_POST['opcao'];
	$oDisciplina->setCurso_idcurso($_POST['selectCurso']);
	$oDisciplina->setNome($_POST['campoNomeDisciplina']);
	$oDisciplina->setCarga_horaria($_POST['campoCargaHoraria']);
	$oDisciplina->setModulo($_POST['selectModulo']);
	
	switch($opcao){
		case 0:
			if(!$oDisciplina->inserir()){
				echo "
				<script type='text/javascript'>
					alert('Erro ao cadastrar Disciplina!');
					history.back();
				</script>";
			}else{		
				echo "
					<script type='text/javascript'>
						alert('Disciplina cadastrada com sucesso!');
						window.top.location.href='./cadDisciplina.php';
					</script>";
			}
			break;
			
		case 1:
			$oDisciplina->setIddisciplina($_POST['idDisciplina']);
			if(!$oDisciplina->alterar()){
				echo "
					<script type='text/javascript'>
						alert('Erro ao alterar Disciplina!');
						history.back();
					</script>";
			}else{
				echo "
					<script type='text/javascript'>
						alert('Disciplina alterada com sucesso!');
						window.top.location.href='disciplina.php';
					</script>";
			}
			break;
	}
?>