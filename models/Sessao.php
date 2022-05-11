<?php
/**
 * Classe para controle de sess�o.
 *
 * @author Andre Oshiro Barcelos
 * @version 11 de maio de 2007
 *
 * Notacoes para variaveis: 
 * b - booleano
 * c - caracter (byte)
 * i - numero inteiro
 * r - numero real
 * s - string
 * p - ponteiro
 * o - objeto (instancia)
 * a - array
 */
require_once ("Usuario.php");

class Sessao
{

	/**
	 * @author Andr� Oshiro Barcelos e Luciana da Rocha Motta
	 * @version 11 de maio de 2007
	 * alterada por Leandro Souza Ferreira em 30 de abril de 2010
	 */
	public function __construct()
	{
		if(!isset($_SESSION)){
			session_start();
		}
	}
	
	/**
	 *Esta funcao define uma variavel de sessao
	 * @param sVariavel nome da variavel a ser setada
	 * @param oDado valor a ser atribuido a variavel
	 */
	public function setVariavelSessao($sVariavel, $oDado = null)
    {
		$_SESSION[$sVariavel] = $oDado;
	}
	
	/**
	 *Esta funcao recupera o valor de uma  variavel de sessao ou NULL caso nao encontre
	 * @param sVariavel nome da variavel de sessao
	 * @return null retorna conteudo da variavel de sessao ou caso a variavel nao possa ser encontrada retorna NULL
	 */
	public function getVariavelSessao($sVariavel)
    {
		return isset($_SESSION[$sVariavel]) ? $_SESSION[$sVariavel] : null;
	}
	
	
	/**
	 * Efetuar login de um usuario, ou seja, verifica se o nome e senha realmente existem 
	 * em um banco de dados. Variaveis constando o login, a senha e matricula do usuario sao criadas.
	 * @param sLogin Login do usuario. 
	 * @param sSenha Senha do usuario.
	 * @return boolean retorna TRUE caso o usuario e a senha sejam validos, ou FALSE caso o usuario ou a senha nao sejam validos

	 * @author Andre Oshiro Barcelos
	 * @version 11 de maio de 2007
	 */
	public function efetuarLogin($sLogin, $sSenha)
	{
		$oUsuario = new Usuario();
		
		if($oUsuario->autenticarUsuario($sLogin,$sSenha))
		{
            $this->setVariavelSessao("usuario", $oUsuario);
            $this->setVariavelSessao("sLogin", $oUsuario->getLogin());//cria vari�vel de sess�o contendo o login do usu�rio.
            $this->setVariavelSessao("sSenha", $oUsuario->getSenha());//cria vari�vel de sess�o contendo a senha do usu�rio.
            $this->setVariavelSessao('iIdUsuario', $oUsuario->getIdusuario());//cria vari�vel de sess�o contendo a matr�cula do usu�rio.
            $this->setVariavelSessao('sNomeUsuario', $oUsuario->getNome());//cria vari�vel de sess�o contendo a data e hora do login
            $this->setVariavelSessao('nivelAcesso', $oUsuario->getNivel_acesso());//cria vari�vel de sess�o contendo a data e hora do login
            $this->setVariavelSessao('sDataHoraLogin', date("d/m/Y H:i:s"));//cria vari�vel de sess�o contendo a data e hora do login
			unset($oUsuario);
			return true;
		}else{
			$this->efetuarLogout();
			return false;
		}
	}
	
	
	/**
	 * Efetua logout do usuario, ou seja, termina a sessao e as variaveis alocadas.
	 */
	public function efetuarLogout()
	{
		$_SESSION = array();//apagando variaveis de sessao
		session_unset(); //destruindo variaveis da sessao
		session_destroy();//destruindo sessao
	}
	
	
	/**
	 * Verifica se o usuario esta logado.
	 * se encarrega disso automaticamente.
	 * @return true caso o usuario esteja logado.
	 * @return false caso o usuario nao esteja logado.
	 * @author AndreOshiro Barcelos
	 * @version 11 de maio de 2007
	 */
	public function estaLogado()
	{
		$sLogin = (isset($_SESSION['sLogin'])) ? $_SESSION['sLogin'] : null;
		$sSenha = (isset($_SESSION['sSenha'])) ? $_SESSION['sSenha'] : null;

		if($sLogin == null || $sSenha == null)
		{
			return false;
		}else{
			return $this->efetuarLogin($sLogin,$sSenha);
		}
	}

	public function expulsar()
    {
		$this->efetuarLogout();
		header('Location: ../area_restrita.php');
	}
}