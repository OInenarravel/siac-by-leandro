<?php
    require_once("../models/Sessao.php");
    require_once("../models/Curso.php");
    require_once("../models/Disciplina.php");
    require_once("../models/Professor.php");

    $oSessao = new Sessao();

    if(!$oSessao->estaLogado()){	
        $oSessao->efetuarLogout();
        header("Location: ../models/AreaRestrita.php");
        exit();
    }

    $iIdUsuario = $oSessao->getVariavelSessao("iIdUsuario");
    $sNivelAcesso = $oSessao->getVariavelSessao("nivelAcesso");
    $sNomeUsuario = $oSessao->getVariavelSessao("sNomeUsuario");
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
				<form name='formProfessor' action='./manipularProfessor.php' method='post' onSubmit='return validarFormulario(this);'>
					<center><b>Cadastro de Professor:</b></center>
					<fieldset>
						<legend>Nome:</legend>
						<input type='text' name='nome' id='nome' class='campoNome'/>
					</fieldset>
					
					<fieldset>
						<legend>Endere&ccedil;o:</legend>								
						<table>
							<tr>
								<td>Rua:</td>
								<td><input type='text' name='campoRua' class='campoRua' value=''/></td>
							</tr>
							<tr>
								<td>N&uacute;mero:</td>
								<td><input type='text' name='campoNumero' class='campoNumero'/></td>
							</tr>
							<tr>
								<td>Bairro:</td>
								<td><input type='text' name='campoBairro' class='campoBairro'/></td>
							</tr>
							<tr>
								<td>Munic&iacute;pio:</td>
								<td><input type='text' name='campoMunicipio' class='campoMunicipio'/></td>
							</tr>
							<tr>
								<td>CEP:</td>
								<td><input type='text' maxlength=5 class='campoCEP1' name='campoCEP1' id='campoCEP1' onKeyPress='mudarFoco("campoCEP1", "campoCEP2", 5)' /> - <input type='text' class='campoCEP2' name='campoCEP2' id='campoCEP2' maxlength=3 /></td>
							</tr>
							<tr>
								<td>Estado:</td>
								<td>
									<select name='campoEstado'>
										<option>AC</option>
										<option>AL</option>
										<option>AP</option>
										<option>AM</option>
										<option>BA</option>
										<option>CE</option>
										<option>DF</option>
										<option>ES</option>
										<option>GO</option>
										<option>MA</option>
										<option>MT</option>
										<option>MS</option>
										<option>MG</option>
										<option>PA</option>
										<option>PB</option>
										<option>PR</option>
										<option>PE</option>
										<option>PI</option>
										<option>RJ</option>
										<option>RN</option>
										<option>RS</option>
										<option>RO</option>
										<option>RR</option>
										<option>SC</option>
										<option>SP</option>
										<option>SE</option>
										<option>TO</option>
									</select>
								</td>
							</tr>
						</table>
					</fieldset>
					
					<fieldset>
						<legend>Dados Pessoais:</legend>
						<table>
							<tr>
								<td>Nacionalidade:</td>
								<td><input type='text' name='campoNacionalidade' class='campoNacionalidade' /></td>
							</tr>
							<tr>
								<td>UF de Origem:</td>
								<td>
									<select name='campoUFOrigem'>
										<option>AC</option>
										<option>AL</option>
										<option>AP</option>
										<option>AM</option>
										<option>BA</option>
										<option>CE</option>
										<option>DF</option>
										<option>ES</option>
										<option>GO</option>
										<option>MA</option>
										<option>MT</option>
										<option>MS</option>
										<option>MG</option>
										<option>PA</option>
										<option>PB</option>
										<option>PR</option>
										<option>PE</option>
										<option>PI</option>
										<option>RJ</option>
										<option>RN</option>
										<option>RS</option>
										<option>RO</option>
										<option>RR</option>
										<option>SC</option>
										<option>SP</option>
										<option>SE</option>
										<option>TO</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>Nome Completo do pai:</td>
								<td><input type='text' name='campoPai' class='campoPai' /></td>
							</tr>
							<tr>
								<td>Nome Completo da m&atilde;e:</td>
								<td><input type='text' name='campoMae' class='campoMae' /></td>
							</tr>
							<tr>
								<td>RG:</td>
								<td><input type='text' name='campoRG' class='campoRG' /></td>
							</tr>
							<tr>
								<td>CPF:</td>
								<td><input type='text' name='campoCPF' class='campoCPF' /></td>
							</tr>
							<tr>
								<td>Telefone Fixo:</td>
								<td>
									(<input type='text' name='campoTelefoneFixoDDD' class='campoDDD' id='campoTelefoneFixoDDD' maxlength=2 onKeyPress='mudarFoco("campoTelefoneFixoDDD", "campoTelefoneFixo1", 2)' />)&nbsp;
									<input type='text' name='campoTelefoneFixo1' class='campoTelefoneFixo1' id='campoTelefoneFixo1' maxlength=4 onKeyPress='mudarFoco("campoTelefoneFixo1", "campoTelefoneFixo2", 4)' /> - 
									<input type='text' name='campoTelefoneFixo2' class='campoTelefoneFixo2' id='campoTelefoneFixo2' maxlength=4 />
								</td>
							</tr>
							<tr>
								<td>Recado:</td>
								<td>
									(<input type='text' name='campoRecadoDDD' class='campoDDD' id='campoRecadoDDD' maxlength=2 onKeyPress='mudarFoco("campoRecadoDDD", "campoRecado1", 2)' />)&nbsp;
									<input type='text' name='campoRecado1' class='campoRecado1' id='campoRecado1' maxlength=4 onKeyPress='mudarFoco("campoRecado1", "campoRecado2", 4)' /> - 
									<input type='text' name='campoRecado2' class='campoRecado2' id='campoRecado2' maxlength=4 />
								</td>
							</tr>
							<tr>
								<td>Celular:</td>
								<td>
									(<input type='text' name='campoCelularDDD' class='campoDDD' id='campoCelularDDD' maxlength=2 onKeyPress='mudarFoco("campoCelularDDD", "campoCelular1", 2)' />)&nbsp;
									<input type='text'  name='campoCelular1' class='campoCelular1' id='campoCelular1' maxlength=4 onKeyPress='mudarFoco("campoCelular1", "campoCelular2", 4)' /> - 
									<input type='text' name='campoCelular2' class='campoCelular2' id='campoCelular2' maxlength=4 />
								</td>
							</tr>
							<tr>
								<td>Email:</td>
								<td><input type='text' name='campoEmail' id='email' class='campoEmail'/> <input type='checkbox' name='enviarEmail' checked />Enviar Confirma��o de Cadastro para este e-mail</td>
							</tr>
						</table>
					</fieldset>
					
					<fieldset>
						<legend>Documenta&ccedil;&atilde;o:</legend>
						Carteira de Trabalho:&nbsp;<input type='text' name='campoCarteiraTrabalho' id='campoCarteiraTrabalho'/><br/><br/>
						N&ordm; Funcional:&nbsp;<input type='text' name='campoNFuncional' id='campoNFuncional'/><br/><br/>
						Marque as disciplinas que ser&atilde;o lecionadas pelo professor:<br/>
						<?php
							$oCurso = new Curso();
							$oDisciplina = new Disciplina();

                            $aListaDeCursos = $oCurso->listarTodos();
                            if($aListaDeCursos != NULL){
                                foreach($aListaDeCursos as $curso){
                                    list($idcurso, $nome_curso,,,,,,,,) = $curso;
                                    echo "<br/>* ".$nome_curso."<br/>";
                                    $oDisciplina->setCurso_idcurso($idcurso);
                                    $aListaDeDisciplinas = $oDisciplina->listarPorCurso();
                                    $i = 1;
                                    if($aListaDeDisciplinas != NULL){
                                        foreach($aListaDeDisciplinas as $disciplina){
                                            list($iddisciplina, $nome,,,) = $disciplina;
                                            echo "
                                            <input type='checkbox' name='checkDisciplina' id='checkDisciplina".$i."' value='".$iddisciplina."' />".$nome."<br/>";
                                            $i++;
                                        }
                                    }else{
                                        echo "<h3>NENHUMA DISCIPLINA CADASTRADA</h3>";
                                    }
                                }
                            }else{
                                echo "<h3>NENHUM CURSO CADASTRADO</h3>";
                            }
						?>
						<input type='hidden' name='ocultoListaDisciplinas' id='ocultoListaDisciplinas' />
					</fieldset>
							
					<fieldset>
						<legend>N&iacute;vel de Acesso:</legend>
						<select name='nivelAcesso' id='nivelAcesso'>
							<option value='Professor'>Professor</option>
							<option value='Coordenador'>Coordenador</option>
						</select>
					</fieldset>
					
					<fieldset>
						<legend>Login:</legend>
						<input type='text' name='campoLogin' id='campoLogin'/>&nbsp;
						<input type='checkbox' id='genLog' onclick='gerarLogin();' />Gerar Login automaticamente
					</fieldset>
					
					<fieldset>
						<legend>Senha:</legend>
						<input type='password' name='senha' id='senha'/>
					</fieldset>
					
					<fieldset>
						<legend>Confirmar Senha:</legend>
						<input type='password' name='confirmaSenha' id='confirmaSenha' onBlur='validarSenha()' />
					</fieldset>

					<center><input type='submit' value='Salvar'/>&nbsp;<input type='reset' value='Limpar' /></center>
					<input type='hidden' name='tipoUsuario' value='3'/>
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
	</body>
</html>