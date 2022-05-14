<?php
    require_once("../models/Sessao.php");
    require_once("../models/Paginacao.php");
    require_once("../models/Paginacao.php");
    require_once("../models/Aluno.php");

    $oSessao = new Sessao();
    $oAluno = new Aluno();
    $aAlunos = array();

    if (!$oSessao->estaLogado()) {
        $oSessao->efetuarLogout();
        header("Location: ../models/AreaRestrita.php");
        exit();
    }

    $iIdUsuario = $oSessao->getVariavelSessao("iIdUsuario");
    $sNivelAcesso = $oSessao->getVariavelSessao("nivelAcesso");
    $sNomeUsuario = $oSessao->getVariavelSessao("sNomeUsuario");

    $opcao = @$_GET['opcao'];

    switch ($opcao) {
        case 0://LISTAR TODOS OS ALUNOS
            $aAlunos = $oAluno->listarTodos();
        break;

        case 1://LISTAR RESULTADO DA BUSCA
            $sQuery = $_GET['campoBusca'];
            $parametro = $_GET['radioParametro'];

            if ($parametro == 1) {//BUSCA POR ID
                $oAluno->setIdusuario($sQuery);
                $aAlunos = $oAluno->listar();
            }
            if ($parametro == 2) {//BUSCA POR MATRICULA
                $oAluno->setNum_matricula($sQuery);
                $aAlunos = $oAluno->listarPorMatricula();
            }
            if ($parametro == 3) {//BUSCA POR NOME
                $oAluno->setNome($sQuery);
                $aAlunos = $oAluno->listarPorNome();
            }
            if ($parametro == 4) {//BUSCA POR CPF
                $oAluno->setCpf($sQuery);
                $aAlunos = $oAluno->listarPorCpf();
            }
            if ($parametro == 5) {//BUSCA POR RG
                $oAluno->setRg($sQuery);
                $aAlunos = $oAluno->listarPorRg();
            }
            if ($parametro == 6) {//BUSCA POR TURMA
                $oAluno->setTurma_idturma($sQuery);
                $aAlunos = $oAluno->listarPorTurma();
            }
            if ($parametro == 7) {//BUSCA POR CURSO
                $aAlunos = $oAluno->listarPorCurso($sQuery);
            }
            break;
    }

    $oPaginacao = new Paginacao(10, sizeof($aAlunos), "alunos.php?opcao=" . $opcao . "&");

    if (!@$pagina = $_GET['pagina'])
        $oPaginacao->setINumeroPagina();
    else
        $oPaginacao->setINumeroPagina($pagina);

    $iFirstReg = $oPaginacao->getIPrimeiroRegistro();

    switch ($opcao) {
        case 0://LISTAR TODOS OS USUARIOS
            $aAlunos = $oAluno->listarTodos($iFirstReg, 10);
            break;

        case 1://LISTAR RESULTADO DA BUSCA
            $sQuery = $_GET['campoBusca'];
            $parametro = $_GET['radioParametro'];

            if ($parametro == 1) {
                $aAlunos = $oAluno->listar();
            }
            if ($parametro == 2) {
                $oAluno->setNum_matricula($sQuery);
                $aAlunos = $oAluno->listarPorMatricula($iFirstReg, 10);
            }
            if ($parametro == 3) {
                $oAluno->setNome($sQuery);
                $aAlunos = $oAluno->listarPorNome($iFirstReg, 10);
            }
            if ($parametro == 4) {
                $oAluno->setCpf($sQuery);
                $aAlunos = $oAluno->listarPorCpf($iFirstReg, 10);
            }
            if ($parametro == 5) {
                $oAluno->setRg($sQuery);
                $aAlunos = $oAluno->listarPorRg($iFirstReg, 10);
            }
            if ($parametro == 6) {
                $oAluno->setTurma_idturma($sQuery);
                $aAlunos = $oAluno->listarPorTurma($iFirstReg, 10);
            }
            if ($parametro == 7) {
                $aAlunos = $oAluno->listarPorCurso($sQuery, $iFirstReg, 10);
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
					<?php echo $opcao == 1 ? "Resultados da busca para: ".$sQuery."<br/>" : "<b>ALUNOS CADASTRADOS</b><br/>"?>
					Clique sobre um aluno para exibir seu cadastro completo
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
						if($aAlunos == null){
							echo "
								<tr class='linhaDados'>
									<td colspan=5><b>NENHUM ALUNO ENCONTRADO</b></td>
								</tr>";
						}else{
							if(@$parametro == 1){
                                $idusuario = $oAluno->getIdusuario();
                                $nivelAcesso = $oAluno->getNivel_acesso();
                                $nome = $oAluno->getNome();
                                $dataCadastro = $oAluno->getData_cadastro();
                                $timestamp = strtotime($dataCadastro);
								$dataCadastro = date("d/m/Y h:i",$timestamp);
                                echo "
                                <tr class='linhaDados'>
                                    <td class='celCheck'><input type='checkbox' name='check".$idusuario."' value='".$idusuario."'/></td>
                                    <td class='celIDUsuario'><a href='./cadAluno.php?opcao=1&idaluno=".$idusuario."'>".$idusuario."</a></td>
                                    <td class='celNome'><a href='./cadAluno.php?opcao=1&idaluno=".$idusuario."'>".$nome."</a></td>
                                    <td class='celNivelAcesso'><a href='./cadAluno.php?opcao=1&idaluno=".$idusuario."'>".$nivelAcesso."</a></td>
                                    <td class='celDataCadastro'><a href='./cadAluno.php?opcao=1&idaluno=".$idusuario."'>".$dataCadastro."</a></td>
                                </tr>";
                            }else{
                                foreach($aAlunos as $aluno){
                                    list($idusuario,,, $nivelAcesso, $nome,,,,,,,,,,,,, $dataCadastro) = $aluno;
                                    $timestamp = strtotime($dataCadastro);
                                    $dataCadastro = date("d/m/Y h:i",$timestamp);
                                    echo "
                                    <tr class='linhaDados'>
                                        <td class='celCheck'><input type='checkbox' name='check".$idusuario."' value='".$idusuario."'/></td>
                                        <td class='celIDUsuario'><a href='./cadAluno.php?opcao=1&idaluno=".$idusuario."'>".$idusuario."</a></td>
                                        <td class='celNome'><a href='./cadAluno.php?opcao=1&idaluno=".$idusuario."'>".$nome."</a></td>
                                        <td class='celNivelAcesso'><a href='./cadAluno.php?opcao=1&idaluno=".$idusuario."'>".$nivelAcesso."</a></td>
                                        <td class='celDataCadastro'><a href='./cadAluno.php?opcao=1&idaluno=".$idusuario."'>".$dataCadastro."</a></td>
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
						// exibir painel de navega��o
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