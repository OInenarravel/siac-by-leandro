<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 *
 * Description of Topico
 *
 * @author Leandro Souza Ferreira
 */

require_once("BancoDados.php");

class Topico {

    private $idtopico;
    private $usuario_idusuario;
    private $subcategoria_idsubcategoria;
    private $titulo;
    private $descricao;
    private $dt;
    
    function __construct($idtopico = 0, $usuario_idusuario = 0, $subcategoria_idsubcategoria = 0, $titulo = null, $descricao = null, $dt = null) {
        $this->idtopico = $idtopico;
        $this->usuario_idusuario = $usuario_idusuario;
        $this->subcategoria_idsubcategoria = $subcategoria_idsubcategoria;
        $this->titulo = $titulo;
        $this->descricao = $descricao;
        $this->dt = $dt;
        
        if($idtopico != 0){
            $this->listar();
        }
    }
    
    function getIdtopico() {
        return $this->idtopico;
    }

    function getUsuario_idusuario() {
        return $this->usuario_idusuario;
    }

    function getSubcategoria_idsubcategoria() {
        return $this->subcategoria_idsubcategoria;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getDt() {
        return $this->dt;
    }

    function setIdtopico($idtopico) {
        $this->idtopico = $idtopico;
    }

    function setUsuario_idusuario($usuario_idusuario) {
        $this->usuario_idusuario = $usuario_idusuario;
    }

    function setSubcategoria_idsubcategoria($subcategoria_idsubcategoria) {
        $this->subcategoria_idsubcategoria = $subcategoria_idsubcategoria;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setDt($dt) {
        $this->dt = $dt;
    }

    
    public function inserir(){
        $oBanco = new BancoDados();
        
        $sQuery = "
        INSERT INTO 
            topico
        VALUES (
            '".$this->getUsuario_idusuario()."',
            '".$this->getSubcategoria_idsubcategoria()."',
            '".$this->getTitulo()."',
            '".$this->getDescricao()."')";
        
        if($oBanco->manipular($sQuery)){
            $this->setIdtopico($oBanco->getCodIncluido());
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
            topico 
        SET() 
        WHERE 
            idtopico=".$this->getIdtopico();
        
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
            topico 
        WHERE 
            idtopico=".$this->getIdtopico();
        
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
            topico 
        WHERE 
            idtopico=".$this->getIdtopico();
        
        if($oBanco->pesquisar($sQuery) && $oBanco->getQtd() > 0){
            
            $topicos = $oBanco->getResultado();
            
            foreach($topicos as $topico){
                $this->setSubcategoria_idsubcategoria($topico['subcategoria_idsubcategoria']);
                $this->setDescricao($topico['descricao']);
                $this->setTitulo($topico['titulo']);
                $this->setUsuario_idusuario($topico['usuario_idusuario']);
                $this->setDt($topico['dt']);
                
            }
            ;
            return true;
        } else {
            ;
            return false;
        }
    }

    public function listarTodos(){
        $oBanco = new BancoDados();
        $lista = array();
        
        $sQuery = "
        SELECT * 
        FROM 
            topico";
        
        if($iFirstReg != -1 && $iLastReg != -1)
            $sQuery .= " LIMIT ".$iFirstReg.", ".$iLastReg;
        
        if($oBanco->pesquisar($sQuery) && $oBanco->getQtd() > 0){
            $topicos = $oBanco->getResultado();
            foreach($topicos as $topico){
                $lista[] = new Topico($topico['idtopico'], $topico['usuario_idusuario'], $topico['subcategoria_idsubcategoria'], $topico['titulo'], $topico['descricao'], $topico['dt']);
            }
        }
        ;
        return ($lista);
    }
    
    public function listarPorSubCategoria($idSubCategoria, $iFirstReg = -1, $iLastReg = -1){
        $oBanco = new BancoDados();
        $lista = array();

        $sQuery = "
        SELECT * 
        FROM 
            topico
        WHERE 
            subcategoria_idsubcategoria=".$idSubCategoria."
        ORDER BY
            idtopico ASC";
        
        if($iFirstReg != -1 && $iLastReg != -1)
            $sQuery .= " LIMIT ".$iFirstReg.", ".$iLastReg;
        
        if($oBanco->pesquisar($sQuery) && $oBanco->getQtd() > 0){
            $topicos = $oBanco->getResultado();
            foreach($topicos as $topico){
                $lista[] = new Topico($topico['idtopico'], $topico['usuario_idusuario'], $topico['subcategoria_idsubcategoria'], $topico['titulo'], $topico['descricao'], $topico['dt']);
            }
        }
        ;
        return ($lista);
    }
    
    public function somarComentarios(){
        $oComentario = new Comentario();
        
        return sizeof($oComentario->listarPorTopico($this->getIdtopico()));
    }
    
    public function ultimoComentario(){
        $oComentario = new Comentario();
        
        return $oComentario->listarUltimoComentario($this->getIdtopico());
    }
}
?>
