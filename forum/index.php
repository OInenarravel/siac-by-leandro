<?php
require_once("../models/Sessao.php");
require_once("../models/Banido.php");
require_once("../models/Moderador.php");
require_once("../models/Categoria.php");
require_once("../models/SubCategoria.php");
require_once("../models/Topico.php");
require_once("../models/Comentario.php");
require_once("../service/rodape.php");

$oSessao = new Sessao();
$oUsuario = new Usuario();
$oBanido = new Banido();
$oModerador = new Moderador();
$oCategoria = new Categoria();
$oSubCategoria = new SubCategoria();
$oTopico = new Topico();
$oComentario = new Comentario();

if ($oSessao->estaLogado() == null) {
    $oSessao->expulsar();
}

$oBanido->setUsuario_idusuario($oSessao->getVariavelSessao("iIdUsuario"));

echo $oBanido->listar() ? "<script>\nalert(\"Seu nome consta na lista de usuarios banidos! Voce nao podera acessar a area do forum. Entre em contato com seu coordenador de curso para regularizar sua situa��o.\");\nwindow.location = \"../Portal/index.php\";\n</script>\n" : "";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt" lang="pt" dir="ltr">
    <head>
        <title>..:::.. F&Oacute;RUM CEET VASCO COUTINHO ..:::..</title>
        <link rel='stylesheet' href='../css/estilo_forum.css' type="text/css" media='screen'/>
        <link rel="stylesheet" href="../css/menu_style.css" type="text/css" media='screen'/>
        <script type='text/javascript' language='JavaScript' src='../js/forum.js'></script>
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
                <table class='tabela'>
                    <tr class='tabela_linha_titulo'>
                        <td colspan=2 class='tabela_coluna'>F&Oacute;RUM</td>
                        <td class='tabela_coluna topicos'>T&Oacute;PICOS</td>
                        <td class='tabela_coluna comentarios'>COMENT&Aacute;RIOS</td>
                        <td class='tabela_coluna ultimo_comentario'>&Uacute;LTIMO COMENT&Aacute;RIO</td>
                    </tr>
                    <tr class='tabela_linha linha_em_branco'>
                        <td class='cel_em_branco' colspan=4></td>
                    </tr>					
                    <?php
                    $listaCategorias = $oCategoria->listarTodos();
                    $qtdTopicos = 0;
                    
                    foreach($listaCategorias as $categoria){
                        echo "
                        <tr class='tabela_linha_titulo'>
                            <td colspan=5 class='tabela_coluna'>".$categoria->getNomeCategoria()."</td>
                        </tr>";
                        $listaModeradores = $oModerador->listarPorCategoria($categoria->getIdCategoria());
                        if($listaModeradores){
                            $oSessao->setVariavelSessao("listaModeradores", $listaModeradores);
                            echo "
                            <tr class='linhaModerador'>
                                <td class='dadosModerador' colspan=5>Moderador(es): <br/>";
                            foreach($listaModeradores as $moderador){
                                echo " &diams; ".$moderador->getNome();
                            }
                            echo "
                                <br/></td>
                            </tr>";
                        } else {
                            echo "
                            <tr class='linhaModerador'>
                                <td class='dadosModerador' colspan=5>Moderador(es):<br/></td>
                            </tr>";
                        }

                        $listaSubCategorias = $oSubCategoria->listarPorCategoria($categoria->getIdCategoria());
                        if($listaSubCategorias){
                            foreach($listaSubCategorias as $subcategoria){
                                $topicosDaSubCategoria = $oTopico->listarPorSubCategoria($subcategoria->getIdSubCategoria());
                                $ultimoComentario = new Comentario();
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
                                    }
                                }
                                
                                $oUsuario->setIdusuario($ultimoComentario->getUsuario_idusuario());
                                if($oUsuario->listar()){
                                    $nomeUsuarioUltimoComentario = $oUsuario->getNome();
                                } else {
                                    $nomeUsuarioUltimoComentario = null;
                                }
                                
                                $dataUltimoComentario = $ultimoComentario->getData();
                                if(!strcmp($dataUltimoComentario, "1900-01-01 00:00:00")){
                                    $dataUltimoComentario = null;
                                }
                                        
                                echo "
                                <tr class='tabela_linha'>
                                    <td class='tabela_coluna figura'>
                                        <a href='./subcategoria.php?nome_categoria=.".$categoria->getNomeCategoria()."&amp;nome_subcategoria=".$subcategoria->getNomeSubCategoria()."&amp;idsubcategoria=".$subcategoria->getIdSubCategoria()."'>
                                            <img src='../img/icone_folder.png' width='32' height='32' />
                                        </a>
                                    </td>
                                    <td class='tabela_coluna dados_subcategoria'>
                                        <a href='./subcategoria.php?nome_categoria=".$categoria->getNomeCategoria()."&amp;idcategoria=".$categoria->getIdCategoria()."&amp;nome_subcategoria=".$subcategoria->getNomeSubCategoria()."&amp;idsubcategoria=".$subcategoria->getIdSubCategoria()."'><b>".$subcategoria->getNomeSubCategoria()."</b></a><br/>".
                                        $subcategoria->getDescricao()."<br/>
                                    </td>
                                    <td class='tabela_coluna numero_topicos'>".$qtdTopicos."</td>
                                    <td class='tabela_coluna numero_comentarios'>".$qtdComentarios."</td>
                                    <td class='tabela_coluna ultimo_comentario'>".$dataUltimoComentario."<br/><i>".$nomeUsuarioUltimoComentario."</i></td>
                                </tr>";
                                $qtdTopicos = 0;
                                $qtdComentarios = 0;
                                $ultimoComentario = new Comentario();
                            }
                            
                        } else {
                            echo "
                            <tr class='tabela_linha'>
                                <td colspan=5 class='tabela_coluna figura'><b>Nenhuma subcategoria cadastrada.</b></td>
                            </tr>";
                        }
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