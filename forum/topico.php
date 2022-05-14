<?php
require_once("../models/Sessao.php");
require_once("../models/Topico.php");
require_once("../models/Comentario.php");
require_once("../models/Usuario.php");
require_once("../models/Moderador.php");
require_once("../service/rodape.php");

$oSessao = new Sessao();
$oTopico = new Topico();
$oComentario = new Comentario();
$oUsuario = new Usuario();
$oModerador = new Moderador();

if ($oSessao->estaLogado() == null) {
    $oSessao->expulsar();
}

$nome_subcategoria = $oSessao->getVariavelSessao("nome_subcategoria");
$idusuario = $oSessao->getVariavelSessao("iIdUsuario");
$titulotopico = $_GET['titulotopico'];
$idtopico = $_GET['idtopico'];
$oSessao->setVariavelSessao("idtopico", $idtopico);
$oSessao->setVariavelSessao("titulotopico", $titulotopico);
$listaModeradores = $oSessao->getVariavelSessao("listaModeradores");

foreach ($listaModeradores as $moderador) {
    if ($moderador->getUsuario_idusuario() == $oSessao->getVariavelSessao("iIdUsuario")) {
        $bIsModerador = true;
        break;
    } else {
        $bIsModerador = false;
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt" lang="pt" dir="ltr">
    <head>

        <title>..:::.. F&Oacute;RUM CEET VASCO COUTINHO - <?php echo $nome_subcategoria; ?> ..:::..</title>
        <link rel='stylesheet' href='../css/estilo_forum.css' type='text/css' media='screen' />
        <link rel="stylesheet" href="../css/menu_style.css" type="text/css" />
        <script src="../js/forum.js" type="text/javascript"></script>
        <script type='text/javascript'>
            function enviarComentario(){
                var conteudo = document.formulario.conteudo_comentario.value;

                if(conteudo == ''){
                    alert("E preciso preencher o conteudo para enviar o comentario!");
                    return false;
                }
                else{
                    return true;
                }
            }
        </script>
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
                        <?php if (($oSessao->getVariavelSessao("nivelAcesso") != "Aluno") && ($oSessao->getVariavelSessao("nivelAcesso") != "Professor" && $oSessao->getVariavelSessao("nivelAcesso") != "Usuario")) { ?>
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
                $oTopico->setIdtopico($idtopico);
                $oTopico->listar();
                $comentariosDoTopico = $oComentario->listarPorTopico($idtopico);
                echo "
                <table class='topico'>	
                    <tr class='linha_titulo'>
                        <td colspan=2 class='cel_titulo_topico'>".$titulotopico."</td>
                    </tr>";
                
                if($comentariosDoTopico){
                    
                    foreach($comentariosDoTopico as $comentario){
                        $oUsuario->setIdusuario($comentario->getUsuario_idusuario());
                        if($oUsuario->listar()){
                            $nomeUsuarioComentario = $oUsuario->getNome();
                        } else {
                            $nomeUsuarioComentario = null;
                        }
                        echo"
                        <tr class='linha_data_postagem'>
                            <td class='cel_data_postagem' colspan=2>".$comentario->getData()."</td>
                        </tr>

                        <tr class='linha_dados_usuario'>
                            <td class='cel_dados_usuario'>
                                <b>".$nomeUsuarioComentario."</b><br/>
                                Turma:<br/>
                                Turno:";
                        echo $bIsModerador ? "<br/><input type='button' name='botaoAdvertir' id='botaoAdvertir' value='Advertir Usu&aacute;rio' onClick='javascript:advertirUsuario(".$idusuario.",".$comentario->getUsuario_idusuario().");'>" : "";
                        echo "                  
                            </td>
                            <td class='cel_conteudo'>
                                ".$comentario->getConteudo()."
                            </td>
                        </tr>";
                    }
                }
                echo"
                </table>";
                
                ?>
                </br></br>
                <center><b>Use o formulario abaixo para deixar um comentario neste t&oacute;pico.</b><br/>
                <form name='formulario' method='post' action='inserir_comentario.php' onSubmit='return enviarComentario()'>
                    <table>
                        <tr>
                            <td><textarea name='conteudo_comentario' cols=120 rows=10></textarea></td>
                        </tr>
                        <tr>
                            <td align='center'>
                                <input type='submit' value='Enviar Coment&aacute;rio'/>								
                            </td>
                        </tr>
                    </table>
                </form>
                </center>    
            </div>

            <div id="rodape">
                <?php
                    exibeRodape();
                ?>
            </div>

        </div>

    </body>
</html>