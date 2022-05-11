<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 *
 * Description of Banido
 *
 * @author Leandro Souza Ferreira
 */
 
require_once("BancoDados.php");

class Banido {

    private $usuario_idusuario;
    private $moderador_usuario_idusuario;
    private $data_banido;
    private $motivo;

    public function __construct($usuario_idusuario = 0, $moderador_usuario_idusuario = 0, $data_banido = null, $motivo = null){
        $this->usuario_idusuario = $usuario_idusuario;
        $this->moderador_usuario_idusuario = $moderador_usuario_idusuario;
        $this->data_banido = $data_banido;
        $this->motivo = $motivo;
    }

    public function getUsuario_idusuario(){
        return $this->usuario_idusuario;
    }

    public function setUsuario_idusuario($usuario_idusuario){
        $this->usuario_idusuario = $usuario_idusuario;
    }

    public function getModerador_usuario_idusuario(){
        return ;
    }

    public function setModerador_usuario_idusuario($moderador_usuario_idusuario){
        $this->moderador_usuario_idusuario = $moderador_usuario_idusuario;
    }

    public function getDataBanido(){
        return $this->data_banido;
    }

    public function setDataBanido($data_banido){
        $this->data_banido = $data_banido;
    }

    public function getMotivo(){
        return $this->motivo;
    }

    public function setMotivo($motivo){
        $this->motivo = $motivo;
    }

    public function inserir() {
        $oBanco = new BancoDados();
        $sQuery = "
        INSERT INTO
            banido
        VALUES(
            ".$this->getUsuario_idusuario()."
            ".$this->getModerador_usuario_idusuario().",
            now(),
            '".$this->getMotivo()."')";
        
        if($oBanco->manipular($sQuery)){
            $this->setUsuario_idusuario($oBanco->getCodIncluido());
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
            banido 
        SET() 
        WHERE 
            usuario_idusuario=" . $this->getUsuario_idusuario();
        
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
            banido
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

    public function listar() {
        $oBanco = new BancoDados();

        $sQuery = "
        SELECT * 
        FROM 
            banido 
        WHERE 
            usuario_idusuario=" . $this->getUsuario_idusuario();

        if($oBanco->pesquisar($sQuery) && $oBanco->getQtd() > 0){
            
            $banidos = $oBanco->getResultado();
            
            foreach($banidos as $banido){
                $this->setUsuario_idusuario($banido['usuario_idusuario']);
                $this->setModerador_usuario_idusuario($banido['moderador_usuario_idusuario']);
                $this->setDataBanido($banido['data_banido']);
                $this->setMotivo($banido['motivo']);
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
            banido";
        
        if($iFirstReg != -1 && $iLastReg != -1)
            $sQuery .= " LIMIT ".$iFirstReg.", ".$iLastReg;
        
        if($oBanco->pesquisar($sQuery) && $oBanco->getQtd() > 0){
            $banidos = $oBanco->getResultado();
            foreach($banidos as $banido){
                $lista[] = new Banido($banido['usuario_idusuario'], $banido['moderador_usuario_idusuario'], $banido['data_banido'], $banido['motivo']);
            }
        } 
        ;
        return ($lista);
    }

}
?>
