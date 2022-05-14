<?php
	require_once("../models/Curso.php");
	
    $oCurso = new Curso();
	
	$opcao = @$_POST['opcao'];
	$estagioObrigatorio = !(@$_POST['estagioObrigatorio']) ? 0 : 1;
	
	echo "<br/>NOME CURSO: ".$_POST['campoNome'];
	echo "<br/>QTD MODULOS: ".$_POST['campoQtdModulos'];
	echo "<br/>TURNO: ".$_POST['campoTurno'];
	echo "<br/>CARGA HORARIA CURSO: ".$_POST['cargaHCurso'];
	echo "<br/>CARGA HORARIA ESTAGIO: ".$_POST['cargaHEstagio'];
	echo "<br/>ESTAGIO OBRIGATORIO: ".$estagioObrigatorio;
	echo "<br/>AMPARO LEGAL: ".$_POST['campoAmparoLegal'];
	echo "<br/>SOBRE: ".$_POST['campoSobre'];
	echo "<br/>PERFIL PROFISSIONAL: ".$_POST['campoPerfilProfissional'];
	
	$oCurso->setNome_curso($_POST['campoNome']);
	$oCurso->setQtd_modulos($_POST['campoQtdModulos']);
	$oCurso->setTurno($_POST['campoTurno']);
	$oCurso->setCarga_horaria_curso($_POST['cargaHCurso']);
	$oCurso->setCarga_horaria_estagio($_POST['cargaHEstagio']);
	$oCurso->setEstagio_obrigatorio($estagioObrigatorio);
	$oCurso->setAmparo_legal($_POST['campoAmparoLegal']);
	$oCurso->setSobre($_POST['campoSobre']);
	$oCurso->setPerfil_profissional($_POST['campoPerfilProfissional']);
	
	switch($opcao){
		case 0:
			if(!$oCurso->inserir()){
				echo "
					<script type='text/javascript'>
						alert('Erro ao cadastrar Curso!');
						window.top.location.href='./cadCurso.php';
					</script>";
			}else{
				echo "
					<script type='text/javascript'>
						alert('Curso cadastrado com sucesso!');
						window.top.location.href='./cadCurso.php';
					</script>";
			}
			break;
		
		case 1:
			$oCurso->setIdcurso($_POST['idCurso']);
			if(!$oCurso->alterar()){
				echo "
					<script type='text/javascript'>
						alert('Erro ao alterar Curso!');
						window.top.location.href='curso.php';
					</script>";
			}else{
				echo "
					<script type='text/javascript'>
						alert('Curso alterado com sucesso!');
						window.top.location.href='curso.php';
					</script>";
			}
			break;
	}
	
?>