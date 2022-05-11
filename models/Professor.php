<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Professor
 *
 * @author leandro
 */
 
require_once("BancoDados.php");
require("Funcionario.php");
 
class Professor extends Funcionario{
    
    private $idusuario;
    private $disciplina_iddisciplina;
	private $numero_funcional;

    public function __construct(){
        $this->idusuario = null;
        $this->disciplina_iddisciplina = null;
        $this->numero_funcional = null;
    }

    public function getIdusuario(){
        return $this->idusuario;
    }

    public function setIdusuario($idusuario){
        $this->idusuario = $idusuario;
    }
	
	public function getDisciplinaIdDisciplina(){
		return $this->idusuario;
	}

	public function setDisciplinaIdDisciplina($disciplina_iddisciplina){
		$this->idusuario = $disciplina_iddisciplina;
	}
	
	public function getNumero_funcional(){
        return $this->numero_funcional;
    }

    public function setNumero_funcional($numero_funcional){
        $this->numero_funcional = $numero_funcional;
    }

    public function inserirProfessor(){
        if(parent::inserirFuncionario()){
			$id = parent::getIdusuario();
			
			$oBanco = new BancoDados();
			
			$sQuery = "
			INSERT INTO 
				professor
			VALUES (
				".$id.",
				'".$this->numero_funcional."')"; 
			
			$retorno = $oBanco->manipular($sQuery);
			
			if(!$retorno){
				return false;
			}
			;
			$this->idfuncionario = $id;
			return true;
		}else{
			return true;
		}
    }

    public function alterar(){
        $oBanco = new BancoDados();
        
        $retorno = $oBanco->manipular("UPDATE professor SET() WHERE idfuncionario=".$this->idfuncionario);
        if(!$retorno){
            echo "Nenhum resultado encontrado!";
        }
        ;
    }

    public function excluir(){
        $oBanco = new BancoDados();
        
        $retorno = $oBanco->manipular("DELETE * FROM professor WHERE idfuncionario=".$this->idfuncionario);
        if(!$retorno){
            echo "Nenhum resultado encontrado!";
        }
        ;
    }

    public function listar(){
        $oBanco = new BancoDados();
        
        $retorno = $oBanco->pesquisar("SELECT * FROM professor WHERE idfuncionario=".$this->idfuncionario);
        if(!$retorno){
            echo "Nenhum resultado encontrado!";
        }
        ;
    }

	public function listarTodos(){
        $oBanco = new BancoDados();
        
		$sQuery = "
		SELECT * 
		FROM 
			professor";

		$resultado = $oBanco->pesquisar($sQuery);
        
		if(!$oBanco->getQtd()){
			;
			return false;
        }else{
			$resultado = $oBanco->getResultado();
			;
			return $resultado;
		}
    }
	
	
	public function listarCoordenador($idcurso){
        $oBanco = new BancoDados();
        
		$sQuery = "
		SELECT * 
		FROM 
			professor
		WHERE
			coordenador = $idcurso";

		$resultado = $oBanco->pesquisar($sQuery);
        
		if(!$oBanco->getQtd()){
			;
			return false;
        }else{
			$resultado = $oBanco->getResultado();
			;
			return $resultado;
		}
    }
	
	
	public function inserirDisciplina($disciplinas){
		$oBanco = new BancoDados();
		
		foreach($disciplinas as $iddisciplina){
			$retorno = $oBanco->manipular("INSERT INTO 
											   disciplina_has_professor
										   VALUES (".$iddisciplina.",".$this->idfuncionario.")");
			if(!$retorno){
				echo "Erro ao inserir disciplinas do professor no banco";
				return false;
			}
		}
		return true;
	}
}
?>
