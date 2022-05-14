<?php

require_once("../models/Aluno.php");

$opcao = @$_POST['opcao'];
$numeroMatricula = $_POST['ocultoNumeroMatricula'];
$oAluno = new Aluno();

echo "<br/>Login: " . $_POST['campoLogin'];
echo "<br/>Senha: " . $_POST['senha'];
echo "<br/>Nivel de Acesso: " . @$_POST['nivelAcesso'];
echo "<br/>Nome: " . $_POST['nome'];
echo "<br/>Rua: " . $_POST['campoRua'];
echo "<br/>Numero: " . $_POST['campoNumero'];
echo "<br/>Bairro: " . $_POST['campoBairro'];
echo "<br/>Municipio: " . $_POST['campoMunicipio'];
echo "<br/>Estado: " . $_POST['campoEstado'];
echo "<br/>CEP: " . $_POST['campoCEP1'] . "-" . $_POST['campoCEP2'];
echo "<br/>Nacionalidade: " . $_POST['campoNacionalidade'];
echo "<br/>UF Origem: " . $_POST['campoUFOrigem'];
echo "<br/>Nome do Pai: " . $_POST['campoPai'];
echo "<br/>Nome do M�e: " . $_POST['campoMae'];
echo "<br/>RG: " . $_POST['campoRG'];
echo "<br/>CPF: " . $_POST['campoCPF'];
echo "<br/>Tel. Fixo: " . $_POST['campoTelefoneFixoDDD'] . $_POST['campoTelefoneFixo1'] . $_POST['campoTelefoneFixo2'];
echo "<br/>Tel. Recado: " . $_POST['campoRecadoDDD'] . $_POST['campoRecado1'] . $_POST['campoRecado2'];
echo "<br/>Tel. Celular: " . $_POST['campoCelularDDD'] . $_POST['campoCelular1'] . $_POST['campoCelular2'];
echo "<br/>E-mail: " . $_POST['campoEmail'];
if (@$_POST['enviarEmail'] == "on")
    echo "<br/>Enviar confirma��o para e-mail: " . @$_POST['enviarEmail'];
echo "<br/><br/>----- ALUNO -------";
echo "<br/>Turma: " . $_POST['selectTurma'];
echo "<br/>Matricula: " . $_POST['ocultoNumeroMatricula'];
echo "<br/>Necessidades: " . $_POST['campoNecessidades'];
echo "<br/>Raca: " . $_POST['campoRaca'];

$oAluno->setLogin(trim($_POST['campoLogin']));
$oAluno->setSenha(trim($_POST['senha']));
$oAluno->setNivel_acesso($_POST['nivelAcesso']);
$oAluno->setNome($_POST['nome']);
$oAluno->setRua($_POST['campoRua']);
$oAluno->setNumero($_POST['campoNumero']);
$oAluno->setBairro($_POST['campoBairro']);
$oAluno->setMunicipio($_POST['campoMunicipio']);
$oAluno->setEstado($_POST['campoEstado']);
$oAluno->setCep($_POST['campoCEP1'] . "-" . $_POST['campoCEP2']);
$oAluno->setNacionalidade($_POST['campoNacionalidade']);
$oAluno->setUf_origem($_POST['campoUFOrigem']);
$oAluno->setPai($_POST['campoPai']);
$oAluno->setMae($_POST['campoMae']);
$oAluno->setRg($_POST['campoRG']);
$oAluno->setCpf($_POST['campoCPF']);
$oAluno->setTelefone_fixo($_POST['campoTelefoneFixoDDD'] . $_POST['campoTelefoneFixo1'] . $_POST['campoTelefoneFixo2']);
$oAluno->setTelefone_celular($_POST['campoCelularDDD'] . $_POST['campoCelular1'] . $_POST['campoCelular2']);
$oAluno->setTelefone_recado($_POST['campoTelefoneFixoDDD'] . $_POST['campoRecado1'] . $_POST['campoRecado2']);
$oAluno->setEmail($_POST['campoEmail']);

$oAluno->setNum_matricula($_POST['ocultoNumeroMatricula']);
$oAluno->setTurma_idturma($_POST['selectTurma']);
$oAluno->setNecessidades_especiais($_POST['campoNecessidades']);
$oAluno->setRaca($_POST['campoRaca']);

if (!$opcao) {
    if ($oAluno->inserir()) {
        //mail("ze@criarweb.com,maria@criarweb.com","assunto","Este � o corpo da mensagem")
        echo "
            <script type='text/javascript'>
                alert('Aluno cadastrado com sucesso!');
                window.top.location.href='./cadAluno.php';
            </script>";
    } else {
        echo "
            <script type='text/javascript'>
                alert('Erro ao Cadastrar Aluno!');
                window.top.location.href='./cadAluno.php';
            </script>";
    }
} else {
    $idUsuario = @$_POST['idAluno'];
    echo $idUsuario;
    $oAluno->setIdusuario($idAluno);

    if ($oAluno->alterar()) {
        echo "
            <script type='text/javascript'>
                alert('Cadastrado alterado com sucesso!');
                //window.top.location.href='./cadAluno.php';
            </script>";
    } else {
        echo "
            <script type='text/javascript'>
                alert('Erro ao alterar cadastro de Usuario!');
                //window.top.location.href='./cadAluno.php';
            </script>";
    }
}
?>