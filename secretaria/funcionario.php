<?php
	require_once("../models/Sessao.php");
	require_once("../models/BancoDados.php");
	require_once("../models/Funcionario.php");
	
	
	$oSessao = new Sessao();
	
	if(!$oSessao->estaLogado()){	
            $oSessao->efetuarLogout();
            header("Location: ../models/AreaRestrita.php");
            exit();
	}	
	
	$oBanco = new BancoDados();
	
	$iIdUsuario = $oSessao->getVariavelSessao("iIdUsuario");
	$sNivelAcesso = $oSessao->getVariavelSessao("nivelAcesso");
	$sNomeUsuario = $oSessao->getVariavelSessao("sNomeUsuario");

        $s_Login = "";
	$s_Senha = "";
	$sNivel_Acesso = "";
	$sNome = "";
	$sRua = "";
	$iNumero = null;
	$sBairro = "";
	$sMunicipio = "";
	$sEstado = "";
	$iCep = null;
	$sNacionalidade = "";
	$sUfOrigem= "";
	$sPai = "";
	$sMae = "";
	$iRg = null;
	$iCpf = null;
	$sDataCadastro = "";
	$sTelefoneFixo = "";
	$sTelefoneCelular = "";
	$sTelefoneRecado = "";
	$sEmail = "";
    $iCarteiraTrabalho = null;

    $opcao = @$_GET['opcao'];

    $erro = "";
	switch($opcao){
		case 0://inserir novo cadastro de aluno
            $oFuncionario= new Funcionario();
            $s_Senha = $oFuncionario->gerarSenha();
			break;

		case 1://alterar cadastro de aluno
			$id_funcionario = @$_GET['idfuncionario'];
			if(!$id_funcionario){
				$erro = "ERRO AO EXIBIR FUNCIONARIO!<br/>ID FUNCIONARIO NAO INFORMADO!";
			}else{
				$oFuncionario = new Funcionario();
				$oFuncionario->setIdusuario($id_funcionario);

				if($oFuncionario->listar()){
					$s_Login = $oFuncionario->getLogin();
					$s_Senha = $oFuncionario->getSenha();
					$sNivel_acesso = $oFuncionario->getNivel_acesso();
					$sNome = $oFuncionario->getNome();
					$sRua = $oFuncionario->getRua();
					$iNumero = $oFuncionario->getNumero();
					$sBairro = $oFuncionario->getBairro();
					$sMunicipio = $oFuncionario->getMunicipio();
					$sEstado = $oFuncionario->getEstado();
					$sCep = $oFuncionario->getCep();
					$sNacionalidade = $oFuncionario->getNacionalidade();
					$sUfOrigem= $oFuncionario->getUf_origem();
					$sPai = $oFuncionario->getPai();
					$sMae = $oFuncionario->getMae();
					$iRg = $oFuncionario->getRg();
					$iCpf = $oFuncionario->getCpf();
					$sDataCadastro = $oFuncionario->getData_cadastro();
					$sTelefoneFixo = $oFuncionario->getTelefone_fixo();
					$sTelefoneCelular = $oFuncionario->getTelefone_celular();
					$sTelefoneRecado = $oFuncionario->getTelefone_recado();
					$sEmail = $oFuncionario->getEmail();
					$sCarteiraTrabalho = $oFuncionario->getNumCarteira();


					unset($oFuncionario);
				}else{
					$erro = "ERRO AO EXIBIR FUNCIONARIO!<br/> O FUNCIONARIO NAO FOI ENCONTRADO!";
				}
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
				<form name='formFuncionario' action='manipularFuncionario.php' method='post' onSubmit='return validarFormulario(this);'>
					<center><b>Cadastro de Funcion&aacute;rio:</b></center>
					<fieldset>
						<legend>Nome:</legend>
						<input type='text' name='nome' id='nome' class='campoNome' value='<?php echo $opcao ? $sNome : "";?>'/>
					</fieldset>

					<fieldset>
						<legend>Endere&ccedil;o</legend>
						<table>
							<tr>
								<td>Rua:</td>
								<td><input type='text' name='campoRua' class='campoRua' value='<?php echo $opcao ? $sRua : "";?>'/></td>
							</tr>
							<tr>
                                <td>N&uacute;mero:</td>
								<td><input type='text' name='campoNumero' class='campoNumero' value='<?php echo $opcao ? $iNumero : "";?>' /></td>
							</tr>
							<tr>
								<td>Bairro:</td>
								<td><input type='text' name='campoBairro' class='campoBairro' value='<?php echo $opcao ? $sBairro : "";?>'/></td>
							</tr>
							<tr>
                                <td>Munic&iacute;pio:</td>
								<td><input type='text' name='campoMunicipio' class='campoMunicipio' value='<?php echo $opcao ? $sMunicipio : "";?>'/></td>
							</tr>
							<tr>
								<td>CEP:</td>
								<td><input type='text' maxlength=5 class='campoCEP1' name='campoCEP1' id='campoCEP1' onKeyPress='mudarFoco("campoCEP1", "campoCEP2", 5)' value='<?php echo $opcao ? substr($sCep, 0, 5) : "";?>'/> - <input type='text' class='campoCEP2' name='campoCEP2' id='campoCEP2' maxlength=3 value='<?php echo $opcao ? substr($sCep, 6, 3) : "";?>'/></td>
							</tr>
							<tr>
								<td>Estado:</td>
								<td>
									<select id='campoEstado' name='campoEstado'>
										<option value='AC'>AC</option>
										<option value='AL'>AL</option>
										<option value='AP'>AP</option>
										<option value='AM'>AM</option>
										<option value='BA'>BA</option>
										<option value='CE'>CE</option>
										<option value='DF'>DF</option>
										<option value='ES'>ES</option>
										<option value='GO'>GO</option>
										<option value='MA'>MA</option>
										<option value='MT'>MT</option>
										<option value='MS'>MS</option>
										<option value='MG'>MG</option>
										<option value='PA'>PA</option>
										<option value='PB'>PB</option>
										<option value='PR'>PR</option>
										<option value='PE'>PE</option>
										<option value='PI'>PI</option>
										<option value='RJ'>RJ</option>
										<option value='RN'>RN</option>
										<option value='RS'>RS</option>
										<option value='RO'>RO</option>
										<option value='RR'>RR</option>
										<option value='SC'>SC</option>
										<option value='SP'>SP</option>
										<option value='SE'>SE</option>
										<option value='TO'>TO</option>
									</select>
								</td>
							</tr>
						</table>
					</fieldset>

					<fieldset>
						<legend>Dados Pessoais</legend>
						<table>
							<tr>
								<td>Nacionalidade:</td>
								<td><input type='text' name='campoNacionalidade' class='campoNacionalidade' value='<?php echo $opcao ? $sNacionalidade : "";?>'/></td>
							</tr>
							<tr>
								<td>UF de Origem:</td>
								<td>
									<select id='campoUFOrigem' name='campoUFOrigem'>
										<option value='AC'>AC</option>
										<option value='AL'>AL</option>
										<option value='AP'>AP</option>
										<option value='AM'>AM</option>
										<option value='BA'>BA</option>
										<option value='CE'>CE</option>
										<option value='DF'>DF</option>
										<option value='ES'>ES</option>
										<option value='GO'>GO</option>
										<option value='MA'>MA</option>
										<option value='MT'>MT</option>
										<option value='MS'>MS</option>
										<option value='MG'>MG</option>
										<option value='PA'>PA</option>
										<option value='PB'>PB</option>
										<option value='PR'>PR</option>
										<option value='PE'>PE</option>
										<option value='PI'>PI</option>
										<option value='RJ'>RJ</option>
										<option value='RN'>RN</option>
										<option value='RS'>RS</option>
										<option value='RO'>RO</option>
										<option value='RR'>RR</option>
										<option value='SC'>SC</option>
										<option value='SP'>SP</option>
										<option value='SE'>SE</option>
										<option value='TO'>TO</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>Nome Completo do pai:</td>
								<td><input type='text' name='campoPai' class='campoPai' value='<?php echo $opcao ? $sPai : "";?>'/></td>
							</tr>
							<tr>
                                <td>Nome Completo da m&atilde;e:</td>
								<td><input type='text' name='campoMae' class='campoMae' value='<?php echo $opcao ? $sMae : "";?>'/></td>
							</tr>
							<tr>
								<td>RG:</td>
								<td><input type='text' name='campoRG' class='campoRG' value='<?php echo $opcao ? $iRg : "";?>'/></td>
							</tr>
							<tr>
								<td>CPF:</td>
								<td><input type='text' name='campoCPF' class='campoCPF' value='<?php echo $opcao ? $iCpf : "";?>'/></td>
							</tr>
							<tr>
								<td>Telefone Fixo:</td>
								<td>
									(<input type='text' name='campoTelefoneFixoDDD' class='campoDDD' id='campoTelefoneFixoDDD' maxlength=2 onKeyPress='mudarFoco("campoTelefoneFixoDDD", "campoTelefoneFixo1", 2)' value='<?php echo $opcao ? substr($sTelefoneFixo, 0, 2) : "";?>'/>)&nbsp;
									<input type='text' name='campoTelefoneFixo1' class='campoTelefoneFixo1' id='campoTelefoneFixo1' maxlength=4 onKeyPress='mudarFoco("campoTelefoneFixo1", "campoTelefoneFixo2", 4)' value='<?php echo $opcao ? substr($sTelefoneFixo, 2, 4) : "";?>'/> -
									<input type='text' name='campoTelefoneFixo2' class='campoTelefoneFixo2' id='campoTelefoneFixo2' maxlength=4 value='<?php echo $opcao ? substr($sTelefoneFixo, 6, 4) : "";?>'/>
								</td>
							</tr>
							<tr>
								<td>Recado:</td>
								<td>
									(<input type='text' name='campoRecadoDDD' class='campoDDD' id='campoRecadoDDD' maxlength=2 onKeyPress='mudarFoco("campoRecadoDDD", "campoRecado1", 2)' value='<?php echo $opcao ? substr($sTelefoneFixo, 0, 2) : "";?>'/>)&nbsp;
									<input type='text' name='campoRecado1' class='campoRecado1' id='campoRecado1' maxlength=4 onKeyPress='mudarFoco("campoRecado1", "campoRecado2", 4)' value='<?php echo $opcao ? substr($sTelefoneFixo, 2, 4) : "";?>'/> -
									<input type='text' name='campoRecado2' class='campoRecado2' id='campoRecado2' maxlength=4 value='<?php echo $opcao ? substr($sTelefoneFixo, 6, 4) : "";?>'/>
								</td>
							</tr>
							<tr>
								<td>Celular:</td>
								<td>
									(<input type='text' name='campoCelularDDD' class='campoDDD' id='campoCelularDDD' maxlength=2 onKeyPress='mudarFoco("campoCelularDDD", "campoCelular1", 2)' value='<?php echo $opcao ? substr($sTelefoneFixo, 0, 2) : "";?>'/>)&nbsp;
									<input type='text'  name='campoCelular1' class='campoCelular1' id='campoCelular1' maxlength=4 onKeyPress='mudarFoco("campoCelular1", "campoCelular2", 4)' value='<?php echo $opcao ? substr($sTelefoneFixo, 2, 4) : "";?>'/> -
									<input type='text' name='campoCelular2' class='campoCelular2' id='campoCelular2' maxlength=4 value='<?php echo $opcao ? substr($sTelefoneFixo, 6, 4) : "";?>'/>
								</td>
							</tr>
							<tr>
								<td>Email:</td>
                                <td><input type='text' name='campoEmail' id='email' class='campoEmail' value='<?php echo $opcao ? $sEmail : "";?>'/> <input type='checkbox' name='enviarEmail' checked disabled/>Enviar Confirma&ccedil;&atilde;o de Cadastro para este e-mail</td>
							</tr>
						</table>
					</fieldset>
					
					<fieldset>
						<legend>Documenta&ccedil;&atilde;o:</legend>
						Carteira de Trabalho:&nbsp;<input type='text' name='campoCarteiraTrabalho' id='campoCarteiraTrabalho' value='<?php echo $opcao ? $iCarteiraTrabalho : "";?>'/>
					</fieldset>
					
					<fieldset>
						<legend>N&iacute;vel de Acesso:</legend>
						<select name='nivelAcesso' id='nivelAcesso'>
							<option value='Secretaria'>Secretaria</option>
							<option value='Direcao'>Dire&ccedil;&atilde;o</option>
							<option value='Administrador'>Administrador</option>
						</select>
					</fieldset>
					
					<fieldset>
						<legend>Login:</legend>
						<input type='text' name='campoLogin' id='campoLogin' value='<?php echo $opcao ? $s_Login : "";?>'/>&nbsp;
					</fieldset>

					<fieldset>
						<legend>Senha:</legend>
                        <input type='password' name='senha' id='senha' value='<?php echo $s_Senha;?>' onBlur='validarSenha(document.forms[0]);'/>&nbsp;
                        <input type="button" id="buttonExibirSenha" name="buttonExibirSenha" value="Exibir senha" onClick="exibirSenha('senha');"/>
					</fieldset>

					<fieldset>
						<legend>Confirmar Senha:</legend>
                        <input type='password' name='confirmaSenha' id='confirmaSenha' value='<?php echo $s_Senha;?>' onBlur='validarSenha(document.forms[0]);'/>
					</fieldset>

					<center><input type='submit' value='Salvar'/>&nbsp;<input type='reset' value='Limpar' /></center>
                    <input type='hidden' name='opcao' value='<?php echo $opcao ? "1" : "0";?>'/>
                    <?php echo $opcao ? "<input type='hidden' name='idFuncionario' value='$id_funcionario'/>" : "";?>
				</form>
			</div>
			
			<div id='menu_inferior'>
				<ul>
					<li><a href="../perfil/index.php" target="_self">PERFIL</a></li>
                    <li><a href="../forum/index.php" target="_self">F&Oacute;RUM</a></li>
					<?php if($sNivelAcesso == "Administrador" || $sNivelAcesso == "Secretaria" || $sNivelAcesso == "Professor"){?>
					<li><a href="../noticias/index.php" target="_self">NOT&Iacute;CIAS</a></li>
					<?php }?>
					<li><a href="../portal/index.php" target="_self">SAIR</a></li>
				</ul>
			</div>
			
		</div>
        <?php
			if($opcao == 1 && $erro == ""){
				echo "
				<script type='text/javascript' language='javascript'>
					var selectEstado = document.getElementById('campoEstado');
					var campoUFOrigem = document.getElementById('campoUFOrigem');
					var nivelAcesso = document.getElementById('nivelAcesso');

					for (var i=0; i < selectEstado.length; i++){
						if(selectEstado.options[i].value == '".$sEstado."'){
							selectEstado.selectedIndex=i;
							break;
						}
					}

					for (var i=0; i < campoUFOrigem.length; i++){
						if(campoUFOrigem.options[i].value == '".$sUfOrigem."'){
							campoUFOrigem.selectedIndex=i;
							break;
						}
					}

					for (var i=0; i < nivelAcesso.length; i++){
						if(nivelAcesso.options[i].value == '".$sNivel_acesso."'){
							nivelAcesso.selectedIndex=i;
							break;
						}
					}
				</script>";
			}
		?>
	</body>
</html>