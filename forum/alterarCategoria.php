<?php
require_once("../models/Sessao.php");
require_once("../models/Banido.php");
require_once("../models/Categoria.php");

$oSessao = new Sessao();
$oBanido = new Banido();
$oCategoria = new Categoria();

$nivelAcesso = $oSessao->getVariavelSessao("nivelAcesso");

if ($oSessao->estaLogado() == null || $oSessao->getVariavelSessao("nivelAcesso") != "Administrador") {
    $oSessao->expulsar();
}

$oBanido->setUsuario_idusuario($oSessao->getVariavelSessao("iIdUsuario"));

echo $oBanido->listar() ? "<script>\nalert(\"Seu nome consta na lista de usuarios banidos! Voce nao podera acessar a area do forum. Entre em contato com seu coordenador de curso para regularizar sua situacao.\");\nwindow.location = \"../portal/index.php\";\n</script>\n" : "";

$erro = null;
$opcao = @$_GET['opcao'];

if ($opcao != 1 && $opcao != 2) {
    $opcao = null;
}

switch ($opcao) {

    //INSERIR NOVA CATEGORIA
    case 1:
        $idcategoria = null;
        $nomeCategoria = null;
        $descricao = null;
        break;

    //ALTERAR CATEGORIA
    case 2:
        if (!$idcategoria = @$_GET['idcategoria']) {
            $erro = "<center><h1>ERRO AO EXIBIR CATEGORIA!<BR/>ID CATEGORIA N&Acedil;O INFORMADO!</h1></center>";
        } else {
            $oCategoria->setIdCategoria($idcategoria);
            
            if ($oCategoria->listar()) {
                $nomeCategoria = $oCategoria->getNomeCategoria();
                $descricao = $oCategoria->getDescricao();
            } else {
                $erro = "<center><h1>CATEGORIA N&Acedil;O ENCONTRADA</h1></center>";
            }
        }
        break;

    case null:
        $erro = "<center><h1>ERRO AO CARREGAR A P&Aacute;GINA!<br/>A CATEGORIA N&Acedil;O SER&Aacute; EXIBIDA!<br/>ESCOLHA UMA OP&Ccedil;&Acedil;O V&Aacute;LIDA E TENTE NOVAMENTE.</h1></center>";
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
            .linha_titulo{
                border: 1px solid black;
            }
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
                        <?php if(($_SESSION["nivelAcesso"] != "Aluno") && ($_SESSION["nivelAcesso"] != "Professor" && $_SESSION["nivelAcesso"] != "Usuario")){?>
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
                        <?php }?>
                        <li><a href='../portal/index.php'>SAIR</a></li>
                    </ul>
                </div>

            </div>

            <div id='conteudo'>
                <?php if(!$erro){ ?>

                <fieldset>
                    <legend><b>CATEGORIA</b></legend>
                    <form name='formCategoria' method='post' action='salvarCategoria.php' onSubmit='return validarCategoria();'>
                        <table>
                            <tr>
                                <td><b>ID:</b></td>
                                <td><input type='text' size=1 name='campoID' id='campoID' value='<?php echo $idcategoria;?>' disabled /></td>
                                <td><input type='hidden' name='campoID' id='campoID' value='<?php echo $idcategoria;?>' /></td>
                            </tr>
                            <tr>
                                <td><b>Nome:</b></td>
                                <td><input type='text' size=100 name='campoNome' id='campoNome' class='campoNome' value='<?php echo $nomeCategoria;?>'/></td>
                            </tr>
                            <tr>
                                <td><b>Descri&ccedil;&atilde;o:</b></td>
                                <td><input type='text' size=100 name='campoDescricao' id='campoDescricao' class='campoDescricao' value='<?php echo $descricao;?>'/></td>
                            </tr>
                            <tr>
                                <td colspan=2 align='center'><input type='submit' value='Salvar' />&nbsp;<input type='reset' value='Limpar' /></td>
                            </tr>
                        </table>
                    </form>
                </fieldset>

                <?php }else{ echo $erro;} ?>
            </div>

            <?php
            require_once("../models/rodape.php");
            ?>

        </div>

    </body>
</html>