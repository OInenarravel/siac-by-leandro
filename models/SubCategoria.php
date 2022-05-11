<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 *
 * Description of Categoria
 *
 * @author Leandro Souza Ferreira
 */

require_once("BancoDados.php");

class SubCategoria {

    private $idsubcategoria;
    private $idcategoria;
    private $nome_subcategoria;
    private $descricao;

    public function __construct($idsubcategoria = 0, $idcategoria = 0, $nome_subcategoria = null, $descricao = null) {
        $this->idsubcategoria = $idsubcategoria;
        $this->idcategoria = $idcategoria;
        $this->nome_subcategoria = $nome_subcategoria;
        $this->descricao = $descricao;
    }

    public function getIdSubCategoria() {
        return $this->idsubcategoria;
    }

    public function setIdSubCategoria($idsubcategoria) {
        $this->idsubcategoria = $idsubcategoria;
    }

    public function getIdCategoria() {
        return $this->idcategoria;
    }

    public function setIdCategoria($idcategoria) {
        $this->idcategoria = $idcategoria;
    }

    public function getNomeSubCategoria() {
        return $this->nome_subcategoria;
    }

    public function setNomeSubCategoria($nome_subcategoria) {
        $this->nome_subcategoria = $nome_subcategoria;
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
            subcategoria
        VALUES (
            0,
            ".$this->getIdCategoria().",
            '".$this->getNomeSubCategoria()."',
            '".$this->getDescricao()."')";
        
        if($oBanco->manipular($sQuery)){
            $this->setIdCategoria($oBanco->getCodIncluido());
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
            subcategoria 
        SET
            categoria_idcategoria=".$this->getIdCategoria().",
            nome_subcategoria='".$this->getNomeSubCategoria()."',
            descricao='".$this->getDescricao()."'
        WHERE
            idsubcategoria=".$this->getIdSubCategoria();
        
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
        DELETE FROM 
            subcategoria 
        WHERE 
            idsubcategoria=".$this->getIdSubCategoria();
        
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

        $sQuery = "
        SELECT *
        FROM 
            subcategoria 
        WHERE 
            idsubcategoria=".$this->getIdSubCategoria();
        
        if($oBanco->pesquisar($sQuery) && $oBanco->getQtd() > 0){
            
            $subcategorias = $oBanco->getResultado();
            
            foreach($subcategorias as $subcategoria){
                $this->setIdCategoria($subcategoria['categoria_idcategoria']);
                $this->setNomeSubCategoria($subcategoria['nome_subcategoria']);
                $this->setDescricao($subcategoria['descricao']);
            }
            ;
            return true;
        } else {
            ;
            return false;
        }
    }

    public function listarTodos() {
        $oBanco = new BancoDados();
        $lista = array();
        
        $sQuery = "
        SELECT * 	
        FROM 
            subcategoria";
        
        if($iFirstReg != -1 && $iLastReg != -1)
            $sQuery .= " LIMIT ".$iFirstReg.", ".$iLastReg;
        
        if($oBanco->pesquisar($sQuery) && $oBanco->getQtd() > 0){
            $subcategorias = $oBanco->getResultado();
            foreach($subcategorias as $subcategoria){
                $lista[] = new SubCategoria($subcategoria['idsubcategoria'], $subcategoria['categoria_idcategoria'], $subcategoria['nome_subcategoria'], $subcategoria['descricao']);
            }
        }
        ;
        return ($lista);
    }
    
    public function listarPorCategoria($idcategoria, $iFirstReg = -1, $iLastReg = -1){
        $oBanco = new BancoDados();
        $lista = array();

        $sQuery = "
        SELECT *
        FROM 
            subcategoria
        WHERE 
            categoria_idcategoria=$idcategoria
        ORDER BY
            idsubcategoria ASC";
        
        if($iFirstReg != -1 && $iLastReg != -1)
            $sQuery .= " LIMIT ".$iFirstReg.", ".$iLastReg;
        
        if($oBanco->pesquisar($sQuery) && $oBanco->getQtd() > 0){
            $subcategorias = $oBanco->getResultado();
            foreach($subcategorias as $subcategoria){
                $lista[] = new SubCategoria($subcategoria['idsubcategoria'], $subcategoria['categoria_idcategoria'], $subcategoria['nome_subcategoria'], $subcategoria['descricao']);
            }
        }
        ;
        return ($lista);
    }
    
    public function somarTopicos(){
        $oTopico = new Topico();
        
        return sizeof($oTopico->listarPorSubCategoria($this->getIdSubCategoria()));
    }
}
?>
