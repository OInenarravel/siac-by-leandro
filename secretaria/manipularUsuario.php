<?php
	require_once("../models/Usuario.php");
	require_once("../models/Aluno.php");
	require_once("../models/Professor.php");
	require_once("../models/Funcionario.php");
	
	$opcao = @$_POST['opcao'];
	
	echo "<br/>Login: ".$_POST['campoLogin'];
	echo "<br/>Senha: ".$_POST['senha'];
	echo "<br/>Nivel de Acesso: ".@$_POST['nivelAcesso'];
	echo "<br/>Nome: ".$_POST['nome'];
	echo "<br/>Rua: ".$_POST['campoRua'];
	echo "<br/>Numero: ".$_POST['campoNumero'];
	echo "<br/>Bairro: ".$_POST['campoBairro'];
	echo "<br/>Municipio: ".$_POST['campoMunicipio'];
	echo "<br/>Estado: ".$_POST['campoEstado'];
	echo "<br/>CEP: ".$_POST['campoCEP1']."-".$_POST['campoCEP2'];
	echo "<br/>Nacionalidade: ".$_POST['campoNacionalidade'];
	echo "<br/>UF Origem: ".$_POST['campoUFOrigem'];
	echo "<br/>Nome do Pai: ".$_POST['campoPai'];
	echo "<br/>Nome do M�e: ".$_POST['campoMae'];
	echo "<br/>RG: ".$_POST['campoRG'];
	echo "<br/>CPF: ".$_POST['campoCPF'];
	echo "<br/>Tel. Fixo: ".$_POST['campoTelefoneFixoDDD'].$_POST['campoTelefoneFixo1'].$_POST['campoTelefoneFixo2'];
	echo "<br/>Tel. Recado: ".$_POST['campoRecadoDDD'].$_POST['campoRecado1'].$_POST['campoRecado2'];
	echo "<br/>Tel. Celular: ".$_POST['campoCelularDDD'].$_POST['campoCelular1'].$_POST['campoCelular2'];
	echo "<br/>E-mail: ".$_POST['campoEmail'];
	if(@$_POST['enviarEmail'] == "on")
	echo "<br/>Enviar confirma��o para e-mail: ".@$_POST['enviarEmail'];

    $oUsuario = new Usuario();

    $oUsuario->setLogin(trim($_POST['campoLogin']));
    $oUsuario->setSenha(trim($_POST['senha']));
    $oUsuario->setNivel_acesso($_POST['nivelAcesso']);
    $oUsuario->setNome($_POST['nome']);
    $oUsuario->setRua($_POST['campoRua']);
    $oUsuario->setNumero($_POST['campoNumero']);
    $oUsuario->setBairro($_POST['campoBairro']);
    $oUsuario->setMunicipio($_POST['campoMunicipio']);
    $oUsuario->setEstado($_POST['campoEstado']);
    $oUsuario->setCep($_POST['campoCEP1']."-".$_POST['campoCEP2']);
    $oUsuario->setNacionalidade($_POST['campoNacionalidade']);
    $oUsuario->setUf_origem($_POST['campoUFOrigem']);
    $oUsuario->setPai($_POST['campoPai']);
    $oUsuario->setMae($_POST['campoMae']);
    $oUsuario->setRg($_POST['campoRG']);
    $oUsuario->setCpf($_POST['campoCPF']);
    $oUsuario->setTelefone_fixo($_POST['campoTelefoneFixoDDD'].$_POST['campoTelefoneFixo1'].$_POST['campoTelefoneFixo2']);
    $oUsuario->setTelefone_celular($_POST['campoCelularDDD'].$_POST['campoCelular1'].$_POST['campoCelular2']);
    $oUsuario->setTelefone_recado($_POST['campoTelefoneFixoDDD'].$_POST['campoRecado1'].$_POST['campoRecado2']);
    $oUsuario->setEmail($_POST['campoEmail']);

    if(!$opcao){
        if($oUsuario->inserir()){
            //mail("ze@criarweb.com,maria@criarweb.com","Confirmacao de Cadastro - SIAC CEET Vasco Coutinho","Este e o corpo da mensagem");
            echo "
            <script type='text/javascript'>
                alert('Usuario cadastrado com sucesso!');
                window.top.location.href='./cadUsuario.php';
            </script>";
        }else{
            echo "
            <script type='text/javascript'>
                alert('Erro ao Cadastrar Usuario!');
                window.top.location.href='./cadUsuario.php';
            </script>";
        }
    }else{
        $idUsuario = @$_POST['idUsuario'];
        $oUsuario->setIdusuario($idUsuario);

        if($oUsuario->alterar()){
            echo "
            <script type='text/javascript'>
                alert('Cadastrado alterado com sucesso!');
                //window.top.location.href='./cadUsuario.php';
            </script>";
        }else{
            echo "
            <script type='text/javascript'>
                alert('Erro ao alterar cadastro de Usuario!');
                //window.top.location.href='./cadUsuario.php';
            </script>";
        }
    }
		
		//ALUNO
		/*case 1:
			$numeroMatricula = $_POST['ocultoNumeroMatricula'];
			$oAluno = new Aluno();
			
			$oAluno->setLogin(trim($_POST['campoLogin']));
			$oAluno->setSenha(trim($_POST['senha']));
			$oAluno->setNivel_acesso($_POST['nivelAcesso']);
			$oAluno->setNome($_POST['nome']);
			$oAluno->setRua($_POST['campoRua']);
			$oAluno->setNumero($_POST['campoNumero']);
			$oAluno->setBairro($_POST['campoBairro']);
			$oAluno->setMunicipio($_POST['campoMunicipio']);			
			$oAluno->setEstado($_POST['campoEstado']);
			$oAluno->setCep($_POST['campoCEP1']."-".$_POST['campoCEP2']);
			$oAluno->setNacionalidade($_POST['campoNacionalidade']);
			$oAluno->setUf_origem($_POST['campoUFOrigem']);
			$oAluno->setPai($_POST['campoPai']);
			$oAluno->setMae($_POST['campoMae']);
			$oAluno->setRg($_POST['campoRG']);
			$oAluno->setCpf($_POST['campoCPF']);
			$oAluno->setTelefone_fixo($_POST['campoTelefoneFixoDDD'].$_POST['campoTelefoneFixo1'].$_POST['campoTelefoneFixo2']);
			$oAluno->setTelefone_celular($_POST['campoCelularDDD'].$_POST['campoCelular1'].$_POST['campoCelular2']);
			$oAluno->setTelefone_recado($_POST['campoTelefoneFixoDDD'].$_POST['campoRecado1'].$_POST['campoRecado2']);
			$oAluno->setEmail($_POST['campoEmail']);
			
			echo "<br/><br/>----- ALUNO -------";
			echo "<br/>Curso: ".$_POST['radioCurso'];
			echo "<br/>Matricula: ".$_POST['ocultoNumeroMatricula'];
			echo "<br/>Necessidades: ".$_POST['campoNecessidades'];
			echo "<br/>Ra�a: ".$_POST['campoRaca'];
			
			$oAluno->setNum_matricula($_POST['ocultoNumeroMatricula']);
			$oAluno->setTurma_idturma($_POST['radioCurso']);
			$oAluno->setNecessidades_especiais($_POST['campoNecessidades']);
			$oAluno->setRaca($_POST['campoRaca']);
			
			if($oAluno->inserir()){
				//mail("ze@criarweb.com,maria@criarweb.com","assunto","Este � o corpo da mensagem") 
				echo "
				<script type='text/javascript'>
					alert('Aluno cadastrado com sucesso!');
					window.top.location.href='./cadUsuario.php';
				</script>";
			}else{
				echo "
				<script type='text/javascript'>
					alert('Erro ao Cadastrar Aluno!');
					window.top.location.href='./cadUsuario.php';
				</script>";					
			}
			
		break;
		
		//FUNCIONARIO
		case 2:
			$oFuncionario = new Funcionario();
			
			$oFuncionario->setLogin(trim($_POST['campoLogin']));
			$oFuncionario->setSenha(trim($_POST['senha']));
			$oFuncionario->setNivel_acesso($_POST['nivelAcesso']);
			$oFuncionario->setNome($_POST['nome']);
			$oFuncionario->setRua($_POST['campoRua']);
			$oFuncionario->setNumero($_POST['campoNumero']);
			$oFuncionario->setBairro($_POST['campoBairro']);
			$oFuncionario->setMunicipio($_POST['campoMunicipio']);			
			$oFuncionario->setEstado($_POST['campoEstado']);
			$oFuncionario->setCep($_POST['campoCEP1']."-".$_POST['campoCEP2']);
			$oFuncionario->setNacionalidade($_POST['campoNacionalidade']);
			$oFuncionario->setUf_origem($_POST['campoUFOrigem']);
			$oFuncionario->setPai($_POST['campoPai']);
			$oFuncionario->setMae($_POST['campoMae']);
			$oFuncionario->setRg($_POST['campoRG']);
			$oFuncionario->setCpf($_POST['campoCPF']);
			$oFuncionario->setTelefone_fixo($_POST['campoTelefoneFixoDDD'].$_POST['campoTelefoneFixo1'].$_POST['campoTelefoneFixo2']);
			$oFuncionario->setTelefone_celular($_POST['campoCelularDDD'].$_POST['campoCelular1'].$_POST['campoCelular2']);
			$oFuncionario->setTelefone_recado($_POST['campoTelefoneFixoDDD'].$_POST['campoRecado1'].$_POST['campoRecado2']);
			$oFuncionario->setEmail($_POST['campoEmail']);

			echo "<br/><br/>----- FUNCIONARIO -------";
			echo "<br/>Carteira de Trabalho: ".$_POST['campoCarteiraTrabalho'];
			$oFuncionario->setNumCarteira($_POST['campoCarteiraTrabalho']);
			
			if($oFuncionario->inserir()){
				//mail("ze@criarweb.com,maria@criarweb.com","assunto","Este � o corpo da mensagem");
				echo "
				<script type='text/javascript'>
					alert('Funcionario cadastrado com sucesso!');
					window.top.location.href='./cadUsuario.php';
				</script>";
			}else{
				echo "
				<script type='text/javascript'>
					alert('Erro ao Cadastrar Funcionario!');
					window.top.location.href='./cadUsuario.php';
				</script>";					
			}
		break;

		//PROFESSOR
		case 3:
			$oProfessor = new Professor();
			
			$oProfessor->setLogin(trim($_POST['campoLogin']));
			$oProfessor->setSenha(trim($_POST['senha']));
			$oProfessor->setNivel_acesso($_POST['nivelAcesso']);
			$oProfessor->setNome($_POST['nome']);
			$oProfessor->setRua($_POST['campoRua']);
			$oProfessor->setNumero($_POST['campoNumero']);
			$oProfessor->setBairro($_POST['campoBairro']);
			$oProfessor->setMunicipio($_POST['campoMunicipio']);			
			$oProfessor->setEstado($_POST['campoEstado']);
			$oProfessor->setCep($_POST['campoCEP1']."-".$_POST['campoCEP2']);
			$oProfessor->setNacionalidade($_POST['campoNacionalidade']);
			$oProfessor->setUf_origem($_POST['campoUFOrigem']);
			$oProfessor->setPai($_POST['campoPai']);
			$oProfessor->setMae($_POST['campoMae']);
			$oProfessor->setRg($_POST['campoRG']);
			$oProfessor->setCpf($_POST['campoCPF']);
			$oProfessor->setTelefone_fixo($_POST['campoTelefoneFixoDDD'].$_POST['campoTelefoneFixo1'].$_POST['campoTelefoneFixo2']);
			$oProfessor->setTelefone_celular($_POST['campoCelularDDD'].$_POST['campoCelular1'].$_POST['campoCelular2']);
			$oProfessor->setTelefone_recado($_POST['campoTelefoneFixoDDD'].$_POST['campoRecado1'].$_POST['campoRecado2']);
			$oProfessor->setEmail($_POST['campoEmail']);
			
			echo "<br/><br/>----- PROFESSOR -------";			
			echo "<br/>Carteira de Trabalho: ".$_POST['campoCarteiraTrabalho'];
			echo "<br/>Numero Funcional: ".$_POST['campoNFuncional'];
			$listaDisciplinas = explode("/",$_POST['ocultoListaDisciplinas']);
			array_pop($listaDisciplinas);
			echo "<br/>Lista de disciplinas: ".print_r($listaDisciplinas);
			
			$oProfessor->setNumCarteira($_POST['campoCarteiraTrabalho']);
			$oProfessor->setNumero_funcional($_POST['campoNFuncional']);
			
			if($oProfessor->inserir()){
				if($oProfessor->inserirDisciplina($listaDisciplinas)){
					//mail($_POST['campoEmail'],"Confirma��o de Cadastrado - CEET Vasco Coutinho","Sauda��es, esta � uma mensagem de confirmacao de cadastrado autom�tica!<br/>Seguem abaixo seu login e senha para acesso ao portal da institui��o:<br/><b>Login</b>: $_POST['campoLogin']<br/><b>Senha:</b>$_POST['senha']<br/>Atensiosamente,<br/>SIAC - Sistema de Integra��o Acad�mica do CEET Vasco Coutinho") 
					echo "
					<script type='text/javascript'>
						alert('Professor cadastrado com sucesso!');
						window.top.location.href='./cadUsuario.php';
					</script>";
				}else{
					echo "
					<script type='text/javascript'>
						alert('Erro ao associar professor e turmas!');
						
					</script>";
				}
			}else{
				echo "
				<script type='text/javascript'>
					alert('Erro ao Cadastrar Professor!');
					
				</script>";					
			}
			
		break;
	}*/
?>