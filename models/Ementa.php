<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Ementa
 *
 * @author Leandro Souza Ferreira
 */

require_once("BancoDados.php");

class Ementa {

    var $idementa;
    var $disciplina_iddisciplina;
    var $carga_horaria;

    public function __construct(){
        $this->idementa = null;
        $this->disciplina_iddisciplina = null;
        $this->carga_horaria = null;
    }

    public function getIdementa(){
        return $this->idementa;
    }

    public function setIdementa($idementa){
        $this->idementa = $idementa;
    }

    public function getDisciplina_iddisciplina(){
        return $this->disciplina_iddisciplina;
    }

    public function setDisciplina_iddisciplina($disciplina_iddisciplina){
        $this->disciplina_iddisciplina = $disciplina_iddisciplina;
    }

    public function getCarga_horaria(){
        return $this->carga_horaria;
    }

    public function setCarga_horaria($carga_horaria){
        $this->carga_horaria = $carga_horaria;
    }
    
    public function inserir(){
        $oBanco = new BancoDados();
        
        $retorno = $oBanco->manipular("INSERT INTO ementa (disciplina_iddisciplina, carga_horaria) VALUES('".$this->disciplina_iddisciplina."','".$this->carga_horaria."')");
        if(!$retorno){
            echo "Erro ao inserir no banco";
        }
        ;
    }

    public function alterar(){
        $oBanco = new BancoDados();
        
        $retorno = $oBanco->manipular("UPDATE ementa SET() WHERE idementa=".$this->idementa);
        if(!$retorno){
            echo "Nenhum resultado encontrado!";
        }
        ;
    }

    public function excluir(){
        $oBanco = new BancoDados();
        
        $retorno = $oBanco->manipular("DELETE * FROM ementa WHERE idementa=".$this->idementa);
        if(!$retorno){
            echo "Nenhum resultado encontrado!";
        }
        ;
    }

    public function listar(){
        $oBanco = new BancoDados();
        
        $retorno = $oBanco->pesquisar("SELECT * FROM ementa WHERE idementa=".$this->idementa);
        if(!$retorno){
            echo "Nenhum resultado encontrado!";
        }
        ;
    }

    public function listarTodos(){
        $oBanco = new BancoDados();
        
        $retorno = $oBanco->pesquisar("SELECT * FROM ementa");
        if(!$retorno){
            echo "Nenhum resultado encontrado!";
        }
        ;
    }

}
?>
