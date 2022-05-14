<?php
require_once("../models/Sessao.php");

$oSessao = new Sessao();

$sLogin = $_POST['login'];
$sSenha = $_POST['senha'];

//impossibilitando SQL Injection
$sLogin = addslashes($sLogin);
$sSenha = addslashes($sSenha);

$loginValido = $oSessao->efetuarLogin($sLogin, $sSenha);

if ($loginValido) {
    header("Location: ../portal/index.php");
    exit;
} else {
    echo "
    <script type='text/javascript'>
        alert('Erro ao logar! Confira seu login e senha e tente novamente.');
        document.location = '../index.php';
    </script>";
}
?>