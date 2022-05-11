<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 *
 * Description of Moderador
 *
 * @author Leandro Souza Ferreira
 */

require_once("Usuario.php");
require_once("BancoDados.php");

class Moderador extends Usuario{

    private $usuario_idusuario;
    private $privilegio;

    public function __construct($usuario_idusuario = 0, $privilegio = null) {
        $this->usuario_idusuario = $usuario_idusuario ;
        $this->privilegio = $privilegio;
        
        if($usuario_idusuario != 0){
            $this->listar();
        }
    }

    public function getUsuario_idusuario() {
        return $this->usuario_idusuario;
    }

    public function setUsuario_idusuario($usuario_idusuario) {
        $this->usuario_idusuario = $usuario_idusuario;
        parent::setIdusuario($usuario_idusuario);
    }

    public function getPrivilegio() {
        return $this->privilegio;
    }

    public function setPrivilegio($privilegio) {
        $this->privilegio = $privilegio;
    }

    public function inserir() {
        $oBanco = new BancoDados();

        $sQuery = "
        INSERT INTO
            moderador
        VALUES (
            ".$this->getUsuario_idusuario().",
            '".$this->getPrivilegio()."')";
        
        if($oBanco->manipular($sQuery)){
            $this->setIdnoticia($oBanco->getCodIncluido());
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
            moderador 
        SET
            usuario_idusuario='".$this->getUsuario_idusuario()."',
            privilegio='".$this->getPrivilegio()."'
        WHERE
            usuario_idusuario=".$this->getUsuario_idusuario();
        
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
            moderador
        WHERE 
            usuario_idusuario=".$this->getUsuario_idusuario();
        
        if($oBanco->manipular($sQuery)){
            $sQuery = "
            DELETE FROM 
                moderador_has_categoria
            WHERE
                moderador_usuario_idusuario=".$this->getUsuario_idusuario();
            
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
            moderador 
        WHERE 
            usuario_idusuario=".$this->getUsuario_idusuario();
        
        if($oBanco->pesquisar($sQuery) && $oBanco->getQtd() > 0){

            $moderadores = $oBanco->getResultado();

            foreach($moderadores as $moderador){
                $this->setUsuario_idusuario($moderador['usuario_idusuario']);
                $this->setPrivilegio($moderador['privilegio']);
            }
            parent::setIdusuario($this->getUsuario_idusuario());
            if(parent::listar()){
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
        
    public function listarTodos($iFirstReg = -1, $iLastReg = -1){
        $oBanco = new BancoDados();
        $lista = array();

        $sQuery = "
        SELECT *
        FROM
            moderador";

        if($iFirstReg != -1 && $iLastReg != -1)
            $sQuery .= " LIMIT ".$iFirstReg.", ".$iLastReg;
        
        if($oBanco->pesquisar($sQuery) && $oBanco->getQtd() > 0){
            $moderadores = $oBanco->getResultado();
            foreach($moderadores as $moderador){
                $lista [] = new Moderador($moderador['usuario_idusuario'], $moderador['privilegio']);
            }
        }
        ;
        return ($lista);
    }

    public function listarPorCategoria($idcategoria, $iFirstReg = -1, $iLastReg = -1) {
        $oBanco = new BancoDados();
        $lista = array();

        $sQuery = "
        SELECT DISTINCT
            moderador.usuario_idusuario, moderador.privilegio 
        FROM 
            moderador, moderador_has_categoria 
        WHERE 
            moderador.usuario_idusuario IN    
            (SELECT 
                moderador_has_categoria.moderador_usuario_idusuario
            FROM 
                moderador_has_categoria 
            WHERE 
                moderador_has_categoria.categoria_idcategoria = $idcategoria)
        ORDER BY 
            moderador.usuario_idusuario ASC";

        if($iFirstReg != -1 && $iLastReg != -1)
            $sQuery .= " LIMIT ".$iFirstReg.", ".$iLastReg;
        
        if($oBanco->pesquisar($sQuery) && $oBanco->getQtd() > 0){
            $moderadores = $oBanco->getResultado();
            foreach($moderadores as $moderador){
                $lista [] = new Moderador($moderador['usuario_idusuario'], $moderador['privilegio']);
            }
        }
        ;
        return ($lista);
    }
    
    public function listarModeradoresAtivos($iFirstReg = -1, $iLastReg = -1) {
        $oBanco = new BancoDados();
        $lista = array();

        $sQuery = "
        SELECT DISTINCT
            moderador.usuario_idusuario, moderador.privilegio 
        FROM 
            moderador, moderador_has_categoria 
        WHERE 
            moderador.usuario_idusuario IN    
            (SELECT 
                moderador_has_categoria.moderador_usuario_idusuario
            FROM 
                moderador_has_categoria)
        ORDER BY 
        moderador.usuario_idusuario ASC";

        if($iFirstReg != -1 && $iLastReg != -1)
            $sQuery .= " LIMIT ".$iFirstReg.", ".$iLastReg;
        
        if($oBanco->pesquisar($sQuery) && $oBanco->getQtd() > 0){
            $moderadores = $oBanco->getResultado();
            foreach($moderadores as $moderador){
                $lista [] = new Moderador($moderador['usuario_idusuario'], $moderador['privilegio']);
            }
        }
        ;
        return ($lista);
    }
    
    public function moderarCategoria($idcategoria) {
        $oBanco = new BancoDados();

        $sQuery = "
        INSERT INTO 
            moderador_has_categoria
        VALUES(
            ".$this->getUsuario_idusuario().",
            ".$idcategoria.")";
        
        if($oBanco->manipular($sQuery)){
            ;
            return true;
        }else{
            ;
            return false;
        }
    }
}
?>