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

class Categoria {

    private $idcategoria;
    private $nome_categoria;
    private $descricao;

    public function __construct($idcategoria = 0, $nome_categoria = null, $descricao = null) {
        $this->idcategoria = $idcategoria ;
        $this->nome_categoria = $nome_categoria;
        $this->descricao = $descricao;
    }

    public function getIdCategoria() {
        return $this->idcategoria;
    }

    public function setIdCategoria($idcategoria) {
        $this->idcategoria = $idcategoria;
    }

    public function getNomeCategoria() {
        return $this->nome_categoria;
    }

    public function setNomeCategoria($nome_categoria) {
        $this->nome_categoria = $nome_categoria;
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
            categoria
        VALUES (
            0,
            '".$this->getNomeCategoria()."',
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
            categoria 
        SET
            nome_categoria='".$this->getNomeCategoria()."',
            descricao='".$this->getDescricao()."'
        WHERE
            idcategoria=".$this->getIdCategoria();
        
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
            categoria 
        WHERE 
            idcategoria=".$this->getIdCategoria();
        
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
            categoria 
        WHERE 
            idcategoria=".$this->getIdCategoria();
        
        if($oBanco->pesquisar($sQuery) && $oBanco->getQtd() > 0){
            
            $categorias = $oBanco->getResultado();
            
            foreach($categorias as $categoria){
                $this->setIdCategoria($categoria['idcategoria']);
                $this->setNomeCategoria($categoria['nome_categoria']);
                $this->setDescricao($categoria['descricao']);
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
            categoria";

        if($iFirstReg != -1 && $iLastReg != -1)
            $sQuery .= " LIMIT ".$iFirstReg.", ".$iLastReg;
        
        if($oBanco->pesquisar($sQuery) && $oBanco->getQtd() > 0){
            $categorias = $oBanco->getResultado();
            foreach($categorias as $categoria){
                $lista[] = new Categoria($categoria['idcategoria'], $categoria['nome_categoria'], $categoria['descricao']);
            }
        }
        ;
        return ($lista);
    }
    
    public function listaPorModerador($idmoderador, $iFirstReg = -1, $iLastReg = -1){
        $oBanco = new BancoDados();
        $lista = array();

        $sQuery = "
        SELECT
            categoria.idcategoria, categoria.nome_categoria, categoria.descricao
        FROM 
            categoria, moderador_has_categoria
        WHERE
            categoria.idcategoria = moderador_has_categoria.moderador_usuario_idusuario AND
            moderador_has_categoria.moderador_usuario_idusuario = $idmoderador
        ORDER BY
            categoria.idcategoria ASC";
        
        if($iFirstReg != -1 && $iLastReg != -1)
            $sQuery .= " LIMIT ".$iFirstReg.", ".$iLastReg;
        
        if($oBanco->pesquisar($sQuery) && $oBanco->getQtd() > 0){
            $categorias = $oBanco->getResultado();
            foreach($categorias as $categoria){
                $lista[] = new Categoria($categoria['idcategoria'], $categoria['nome_categoria'], $categoria['descricao']);
            }
        }
        ;
        return ($lista);
    }
    
    public function somarSubCategorias(){
        $oSubCategoria = new SubCategoria();
        
        return sizeof($oSubCategoria->listarPorCategoria($this->getIdCategoria()));
    }
}
?>
