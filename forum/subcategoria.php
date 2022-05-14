<?php
require_once("../models/Usuario.php");
require_once("../models/Sessao.php");
require_once("../models/Subcategoria.php");
require_once("../models/Topico.php");
require_once("../models/Comentario.php");
require_once("../service/rodape.php");

$oSessao = new Sessao();
$oSubCategoria = new SubCategoria();
$oTopico = new Topico();
$oComentario = new Comentario();
$oUsuario = new Usuario();

if ($oSessao->estaLogado() == null) {
    $oSessao->expulsar();
}

$nome_categoria = $_GET['nome_categoria'];
$idcategoria = @$_GET['idcategoria'];
$nome_subcategoria = $_GET['nome_subcategoria'];
$idsubcategoria = $_GET['idsubcategoria'];

$oSessao->setVariavelSessao("nome_categoria", $nome_categoria);
$oSessao->setVariavelSessao("idcategoria", $idcategoria);
$oSessao->setVariavelSessao("nome_subcategoria", $nome_categoria);
$oSessao->setVariavelSessao("idsubcategoria", $idsubcategoria);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt" lang="pt" dir="ltr">
    <head>

        <title>..:::.. F&Oacute;RUM CEET VASCO COUTINHO - <?php echo $nome_categoria; ?> ..:::..</title>
        <link rel='stylesheet' href='../css/estilo_forum.css' type='text/css' media='screen' />
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
                <input type='button' name='topico' value='Criar T&oacute;pico' onClick='redirect(<?php echo $idsubcategoria; ?>)'/><br/><br/>

                <?php
                echo "
                <table class='tabela topico'>					
                    <tr class='tabela_linha_titulo'>
                        <td colspan=4 class='tabela_coluna'>$nome_subcategoria</td>
                    </tr>
                    <tr class='tabela_linha linha_em_branco'>
                        <td class='cel_em_branco' colspan=4></td>
                    </tr>
                    <tr class='tabela_linha_titulo'>
                        <td colspan=2 class='tabela_coluna'>T&iacute;tulo do T&oacute;pico</td>
                        <td class='tabela_coluna comentarios'>Coment&aacute;rios</td>
                        <td class='tabela_coluna ultimo_comentario'>&Uacute;ltimo Coment&aacute;rio</td>
                    </tr>";

                $topicosDaSubCategoria = $oTopico->listarPorSubCategoria($idsubcategoria);
                $ultimoComentario = new Comentario();
                $qtdTopicos = 0;
                if($topicosDaSubCategoria){
                    $qtdTopicos += count($topicosDaSubCategoria);
                    $qtdComentarios = 0;

                    foreach($topicosDaSubCategoria as $topico){
                        $comentariosDoTopico = $oComentario->listarPorTopico($topico->getIdtopico());
                        if($comentariosDoTopico){
                            $qtdComentarios += count($comentariosDoTopico);
                            if(strftime($topico->ultimoComentario()->getData()) > strftime($ultimoComentario->getData())){
                                $ultimoComentario = $topico->ultimoComentario();
                            }
                        }
                        
                        $oUsuario->setIdusuario($ultimoComentario->getUsuario_idusuario());
                        if($oUsuario->listar()){
                            $nomeUsuarioUltimoComentario = $oUsuario->getNome();
                        } else {
                            $nomeUsuarioUltimoComentario = null;
                        }
                        
                        $oUsuario->setIdusuario($topico->getUsuario_idusuario());
                        if($oUsuario->listar()){
                            $nomeUsuarioDoTopico = $oUsuario->getNome();
                        } else {
                            $nomeUsuarioDoTopico = null;
                        }
                        
                        $dataUltimoComentario = $ultimoComentario->getData();
                        if(!strcmp($dataUltimoComentario, "1900-01-01 00:00:00")){
                            $dataUltimoComentario = null;
                        }

                        echo "
                        <tr class='tabela_linha'>
                            <td class='tabela_coluna figura'>
                                <a href='./topico.php?idtopico=".$topico->getIdtopico()."&titulotopico=".$topico->getTitulo()."'><image src='../img/icone_folder.png' width='32' height='32'></a>
                            </td>
                            <td class='tabela_coluna dados_subcategoria'>
                                <a href='./topico.php?idtopico=".$topico->getIdtopico()."&titulotopico=".$topico->getTitulo()."'><b>".$topico->getTitulo()."</b></a><br/>".
                                $nomeUsuarioDoTopico."
                            </td>						
                            <td class='tabela_coluna numero_comentarios'>".$qtdComentarios."</td>
                            <td class='tabela_coluna ultimo_comentario'>".$dataUltimoComentario."<br/><i>".$nomeUsuarioUltimoComentario."</i></td>
                        </tr>";
                        $qtdTopicos = 0;
                        $qtdComentarios = 0;
                        $ultimoComentario = new Comentario();
                    }
                    
                }else {
                    echo "
                    <tr class='tabela_linha'>
                        <td colspan=5 class='tabela_coluna figura'><b>NENHUM T&Oacute;PICO CADASTRADO.</b></td>
                    </tr>";
                }
                ?>
                </table>

            </div>

            <div id="rodape">
                <?php
                    exibeRodape();
                ?>
            </div>

        </div>

    </body>
</html>