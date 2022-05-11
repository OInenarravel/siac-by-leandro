<?php
/**
 * Description of Noticia
 * @author Leandro Souza Ferreira
 */

require_once("BancoDados.php");
//require_once("../Faker-master/src/autoload.php");

class Noticia {

    private $idnoticia;
    private $funcionario_idusuario;
    private $titulo;
    private $resumo;
    private $noticia_completa;
    private $data_noticia;
    private $destaque;
    private $status;
    private $visibilidade;

    function __construct($idnoticia = 0, $funcionario_idusuario = 0, $titulo = null, $resumo = null, $noticia_completa = null, $data_noticia = null, $destaque = 0, $status = null, $visibilidade = 0) {
        $this->idnoticia = $idnoticia;
        $this->funcionario_idusuario = $funcionario_idusuario;
        $this->titulo = $titulo;
        $this->resumo = $resumo;
        $this->noticia_completa = $noticia_completa;
        $this->data_noticia = $data_noticia;
        $this->destaque = $destaque;
        $this->status = $status;
        $this->visibilidade = $visibilidade;
    }

    public function getIdnoticia() {
        return $this->idnoticia;
    }

    public function setIdnoticia($idnoticia) {
        $this->idnoticia = $idnoticia;
    }

    public function getFuncionario_idusuario() {
        return $this->funcionario_idusuario;
    }

