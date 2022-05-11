<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 *
 * Description of Curso
 *
 * @author Leandro Souza Ferreira
 */
require_once("BancoDados.php");

class Curso {

    var $idcurso;
    var $nome_curso;
    var $carga_horaria_curso;
    var $carga_horaria_estagio;
    var $turno;
    var $qtd_modulos;
    var $estagio_obrigatorio;
    var $amparo_legal;
    var $sobre;
    var $perfil_profissional;

    public function __construct($idcurso = 0, $nome_curso = null, $carga_horaria_curso = null, $carga_horaria_estagio = null, $turno = null, $qtd_modulos = 0, $estagio_obrigatorio = 0, $amparo_legal = null, $sobre = null, $perfil_profissional = null) {
        $this->idcurso = $idcurso;
        $this->nome_curso = $nome_curso;
        $this->carga_horaria_curso = $carga_horaria_curso;
        $this->carga_horaria_estagio = $carga_horaria_estagio;
        $this->turno = $turno;
        $this->qtd_modulos = $qtd_modulos;
        $this->estagio_obrigatorio = $estagio_obrigatorio;
        $this->amparo_legal = $amparo_legal;
        $this->sobre = $sobre;
        $this->perfil_profissional = $perfil_profissional;
    }

    public function getIdcurso() {
        return $this->idcurso;
    }

    public function setIdcurso($idcurso) {
        $this->idcurso = $idcurso;
    }

    public function getNome_curso() {
        return $this->nome_curso;
    }

    public function setNome_curso($nome_curso) {
        $this->nome_curso = $nome_curso;
    }

    public function getCarga_horaria_curso() {
        return $this->carga_horaria_curso;
    }

    public function setCarga_horaria_curso($carga_horaria_curso) {
        $this->carga_horaria_curso = $carga_horaria_curso;
    }

    public function getCarga_horaria_estagio() {
        return $this->carga_horaria_estagio;
    }

    public function setCarga_horaria_estagio($carga_horaria_estagio) {
        $this->carga_horaria_estagio = $carga_horaria_estagio;
    }

    public function getTurno() {
        return $this->turno;
    }

    public function setTurno($turno) {
        $this->turno = $turno;
    }

    public function getQtd_modulos() {
        return $this->qtd_modulos;
    }

    public function setQtd_modulos($qtd_modulos) {
        $this->qtd_modulos = $qtd_modulos;
    }

    public function getEstagio_obrigatorio() {
        return $this->estagio_obrigatorio;
    }

    public function setEstagio_obrigatorio($estagio_obrigatorio) {
        $this->estagio_obrigatorio = $estagio_obrigatorio;
    }

    public function getAmparo_legal() {
        return $this->amparo_legal;
    }

    public function setAmparo_legal($amparo_legal) {
        $this->amparo_legal = $amparo_legal;
    }

    public function getSobre() {
        return $this->sobre;
    }

    public function setSobre($sobre) {
        $this->sobre = $sobre;
    }

    public function getPerfil_profissional() {
        return $this->perfil_profissional;
    }

    public function setPerfil_profissional($perfil_profissional) {
        $this->perfil_profissional = $perfil_profissional;
    }

    public function inserir() {
        $oBanco = new BancoDados();

        $sQuery = "
        INSERT INTO
            curso()
        VALUES(
            0,
            '".$this->nome_curso . "',
            ". $this->carga_horaria_curso . ",
            ". $this->carga_horaria_estagio . ",
            '".$this->turno . "',
            ". $this->qtd_modulos . ",
            ". $this->estagio_obrigatorio . ",
            '".$this->amparo_legal . "',
            '".$this->sobre . "',
            '".$this->perfil_profissional . "')";

        $resultado = $oBanco->manipular($sQuery);

        if (!$resultado) {
           
            return false;
        } else {
            $this->idcurso = $oBanco->getCodIncluido();
           
            return true;
        }
    }

    public function alterar() {
        $oBanco = new BancoDados();

        $sQuery = "
        UPDATE 
                curso
        SET
            nome_curso = '" . $this->nome_curso . "',
            carga_horaria_curso = " . $this->carga_horaria_curso . ",
            carga_horaria_estagio = " . $this->carga_horaria_estagio . ",
            turno = '" . $this->turno . "',
            qtd_modulos = " . $this->qtd_modulos . ",
            estagio_obrigatorio = " . $this->estagio_obrigatorio . ",
            amparo_legal = '" . $this->amparo_legal . "',
            sobre = '" . $this->sobre . "',
            perfil_profissional = '" . $this->perfil_profissional . "'
        WHERE 
            idcurso = " . $this->idcurso;

        $resultado = $oBanco->manipular($sQuery);
        if (!$resultado) {
           
            return false;
        } else {
           
            return true;
        }
    }

    public function excluir() {
        $oBanco = new BancoDados();

        $sQuery = "
        DELETE
        FROM
            curso
        WHERE 
            idcurso = " . $this->idcurso . "
        LIMIT 1";

        $resultado = $oBanco->manipular($sQuery);
        if (!$resultado) {
           
            return false;
        } else {
           
            return true;
        }
    }

    public function listar() {
        $oBanco = new BancoDados();

        $sQuery = "
        SELECT * 
        FROM 
            curso
        WHERE 
            idcurso = " . $this->getIdcurso() . "
        LIMIT 1";
        
        if($oBanco->pesquisar($sQuery) && $oBanco->getQtd() > 0){
            
            $lista = $oBanco->getResultado();
            
            foreach($lista as $linha){
                $this->setIdcurso($linha['idcurso']);
                $this->setNome_curso($linha['nome_curso']);
                $this->setCarga_horaria_curso($linha['carga_horaria_curso']);
                $this->setCarga_horaria_estagio($linha['carga_horaria_estagio']);
                $this->setTurno($linha['turno']);
                $this->setQtd_modulos($linha['qtd_modulos']);
                $this->setEstagio_obrigatorio($linha['estagio_obrigatorio']);
                $this->setAmparo_legal($linha['amparo_legal']);
                $this->setSobre($linha['sobre']);
                $this->setPerfil_profissional($linha['perfil_profissional']);
            }
           
            return true;
        } else {
           
            return false;
        }
    }

    /**
     * @return <array>
     */
    public function listarTodos($iFirstReg = -1, $iLastReg = -1) {
        $oBanco = new BancoDados();
        $lista = array();

        $sQuery = "
        SELECT * 
        FROM 
            curso";

        if ($iFirstReg != -1 && $iLastReg != -1)
            $sQuery .= " LIMIT " . $iFirstReg . ", " . $iLastReg;

        if($oBanco->pesquisar($sQuery) && $oBanco->getQtd() > 0){
            $cursos = $oBanco->getResultado();
            foreach($cursos as $curso){
                $lista[] = new Curso($curso['idcurso'], $curso['nome_curso'], $curso['carga_horaria_curso'], $curso['carga_horaria_estagio'], $curso['turno'], $curso['qtd_modulos'], $curso['estagio_obrigatorio'], $curso['amparo_legal'], $curso['sobre'], $curso['perfil_profissional']);
            }   
        }
       
        return ($lista);
    }

}
?>