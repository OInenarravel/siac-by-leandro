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

class Canal {

    var $idcanal;
    var $visibilidade_idvisibilidade;
    var $esquerda;
    var $direita;
    var $nome;
    var $descricao;

    public function __construct($idcanal = 0, $visibilidade_idvisibilidade = 0, $esquerda = 0, $direita = 0, $nome = null, $descricao = null){
        $this->idcanal = $idcanal;
        $this->visibilidade_idvisibilidade = $visibilidade_idvisibilidade;
        $this->esquerda = $esquerda;
        $this->direita = $direita;
        $this->nome = $nome;
        $this->descricao = $descricao;
    }

    public function getIdcanal(){
        return $this->idcanal;
    }

    public function setIdcanal($idcanal){
        $this->idcanal = $idcanal;
    }

    public function getVisibilidade_idvisibilidade(){
        return $this->visibilidade_idvisibilidade;
    }

    public function setVisibilidade_idvisibilidade($visibilidade_idvisibilidade){
        $this->visibilidade_idvisibilidade = $visibilidade_idvisibilidade;
    }

    public function getEsquerda(){
        return $this->esquerda;
    }

    public function setEsquerda($esquerda){
        $this->esquerda = $esquerda;
    }

    public function getDireita(){
        return $this->direita;
    }

    public function setDireita($direita){
        $this->direita = $direita;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function getDescricao(){
        return $this->descricao;
    }

    public function setDescricao($descricao){
        $this->descricao = $descricao;
    }
    
    public function inserir(){
        $oBanco = new BancoDados();
        
        $retorno = $oBanco->manipular("INSERT INTO canal (idcanal, visibilidade_idvisibilidade, esquerda, direita, nome, descricao) VALUES ('".$this->visibilidade_idvisibilidade."','".$this->esquerda ."','".$this->direita."','".$this->nome."','".$this->descricao."')");
        if(!$retorno){
            echo "Erro ao inserir no banco";
        }
        ;
    }

    public function alterar($idcanal){
        $oBanco = new BancoDados();
        
        $retorno = $oBanco->manipular("UPDATE canal SET() WHERE idcanal=".$idcanal);
        if(!$retorno){
            echo "Nenhum resultado encontrado!";
        }
        ;
    }

    public function excluir($idcanal){
        $oBanco = new BancoDados();
        
        $retorno = $oBanco->manipular("DELETE * FROM canal WHERE idcanal=".$idcanal);
        if(!$retorno){
            echo "Nenhum resultado encontrado!";
        }
        ;
    }

    public function listar($idcanal){
        $oBanco = new BancoDados();
        
        $retorno = $oBanco->pesquisar("SELECT * FROM canal WHERE idcanal=".$idcanal);
        if(!$retorno){
            echo "Nenhum resultado encontrado!";
        }
        ;
    }

    public function listarTodos(){
        $oBanco = new BancoDados();
        
        $retorno = $oBanco->pesquisar("SELECT * FROM canal");
        if(!$retorno){
            echo "Nenhum resultado encontrado!";
        }
        ;
    }

}
?>
