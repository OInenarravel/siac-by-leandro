<?php
require_once("../models/Sessao.php");
require_once("../models/Usuario.php");

$oSessao = new Sessao();
$oUsuario = new Usuario();

if ($oSessao->estaLogado() == null) {
    $oSessao->expulsar();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt" lang="pt" dir="ltr">
    <head>

        <title>..:::.. F&Oacute;RUM CEET VASCO COUTINHO - MEMBROS ..:::..</title>
        <link rel='stylesheet' href='../css/estilo_forum.css' media='screen'/>
        <link rel="stylesheet" href="../css/menu_style.css" type="text/css" />
        <script type='text/javascript' src='../js/forum.js'></script>
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
                        <?php if (($_SESSION["nivelAcesso"] != "aluno") && ($_SESSION["nivelAcesso"] != "professor" && $_SESSION["nivelAcesso"] != "usuario")) { ?>
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
                <table class='tabela'>

                    <tr class='tabela_linha_titulo'>
                        <td colspan=4 class='tabela_coluna'>F&oacute;rum CEET - Lista de Membros</td>
                    </tr>
                    <tr class='tabela_linha linha_em_branco'>
                        <td class='cel_em_branco' colspan=4></td>
                    </tr>	
                    <tr class='tabela_linha_titulo'>
                        <td class='tabela_coluna'>Nome de Usu&aacute;rio</td>
                        <td class='tabela_coluna'>N&iacute;vel de Acesso</td>
                        <td class='tabela_coluna'>Membro desde</td>
                        <td class='tabela_coluna'>Cidade, Estado</td>						
                    </tr>
                    <?php
                    $listaMembros = $oUsuario->listarPorNivelAcesso();
                    if($listaMembros){
                        foreach($listaMembros as $membro){
                            echo "
                            <tr class='tabela_linha dados'>
                                <td class='tabela_coluna nome_usuario'>".$membro->getNome()."</td>
                                <td class='tabela_coluna nivel'>".$membro->getNivel_acesso()."</td>
                                <td class='tabela_coluna data_cadastro'>".$membro->getData_cadastro()."</td>
                                <td class='tabela_coluna cidade_estado'>".$membro->getMunicipio().", ".$membro->getEstado()."</td>	
                            </tr>";
                        }
                    }else{
                        echo "
                        <tr class='tabela_linha dados'>
                            <td class='tabela_coluna' colspan=4><center><b>N&Atilde;O EXISTEM MEMBROS ATIVOS!</b></center></td>
                        </tr>";
                    }
                    ?>
                </table>
            </div>

            <?php
            require_once("../models/rodape.php");
            ?>

        </div>

    </body>
</html>