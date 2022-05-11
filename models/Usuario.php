<?php

/*
 * Classe Usuário
 * Desenvolvida por Leandro Souza Ferreira
 * em 8 de outubro de 2009
 */

include_once ("BancoDados.php");

class Usuario {

    private $idusuario;
    private $login;
    private $senha;
    private $nivel_acesso;
    private $nome;
    private $rua;
    private $numero;
    private $bairro;
    private $municipio;
    private $estado;
    private $cep;
    private $nacionalidade;
    private $uf_origem;
    private $pai;
    private $mae;
    private $rg;
    private $cpf;
    private $data_cadastro;
    private $telefone_fixo;
    private $telefone_celular;
    private $telefone_recado;
    private $email;

    public function __construct($idusuario = 0, $login = null, $senha = null, $nivel_acesso = null, $nome = null, $rua = null, $numero = null, $bairro = null, $municipio = null, $estado = null, $cep = null, $nacionalidade = null, $uf_origem = null, $pai = null, $mae = null, $rg = null, $cpf = null, $data_cadastro = null, $telefone_fixo = null, $telefone_celular = null, $telefone_recado = null, $email = null){
        $this->idusuario = $idusuario;
        $this->login = $login;
        $this->senha = $senha;
        $this->nivel_acesso = $nivel_acesso;
        $this->nome = $nome;
        $this->rua = $rua;
        $this->numero = $numero;
        $this->bairro = $bairro;
        $this->municipio = $municipio;
        $this->estado = $estado;
        $this->cep = $cep;
        $this->nacionalidade = $nacionalidade;
        $this->uf_origem = $uf_origem;
        $this->pai = $pai;
        $this->mae = $mae;
        $this->rg = $rg;
        $this->cpf = $cpf;
        $this->data_cadastro = $data_cadastro;
        $this->telefone_fixo = $telefone_fixo;
        $this->telefone_celular = $telefone_celular;
        $this->telefone_recado = $telefone_recado;
        $this->email = $email;
    }

    public function __destruct() {
        $this->idusuario = 0;
        $this->login = "*";
        $this->senha = "*";
        $this->nivel_acesso = "*";
        $this->nome = "*";
        $this->rua = "*";
        $this->numero = "*";
        $this->bairro = "*";
        $this->municipio = "*";
        $this->estado = "*";
        $this->cep = "*";
        $this->nacionalidade = "*";
        $this->uf_origem = "*";
        $this->pai = "*";
        $this->mae = "*";
        $this->rg = "*";
        $this->cpf = "*";
        $this->data_cadastro = null;
        $this->telefone_fixo = "*";
        $this->telefone_celular = "*";
        $this->telefone_recado = "*";
        $this->email = "*";
    }

    public function getIdusuario() {
        return $this->idusuario;
    }

    public function setIdusuario($idusuario) {
        $this->idusuario = $idusuario;
    }

