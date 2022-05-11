<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mensagem
 *
 * @author leandro
 */

require_once("BancoDados.php");

class Mensagem {

    var $idmensagem;
    var $remetente;
    var $destinatario;
    var $conteudo;
    var $status;
    var $titulo;

    public function __construct(){
        $this->idmensagem = 0;
        $this->remetente = 0;
        $this->destinatario = 0;
        $this->conteudo = '*';
        $this->status = 'NAO-LIDA';
        $this->titulo = '*';
    }

    public function getIdmensagem(){
        return $this->idmensagem;
    }

    public function setIdmensagem($idmensagem){
        $this->idmensagem = $idmensagem;
    }

    public function getRemetente(){
        return $this->remetente;
    }

    public  function setRemetente($remetente){
        $this->remetente = $remetente;
    }

    public function getDestinatario(){
        return $this->destinatario;
    }

    public function setDestinatario($destinatario){
        $this->destinatario = $destinatario;
    }

    public function getConteudo(){
        return $this->conteudo;
    }

    public function setConteudo($conteudo){
        $this->conteudo = $conteudo;
    }

    public function getStatus(){
        return $this->status;
    }

    public function setStatus($status){
        $this->status = $status;
    }

    public function getTitulo(){
        return $this->titulo;
    }

    public function setTitulo($titulo){
        $this->titulo = $titulo;
    }

    public function inserir(){
        $oBanco = new BancoDados();
        $sQuery = "
        INSERT INTO 
            mensagem 
        VALUES(
            0,
            $this->remetente,
            $this->destinatario,
            '$this->conteudo',
            '$this->status',
            '$this->titulo',
            now())";

        $retorno = $oBanco->manipular($sQuery);

       
        if(!$retorno){
            return false;
        }else{
            $this->idmensagem = $oBanco->getCodIncluido();
            return true;
        }
    }

    public function alterar(){
        $oBanco = new BancoDados();
        $sQuery = "
        UPDATE
            mensagem
        SET()
        WHERE
            idmensagem = ".$this->idmensagem;
        
        $retorno = $oBanco->manipular($sQuery);
       
			if(!$retorno)
                return false;
            else
                return true;
    }

    public function excluir(){
        $oBanco = new BancoDados();
        $sQuery = "
        DELETE FROM
            mensagem
        WHERE
            idmensagem = ".$this->idmensagem."
        LIMIT 1";

        $retorno = $oBanco->manipular($sQuery);
       
        if(!$retorno)
            return false;
        else
            return true;
    }

    public function listar(){
        $oBanco = new BancoDados();
        $sQuery = "
        SELECT *
        FROM
            mensagem
        WHERE
            idmensagem = ".$this->idmensagem;
        
        $retorno = $oBanco->pesquisar($sQuery);
        
        if(!$oBanco->getQtd()){
			;
			return false;
        }else{
			$resultado = $oBanco->getResultado();
			$linha = mysqli_fetch_array($resultado);

			$this->idmensagem = $linha['idmensagem'];
            $this->remetente = $linha['remetente'];
            $this->destinatario = $linha['destinatario'];
            $this->conteudo = $linha['conteudo'];
            $this->status = $linha['status'];
            $this->titulo = $linha['titulo'];

			;
			return true;
		}
    }

    public function listarTodos($iFirstReg = -1,$iLastReg = -1){
        $oBanco = new BancoDados();
        $lista = array();

		$sQuery = "
		SELECT *
		FROM
			mensagem
        ORDER BY
			data_envio DESC";

        if($iFirstReg != -1 && $iLastReg != -1)
            $sQuery .= " LIMIT ".$iFirstReg.", ".$iLastReg;

		$oBanco->pesquisar($sQuery);

        if(!$oBanco->getQtd()){
			;
			return false;
        }else{
			$resultado = $oBanco->getResultado();
			;
			while($linha = mysqli_fetch_array($resultado))
                $lista[] = $linha;
            return ($lista);
		}
    }
	
    public function listarPorDestinatario($iFirstReg = -1,$iLastReg = -1){
        $oBanco = new BancoDados();
        $lista = array();

		$sQuery = "
		SELECT *
		FROM
			mensagem
        WHERE
            destinatario = ".$this->destinatario."
        ORDER BY
			data_envio DESC";

        if($iFirstReg != -1 && $iLastReg != -1)
            $sQuery .= " LIMIT ".$iFirstReg.", ".$iLastReg;

        if($oBanco->pesquisar($sQuery) && $oBanco->getQtd() > 0){
            $mensagens = $oBanco->getResultado();
            foreach($mensagens as $mensagem){
                $lista[] = new Mensagem($mensagem['idmensagem'], $mensagem['remetente'], $mensagem['destinatario'], $mensagem['conteudo'], $mensagem['status'], $mensagem['titulo']);
            }
        }

        return ($lista);
    }

	public function marcarMensagem(){
		$oBanco = new BancoDados();
        $sQuery = "
        UPDATE
            mensagem
        SET
            status = '".$this->status."'
        WHERE
            idmensagem = ".$this->idmensagem;

        $retorno = $oBanco->manipular($sQuery);
       
        if(!$retorno)
            return false;
        else
            return true;
	}
}
?>
