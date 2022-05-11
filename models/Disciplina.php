<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Disciplina
 *
 * @author leandro
 */
require_once("BancoDados.php");

class Disciplina {

    private $iddisciplina;
    private $curso_idcurso;
    private $nome;
    private $carga_horaria;
    private $modulo;

    public function __construct($iddisciplina = 0, $curso_idcurso = 0, $nome = null, $carga_horaria = null, $modulo = null) {
        $this->iddisciplina = $iddisciplina;
        $this->curso_idcurso = $curso_idcurso;
        $this->nome = $nome;
        $this->carga_horaria = $carga_horaria;
        $this->modulo = $modulo;
    }

    public function getIddisciplina() {
        return $this->iddisciplina;
    }

    public function setIddisciplina($iddisciplina) {
        $this->iddisciplina = $iddisciplina;
    }

    public function getCurso_idcurso() {
        return $this->curso_idcurso;
    }

    public function setCurso_idcurso($curso_idcurso) {
        $this->curso_idcurso = $curso_idcurso;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getCarga_horaria() {
        return $this->carga_horaria;
    }

    public function setCarga_horaria($carga_horaria) {
        $this->carga_horaria = $carga_horaria;
    }

    public function getModulo() {
        return $this->modulo;
    }

    public function setModulo($modulo) {
        $this->modulo = $modulo;
    }

    public function inserir() {
        $oBanco = new BancoDados();

        $sQuery = "INSERT INTO
				disciplina()
			VALUES(
				0,
				'" . $this->nome . "',
				" . $this->curso_idcurso . ",
				" . $this->carga_horaria . ",
				" . $this->modulo . ")";

        $resultado = $oBanco->manipular($sQuery);

        if (!$resultado) {
            ;
            return false;
        } else {
            $this->iddisciplina = $oBanco->getCodIncluido();
            ;
            return true;
        }
    }

    public function alterar() {
        $oBanco = new BancoDados();

        $sQuery = "
		UPDATE 
			disciplina
		SET
			nome = '" . $this->nome . "',
			curso_idcurso = " . $this->curso_idcurso . ",
			carga_horaria = " . $this->carga_horaria . ",
			modulo = " . $this->modulo . "
		WHERE 
			iddisciplina=" . $this->iddisciplina;

        $resultado = $oBanco->manipular($sQuery);
        if (!$resultado) {
            ;
            return false;
        } else {
            ;
            return true;
        }
    }

    public function excluir() {
        $oBanco = new BancoDados();

        $sQuery = "
		DELETE
		FROM
			disciplina
		WHERE 
			iddisciplina=" . $this->iddisciplina . "
		LIMIT 1";

        $resultado = $oBanco->manipular($sQuery);
        if (!$resultado) {
            ;
            return false;
        } else {
            ;
            return true;
        }
    }

    public function listar() {
        $oBanco = new BancoDados();

        $sQuery = "
		SELECT * 
		FROM 
			disciplina
		WHERE 
			iddisciplina=" . $this->iddisciplina . "
		LIMIT 1";

        $oBanco->pesquisar($sQuery);

        if (!$oBanco->getQtd()) {
            ;
            return false;
        } else {
            $resultado = $oBanco->getResultado();
            $linha = mysqli_fetch_array($resultado);

            $this->setIddisciplina($linha['iddisciplina']);
            $this->setNome($linha['nome']);
            $this->setCurso_idcurso($linha['curso_idcurso']);
            $this->setCarga_horaria($linha['carga_horaria']);
            $this->setModulo($linha['modulo']);

            ;
            return true;
        }
    }

    public function listarTodos() {
        $oBanco = new BancoDados();

        $sQuery = "
		SELECT * 
		FROM 
			disciplina";

        $resultado = $oBanco->pesquisar($sQuery);

        if (!$oBanco->getQtd()) {
            ;
            return false;
        } else {
            $resultado = $oBanco->getResultado();
            ;
            return $resultado;
        }
    }

    public function listarPorCurso($iFirstReg = -1, $iLastReg = -1) {
        $oBanco = new BancoDados();
        $lista = array();
        
        $sQuery = "
        SELECT * 
        FROM 
            disciplina
        WHERE
            curso_idcurso = " . $this->getCurso_idcurso() . "
        ORDER BY
            modulo ASC, nome ASC";

        if ($iFirstReg != -1 && $iLastReg != -1){
            $sQuery .= " LIMIT " . $iFirstReg . ", " . $iLastReg;
        }
        
        $resultado = $oBanco->pesquisar($sQuery);

        if($oBanco->pesquisar($sQuery) && $oBanco->getQtd() > 0){
            $disciplinas = $oBanco->getResultado();
            ;
            foreach ($disciplinas  as $disciplina){    
                $lista[] = new Disciplina($disciplina['iddisciplina'], $disciplina['curso_idcurso'], $disciplina['nome'], $disciplina['carga_horaria'], $disciplina['modulo']);
            }
        }
        ;
        return ($lista);
    }

}

?>