    public function getLogin() {
        return $this->login;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function getNivel_acesso() {
        return $this->nivel_acesso;
    }

    public function setNivel_acesso($nivel_acesso) {
        $this->nivel_acesso = $nivel_acesso;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getRua() {
        return $this->rua;
    }

    public function setRua($rua) {
        $this->rua = $rua;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function getBairro() {
        return $this->bairro;
    }

    public function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    public function getMunicipio() {
        return $this->municipio;
    }

    public function setMunicipio($municipio) {
        $this->municipio = $municipio;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function getCep() {
        return $this->cep;
    }

    public function setCep($cep) {
        $this->cep = $cep;
    }

    public function getNacionalidade() {
        return $this->nacionalidade;
    }

    public function setNacionalidade($nacionalidade) {
        $this->nacionalidade = $nacionalidade;
    }

    public function getUf_origem() {
        return $this->uf_origem;
    }

    public function setUf_origem($uf_origem) {
        $this->uf_origem = $uf_origem;
    }

    public function getPai() {
        return $this->pai;
    }

    public function setPai($pai) {
        $this->pai = $pai;
    }

    public function getMae() {
        return $this->mae;
    }

    public function setMae($mae) {
        $this->mae = $mae;
    }

    public function getRg() {
        return $this->rg;
    }

    public function setRg($rg) {
        $this->rg = $rg;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function getData_cadastro() {
        return $this->data_cadastro;
    }

    public function setData_cadastro($data_cadastro) {
        $this->data_cadastro = $data_cadastro;
    }

    public function getTelefone_fixo() {
        return $this->telefone_fixo;
    }

    public function setTelefone_fixo($telefone_fixo) {
        $this->telefone_fixo = $telefone_fixo;
    }

    public function getTelefone_celular() {
        return $this->telefone_celular;
    }

    public function setTelefone_celular($telefone_celular) {
        $this->telefone_celular = $telefone_celular;
    }

    public function getTelefone_recado() {
        return $this->telefone_recado;
    }

    public function setTelefone_recado($telefone_recado) {
        $this->telefone_recado = $telefone_recado;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function inserir() {
        $oBanco = new BancoDados();

        $sQuery = "
        INSERT INTO
            usuario()
        VALUES(
            0,
            '" . $this->getLogin() . "',
            '" . $this->getSenha() . "',
            '" . $this->getNivel_acesso() . "',
            '" . $this->getNome() . "',
            '" . $this->getRua() . "',
            '" . $this->getNumero() . "',
            '" . $this->getBairro() . "',
            '" . $this->getMunicipio() . "',
            '" . $this->getEstado() . "',
            '" . $this->getCep() . "',
            '" . $this->getNacionalidade() . "',
            '" . $this->getUf_origem() . "',
            '" . $this->getPai() . "',
            '" . $this->getMae() . "',
            '" . $this->getRg() . "',
            '" . $this->getCpf() . "',
            now(),
            '" . $this->getTelefone_fixo() . "',
            '" . $this->getTelefone_celular() . "',
            '" . $this->getTelefone_recado() . "',
            '" . $this->getEmail() . "')";

        if($oBanco->manipular($sQuery)){
            $this->setIdusuario($oBanco->getCodIncluido());
            ;
            return true;
        }else{
            ;
            return false;
        }
    }

    public function alterar() {
        $oBanco = new BancoDados();

        $sQuery = "
        UPDATE 
            usuario
        SET
            login = '" . $this->getLogin() . "',
            senha = '" . $this->getSenha() . "',
            nivel_acesso = '" . $this->getNivel_acesso() . "',
            nome = '" . $this->getNome() . "',
            rua = '" . $this->getRua() . "',
            numero = '" . $this->getNumero() . "',
            bairro = '" . $this->getBairro() . "',
            municipio = '" . $this->getMunicipio() . "',
            estado = '" . $this->getEstado() . "',
            cep = '" . $this->getCep() . "',
            nacionalidade = '" . $this->getNacionalidade() . "',
            uf_origem = '" . $this->getUf_origem() . "',
            pai = '" . $this->getPai() . "',
            mae = '" . $this->getMae() . "',
            rg = '" . $this->getRg() . "',
            cpf = '" . $this->getCpf() . "',
            telefone_fixo = '" . $this->getTelefone_fixo() . "',
            telefone_celular = '" . $this->getTelefone_celular() . "',
            telefone_recado = '" . $this->getTelefone_recado() . "',
            email = '" . $this->getEmail() . "'
        WHERE 
            idusuario = " . $this->getIdusuario();

        if($oBanco->manipular($sQuery)){
            ;
            return true;
        }else{
            ;
            return false;
        }
    }

    public function excluir() {
        $oBanco = new BancoDados();

        $sQuery = "
        DELETE
        FROM
            usuario
        WHERE 
            idusuario=" . $this->getIdusuario() . "
        LIMIT 1";

        if($oBanco->manipular($sQuery)){
            ;
            return true;
        }else{
            ;
            return false;
        }
    }

    public function listar() {
        $oBanco = new BancoDados();
        $lista = array();
        
        $sQuery = "
        SELECT * 
        FROM 
            usuario
        WHERE 
            idusuario = " . $this->getIdusuario() . "
        LIMIT 1";
        
        if($oBanco->pesquisar($sQuery) && $oBanco->getQtd() > 0){
            
            $lista = $oBanco->getResultado();
            
            foreach($lista as $linha){
                $this->setIdusuario($linha['idusuario']) ;
                $this->setLogin($linha['login']);
                $this->setSenha($linha['senha']);
                $this->setNivel_acesso($linha['nivel_acesso']);
                $this->setNome($linha['nome']);
                $this->setRua($linha['rua']);
                $this->setNumero($linha['numero']);
                $this->setBairro($linha['bairro']);
                $this->setMunicipio($linha['municipio']);
                $this->setEstado($linha['estado']);
                $this->setCep($linha['cep']);
                $this->setNacionalidade($linha['nacionalidade']);
                $this->setUf_origem($linha['uf_origem']);
                $this->setPai($linha['pai']);
                $this->setMae($linha['mae']);
                $this->setRg($linha['rg']);
                $this->setCpf($linha['cpf']);
                $this->setData_cadastro($linha['data_cadastro']);
                $this->setTelefone_fixo($linha['telefone_fixo']);
                $this->setTelefone_celular($linha['telefone_celular']);
                $this->setTelefone_recado($linha['telefone_recado']);
                $this->setEmail($linha['email']);
            }
            ;
            return true;
        } else {
            ;
            return false;
        }
    }

    public function listarTodos($iFirstReg = -1, $iLastReg = -1) {
        $oBanco = new BancoDados();
        $lista = array();

        $sQuery = "
        SELECT * 
        FROM 
            usuario";

        if ($iFirstReg != -1 && $iLastReg != -1)
            $sQuery .= " LIMIT " . $iFirstReg . ", " . $iLastReg;

        if($oBanco->pesquisar($sQuery) && $oBanco->getQtd() > 0){
            $lista = $this->gerarListaResultados($oBanco->getResultado());
        }

        return ($lista);
    }

    public function listarPorNome($iFirstReg = -1, $iLastReg = -1) {
        $oBanco = new BancoDados();
        $lista = array();

        $sQuery = "
        SELECT *
        FROM
            usuario
        WHERE
            nome LIKE '%" .$this->getNome(). "%'";

        if ($iFirstReg != -1 && $iLastReg != -1)
            $sQuery .= " LIMIT " . $iFirstReg . ", " . $iLastReg;

        if($oBanco->pesquisar($sQuery) && $oBanco->getQtd() > 0){
            $lista = $this->gerarListaResultados($oBanco->getResultado());
        }
        ;
        return ($lista);
    }

    public function listarPorCpf($iFirstReg = -1, $iLastReg = -1) {
        $oBanco = new BancoDados();
        $lista = array();

        $sQuery = "
        SELECT *
        FROM
            usuario
        WHERE
            usuario.cpf = " . $this->getCpf();

        if ($iFirstReg != -1 && $iLastReg != -1)
            $sQuery .= " LIMIT " . $iFirstReg . ", " . $iLastReg;

        if($oBanco->pesquisar($sQuery) && $oBanco->getQtd() > 0){
            $lista = $this->gerarListaResultados($oBanco->getResultado());
        }
        ;
        return ($lista);
    }

    public function listarPorRg($iFirstReg = -1, $iLastReg = -1) {
        $oBanco = new BancoDados();
        $lista = array();

        $sQuery = "
        SELECT *
        FROM
            usuario
        WHERE
            usuario.rg = " . $this->getRg();

        if ($iFirstReg != -1 && $iLastReg != -1)
            $sQuery .= " LIMIT " . $iFirstReg . ", " . $iLastReg;

        if($oBanco->pesquisar($sQuery) && $oBanco->getQtd() > 0){
            $lista = $this->gerarListaResultados($oBanco->getResultado());
        }
        ;
        return ($lista);
    }
    
    public function listarPorNivelAcesso($nivelAcesso = null, $iFirstReg = -1, $iLastReg = -1) {
        $oBanco = new BancoDados();
        $lista = array();

        $sQuery = "
        SELECT *
        FROM
            usuario";
        
        if($nivelAcesso){
            $sQuery .= " 
            WHERE
                nivel_acesso = '".$nivelAcesso."'";
        }
        
        $sQuery .= "
        ORDER BY 
            nivel_acesso ASC";

        if ($iFirstReg != -1 && $iLastReg != -1)
            $sQuery .= " LIMIT " . $iFirstReg . ", " . $iLastReg;

        if($oBanco->pesquisar($sQuery) && $oBanco->getQtd() > 0){
            $lista = $this->gerarListaResultados($oBanco->getResultado());
        }
        ;
        return ($lista);
    }

    public function autenticarUsuario($sLogin, $sSenha) {
        $oBanco = new BancoDados();
        
        $sQuery = "
        SELECT
            idusuario,
            login,
            senha,
            nome,
            nivel_acesso 
        FROM
            usuario
        WHERE
            login = '" . $sLogin . "' AND senha = '" . $sSenha . "'
        LIMIT 1";
        
        if($oBanco->pesquisar($sQuery) && $oBanco->getQtd() > 0){
            
            $usuarios = $oBanco->getResultado();
            
            foreach($usuarios as $usuario){
                $this->setIdusuario($usuario['idusuario']);
                $this->setLogin($usuario['login']);
                $this->setSenha($usuario['senha']);
                $this->setNivel_acesso($usuario['nivel_acesso']);
                $this->setNome($usuario['nome']);
            }
            ;
            return true;
        } else {
            ;
            return false;
        }
    }

    public function gerarSenha() {
        $sSenha = null;
        $sCaracteresAceitos = 'abcdefghijklmnopqrstuvxywzABCDEFGHIJKLMNOPQRSTUVXYWZ0123456789';
        $iMax = strlen($sCaracteresAceitos) - 1;

        for ($i = 0; $i < 8; $i++){
            $sSenha .= $sCaracteresAceitos[mt_rand(0, $iMax)];
        }
        return $sSenha;
    }

    public function gerarLogin() {
        $sSenha = null;
        $sCaracteresAceitos = 'abcdefghijklmnopqrstuvxywzABCDEFGHIJKLMNOPQRSTUVXYWZ0123456789';
        $iMax = strlen($sCaracteresAceitos) - 1;

        for ($i = 0; $i < 8; $i++){
            $sSenha .= $sCaracteresAceitos[mt_rand(0, $iMax)];
        }
        return $sSenha;
    }

    public function gerarListaResultados($usuarios){
        foreach($usuarios as $usuario){
            $lista[] = new Usuario($usuario['idusuario'], $usuario['login'], $usuario['senha'], $usuario['nivel_acesso'], $usuario['nome'], $usuario['rua'], $usuario['numero'], $usuario['bairro'], $usuario['municipio'], $usuario['estado'], $usuario['cep'], $usuario['nacionalidade'], $usuario['uf_origem'], $usuario['pai'], $usuario['mae'], $usuario['rg'], $usuario['cpf'], $usuario['data_cadastro'], $usuario['telefone_fixo'], $usuario['telefone_celular'], $usuario['telefone_recado'], $usuario['email']);
        }
        return $lista;
    }
}
?>