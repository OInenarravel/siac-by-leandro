<?php

/* Conexao com o banco de dados MySQL
  Willian Soares
  wfsoares@unimep.br / wildsoares@bol.com.br
  Criado: 29/09/03 - 11:49
  23/08/2004 - Atualizada, adição da função fecha() para
  encerrar a conexão com o banco de dados, dica fornecida pelo
  internauta Leandro Fernandes.
  08/10/2004 - Modificações seguindo sugestão enviada pelo internauta
  Alfred Reinold Baudisch.
  As funções de navegação existentes na classe conexao do arquivo connect_db.php
  não são mais necessárias, o posicionamento do ponteiro passa a ser automático.
 */

const URL = "localhost";
const PORTA = "3306";
const USER = "root";
const PASSWORD = "root";
const NOME_BANCO = "siac";
const NOME_ARQUIVO_LOG = "errodb.html";
const PASTA_DE_LOG = __DIR__.'\logs\\';

error_reporting(E_ALL);

class BancoDados {

    private $conexao;      // Identificador da conexão
    private $resultado;    // Armazena resultado das consultas
    private $qtd;          // Quantidade de linhas retornadas
    private $erro;         // Armazena o último erro
    private $cod_incluido; // Armazena o chave primaria do ultimo registro incluido com sucesso

    public function getCodIncluido() {
        return $this->cod_incluido;
    }

    public function getResultado() {
        return $this->resultado;
    }

    public function getQtd() {
        return $this->qtd;
    }

    public function __construct() {
        try{
            $this->conectar();
        }catch(Exception $erro){
            echo "<h1> ERRO AO TENTAR CONECTAR COM O BANCO DE DADOS!</h1></br>".$erro->getMessage();
        }
    }

    public function conectar(){
        $this->conexao = mysqli_connect(URL, USER, PASSWORD, NOME_BANCO, PORTA);
        mysqli_select_db($this->conexao, NOME_BANCO);
    }
    
    //Executa uma query no banco de dados e retorna os dados.
    public function pesquisar($sql = "") {
        
        $lista = array();
        // Verifica se o parametro da query SQL foi informado
        if ($sql == "") {   // Se o parametro da query SQL nao foi informado
            $this->resultado = 0; // Sem resultados
            $this->qtd = 0; // Sem linhas
            return false;
        } else {
            // Se o parametro da query SQL foi informado
            $this->resultado = mysqli_query($this->conexao, $sql); // Executa a query e armazena a resposta em '$this->res'
            if ($this->resultado) { // Se houver um resultado válido, atualiza o numero de linhas retornadas
                $this->qtd = mysqli_num_rows($this->resultado); // Armazena a qtd. de linhas
                while($linha = mysqli_fetch_array($this->resultado, MYSQLI_ASSOC)){ //Converte o resultado em uma matriz associativa
                    $lista[] = $linha; // Atribui cada nova linha a um array
                }
                $this->resultado = $lista; // Armazena a lista de resultados completos na variavel '$this->res'
                return true;
            } else { // Se o resultado nao for válido, armazena o log e informa erro na execucao 
                $this->registrarLog("SQL: ".$sql." <br/> ERRO: ".mysqli_error($this->conexao));
                return false;
            }
        }
    }

    public function newPesquisar($tabelas, $colunas = [], $condicoes = []){
        
        //Determina a clausula SELECT a ser usada com base nos parametros informados
        if (sizeof($colunas) == 0){
            $sql = "SELECT *";
        }
        else{
            $sql = "SELECT " . implode(", ", $colunas);
        }

        //Verifica se foram informadas as tabelas (FROM) a serem pesquisadas, senão retorna mensagem de erro para condicao obrigatoria para consulta
        if (sizeof($tabelas) != 0){
            if(sizeof($tabelas) < 1) 
                $sql .= " FROM " . implode(", ", $tabelas);
            else
                $sql .= " FROM ".$tabelas[0];
        }
        else{
            echo "<h1> ERRO AO INFORMAR O NOME DAS TABELAS PARA CONSULTA!</h1>";    
            return false;
        }
        
        //Verifica se foram informadas condicoes (WHERE) como parametro
        if (sizeof($condicoes) != 0){
            $sql .= " WHERE ";
            if(sizeof($condicoes) == 1){
                while(list($condicao, $valor) = $condicoes)
                    $sql .= $condicao." = ".$valor;
            }else{
                foreach($condicoes as $condicao => $valor){
                    $sql .= $condicao." = ".$valor;
                }
            }
        }
        

        //Executa uma query no bd e retorna os dados.
        if ($sql == "") {   // Se não foi passada nenhuma SQL,
            $this->resultado = 0; // Sem resultados
            $this->qtd = 0; // Sem linhas
            return false;
        } else {
            // Se passou uma SQL,			
            $this->resultado = mysqli_query($this->conexao, $sql); // Executa a query
            if ($this->resultado) { // Se houve um resultado,
                $this->qtd = mysqli_num_rows($this->resultado); // Armazena a qtd. de linhas
            } else {
                $this->registrarLog("SQL: ".$sql." <br/> ERRO: ".mysqli_error($this->conexao));
            }
            return true;
        }
    }

    public function manipular($sql = "") {
        //Executa uma query de DDL ou DML (manipulação de dados)        
        if (mysqli_query($this->conexao, $sql)) {
            $this->cod_incluido = mysqli_insert_id($this->conexao);
            return true; // Se OK, retorna TRUE.
        } else {
            $this->cod_incluido = 0;
            $this->erro = mysqli_error($this->conexao); // Armazena o último erro.
            $this->registrarLog("SQL: ".$sql." <br/> ERRO: ".$this->erro);
            return false;
        }
    }

    public function registrarLog($mensagem) {
        $nameFile = PASTA_DE_LOG.NOME_ARQUIVO_LOG;

        echo $mensagem;
        try{
            $arquivo = fopen($nameFile, "a+");
            fwrite($arquivo, "<b>Nome do arquivo:</b> ". $_SERVER['PHP_SELF'] ."<br/><b>Data:</b> ". date("j/n/Y") . ' - <b>Horario:</b> ' . date('H:i:s') . "<br/><b>Mensagem:</b> ".$mensagem."<br/><br/>");
            fclose($arquivo);
        } catch (Exception $ex) {
            echo "<h1>ERRO AO TENTAR REGISTRAR LOG!</h1><h1>".$ex->getMessage()."</h1>";
        }
    }
}
?>