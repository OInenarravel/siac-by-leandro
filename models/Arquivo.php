<?php
/**
 * Description of Arquivo
 * @author Leandro Souza Ferreira
 */
require_once("BancoDados.php");

class Arquivo {

    private $idarquivo;
    private $id_usuario;
    private $nome_arquivo;
    private $data_envio;
    private $endereco;
    private $descricao;

    public function __construct($idarquivo = 0, $id_usuario = 0, $nome_arquivo = null, $data_envio = null, $endereco = null, $descricao = null) {
        $this->idarquivo = $idarquivo;
        $this->id_usuario = $id_usuario;
        $this->nome_arquivo = $nome_arquivo;
        $this->data_envio = $data_envio;
        $this->endereco = $endereco;
        $this->descricao = $descricao;
    }

    public function getIdArquivo() {
        return $this->idarquivo;
    }

    public function setIdArquivo($idarquivo) {
        $this->idarquivo = $idarquivo;
    }

    public function getId_usuario() {
        return $this->id_usuario;
    }

    public function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    public function getNomeArquivo() {
        return $this->nome_arquivo;
    }

    public function setNomeArquivo($nome_arquivo) {
        $this->nome_arquivo = $nome_arquivo;
    }

    public function getDataEnvio() {
        return $this->data_envio;
    }

    public function setDataEnvio($data_envio) {
        $this->data_envio = $data_envio;
    }

    public function getEndereco() {
        return $this->endereco;
    }

    public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function inserir() {
        $oBanco = new BancoDados();
        $sQuery = "
        INSERT INTO
            arquivo ()
        VALUES(
            0,"
            . $this->getId_usuario() . ",
            '" . $this->getNomeArquivo() . "',
            now(),
            '" . $this->getEndereco() . "',
            '" . $this->getDescricao() . "')";

        echo $sQuery;
        $retorno = $oBanco->manipular($sQuery);

        ;
        if (!$retorno) {
            return false;
        } else {
            $this->setIdArquivo($oBanco->getCodIncluido());
            return true;
        }
    }

    public function alterar() {
        $oBanco = new BancoDados();
        $sQuery = "
        UPDATE
            arquivo
        SET
            nome_arquivo = '" . $this->getNomeArquivo() . "'
            data_envio = '" . $this->getDataEnvio() . "'
            endereco = '" . $this->getEndereco() . "'
            descricao = '" . $this->getDescricao() . "'
        WHERE
            idarquivo = " . $this->getIdArquivo();

        $retorno = $oBanco->manipular($sQuery);
        ;
        if (!$retorno){
            return false;
        } else {
            return true;
        }
    }

    public function excluir() {
        $oBanco = new BancoDados();
        $sQuery = "
        DELETE FROM 
            arquivo 
        WHERE 
            idarquivo = " . $this->getIdArquivo() . "
        LIMIT 1";
        
        if(unlink($this->getEndereco())){
            if($oBanco->manipular($sQuery)){
                ;
                return true;
            } else {
                ;
                return false;
            }
        } else {
            ;
            return false;
        }
    }

    public function listar() {
        $oBanco = new BancoDados();
        
        $sQuery = "
        SELECT *
        FROM
            arquivo
        WHERE
            idarquivo = " . $this->getIdArquivo() ."
        LIMIT 1";

        if($oBanco->pesquisar($sQuery) && $oBanco->getQtd() > 0){
            
            $arquivos = $oBanco->getResultado();
            
            foreach($arquivos as $arquivo){
                $this->setIdArquivo($arquivo['idarquivo']);
                $this->setId_usuario($arquivo['id_usuario']);
                $this->setNomeArquivo($arquivo['nome_arquivo']);
                $this->setDataEnvio($arquivo['data_envio']);
                $this->setEndereco($arquivo['endereco']);
                $this->setDescricao($arquivo['descricao']);
            }
            ;
            return true;
        } else {
            ;
            return false;
        }
    }

    public function listarPorUsuario($idUsuario, $iFirstReg = -1, $iLastReg = -1) {
        $oBanco = new BancoDados();
        $lista = array();

        $sQuery = "
        SELECT *
        FROM
            arquivo
        WHERE
            arquivo.id_usuario = ".$idUsuario."
        ORDER BY
            data_envio DESC";

        if ($iFirstReg != -1 && $iLastReg != -1)
            $sQuery .= " LIMIT " . $iFirstReg . ", " . $iLastReg;

        if($oBanco->pesquisar($sQuery) && $oBanco->getQtd() > 0){
            $arquivos = $oBanco->getResultado();
            foreach($arquivos as $arquivo){
                $lista[] = new Arquivo($arquivo['idarquivo'], $arquivo['id_usuario'], $arquivo['nome_arquivo'], $arquivo['data_envio'], $arquivo['endereco'], $arquivo['descricao']);
            }
        } 
        ;
        return ($lista);
    }
    
    public function listarTodos($iFirstReg = -1, $iLastReg = -1) {
        $oBanco = new BancoDados();
        $lista = array();

        $sQuery = "
        SELECT *
        FROM
            arquivo
        ORDER BY
            data_envio DESC";

        if ($iFirstReg != -1 && $iLastReg != -1)
            $sQuery .= " LIMIT " . $iFirstReg . ", " . $iLastReg;

        if($oBanco->pesquisar($sQuery) && $oBanco->getQtd() > 0){
            $arquivos = $oBanco->getResultado();
            foreach($arquivos as $arquivo){
                $lista[] = new Arquivo($arquivo['idarquivo'], $arquivo['id_usuario'], $arquivo['nome_arquivo'], $arquivo['data_envio'], $arquivo['endereco'], $arquivo['descricao']);
            }
        } 
        ;
        return ($lista);
    }

    public function toString(){
        $string =  "Data de envio: ".$this->getDataEnvio();
        $string .= "</br>Descricao: ".$this->getDescricao();
        $string .= "</br>Endereco: ".$this->getEndereco();
        $string .= "</br>ID arquivo: ".$this->getIdArquivo();
        $string .= "</br>ID usuario: ".$this->getId_usuario();
        $string .= "</br>Nome do arquivo: ".$this->getNomeArquivo();
        
        return $string;
    }
}
?>