    public function setFuncionario_idusuario($funcionario_idusuario) {
        $this->funcionario_idusuario = $funcionario_idusuario;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getResumo() {
        return $this->resumo;
    }

    public function setResumo($resumo) {
        $this->resumo = $resumo;
    }

    public function getNoticia_completa() {
        return $this->noticia_completa;
    }

    public function setNoticia_completa($noticia_completa) {
        $this->noticia_completa = $noticia_completa;
    }

    public function getData_noticia() {
        return $this->data_noticia;
    }

    public function setData_noticia($data_noticia) {
        $this->data_noticia = $data_noticia;
    }

    public function getDestaque() {
        return $this->destaque;
    }

    public function setDestaque($destaque) {
        $this->destaque = $destaque;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getVisibilidade() {
        return $this->visibilidade;
    }

    public function setVisibilidade($visibilidade) {
        $this->visibilidade = $visibilidade;
    }

    public function inserir(){
        $oBanco = new BancoDados();
        $sQuery = "
        INSERT INTO
            noticia()
        VALUES(
            0,
            " .$this->getFuncionario_idusuario().",
            '".$this->getTitulo()."',
            '".$this->getResumo()."',
            '".$this->getNoticia_completa()."',
            now(),
            " .$this->getDestaque().",
            '".$this->getStatus()."',
            " .$this->getVisibilidade().")";

        if($oBanco->manipular($sQuery)){
            $this->setIdnoticia($oBanco->getCodIncluido());
            
            return true;
        }else{
            
            return false;
        }
    }

    public function alterar(){
        $oBanco = new BancoDados();
        $sQuery = "
        UPDATE
            noticia
        SET
            titulo = '".$this->getTitulo()."',
            resumo = '".$this->getResumo()."',
            noticia_completa = '".$this->getNoticia_completa()."',
            destaque = ".$this->getDestaque().",
            status = '".$this->getStatus()."',
            visibilidade = ".$this->getVisibilidade()."
        WHERE
            idnoticia = ".$this->getIdnoticia();

        if($oBanco->manipular($sQuery)){
            
            return true;
        }else{
            
            return false;
        }
    }

    public function excluir(){
        $oBanco = new BancoDados();
        $sQuery = "
        DELETE
        FROM
            noticia
        WHERE
            idnoticia = ".$this->getIdnoticia()."
        LIMIT 1";

        if($oBanco->manipular($sQuery)){
            
            return true;
        }else{
            
            return false;
        }
    }

    public function listar(){
        $oBanco = new BancoDados();
        $sQuery = "
        SELECT *
        FROM
            noticia
        WHERE
            idnoticia = ".$this->getIdnoticia()."
        LIMIT 1";

        if($oBanco->pesquisar($sQuery) && $oBanco->getQtd() > 0){
            
            $noticias = $oBanco->getResultado();
            
            foreach($noticias as $noticia){
                $this->setIdnoticia($noticia['idnoticia']);
                $this->setFuncionario_idusuario($noticia['funcionario_idusuario']);
                $this->setTitulo($noticia['titulo']);
                $this->setResumo($noticia['resumo']);
                $this->setNoticia_completa($noticia['noticia_completa']);
                $this->setData_noticia($noticia['data_noticia']);
                $this->setDestaque($noticia['destaque']);
                $this->setStatus($noticia['status']);
                $this->setVisibilidade($noticia['visibilidade']);
            }
            
            return true;
        } else {
            
            return false;
        }
    }

    public function listarTodos($iFirstReg = -1, $iLastReg = -1){
        $oBanco = new BancoDados();
        $lista = array();

        $sQuery = "
        SELECT *
        FROM
            noticia
        ORDER BY
            data_noticia DESC";

        if($iFirstReg != -1 && $iLastReg != -1)
            $sQuery .= " LIMIT ".$iFirstReg.", ".$iLastReg;
        
        if($oBanco->pesquisar($sQuery) && $oBanco->getQtd() > 0){
            $noticias = $oBanco->getResultado();
            foreach($noticias as $noticia){
                $lista[] = new Noticia($noticia['idnoticia'], $noticia['funcionario_idusuario'], $noticia['titulo'], $noticia['resumo'], $noticia['noticia_completa'], $noticia['data_noticia'], $noticia['destaque'], $noticia['status'], $noticia['visibilidade']);
            }
        } 
        
        return ($lista);
    }

    public function listarNoticiaDestaque($iFirstReg = -1, $iLastReg = -1){
        $oBanco = new BancoDados();
        $lista = array();

        $sQuery = "
        SELECT *
        FROM
            noticia
        WHERE
            destaque = ".$this->getDestaque()."
        ORDER BY
            data_noticia DESC";

        if($iFirstReg != -1 && $iLastReg != -1)
            $sQuery .= " LIMIT ".$iFirstReg.", ".$iLastReg;

        if($oBanco->pesquisar($sQuery) && $oBanco->getQtd() > 0){
            $noticias = $oBanco->getResultado();
            foreach($noticias as $noticia){
                $lista[] = new Noticia($noticia['idnoticia'], $noticia['funcionario_idusuario'], $noticia['titulo'], $noticia['resumo'], $noticia['noticia_completa'], $noticia['data_noticia'], $noticia['destaque'], $noticia['status'], $noticia['visibilidade']);
            }
        } 
        
        return ($lista);
    }

    public function listarPorVisibilidade($iFirstReg = -1, $iLastReg = -1){
        $oBanco = new BancoDados();
        $lista = array();

        $sQuery = "
        SELECT *
        FROM
            noticia
        WHERE
            visibilidade = ".$this->getVisibilidade()."
        ORDER BY
            data_noticia DESC";

        if($iFirstReg != -1 && $iLastReg != -1)
            $sQuery .= " LIMIT ".$iFirstReg.", ".$iLastReg;

        if($oBanco->pesquisar($sQuery) && $oBanco->getQtd() > 0){
            $noticias = $oBanco->getResultado();
            foreach($noticias as $noticia){
                $lista[] = new Noticia($noticia['idnoticia'], $noticia['funcionario_idusuario'], $noticia['titulo'], $noticia['resumo'], $noticia['noticia_completa'], $noticia['data_noticia'], $noticia['destaque'], $noticia['status'], $noticia['visibilidade']);
            }
        } 
        
        return ($lista);
    }

    public function listarDestaquePorVisibilidade($iFirstReg = -1, $iLastReg = -1){
        $oBanco = new BancoDados();
        $lista = array();

        $sQuery = "
        SELECT *
        FROM
            noticia
        WHERE
            (visibilidade = ".$this->getVisibilidade()." OR visibilidade = 3) "
            ."AND destaque = ".$this->getDestaque()."
        ORDER BY
            data_noticia DESC";

        if($iFirstReg != -1 && $iLastReg != -1)
            $sQuery .= " LIMIT ".$iFirstReg.", ".$iLastReg;

        if($oBanco->pesquisar($sQuery) && $oBanco->getQtd() > 0){
            $noticias = $oBanco->getResultado();
            foreach($noticias as $noticia){
                $lista[] = new Noticia($noticia['idnoticia'], $noticia['funcionario_idusuario'], $noticia['titulo'], $noticia['resumo'], $noticia['noticia_completa'], $noticia['data_noticia'], $noticia['destaque'], $noticia['status'], $noticia['visibilidade']);
            }
        } 
        
        return ($lista);
    }

    public function listarPorUsuario($iFirstReg = -1, $iLastReg = -1){
        $oBanco = new BancoDados();
        $lista = array();

        $sQuery = "
        SELECT *
        FROM
            noticia
        WHERE
            funcionario_idusuario = ".$this->getFuncionario_idusuario()."
        ORDER BY
            data_noticia DESC";

        if($iFirstReg != -1 && $iLastReg != -1)
            $sQuery .= " LIMIT ".$iFirstReg.", ".$iLastReg;

        if($oBanco->pesquisar($sQuery) && $oBanco->getQtd() > 0){
            $noticias = $oBanco->getResultado();
            foreach($noticias as $noticia){
                $lista[] = new Noticia($noticia['idnoticia'], $noticia['funcionario_idusuario'], $noticia['titulo'], $noticia['resumo'], $noticia['noticia_completa'], $noticia['data_noticia'], $noticia['destaque'], $noticia['status'], $noticia['visibilidade']);
            }
        } 
        
        return ($lista);
    }

    public function listarPorStatus($iFirstReg = -1, $iLastReg = -1){
        $oBanco = new BancoDados();
        $lista = array();

        $sQuery = "
        SELECT *
        FROM
            noticia
        WHERE
            status = '".$this->getStatus()."'
        ORDER BY
            data_noticia DESC";

        if($iFirstReg != -1 && $iLastReg != -1)
            $sQuery .= " LIMIT ".$iFirstReg.", ".$iLastReg;

        if($oBanco->pesquisar($sQuery) && $oBanco->getQtd() > 0){
            $noticias = $oBanco->getResultado();
            foreach($noticias as $noticia){
                $lista[] = new Noticia($noticia['idnoticia'], $noticia['funcionario_idusuario'], $noticia['titulo'], $noticia['resumo'], $noticia['noticia_completa'], $noticia['data_noticia'], $noticia['destaque'], $noticia['status'], $noticia['visibilidade']);
            }
        } 
        
        return ($lista);
    }

    public function listarPorData($iFirstReg = -1, $iLastReg = -1){
        $oBanco = new BancoDados();
        $lista = array();

        $sQuery = "
        SELECT *
        FROM
            noticia
        WHERE
            DATE_FORMAT(data_noticia, '%Y-%m-%d') = '".$this->getData_noticia()."'
        ORDER BY
            data_noticia DESC";

        if($iFirstReg != -1 && $iLastReg != -1)
            $sQuery .= " LIMIT ".$iFirstReg.", ".$iLastReg;

        if($oBanco->pesquisar($sQuery) && $oBanco->getQtd() > 0){
            $noticias = $oBanco->getResultado();
            foreach($noticias as $noticia){
                $lista[] = new Noticia($noticia['idnoticia'], $noticia['funcionario_idusuario'], $noticia['titulo'], $noticia['resumo'], $noticia['noticia_completa'], $noticia['data_noticia'], $noticia['destaque'], $noticia['status'], $noticia['visibilidade']);
            }
        } 
        
        return ($lista);
    }

    public function listarPorTitulo($iFirstReg = -1, $iLastReg = -1){
        $oBanco = new BancoDados();
        $lista = array();

        $sQuery = "
        SELECT *
        FROM
            noticia
        WHERE
            titulo LIKE '%".$this->getTitulo()."%' OR resumo LIKE '%".$this->getTitulo()."%' OR noticia_completa LIKE '%".$this->getTitulo()."%'
        ORDER BY
            data_noticia DESC";

        if($iFirstReg != -1 && $iLastReg != -1)
            $sQuery .= " LIMIT ".$iFirstReg.", ".$iLastReg;

        if($oBanco->pesquisar($sQuery) && $oBanco->getQtd() > 0){
            $noticias = $oBanco->getResultado();
            foreach($noticias as $noticia){
                $lista[] = new Noticia($noticia['idnoticia'], $noticia['funcionario_idusuario'], $noticia['titulo'], $noticia['resumo'], $noticia['noticia_completa'], $noticia['data_noticia'], $noticia['destaque'], $noticia['status'], $noticia['visibilidade']);
            }
        } 
        
        return ($lista);
    }
    
    public function pesquisarNoticiasSite($textoBusca, $iFirstReg = -1, $iLastReg = -1){
        $oBanco = new BancoDados();
        $lista = array();

        $sQuery = "
        SELECT *
        FROM
            noticia
        WHERE
            (titulo LIKE \"%".$textoBusca."%\" OR resumo LIKE \"%".$textoBusca."%\" OR noticia_completa LIKE \"%".$textoBusca."%\") 
            AND (destaque = 1) 
            AND (visibilidade = 1 OR visibilidade = 3)
        ORDER BY
            data_noticia DESC";
        
        if($iFirstReg != -1 && $iLastReg != -1)
            $sQuery .= " LIMIT ".$iFirstReg.", ".$iLastReg;

        if($oBanco->pesquisar($sQuery) && $oBanco->getQtd() > 0){
            $noticias = $oBanco->getResultado();
            foreach($noticias as $noticia){
                $lista[] = new Noticia($noticia['idnoticia'], $noticia['funcionario_idusuario'], $noticia['titulo'], $noticia['resumo'], $noticia['noticia_completa'], $noticia['data_noticia'], $noticia['destaque'], $noticia['status'], $noticia['visibilidade']);
            }
        } 
        
        return ($lista);
    }
    
    public function pesquisarNoticiasPortal($textoBusca, $iFirstReg = -1, $iLastReg = -1){
        $oBanco = new BancoDados();
        $lista = array();

        $sQuery = "
        SELECT *
        FROM
            noticia
        WHERE
            (titulo LIKE \"%".$textoBusca."%\" OR resumo LIKE \"%".$textoBusca."%\" OR noticia_completa LIKE \"%".$textoBusca."%\") 
            AND (destaque = 1) 
            AND (visibilidade = 2 OR visibilidade = 3)
        ORDER BY
            data_noticia DESC";
        
        if($iFirstReg != -1 && $iLastReg != -1)
            $sQuery .= " LIMIT ".$iFirstReg.", ".$iLastReg;

        if($oBanco->pesquisar($sQuery) && $oBanco->getQtd() > 0){
            $noticias = $oBanco->getResultado();
            foreach($noticias as $noticia){
                $lista[] = new Noticia($noticia['idnoticia'], $noticia['funcionario_idusuario'], $noticia['titulo'], $noticia['resumo'], $noticia['noticia_completa'], $noticia['data_noticia'], $noticia['destaque'], $noticia['status'], $noticia['visibilidade']);
            }
        } 
        
        return ($lista);
    }
    
    /*public function gerarNoticiaFake(){
        $faker = Faker\Factory::create();
        
        $this->setDestaque(1);
        $this->setFuncionario_idusuario(2);
        $this->setStatus("ABERTA");
        $this->setVisibilidade(3);

        $this->setTitulo($faker->sentence($nbWords = 8, $privateiableNbWords = true));
        $this->setResumo($faker->text);
        $paragrafos = $faker->paragraphs($nb = 8, $asText = false);
        $noticia_completa = null;
        foreach($paragrafos as $paragrafo){
            $noticia_completa .= "<p>".$paragrafo."</p>";
        }
        $this->setNoticia_completa($noticia_completa);

        $this->inserir();
    }*/
}
?>