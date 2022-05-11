<?php
/**
 * Description of Funcionario
 *
 * @author leandro
 */
 
require_once("BancoDados.php");
require_once("Usuario.php");

class Funcionario extends Usuario{
    
    private $funcionario_idusuario;
    private $numcarteira;

    public function __construct($funcionario_idusuario = 0, $numcarteira = 0){
        parent::__construct();
        $this->funcionario_idusuario = $funcionario_idusuario;
        $this->numcarteira = $numcarteira;
    }

    function getFuncionario_idusuario() {
        return $this->funcionario_idusuario;
    }

    function setFuncionario_idusuario($funcionario_idusuario) {
        $this->funcionario_idusuario = $funcionario_idusuario;
    }
	
    public function getNumCarteira(){
        return $this->idusuario;
    }

    public function setNumCarteira($numcarteira){
        $this->numcarteira = $numcarteira;
    }

    public function inserir() {
        if (parent::inserir()) {
            $this->setFuncionario_idusuario(parent::getIdusuario());

            $oBanco = new BancoDados();

            $sQuery = "
            INSERT INTO
                funcionario
            VALUES(
                " . $this->getFuncionario_idusuario(). ",
                '" .$this->getNumCarteira(). "')";

            $retorno = $oBanco->manipular($sQuery);

            ;
            if (!$retorno) {
                return false;
            } else {
                return true;
            }
        } else
            return false;
    }

    public function alterar() {
        parent::setIdusuario($this->getFuncionario_idusuario());
        if (parent::alterar()) {
            $oBanco = new BancoDados();

            $sQuery = "
            UPDATE
                funcionario
            SET
                carteiraTrabalho = '" . $this->getNumCarteira() . "'
            WHERE
                idusuario = " . $this->getFuncionario_idusuario();

            $retorno = $oBanco->manipular($sQuery);

            ;
            if (!$retorno)
                return false;
            else
                return true;
        } else
            return false;
    }

    public function excluir(){
        $oBanco = new BancoDados();

        $sQuery = "
        DELETE *
        FROM
            funcionario
        WHERE
            idusuario = ".$this->setFuncionario_idusuario()."
        LIMIT 1";

        $retorno = $oBanco->pesquisar($sQuery);

        ;

        if(!$retorno)
            return false;
        else
            return true;
    }

    public function listar() {
        $sQuery = "
        SELECT *
        FROM
            funcionario
        WHERE
            funcionario_idusuario = " . $this->getFuncionario_idusuario() . "
        LIMIT 1";

        parent::setIdusuario($this->getFuncionario_idusuario());

        if (parent::listar()) {
            $oBanco = new BancoDados();
            $lista = array();
            
            if($oBanco->pesquisar($sQuery) && $oBanco->getQtd() > 0){
            
                $lista = $oBanco->getResultado();

                foreach($lista as $linha){
                    $this->setFuncionario_idusuario($linha['funcionario_idusuario']);
                    $this->setNumCarteira($linha['carteiraTrabalho']);
                }
                ;
                return true;
            } else {
                ;
                return false;
            }
        } else {
            return false;
        }
    }

    public function listarPorCarteiraTrabalho(){
        $oBanco = new BancoDados();

        $sQuery = "
        SELECT
            usuario.idusuario,
            usuario.login,
            usuario.senha,
            usuario.nivel_acesso,
            usuario.nome,
            usuario.rua,
            usuario.numero,
            usuario.bairro,
            usuario.municipio,
            usuario.estado,
            usuario.cep,
            usuario.nacionalidade,
            usuario.uf_origem,
            usuario.pai,
            usuario.mae,
            usuario.rg,
            usuario.cpf,
            usuario.data_cadastro,
            usuario.telefone_fixo,
            usuario.telefone_celular,
            usuario.telefone_recado,
            usuario.email,
            funcionario.carteiraTrabalho
        FROM
                usuario, funcionario
        WHERE
                carteiraTrabalho = '".$this->getNumCarteira()."'
        LIMIT 1";

        $oBanco->pesquisar($sQuery);

        if(!$oBanco->getQtd()){
            ;
            return false;
        }else{
            $resultado = $oBanco->getResultado();
            $linha = mysqli_fetch_array($resultado);

            $this->setFuncionario_idusuario($linha['funcionario_idusuario']);
            $this->setNumCarteira($linha['carteiraTrabalho']);

            parent::setIdusuario($this->getFuncionario_idusuario());

            ;

            if(parent::listar())
                return true;
            else
                return false;
        }
    }

    public function listarTodos($iFirstReg = -1,$iLastReg = -1){
        $oBanco = new BancoDados();
        $lista = array();

        $sQuery = "
        SELECT
            usuario.idusuario,
            usuario.login,
            usuario.senha,
            usuario.nivel_acesso,
            usuario.nome,
            usuario.rua,
            usuario.numero,
            usuario.bairro,
            usuario.municipio,
            usuario.estado,
            usuario.cep,
            usuario.nacionalidade,
            usuario.uf_origem,
            usuario.pai,
            usuario.mae,
            usuario.rg,
            usuario.cpf,
            usuario.data_cadastro,
            usuario.telefone_fixo,
            usuario.telefone_celular,
            usuario.telefone_recado,
            usuario.email,
            funcionario.carteiraTrabalho
        FROM
            usuario, funcionario, professor
        WHERE
            funcionario.idusuario = usuario.idusuario AND
            funcionario.idusuario != professor.idfuncionario";

        if($iFirstReg != -1 && $iLastReg != -1)
            $sQuery .= " LIMIT ".$iFirstReg.", ".$iLastReg;

        $oBanco->pesquisar($sQuery);

        if(!$oBanco->getQtd()){
            ;
            return false;
        }else{
            $resultado = $oBanco->getResultado();
            ;
            while($linha = mysqli_fetch_array($resultado))
                $lista[] = $linha;
            return ($lista);
        }
    }
}
?>