<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Visibilidade
 *
 * @author leandro
 */

require_once("BancoDados.php");

class Visibilidade {

    var $idvisibilidade;
    var $descricao;

    public function __construct(){
        $this->idvisibilidade = null;
        $this->descricao = null;
    }

    public function getIdvisibilidade(){
        return $this->idvisibilidade;
    }

    public function setIdvisibilidade($idvisibilidade){
        $this->idvisibilidade = $idvisibilidade;
    }

    public function getDescricao(){
        return $this->descricao;
    }

    public function setDescricao($descricao){
        $this->descricao = $descricao;
    }

    public function inserir(){
        $oBanco = new BancoDados();
        
        $retorno = $oBanco->manipular("INSERT INTO visibilidade (descricao) VALUES (".$this->descricao.")");
        if(!$retorno){
            echo "Erro ao inserir no banco";
        }
        ;
    }

    public function alterar($idvisibilidade){
        $oBanco = new BancoDados();
        
        $retorno = $oBanco->manipular("UPDATE visibilidade SET() WHERE idvisibilidade=".$idvisibilidade);
        if(!$retorno){
            echo "Nenhum resultado encontrado!";
        }
        ;
    }

    public function excluir($idvisibilidade){
        $oBanco = new BancoDados();
        
        $retorno = $oBanco->manipular("DELETE * FROM visibilidade WHERE idvisibilidade=".$idvisibilidade);
        if(!$retorno){
            echo "Nenhum resultado encontrado!";
        }
        ;
    }

    public function listar($idvisibilidade){
        $oBanco = new BancoDados();
        
        $retorno = $oBanco->pesquisar("SELECT * FROM visibilidade WHERE idvisibilidade=".$idvisibilidade);
        if(!$retorno){
            echo "Nenhum resultado encontrado!";
        }
        ;
    }

    public function listarTodos(){
        $oBanco = new BancoDados();
        
        $retorno = $oBanco->pesquisar("SELECT * FROM visibilidade");
        if(!$retorno){
            echo "Nenhum resultado encontrado!";
        }
        ;
    }
}
?>
