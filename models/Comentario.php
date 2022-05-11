<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 *
 * Description of Comentario
 *
 * @author Leandro Souza Ferreira
 */
 
require_once("BancoDados.php");

class Comentario {

    private $idcomentario;
    private $usuario_idusuario;
    private $topico_idtopico;
    private $conteudo;
    private $data;

    function __construct($idcomentario = 0, $usuario_idusuario = 0, $topico_idtopico = 0, $conteudo = null, $data = "1900-01-01 00:00:00") {
        $this->idcomentario = $idcomentario;
        $this->usuario_idusuario = $usuario_idusuario;
        $this->topico_idtopico = $topico_idtopico;
        $this->conteudo = $conteudo;
        $this->data = $data;
        
        if($idcomentario != 0){
            $this->listar();
        }
    }

    public function getIdcomentario(){
        return $this->idcomentario;
    }

    public function setIdcomentario($idcomentario){
        $this->idcomentario = $idcomentario;
    }

    public function getUsuario_idusuario(){
        return $this->usuario_idusuario;
    }

    public function setUsuario_idusuario($usuario_idusuario){
        $this->usuario_idusuario = $usuario_idusuario;
    }

    public function getTopico_idtopico(){
        return $this->topico_idtopico;
    }

    public function setTopico_idtopico($topico_idtopico){
        $this->topico_idtopico = $topico_idtopico;
    }

    public function getConteudo(){
        return $this->conteudo;
    }

    public function setConteudo($conteudo){
        $this->conteudo = $conteudo;
    }
    function getData() {
        return $this->data;
    }

    function setData($data) {
        $this->data = $data;
    }    

    public function inserir(){
        $oBanco = new BancoDados();

        $sQuery = "
        INSERT INTO 
            comentario() 
        VALUES(
            '".$this->getConteudo()."',
            now(),
            '".$this->getTopico_idtopico()."',
            '".$this->getUsuario_idusuario()."'";

        if($oBanco->manipular($sQuery)){
            $this->setIdcomentario($oBanco->getCodIncluido());
            ;
            return true;
        }else{
            ;
            return false;
        }
    }

    public function alterar(){
        $oBanco = new BancoDados();
        
        $sQuery = "
        UPDATE 
            comentario 
        SET
            usuario_idusuario = ".$this->getUsuario_idusuario().",
            topico_idtopico = ".$this->getTopico_idtopico().",
            conteudo = '".$this->getConteudo()."',
            dt = '".$this->getData()."',
        WHERE 
            idcomentario=".$this->getIdcomentario();
        
        if($oBanco->manipular($sQuery)){
            ;
            return true;
        }else{
            ;
            return false;
        }
    }

    public function excluir(){
        $oBanco = new BancoDados();
        
        $sQuery = "
        DELETE * 
        FROM 
            comentario 
        WHERE 
            idcomentario=".$this->getIdcomentario();
        
        if($oBanco->manipular($sQuery)){
            ;
            return true;
        }else{
            ;
            return false;
        }
    }

    public function listar(){
        $oBanco = new BancoDados();

        $sQuery = "
        SELECT * 
        FROM 
            comentario
        WHERE 
            idcomentario=".$this->getIdcomentario()."
        ORDER BY
            dt DESC
        LIMIT 1";
        
        if($oBanco->pesquisar($sQuery) && $oBanco->getQtd() > 0){

            $comentarios = $oBanco->getResultado();

            foreach($comentarios as $comentario){
                $this->setUsuario_idusuario($comentario['usuario_idusuario']);
                $this->setTopico_idtopico($comentario['topico_idtopico']);
                $this->setConteudo($comentario['conteudo']);
                $this->setData($comentario['dt']);
            }
            ;
            return true;
        } else {
            ;
            return false;
        }
    }

    public function listarTodos($iFirstReg = -1, $iLastReg = -1){
        $oBanco = new BancoDados();
        $lista = array();

        $sQuery = "
        SELECT * 
        FROM 
            comentario";
        
        if($iFirstReg != -1 && $iLastReg != -1)
            $sQuery .= " LIMIT ".$iFirstReg.", ".$iLastReg;
        
        if($oBanco->pesquisar($sQuery) && $oBanco->getQtd() > 0){
            $comentarios = $oBanco->getResultado();
            foreach($comentarios as $comentario){
                $lista[] = new Comentario($comentario['idcomentario'], $comentario['usuario_idusuario'], $comentario['topico_idtopico'], $comentario['conteudo'], $comentario['dt']);
            }
        }
        ;
        return ($lista);
    }
    
    public function listarPorTopico($idtopico, $iFirstReg = -1, $iLastReg = -1){
        $oBanco = new BancoDados();
        $lista = array();

        $sQuery = "
        SELECT * 
        FROM 
            comentario
        WHERE 
            topico_idtopico=".$idtopico."
        ORDER BY
            idcomentario ASC";
        
        if($iFirstReg != -1 && $iLastReg != -1)
            $sQuery .= " LIMIT ".$iFirstReg.", ".$iLastReg;
        
        if($oBanco->pesquisar($sQuery) && $oBanco->getQtd() > 0){
            $comentarios = $oBanco->getResultado();
            foreach($comentarios as $comentario){
                $lista[] = new Comentario($comentario['idcomentario'], $comentario['usuario_idusuario'], $comentario['topico_idtopico'], $comentario['conteudo'], $comentario['dt']);
            }
        }
        ;
        return ($lista);
    }
    
    public function listarUltimoComentario($idtopico){
        $oBanco = new BancoDados();
        $ultimoComentario = array();
        
        $sQuery = "
        SELECT * 
        FROM 
            comentario
        WHERE 
            topico_idtopico=".$idtopico."
        ORDER BY
            dt DESC
        LIMIT 1";

        if($oBanco->pesquisar($sQuery) && $oBanco->getQtd() > 0){
            $comentarios = $oBanco->getResultado();
            foreach($comentarios as $comentario){
                return new Comentario($comentario['idcomentario'], $comentario['usuario_idusuario'], $comentario['topico_idtopico'], $comentario['conteudo'], $comentario['dt']);
            }
        }
        ;
        return $ultimoComentario;
    }
}
?>
