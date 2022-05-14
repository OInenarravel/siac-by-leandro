<?php
    require_once("../models/Funcionario.php");

    $opcao = @$_POST['opcao'];
    $oFuncionario = new Funcionario();

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
	echo "<br/>Enviar confirmacao para e-mail: ".@$_POST['enviarEmail'];
    echo "<br/><br/>----- Funcionario -------";
    echo "<br/>Carteira de Trabalho: " . $_POST['campoCarteiraTrabalho'];

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

    $oFuncionario->setNumCarteira($_POST['campoCarteiraTrabalho']);

    if(!$opcao){
        if($oFuncionario->inserir()){
        //mail("ze@criarweb.com,maria@criarweb.com","assunto","Este � o corpo da mensagem")
        echo "
            <script type='text/javascript'>
                alert('Funcionario cadastrado com sucesso!');
                window.top.location.href='./cadFuncionario.php';
            </script>";
        } else {
            echo "
            <script type='text/javascript'>
                alert('Erro ao Cadastrar Funcionario!');
                window.top.location.href='./cadFuncionario.php';
            </script>";
        }
    }else{
        $idUsuario = @$_POST['idFuncionario'];
        $oFuncionario->setIdusuario($idFuncionario);

        if($oFuncionario->alterar()){
            echo "
            <script type='text/javascript'>
                alert('Cadastrado alterado com sucesso!');
                window.top.location.href='listarFuncionario.php';
            </script>";
        }else{
            echo "
            <script type='text/javascript'>
                alert('Erro ao alterar cadastro de Usuario!');
                window.top.location.href='listarFuncionario.php';
            </script>";
        }
    }
?>