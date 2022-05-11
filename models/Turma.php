<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Turma
 *
 * @author Leandro Souza Ferreira
 */
require_once("BancoDados.php");

class Turma {

    var $idturma;
    var $nome;
    var $curso_idcurso;
    var $inicio;
    var $encerramento;
    var $turno;
    var $modulo;

    public function __construct() {
        $this->idturma = null;
        $this->nome = null;
        $this->curso_idcurso = null;
        $this->inicio = null;
        $this->encerramento = null;
        $this->turno = null;
        $this->modulo = null;
    }

    public function getIdturma() {
        return $this->idturma;
    }

    public function setIdturma($idturma) {
        $this->idturma = $idturma;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getCurso_idcurso() {
        return $this->curso_idcurso;
    }

    public function setCurso_idcurso($curso_idcurso) {
        $this->curso_idcurso = $curso_idcurso;
    }

    public function getInicio() {
        return $this->inicio;
    }

    public function setInicio($inicio) {
        $this->inicio = $inicio;
    }

    public function getEncerramento() {
        return $this->encerramento;
    }

    public function setEncerramento($encerramento) {
        $this->encerramento = $encerramento;
    }

    public function getTurno() {
        return $this->turno;
    }

    public function setTurno($turno) {
        $this->turno = $turno;
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
			turma()
		VALUES(
			0,
			" . $this->curso_idcurso . ",
			'" . $this->inicio . "',
			'" . $this->encerramento . "',
			'" . $this->turno . "',
			'" . $this->modulo . "',
			'" . $this->nome . "')";

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
			turma
		SET
			" . $this->curso_idcurso . ",
			'" . $this->inicio . "',
			'" . $this->encerramento . "',
			'" . $this->turno . "',
			'" . $this->modulo . "',
			'" . $this->nome . "'
		WHERE 
			idturma=" . $this->idturma;

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
			turma
		WHERE 
			idturma=" . $this->idturma . "
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
			turma
		WHERE 
			idturma=" . $this->idturma . "
		LIMIT 1";

        $oBanco->pesquisar($sQuery);

        if (!$oBanco->getQtd()) {
            ;
            return false;
        } else {
            $resultado = $oBanco->getResultado();
            $linha = mysqli_fetch_array($resultado);

            $this->setIdturma($linha['idturma']);
            $this->setNome($linha['nome']);
            $this->setCurso_idcurso($linha['curso_idcurso']);
            $this->setInicio($linha['inicio']);
            $this->setEncerramento($linha['encerramento']);
            $this->setTurno($linha['turno']);
            $this->setModulo($linha['modulo']);

            ;
            return true;
        }
    }

    public function listarTodos($iFirstReg = -1, $iLastReg = -1) {
        $oBanco = new BancoDados();
        $lista = array();

        $sQuery = "
		SELECT * 
		FROM 
			turma";

        $oBanco->pesquisar($sQuery);

        if (!$oBanco->getQtd()) {
            ;
            return false;
        } else {
            $resultado = $oBanco->getResultado();
            ;
            while ($linha = mysqli_fetch_array($resultado))
                $lista[] = $linha;
            return ($lista);
        }
    }

    public function listarPorCurso($idcurso) {
        $oBanco = new BancoDados();
        $lista = array();

        $sQuery = "
        SELECT *
        FROM
            turma INNER JOIN curso
        ON
            turma.curso_idcurso=curso.idcurso
        WHERE
            curso.idcurso=" . $idcurso;

        $oBanco->pesquisar($sQuery);

        if (!$oBanco->getQtd()) {
            ;
            return false;
        } else {
            $resultado = $oBanco->getResultado();
            ;
            while ($linha = mysqli_fetch_array($resultado))
                $lista[] = $linha;
            return ($lista);
        }
    }

}

?>
