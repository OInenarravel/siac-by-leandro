<?php
require_once("../models/Categoria.php");
require_once("../models/SubCategoria.php");
require_once("../models/Sessao.php");
require_once("../models/Banido.php");

$oCategoria = new Categoria();
$oSubCategoria = new SubCategoria();
$oSessao = new Sessao();
$oBanido = new Banido();

$nivelAcesso = $oSessao->getVariavelSessao("nivelAcesso");

if ($oSessao->estaLogado() == null || $oSessao->getVariavelSessao("nivelAcesso") != "Administrador") {
    $oSessao->expulsar();
}

$oBanido->setUsuario_idusuario($oSessao->getVariavelSessao("iIdUsuario"));
echo $oBanido->listar() ? "<script>\nalert(\"Seu nome consta na lista de usuarios banidos! Voce nao podera acessar a area do forum. Entre em contato com seu coordenador de curso para regularizar sua situacao.\");\nwindow.location = \"../portal/index.php\";\n</script>\n" : "";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt" lang="pt" dir="ltr">
    <head>

        <title>..:::.. F&Oacute;RUM CEET VASCO COUTINHO - INFORM�TICA - PROGRAMA��O ..:::..</title>
        <link rel='stylesheet' href='../css/estilo_forum.css' type='text/css' media='screen'/>
        <link rel="stylesheet" href="../css/menu_style.css" type="text/css" />
        <script src="../js/forum.js" type="text/javascript"></script>
        <style type='text/css'>
            <!--
            .linha_titulo{
                border: 1px solid black;
            }
            -->
        </style>
    </head>
    <body>
        <div id='container'>

            <div id='cabecalho'>

                <div id='banner_superior'>
                    <div id='banner_superior_figura'>
                        <img src='../img/banner_texto_forum.png'/>
                    </div>
                </div>

                <div id='menu_superior'>
                    <ul>
                        <li><a href="./index.php" >HOME</a></li>
                        <li><a href="./faq.php" >FAQ</a></li>
                        <?php if (($_SESSION["nivelAcesso"] != "Aluno") && ($_SESSION["nivelAcesso"] != "Professor" && $_SESSION["nivelAcesso"] != "Usu�rio")) { ?>
                            <li><a href="./membros.php">LISTA DE MEMBROS</a></li>
                            <li>
                                <a href="#">&Aacute;REA ADMINISTRATIVA</a>
                                <ul>
                                    <li><a href="./administrativoCategoria.php">CATEGORIA</a></li>
                                    <li><a href="./administrativoSubCategoria.php">SUBCATEGORIA</a></li>
                                    <li><a href="./administrativoModerador.php">MODERADOR</a></li>
                                    <li><a href="./administrativoUsuario.php">USU&Aacute;RIO</a></li>
                                </ul>
                            </li>
                        <?php } ?>
                        <li><a href='../portal/index.php'>SAIR</a></li>
                    </ul>
                </div>

            </div>

            <div id='conteudo'>
                <?php
                $sQuery = "
                SELECT 
                    categoria.nome_categoria, 
                    subcategoria.idsubcategoria, 
                    subcategoria.nome_subcategoria, 
                    subcategoria.descricao 
                FROM 
                    subcategoria 
                INNER JOIN 
                    categoria ON subcategoria.categoria_idcategoria=categoria.idcategoria";
                echo "
                <table class='categoria'>
                    <tr class='linha_titulo'>
                        <td class='cel_titulo_nome' colspan=2>Nome da Categoria que pertence</td>
                        <td class='cel_titulo_nome'>Nome da Sub-categoria</td>
                        <td class='cel_titulo_descricao'>Descri&ccedil;&atilde;o</td>
                    </tr>";
                $listaCategorias = $oCategoria->listarTodos();
                if($listaCategorias){
                    $x = 1;
                    foreach($listaCategorias as $categoria){
                        $listaSubCategorias = $oSubCategoria->listarPorCategoria($categoria->getIdCategoria());
                        if($listaSubCategorias){
                            foreach($listaSubCategorias as $subcategoria){
                                echo "
                                <tr class='linha_dados'>
                                    <td class='cel_check'><input type='checkbox' name='row$x'/></td>
                                    <td class='cel_conteudo'>".$categoria->getNomeCategoria()."</td>
                                    <td class='cel_conteudo'><a href='alterarSubCategoria.php?idsubcategoria=".$subcategoria->getIdSubCategoria()."&amp;opcao=2'>".$subcategoria->getNomeSubCategoria()."</a></td>
                                    <td class='cel_conteudo'>".$subcategoria->getDescricao()."</td>
                                </tr>";
                                $x++;
                            }
                        }
                    }
                }
                /*$x = 1;
                foreach($listas as $lista){
                    echo "
                    <tr class='linha_dados'>
                        <td class='cel_check'><input type='checkbox' name='row$x'/></td>
                        <td class='cel_conteudo'>$linha[nome_categoria]</td>
                        <td class='cel_conteudo'><a href='alterarSubCategoria.php?idsubcategoria=$linha[idsubcategoria]&amp;opcao=2'>$linha[nome_subcategoria]</a></td>
                        <td class='cel_conteudo'>$linha[descricao]</td>
                    </tr>";
                    $x++;
                }*/
                echo "
                </table>
                <br/>
                <input type='button' name='criar_cat' value='Criar Nova Sub-categoria' onClick='javascript:window.location = \"./alterarSubCategoria.php?opcao=1\";'/>&nbsp;
                <input type='button' name='excluir_cat' value='Excluir Sub-categoria' onClick=\"javascript:confirm('Tem certeza que deseja excluir a(s) sub-categoria(s) selecionada(s)?');\" disabled />";
                ?>

            </div>

            <?php
            require_once("../models/rodape.php");
            ?>

        </div>

    </body>
</html>