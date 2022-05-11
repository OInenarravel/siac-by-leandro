<?php
/**
 * Description of Aluno
 *
 * @author Leandro Souza Ferreira
 */
 
require_once("Usuario.php");
 
class Aluno extends Usuario{

    private $idusuario;
    private $num_matricula;
    private $turma_idturma;
    private $necessidades_especiais;
    private $raca;

    public function __construct($idusuario = 0, $num_matricula = 0, $turma_idturma = 0, $necessidades_especiais = null, $raca = null){
        $this->idusuario= $idusuario;
        $this->num_matricula = $num_matricula;
        $this->turma_idturma = $turma_idturma;
        $this->necessidades_especiais = $necessidades_especiais;
        $this->raca = $raca;
    }

    public function getIdusuario() {
        return $this->idusuario;
    }

    public function setIdusuario($idusuario) {
        $this->idusuario = $idusuario;
    }

    public function getNum_matricula(){
        return $this->num_matricula;
    }

    public function setNum_matricula($num_matricula){
        $this->num_matricula = $num_matricula;
    }
	
    public function getTurma_idturma(){
        return $this->turma_idturma;
    }

    public function setTurma_idturma($turma_idturma){
        $this->turma_idturma = $turma_idturma;
    }
	
    public function getNecessidades_especiais(){
        return $this->necessidades_especiais;
    }

    public function setNecessidades_especiais($necessidades_especiais){
        $this->necessidades_especiais = $necessidades_especiais;
    }
	
    public function getRaca(){
        return $this->raca;
    }

    public function setRaca($raca){
        $this->raca = $raca;
    }
    
    public function inserir(){
        if(parent::inserir()){
            $this->setIdusuario(parent::getIdusuario());

            $oBanco = new BancoDados();

            $sQuery = "
            INSERT INTO
                aluno
            VALUES(
                ".$this->getIdusuario().",
                ".$this->getNum_matricula().",
                ".$this->getTurma_idturma().",
                '".$this->getNecessidades_especiais()."',
                '".$this->getRaca()."')";

            $retorno = $oBanco->manipular($sQuery);

            ;
            if(!$retorno){
                return false;
            }else{
                $this->setIdusuario($oBanco->getCodIncluido());
                return true;
            }
        }else return false;
    }

    public function alterar(){
        parent::setIdusuario($this->getIdusuario());
        if(parent::alterar()){
            $oBanco = new BancoDados();

            $sQuery = "
            UPDATE
                aluno
            SET
                num_matricula = '".$this->getNum_matricula()."',
                turma_idturma = ".$this->getTurma_idturma().",
                necessidades_especiais = '".$this->getNecessidades_especiais()."',
                raca = '".$this->getRaca()."'
            WHERE
                idusuario = ".$this->getIdusuario();

            $retorno = $oBanco->manipular($sQuery);

            ;
            if(!$retorno)
                return false;
            else
                return true;
        }else return false;
    }

    public function excluir(){
        $oBanco = new BancoDados();

        $sQuery = "
        DELETE *
        FROM
            aluno
        WHERE
            idusuario = ".$this->getIdusuario()."
        LIMIT 1";

        $retorno = $oBanco->pesquisar($sQuery);

        ;

        if(!$retorno)
            return false;
        else
            return true;
    }

    public function listar(){
        $oBanco = new BancoDados();
        $lista = array();
        
        $sQuery = "
        SELECT *
        FROM
            aluno
        WHERE
            idusuario = ".$this->getIdusuario()."
        LIMIT 1";
         
        if($oBanco->pesquisar($sQuery) && $oBanco->getQtd() > 0){
            $lista = $oBanco->getResultado();

            foreach($lista as $linha){
                $this->setIdusuario($linha['idusuario']);
                $this->setNum_matricula($linha['num_matricula']);
                $this->setTurma_idturma($linha['turma_idturma']);
                $this->setRaca($linha['raca']);
                $this->setNecessidades_especiais($linha['necessidades_especiais']);
            }
            parent::setIdusuario($this->getIdusuario());
            if(parent::listar()){
                ;
                return true;
            } else {
                ;
                return false;
            }
        } else {
            ;
            return false;
        }
    }

    /**
     *
     * @return <type> retorna um boolean, sendo TRUE caso a busca seja bem-sucedida
     * ou FALSE caso nenhum resultado seja encontrado
     */
    public function listarPorMatricula(){
        $oBanco = new BancoDados();
        $lista = array();
        
        $sQuery = "
        SELECT *
        FROM
            aluno
        WHERE
            num_matricula = ".$this->getNum_matricula()."
        LIMIT 1";

        if($oBanco->pesquisar($sQuery) && $oBanco->getQtd() > 0){
            $lista = $oBanco->getResultado();

            foreach($lista as $linha){
                $this->setIdusuario($linha['idusuario']);
                $this->setNum_matricula($linha['num_matricula']);
                $this->setTurma_idturma($linha['turma_idturma']);
                $this->setRaca($linha['raca']);
                $this->setNecessidades_especiais($linha['necessidades_especiais']);
            }
            parent::setIdusuario($this->getIdusuario());
            if(parent::listar()){
                ;
                return true;
            } else {
                ;
                return false;
            }
        } else {
            ;
            return false;
        }
    }

