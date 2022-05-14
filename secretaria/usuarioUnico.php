<?php
require_once("../models/Sessao.php");
require_once("../models/Usuario.php");

$oSessao = new Sessao();
$oUsuario = new Usuario();
$opcao = null;
$erro = null;

if(!$oSessao->estaLogado()){
    $oSessao->efetuarLogout();
}

$iIdUsuario = $oSessao->getVariavelSessao("iIdUsuario");
$sNivelAcesso = $oSessao->getVariavelSessao("nivelAcesso");
$sNomeUsuario = $oSessao->getVariavelSessao("sNomeUsuario");

$id_usuario = 0;
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

if(isset($_GET['opcao'])) {
    $opcao = $_GET['opcao'];
}

switch($opcao){
    case 0://inserir novo cadastro de usuario

        break;

    case 1://alterar cadastro de usuario
        if(!isset($_GET['idusuario'])){
            $erro = "ERRO AO EXIBIR USUARIO!<br/>ID USUARIO NAO INFORMADO!";
        }else{
            $id_usuario = $_GET['idusuario'];
            $oUsuario->setIdusuario($id_usuario);

            if($oUsuario->listar()){
                $s_Login = $oUsuario->getLogin();
                $s_Senha = $oUsuario->getSenha();
                $sNivel_acesso = $oUsuario->getNivel_acesso();
                $sNome = $oUsuario->getNome();
                $sRua = $oUsuario->getRua();
                $iNumero = $oUsuario->getNumero();
                $sBairro = $oUsuario->getBairro();
                $sMunicipio = $oUsuario->getMunicipio();
                $sEstado = $oUsuario->getEstado();
                $sCep = $oUsuario->getCep();
                $sNacionalidade = $oUsuario->getNacionalidade();
                $sUfOrigem= $oUsuario->getUf_origem();
                $sPai = $oUsuario->getPai();
                $sMae = $oUsuario->getMae();
                $iRg = $oUsuario->getRg();
                $iCpf = $oUsuario->getCpf();
                $sDataCadastro = $oUsuario->getData_cadastro();
                $sTelefoneFixo = $oUsuario->getTelefone_fixo();
                $sTelefoneCelular = $oUsuario->getTelefone_celular();
                $sTelefoneRecado = $oUsuario->getTelefone_recado();
                $sEmail = $oUsuario->getEmail();

                unset($oUsuario);
            }else{
                $erro = "ERRO AO EXIBIR USUARIO!<br/> O USUARIO NAO FOI ENCONTRADO!";
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
			<?php if($erro == ""){?>
				<form name='formUsuario' action='manipularUsuario.php' method='post' onSubmit='return validarFormulario(this);'>
                    <center><b>Cadastro de Usu&aacute;rio:</b></center>
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
                                <td><input type='text' name='campoEmail' id='email' class='campoEmail' value='<?php echo $opcao ? $sEmail : "";?>'/> <input type='checkbox' name='enviarEmail' checked />Enviar Confirma&ccedil;&atilde;o de Cadastro para este e-mail</td>
							</tr>
						</table>
					</fieldset>
					
					<fieldset>
                        <legend>N&iacute;vel de Acesso:</legend>
						<select name='nivelAcesso' id='nivelAcesso'>
                            <option value='Usuario'>Usu&aacute;rio</option>
						</select>						
					</fieldset>
					
					<fieldset>
						<legend>Login:</legend>
						<input type='text' name='campoLogin' id='campoLogin' value='<?php echo $opcao ? $s_Login : "";?>'/>&nbsp;
					</fieldset>
					
					<fieldset>
						<legend>Senha:</legend>
						<input type='password' name='senha' id='senha' value='<?php echo $opcao ? $s_Senha : "";?>'/>
					</fieldset>
					
					<fieldset>
						<legend>Confirmar Senha:</legend>
						<input type='password' name='confirmaSenha' id='confirmaSenha' value='<?php echo $opcao ? $s_Senha : "";?>' onBlur='validarSenha();'/>
					</fieldset>

					<center><input type='submit' value='Salvar'/>&nbsp;<input type='reset' value='Limpar' <?php //if($opcao == 1){echo "disabled";}?>/></center>
					<input type='hidden' name='opcao' value='<?php echo $opcao ? "1" : "0";?>'/>
					<?php echo $opcao ? "<input type='hidden' name='idUsuario' value='$id_usuario'/>" : "";?>
				</form>
				<?php } else { echo "<center><h1>".$erro."</h1></center>";}?>
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