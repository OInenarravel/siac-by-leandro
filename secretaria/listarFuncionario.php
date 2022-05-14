<?php
	require_once("../models/Sessao.php");
	require_once("../models/Paginacao.php");
	require_once("../models/Paginacao.php");
	require_once("../models/Funcionario.php");

	$oSessao = new Sessao();
    $oFuncionario = new Funcionario();
    $aFuncionarios = array();

	if(!$oSessao->estaLogado()){
		$oSessao->efetuarLogout();
		header("Location: ../models/AreaRestrita.php");
		exit();
	}

	$iIdUsuario = $oSessao->getVariavelSessao("iIdUsuario");
	$sNivelAcesso = $oSessao->getVariavelSessao("nivelAcesso");
	$sNomeUsuario = $oSessao->getVariavelSessao("sNomeUsuario");

	$opcao = @$_GET['opcao'];

	switch($opcao){
		case 0://LISTAR TODOS OS USUARIOS
            $aFuncionarios = $oFuncionario->listarTodos();
			break;

		case 1://LISTAR RESULTADO DA BUSCA
			$sQuery = $_GET['campoBusca'];
			$parametro = $_GET['radioParametro'];

            if($parametro == 1){//BUSCA POR ID
                $oFuncionario->setIdusuario($sQuery);
                $aFuncionarios = $oFuncionario->listar();
            }
            if($parametro == 2){//BUSCA POR NOME
                $oFuncionario->setNome($sQuery);
                $aFuncionarios = $oFuncionario->listarPorNome();
            }
            if($parametro == 3){//BUSCA POR CPF
                $oFuncionario->setCpf($sQuery);
                $aFuncionarios = $oFuncionario->listarPorCpf();
            }
            if($parametro == 4){//BUSCA POR RG
                $oFuncionario->setRg($sQuery);
                $aFuncionarios = $oFuncionario->listarPorRg();
            }
            if($parametro == 5){//BUSCA POR CARTEIRA TRABALHO
                $aFuncionarios = $oFuncionario->listarPorCarteiraTrabalho($sQuery);
            }
			break;
	}

	$oPaginacao = new Paginacao(10, sizeof($aFuncionarios), "listarFuncionario.php?opcao=".$opcao."&");

	if(!@$pagina = $_GET['pagina'])
		$oPaginacao->setINumeroPagina();
	else
		$oPaginacao->setINumeroPagina($pagina);

    $iFirstReg = $oPaginacao->getIPrimeiroRegistro();

    switch($opcao){
		case 0://LISTAR TODOS OS USUARIOS
            $aFuncionarios = $oFuncionario->listarTodos($iFirstReg, 10);
			break;

		case 1://LISTAR RESULTADO DA BUSCA
			$sQuery = $_GET['campoBusca'];
			$parametro = $_GET['radioParametro'];

            if($parametro == 1){
                $aFuncionarios = $oFuncionario->listar();
            }
            if($parametro == 2){
                $oFuncionario->setNome($sQuery);
                $aFuncionarios = $oFuncionario->listarPorNome($iFirstReg, 10);
            }
            if($parametro == 3){
                $oFuncionario->setCpf($sQuery);
                $aFuncionarios = $oFuncionario->listarPorCpf($iFirstReg, 10);
            }
            if($parametro == 4){
                $oFuncionario->setRg($sQuery);
                $aFuncionarios = $oFuncionario->listarPorRg($iFirstReg, 10);
            }
			break;
            if($parametro == 5){
                $oFuncionario->setNumCarteira($sQuery);
                $aFuncionarios = $oFuncionario->listarPorCarteiraTrabalho($iFirstReg, 10);
            }
			break;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title>..: SECRETARIA ON-LINE :..</title>
		<link rel='stylesheet' href='../css/estilo_secretaria.css' type='text/css' media='screen'/>
		<link rel="stylesheet" href="../css/menu_style.css" type="text/css" media='screen'/>
		<script src="../js/secretaria.js" type="text/javascript"></script>
		<script type="text/javascript" language='javascript' src="http://jqueryjs.googlecode.com/files/jquery-1.3.2.min.js"></script>
		<script src="../js/accordion.js" type="text/javascript" language='javascript'></script>
	</head>

	<body>
		<div id='geral'>

			<div id='menu_superior'>
				<div id='text_menu_esquerda'>Seja bem-vindo(a) <?php echo $sNomeUsuario;?></div>
				<div id='text_menu_direita'><a href='../portal/index.php' class='link_sair'>SAIR</a></div>
			</div>

			<?php 
				require_once("painel.php");
				$sPainelSecretaria = gerarPainel($sNivelAcesso);
				echo $sPainelSecretaria;
			?>

			<div id='painel_exibicao'>
				<form name='formMensagem' action='excluirMensagem.php' method='post'>

				<div id='menu_aba'>
					<?php echo $opcao == 1 ? "Resultados da busca para: ".$sQuery."<br/>" : "<b>FUNCIONARIOS CADASTRADOS</b><br/>"?>
					Clique sobre um Funcion&aacute;rio para exibir seu cadastro completo
					<div id='botoes'>
						<input type='button' value='Excluir' onClick='excluirMensagem()' disabled />
						<input type='hidden' name='campoOculto' id='campoOculto' value=''/>
					</div>
				</div>

				<div id='painel_exibicao_conteudo'>

					<table class='tabela'>
						<tr class='titulo'>
							<td colspan=2 class='celTituloIDUsuario'>ID</td>
							<td class='celTituloNome'>Nome</td>
							<td class='celTituloNivelAcesso'>N&iacute;vel de Acesso</td>
							<td class='celTituloDataCadastro'>Data de Cadastro</td>
						</tr>
						<?php
						if($aFuncionarios == null){
							echo "
								<tr class='linhaDados'>
									<td colspan=5><b>NENHUM FUNCION&Aacute;RIO ENCONTRADO</b></td>
								</tr>";
						}else{
							if(@$parametro == 1){
                                $idusuario = $oFuncionario->getIdusuario();
                                $nivelAcesso = $oFuncionario->getNivel_acesso();
                                $nome = $oFuncionario->getNome();
                                $dataCadastro = $oFuncionario->getData_cadastro();
                                $timestamp = strtotime($dataCadastro);
								$dataCadastro = date("d/m/Y h:i",$timestamp);
                                echo "
                                <tr class='linhaDados'>
                                    <td class='celCheck'><input type='checkbox' name='check".$idusuario."' value='".$idusuario."'/></td>
                                    <td class='celIDUsuario'><a href='./cadFuncionario.php?opcao=1&idfuncionario=".$idusuario."'>".$idusuario."</a></td>
                                    <td class='celNome'><a href='./cadFuncionario.php?opcao=1&idfuncionario=".$idusuario."'>".$nome."</a></td>
                                    <td class='celNivelAcesso'><a href='./cadFuncionario.php?opcao=1&idfuncionario=".$idusuario."'>".$nivelAcesso."</a></td>
                                    <td class='celDataCadastro'><a href='./cadFuncionario.php?opcao=1&idfuncionario=".$idusuario."'>".$dataCadastro."</a></td>
                                </tr>";
                            }else{
                                foreach($aFuncionarios as $Funcionario){
                                    list($idusuario,,, $nivelAcesso, $nome,,,,,,,,,,,,, $dataCadastro) = $Funcionario;
                                    $timestamp = strtotime($dataCadastro);
                                    $dataCadastro = date("d/m/Y h:i",$timestamp);
                                    echo "
                                    <tr class='linhaDados'>
                                        <td class='celCheck'><input type='checkbox' name='check".$idusuario."' value='".$idusuario."'/></td>
                                        <td class='celIDUsuario'><a href='./cadFuncionario.php?opcao=1&idfuncionario=".$idusuario."'>".$idusuario."</a></td>
                                        <td class='celNome'><a href='./cadFuncionario.php?opcao=1&idfuncionario=".$idusuario."'>".$nome."</a></td>
                                        <td class='celNivelAcesso'><a href='./cadFuncionario.php?opcao=1&idfuncionario=".$idusuario."'>".$nivelAcesso."</a></td>
                                        <td class='celDataCadastro'><a href='./cadFuncionario.php?opcao=1&idfuncionario=".$idusuario."'>".$dataCadastro."</a></td>
                                    </tr>";
                                }
                            }
						}
						?>
					</table>
				</div>
				</form>

				<div id='paginacao'>
					<?php
						// exibir painel de navegacao
						echo $oPaginacao->getSPainelNavegacao();
					?>
				</div>

			</div>

			<div id='menu_inferior'>
				<ul>
					<li><a href="../perfil/index.php" target="_self">PERFIL</a></li>
					<li><a href="../forum/index.php" target="_self">F&Oacute;RUM</a></li>
					<?php if($sNivelAcesso == "Administrador" || $sNivelAcesso == "Coordenador" || $sNivelAcesso == "Secretaria"){?>
					<li><a href="../noticias/index.php" target="_self">NOT&Iacute;CIAS</a></li>
					<?php }?>
					<li><a href="../portal/index.php" target="_self">SAIR</a></li>
				</ul>
			</div>

		</div>
	</body>
</html>