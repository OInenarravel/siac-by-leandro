<?php
require_once("../models/Sessao.php");
require_once("../models/Banido.php");
require_once("../models/Usuario.php");
require_once("../models/Paginacao.php");

$oSessao = new Sessao();
$oBanido = new Banido();
$oUsuario = new Usuario();
$listaUsuarios = $oUsuario->listarTodos();


$nivelAcesso = $oSessao->getVariavelSessao("nivelAcesso");
if ($oSessao->estaLogado() == null || $oSessao->getVariavelSessao("nivelAcesso") != "Administrador") {
    $oSessao->expulsar();
}

$oBanido->setUsuario_idusuario($oSessao->getVariavelSessao("iIdUsuario"));
echo $oBanido->listar() ? "<script>\nalert(\"Seu nome consta na lista de usuarios banidos! Voce nao podera acessar a area do forum. Entre em contato com seu coordenador de curso para regularizar sua situacao.\");\nwindow.location = \"../portal/index.php\";\n</script>\n" : "";

switch(@$_POST['opcao']){
    case 1:
        /*$idusuario = @$_POST['idusuario'];

        $oModerador->setUsuario_idusuario($idusuario);

        if (!$oModerador->excluir()) {
            echo "
            <script>
                alert('Erro ao exonerar Moderador!');
                window.location = './administrativoModerador.php';
            </script>";
        } else {
            echo "
            <script>
                alert('Moderador exonerado com sucesso!');
                window.location = './administrativoModerador.php';
            </script>";
        }*/
    break;
    
    /*default:
        echo "ERRO!";
    break;*/
}

$oPaginacao = new Paginacao(10, @sizeof($listaUsuarios), "./administrativoUsuario.php?");

if (!$pagina = @$_GET['pagina'])
    $oPaginacao->setINumeroPagina();
else
    $oPaginacao->setINumeroPagina($pagina);

$iFirstReg = $oPaginacao->getIPrimeiroRegistro();
$listaUsuarios = $oUsuario->listarTodos($iFirstReg, 10);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt" lang="pt" >
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
                        <?php if(($oSessao->getVariavelSessao("nivelAcesso") != "Aluno") && ($oSessao->getVariavelSessao("nivelAcesso") != "Professor" && $oSessao->getVariavelSessao("nivelAcesso") != "Usu&aacute;rio")){?>
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
                <form name='formUsuario' method='post' action='alterarUsuario.php'>
                    <?php
                    echo "	
                    <table class='categoria'>
                    <tr class='linha_titulo'>
                        <td class='cel_titulo_nome' colspan=2>Nome do Usu&aacute;rio</td>
                        <td class='cel_titulo_descricao'>N&iacute;vel de Acesso</td>
                        <td class='cel_titulo_descricao'>Status</td>
                    </tr>";
                    if($listaUsuarios){
                        $x = 1;
                        foreach($listaUsuarios as $usuario){
                            echo "
                            <tr class='linha_dados'>
                                <td class='cel_check'><input type='radio' name='check' id='check$x' value='".$usuario->getIdUsuario()."'/></td>
                                <td class='cel_conteudo'>".$usuario->getNome()."</td>
                                <td class='cel_conteudo'>".$usuario->getNivel_acesso()."</td>";
                            $oBanido->setUsuario_idusuario($usuario->getIdUsuario());
                            echo !$oBanido->listar() ? "<td class='cel_conteudo'>ATIVO</td>" : "<td class='cel_conteudo'>BANIDO</td>";
                            echo "
                            </tr>";
                            $x++;
                        }
                    }
                    echo "
                    </table>
                    <br/>
                    <input type='hidden' name='opcao' id='opcao'/>\n
                    <input type='hidden' name='idusuario' id='idusuario'/>\n
                    <b>Motivo do Banimento:</b><br/>
                    <input type='text' size=120 name='campoMotivo' id='campoMotivo'/><br/><br/>
                    <input type='button' name='tornarModerador' value='Tornar Moderador' onClick=\"javascript:nomearModerador();\" />&nbsp;
                    <input type='button' name='reintegrar' value='Reintegrar' onClick=\"javascript:reintegrarUsuario();\" />&nbsp;
                    <input type='button' name='banir' value='Banir' onClick=\"javascript:banirUsuario();\" />";
                    ?>
                </form>
                <div id='paginacao'>
                    <?php
                    // exibir painel de navegacao
                    echo $oPaginacao->getSPainelNavegacao();
                    ?>
                </div>
            </div>

            <?php
            require_once("../models/rodape.php");
            ?>

        </div>

    </body>
</html>