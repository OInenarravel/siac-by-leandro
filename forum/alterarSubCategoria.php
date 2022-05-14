<?php
require_once("../models/Sessao.php");
require_once("../models/Categoria.php");
require_once("../models/SubCategoria.php");

$oSessao = new Sessao();
$oCategoria = new Categoria();
$oSubCategoria = new SubCategoria();

$nivelAcesso = $oSessao->getVariavelSessao("nivelAcesso");
if (!$oSessao->estaLogado() || $nivelAcesso != "Administrador") {
    $oSessao->expulsar();
}

$erro = null;
$opcao = @$_GET['opcao'];

switch ($opcao) {

    //INSERIR NOVA SUBCATEGORIA
    case 1:
        $idsubcategoria = null;
        $nomeSubCategoria = null;
        $descricao = null;
        break;

    //ALTERAR SUBCATEGORIA
    case 2:
        if (!$idsubcategoria = @$_GET['idsubcategoria']) {
            $erro = "<center><h1>ERRO AO EXIBIR SUBCATEGORIA!<br/>ID SUBCATEGORIA NAO INFORMADO!</h1></center>";
        } else {
            $oSubCategoria->setIdSubCategoria($idsubcategoria);
            
            if ($oSubCategoria->listar()) {
                $nomeSubCategoria = $oSubCategoria->getNomeSubCategoria();
                $descricao = $oSubCategoria->getDescricao();
                $idcategoria = $oSubCategoria->getIdCategoria();
            } else {
                $erro = "<center><h1>SUBCATEGORIA NAO ENCONTRADA</h1></center>";
            }
        }
        break;

    case null:
        $erro = "<center><h1>ERRO AO CARREGAR A PAGINA!<br/>A SUBCATEGORIA NAO SERA; EXIBIDA!<br/>ESCOLHA UMA OPCAO VALIDA E TENTE NOVAMENTE.</h1></center>";
        break;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt" lang="pt" dir="ltr">
    <head>

        <title>..:::.. F&Oacute;RUM CEET VASCO COUTINHO - INFORM&Aacute;TICA - PROGRAMA&Ccedil;&Atilde;O ..:::..</title>
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
                        <?php if (($oSessao->getVariavelSessao("nivelAcesso") != "Aluno") && ($oSessao->getVariavelSessao("nivelAcesso") != "Professor" && $oSessao->getVariavelSessao("nivelAcesso") != "Usu�rio")) { ?>
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
                <?php if (!$erro) { ?>

                    <fieldset>
                        <legend><b>SUB-CATEGORIA</b></legend>
                        <form name='formCategoria' method='post' action='salvarSubCategoria.php' onSubmit='return validarCategoria();'>
                            <table>
                                <tr>
                                    <td><b>ID:</b></td>
                                    <td><input type='text' name='campoID' size=1 id='campoID' value='<?php echo $idsubcategoria;?>' disabled /></td>
                                    <td><input type='hidden' name='campoID' id='campoID' value='<?php echo $idsubcategoria;?>' /></td>
                                </tr>
                                <tr>
                                    <td><b>Nome:</b></td>
                                    <td><input type='text' size=100 name='campoNome' id='campoNome' class='campoNome' value='<?php echo $nomeSubCategoria;?>'/></td>
                                </tr>
                                <tr>
                                    <td><b>Descri&ccedil;&atilde;o:</b></td>
                                    <td><input type='text' size=100 name='campoDescricao' id='campoDescricao' class='campoDescricao' value='<?php echo $descricao;?>'/></td>
                                </tr>
                                <tr>
                                    <td><b>Categoria:</b></td>
                                    <td>
                                        <select name='selectCategoria' id='selectCategoria'>
                                            <?php
                                            $listaCategorias = $oCategoria->listarTodos();
                                            
                                            if ($listaCategorias) {
                                                foreach($listaCategorias as $categoria){
                                                    echo "<option value='".$categoria->getIdCategoria()."'>".$categoria->getNomeCategoria()."</option>";
                                                    if ($opcao == 2) {
                                                        echo "
                                                        <script type='text/javascript'>
                                                            var selectObj = document.getElementById(\"selectCategoria\");											
                                                            for (i=0;i<selectObj.length;i++)
                                                            {
                                                                if(selectObj.options[i].value == ".$categoria->getIdCategoria()."){
                                                                    selectObj.selectedIndex = i;
                                                                    break;
                                                                }
                                                            }
                                                        </script>\n";
                                                    }
                                                }
                                            } else {
                                                echo "<b>SUBCATEGORIA NAO ENCONTRADA</b>";
                                            }
                                            ?>
                                        </select>	
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan=2 align='center'><input type='submit' value='Salvar' />&nbsp;<input type='reset' value='Limpar' /></td>
                                </tr>
                            </table>
                        </form>
                    </fieldset>

                <?php
                } else {
                    echo $erro;
                }
                ?>
            </div>

            <?php
            require_once("../models/rodape.php");
            ?>

        </div>

    </body>
</html>