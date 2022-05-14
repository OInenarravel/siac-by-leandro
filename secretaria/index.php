<?php
require_once("../models/Sessao.php");
require_once("painel.php");

$oSessao = new Sessao();
$painel = null;
$usuarioLogado = $oSessao->getVariavelSessao("usuario");

if (!$oSessao->estaLogado()) {
    $oSessao->expulsar();
}

$idUsuario = $oSessao->getVariavelSessao("iIdUsuario");
$nivelAcesso = $oSessao->getVariavelSessao("nivelAcesso");
$nomeUsuario = $oSessao->getVariavelSessao("sNomeUsuario");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title>..: SECRETARIA ON-LINE :..</title>
		<link rel='stylesheet' href='../css/estilo_secretaria.css' type='text/css' media='screen'/>
		<link rel="stylesheet" href="../css/menu_style.css" type="text/css" media='screen'/>
		<script src="../js/secretaria.js" type="text/javascript"></script>
	</head>	
	
	<body>		
		<div id='geral'>
	
			<div id='menu_superior'>
				<div id='text_menu_esquerda'>Seja bem-vindo(a) <?php echo $nomeUsuario;?></div>
				<div id='text_menu_direita'><a href='../portal/index.php' class='link_sair'>SAIR</a></div>
			</div>
			
			<?php
				$painel = gerarPainel($nivelAcesso);
				echo $painel;
			?>
			
			<div id='painel_exibicao'>
				<div id="centerPainel">
                    <button type="button" class="botaoCenterPainel" value="Usuarios" onClick="javascript:top.location='usuarios.php';">Usu&aacute;rios</button>
                    <button type="button" class="botaoCenterPainel" value="Alunos" onClick="javascript:top.location='alunos.php';">Alunos</button>
                    <button type="button" class="botaoCenterPainel" value="Professores" onClick="javascript:top.location='professores.php';">Professores</button>
                    <button type="button" class="botaoCenterPainel" value="Coordenadores" onClick="javascript:top.location='coordenadores.php';">Coordenadores</button>
                    <button type="button" class="botaoCenterPainel" value="Cursos" onClick="javascript:top.location='cursos.php';">Cursos</button>
                    <button type="button" class="botaoCenterPainel" value="Disciplinas" onClick="javascript:top.location='disciplinas.php';">Disciplinas</button>
                    <button type="button" class="botaoCenterPainel" value="Turmas" onClick="javascript:top.location='turmas.php';">Turmas</button>
				</div>
			</div>
			
			<div id='menu_inferior'>
				<ul>
					<li><a href="../perfil/index.php" target="_self">PERFIL</a></li>
					<li><a href="../forum/index.php" target="_self">F&Oacute;RUM</a></li>
					<?php if($nivelAcesso == "Administrador" || $nivelAcesso == "Coordenador" || $nivelAcesso == "Secretaria"){?>
					<li><a href="../noticias/index.php" target="_self">NOT&Iacute;CIAS</a></li>
					<?php }?>
					<li><a href="../portal/index.php" target="_self">SAIR</a></li>						
				</ul>
			</div>
			
		</div>
	</body>
</html>