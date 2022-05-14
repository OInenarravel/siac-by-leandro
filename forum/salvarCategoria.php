<?php

require_once("../models/Categoria.php");

$oCategoria = new Categoria();

echo "ID CATEGORIA: " . @$_POST['campoID'];
echo "<br/>NOME: " . @$_POST['campoNome'];
echo "<br/>DESCRICAO: " . @$_POST['campoDescricao'];

// Testa se foi passado um ID por parametro POST, caso verdadeiro tenta atualizar essa categoria
if ($idcategoria = @$_POST['campoID']) {
    $nomeCategoria = $_POST['campoNome'];
    $descricao = $_POST['campoDescricao'];

    $oCategoria->setIdCategoria($idcategoria);
    $oCategoria->setNomeCategoria($nomeCategoria);
    $oCategoria->setDescricao($descricao);

    $x = $oCategoria->alterar();
    if ($x) {
        echo "
        <script>
            alert('Categoria atualizada com sucesso!');
            window.location = './administrativoCategoria.php';
        </script>";
    } else {
        echo "<h1>ERRO AO ALTERAR CATEGORIA!</h1>";
    }
// Caso o ID nao seja informado, assume que trata-se de uma nova categoria e trata os campos de Nome e Descricao preenchidos.
} else {
    $descricao = @$_POST['campoDescricao'];
    if (!$idcategoria && $descricao) {
        $nome = $_POST['campoNome'];

        $oCategoria->setNomeCategoria($nome);
        $oCategoria->setDescricao($descricao);

        $x = $oCategoria->inserir();
        if ($x) {
            echo "
            <script>
                alert('Categoria cadastrada com sucesso!');
                window.location = './administrativoCategoria.php';
            </script>";
        } else {
            $erro = "<h1>ERRO AO INSERIR CATEGORIA!</h1>";
        }
    }
}
?>