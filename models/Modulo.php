<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Modulo
 *
 * @author leandro
 */

require_once("BancoDados.php");

class Modulo {

    var $idmodulo;
    var $curso_idcurso;
    var $data_inicio;
    var $data_final;

    public function __construct(){
        $this->idmodulo = null;
        $this->curso_idcurso = null;
        $this->data_inicio = null;
        $this->data_final = null;
    }

    public function getIdmodulo(){
        return $this->idmodulo;
    }

    public function setIdmodulo($idmodulo){
        $this->idmodulo = $idmodulo;
    }

    public function getCurso_idcurso(){
        return $this->curso_idcurso;
    }

    public function setCurso_idcurso($curso_idcurso){
        $this->curso_idcurso = $curso_idcurso;
    }

    public function getData_inicio(){
        return $this->data_inicio;
    }

    public function setData_inicio($data_inicio){
        $this->data_inicio = $data_inicio;
    }

    public function getData_final(){
        return $this->data_final;
    }

    public function setData_final($data_final){
        $this->data_final = $data_final;
    }

    public function inserir(){
        $oBanco = new BancoDados();
        
        $retorno = $oBanco->manipular("INSERT INTO modulo (curso_idcurso, data_inicio, data_final) VALUES('".$this->curso_idcurso."','".$this->data_inicio."','".$this->data_final."')");
        if(!$retorno){
            echo "Erro ao inserir no banco";
        }
        ;
    }

    public function alterar(){
        $oBanco = new BancoDados();
        
        $retorno = $oBanco->manipular("UPDATE modulo SET() WHERE idmodulo=".$this->idmodulo);
        if(!$retorno){
            echo "Nenhum resultado encontrado!";
        }
        ;
    }

    public function excluir(){
        $oBanco = new BancoDados();
        
        $retorno = $oBanco->manipular("DELETE * FROM modulo WHERE idmodulo=".$this->idmodulo);
        if(!$retorno){
            echo "Nenhum resultado encontrado!";
        }
        ;
    }

    public function listar(){
        $oBanco = new BancoDados();
        
        $retorno = $oBanco->pesquisar("SELECT * FROM modulo WHERE idmodulo=".$this->idmodulo);
        if(!$retorno){
            echo "Nenhum resultado encontrado!";
        }
        ;
    }

    public function listarTodos(){
        $oBanco = new BancoDados();
        
        $retorno = $oBanco->pesquisar("SELECT * FROM modulo");
        if(!$retorno){
            echo "Nenhum resultado encontrado!";
        }
        ;
    }

}
?>
