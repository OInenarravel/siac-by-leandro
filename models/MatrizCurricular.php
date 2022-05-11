<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MatrizCurricular
 *
 * @author leandro
 */

require_once("BancoDados.php");

class MatrizCurricular {

    var $idmatriz_curricular;
    var $curso_idcurso;

    public function __construct(){
        $this->idmatriz_curricular = null;
        $this->curso_idcurso = null;
    }
    public function inserir(){
        $oBanco = new BancoDados();
        
        $retorno = $oBanco->manipular("INSERT INTO matriz_curricular (curso_idcurso) VALUES (".$this->curso_idcurso.")");
        if(!$retorno){
            echo "Erro ao inserir no banco";
        }
        ;
    }

    public function alterar(){
        $oBanco = new BancoDados();
        
        $retorno = $oBanco->manipular("UPDATE matriz_curricular SET() WHERE idmatriz_curricular=".$this->idmatriz_curricular);
        if(!$retorno){
            echo "Nenhum resultado encontrado!";
        }
        ;
    }

    public function excluir(){
        $oBanco = new BancoDados();
        
        $retorno = $oBanco->manipular("DELETE * FROM matriz_curricular WHERE idmatriz_curricular=".$this->idmatriz_curricular);
        if(!$retorno){
            echo "Nenhum resultado encontrado!";
        }
        ;
    }

    public function listar(){
        $oBanco = new BancoDados();
        
        $retorno = $oBanco->pesquisar("SELECT * FROM matriz_curricular WHERE idmatriz_curricular=".$this->idmatriz_curricular);
        if(!$retorno){
            echo "Nenhum resultado encontrado!";
        }
        ;
    }

    public function listarTodos(){
        $oBanco = new BancoDados();
        
        $retorno = $oBanco->pesquisar("SELECT * FROM matriz_curricular");
        if(!$retorno){
            echo "Nenhum resultado encontrado!";
        }
        ;
    }

}
?>