    /**
     *
     * @return <array> retorna um array de resultados da busca
     */
    public function listarPorTurma($iFirstReg = -1,$iLastReg = -1){
        $oBanco = new BancoDados();
        $lista = array();

        $sQuery = "
        SELECT *
        FROM
            aluno
        WHERE
            turma_idturma = " . $this->getTurma_idturma();

        if ($iFirstReg != -1 && $iLastReg != -1)
            $sQuery .= " LIMIT " . $iFirstReg . ", " . $iLastReg;

        if($oBanco->pesquisar($sQuery) && $oBanco->getQtd() > 0){
            $alunos = $oBanco->getResultado();
            foreach($alunos as $aluno){
                $lista[] = new Aluno($aluno['idusuario'], $aluno['num_matricula'], $aluno['turma_idturma'], $aluno['raca'], $aluno['necessidades_especiais']);
            }
        }
        ;
        return ($lista);
    }

    //****** ELABORAR CONSULTA SQL QUE ATENDA A ESSA CONDICAO !!! *****
    public function listarPorCurso($idCurso = 0, $iFirstReg = -1, $iLastReg = -1) {
        $oBanco = new BancoDados();
        $lista = array();

        $sQuery = "
        SELECT *
        FROM
            aluno
        WHERE
            curso.idcurso = " . $idCurso;

        if ($iFirstReg != -1 && $iLastReg != -1)
            $sQuery .= " LIMIT " . $iFirstReg . ", " . $iLastReg;

        if($oBanco->pesquisar($sQuery) && $oBanco->getQtd() > 0){
            $alunos = $oBanco->getResultado();
            foreach($alunos as $aluno){
                $lista[] = new Aluno($aluno['idusuario'], $aluno['num_matricula'], $aluno['turma_idturma'], $aluno['raca'], $aluno['necessidades_especiais']);
            }
        }
        ;
        return ($lista);
    }

    /**
     *
     * @return <type> retorna array de resultados
     */
    public function listarPorNome($nome = null, $iFirstReg = -1,$iLastReg = -1){
        $oBanco = new BancoDados();
        $lista = array();

        $sQuery = "
        SELECT
            aluno.idusuario, aluno.num_matricula, aluno.turma_idturma, aluno.raca, aluno.necessidades_especiais
        FROM
            aluno, usuario
        WHERE
            usuario.nome LIKE '%".$nome."%' AND usuario.idusuario = aluno.idusuario";

        if ($iFirstReg != -1 && $iLastReg != -1)
            $sQuery .= " LIMIT " . $iFirstReg . ", " . $iLastReg;

        if($oBanco->pesquisar($sQuery) && $oBanco->getQtd() > 0){
            $alunos = $oBanco->getResultado();
            foreach($alunos as $aluno){
                $lista[] = new Aluno($aluno['idusuario'], $aluno['num_matricula'], $aluno['turma_idturma'], $aluno['raca'], $aluno['necessidades_especiais']);
            }
        }
        ;
        return ($lista);
    }

    public function listarTodos($iFirstReg = -1,$iLastReg = -1){
        $oBanco = new BancoDados();
        $lista = array();

        $sQuery = "
        SELECT *
        FROM
            aluno";

        if ($iFirstReg != -1 && $iLastReg != -1)
            $sQuery .= " LIMIT " . $iFirstReg . ", " . $iLastReg;

        if($oBanco->pesquisar($sQuery) && $oBanco->getQtd() > 0){
            $alunos = $oBanco->getResultado();
            foreach($alunos as $aluno){
                $lista[] = new Aluno($aluno['idusuario'], $aluno['num_matricula'], $aluno['turma_idturma'], $aluno['raca'], $aluno['necessidades_especiais']);
            }
        }
        ;
        return ($lista);
    }

    /**
     *
     * @return <type> retorna um numero de matricula ainda nao cadastrado
     */
    public function gerarNumeroMatricula(){
        $numeroMatricula = "";

        do{
            $numeroMatricula = date("Y");
            $numeroMatricula .= rand(10,99);
            $numeroMatricula .= rand(10,99);
            $numeroMatricula .= rand(10,99);
            $numeroMatricula .= rand(10,99);

            $this->setNum_matricula($numeroMatricula);
        }while($this->listarPorMatricula());

        return $numeroMatricula;
    }
}
?>
