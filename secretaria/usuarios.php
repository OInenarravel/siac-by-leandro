<?php
    require_once("../models/Sessao.php");
    require_once("../models/Paginacao.php");
    require_once("../models/Usuario.php");

    $oSessao = new Sessao();
    $oUsuario = new Usuario();
    $usuarios = array();
    $opcao = 0;
    $parametro = null;

    if (!$oSessao->estaLogado()) {
        $oSessao->efetuarLogout();
        header("Location: ../models/AreaRestrita.php");
        exit();
    }

    $iIdUsuario = $oSessao->getVariavelSessao("iIdUsuario");
    $sNivelAcesso = $oSessao->getVariavelSessao("nivelAcesso");
    $sNomeUsuario = $oSessao->getVariavelSessao("sNomeUsuario");

    if(isset($_GET['opcao'])) {
        $opcao = $_GET['opcao'];
    }

    switch ($opcao) {
        case 0://LISTAR TODOS OS USUARIOS
            $usuarios = $oUsuario->listarTodos();
        break;

        case 1://LISTAR RESULTADO DA BUSCA
            $sQuery = $_GET['campoBusca'];
            $parametro = $_GET['radioParametro'];

            if ($parametro == 1) {//BUSCA POR ID
                $oUsuario->setIdusuario($sQuery);
                $usuarios = $oUsuario->listar();
            }
            if ($parametro == 2) {//BUSCA POR NOME
                $oUsuario->setNome($sQuery);
                $usuarios = $oUsuario->listarPorNome();
            }
            if ($parametro == 3) {//BUSCA POR CPF
                $oUsuario->setCpf($sQuery);
                $usuarios = $oUsuario->listarPorCpf();
            }
            if ($parametro == 4) {//BUSCA POR RG
                $oUsuario->setRg($sQuery);
                $usuarios = $oUsuario->listarPorRg();
            }
        break;
    }

    $oPaginacao = new Paginacao(10, sizeof($usuarios), "usuarios.php?opcao=" . $opcao . "&");

    if (!@$pagina = $_GET['pagina'])
        $oPaginacao->setINumeroPagina();
    else
        $oPaginacao->setINumeroPagina($pagina);

    $iFirstReg = $oPaginacao->getIPrimeiroRegistro();

    switch ($opcao) {
        case 0://LISTAR TODOS OS USUARIOS
            $usuarios = $oUsuario->listarTodos($iFirstReg, 10);
        break;

        case 1://LISTAR RESULTADO DA BUSCA
            $sQuery = $_GET['campoBusca'];
            $parametro = $_GET['radioParametro'];

            if ($parametro == 1){ // BUSCA TODOS OS USUARIOS
                $usuarios = $oUsuario->listar($iFirstReg, 10);
            }
            if ($parametro == 2){ // BUSCA POR NOME
                $oUsuario->setNome($sQuery);
                $usuarios = $oUsuario->listarPorNome($iFirstReg, 10);
            }
            if ($parametro == 3){ // BUSCA POR CPF
                $oUsuario->setCpf ($sQuery);
                $usuarios = $oUsuario->listarPorCpf($iFirstReg, 10);
            }
            if ($parametro == 4){ // BUSCA POR RG
                $oUsuario->setRg ($sQuery);
                $usuarios = $oUsuario->listarPorRg($iFirstReg, 10);
            }
        break;
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <title>..: SECRETARIA ON-LINE :..</title>
        <link rel='stylesheet' href='../css/estilo_secretaria.css' type='text/css' media='screen'/>
        <link rel="stylesheet" href="../css/menu_style.css" type="text/css" media='screen'/>
        <script src="../js/secretaria.js" type="text/javascript"></script>
        <script type="text/javascript" language='javascript' src="http://jqueryjs.googlecode.com/files/jquery-1.3.2.min.js"></script>
        <script src="../js/accordion.js" type="text/javascript" language='javascript'></script>
    </head>	

    <body>		
        <div id='geral'>

            <div id='menu_superior'>
                <div id='text_menu_esquerda'>Seja bem-vindo(a) <?php echo $sNomeUsuario; ?></div>
                <div id='text_menu_direita'><a href='../portal/index.php' class='link_sair'>SAIR</a></div>
            </div>

            <?php
            require_once("painel.php");
            $sPainelSecretaria = gerarPainel($sNivelAcesso);
            echo $sPainelSecretaria;
            ?>

            <div id='painel_exibicao'>
                <form name='formMensagem' action='excluirMensagem.php' method='post'>

                    <div id='menu_aba'>
                        <b>USU&Aacute;RIOS CADASTRADOS</b><br/>
                        Clique sobre um usu&aacute;rio para exibir seu cadastro completo
                        <div id='botoes'>
                            <input type='button' value='Excluir' onClick='excluirMensagem()' disabled />							
                            <input type='hidden' name='campoOculto' id='campoOculto' value=''/>
                        </div>
                    </div>

                    <div id='painel_exibicao_conteudo'>

                        <table class='tabela'>
                            <tr class='titulo'>
                                <td colspan=2 class='celTituloIDUsuario'>ID</td>
                                <td class='celTituloNome'>Nome</td>								
                                <td class='celTituloNivelAcesso'>N&iacute;vel de Acesso</td>
                                <td class='celTituloDataCadastro'>Data de Cadastro</td>
                            </tr>
                            <?php
                            if ($usuarios == null) {
                                echo "
                                    <tr class='linhaDados'>
                                        <td colspan=5><b>NENHUM USU&Aacute;RIO ENCONTRADO</b></td>
                                    </tr>";
                            } else {
                                if ($parametro == 1) {
                                    $idusuario = $oUsuario->getIdusuario();
                                    $nivelAcesso = $oUsuario->getNivel_acesso();
                                    $nome = $oUsuario->getNome();
                                    $dataCadastro = date("d/m/Y h:i", strtotime($oUsuario->getData_cadastro()));
                                    echo "
                                <tr class='linhaDados'>
                                    <td class='celCheck'><input type='checkbox' name='check$idusuario' value='$idusuario'/></td>
                                    <td class='celIDUsuario'><a href='./usuario.php?opcao=1&idusuario=$idusuario'>$idusuario</a></td>
                                    <td class='celNome'><a href='./usuario.php?opcao=1&idusuario=$idusuario'>$nome</a></td>
                                    <td class='celNivelAcesso'><a href='./usuario.php?opcao=1&idusuario=$idusuario'>$nivelAcesso</a></td>
                                    <td class='celDataCadastro'><a href='./usuario.php?opcao=1&idusuario=$idusuario'>$dataCadastro</a></td>
                                </tr>";
                                } else {
                                    if(sizeof($usuarios) > 0) {
                                        foreach ($usuarios as $individuo) {
                                            $dataCadastro = date("d/m/Y h:i", strtotime($individuo->getData_cadastro()));
                                            echo "
                                        <tr class='linhaDados'>
                                            <td class='celCheck'><input type='checkbox' name='check{$individuo->getIdusuario()}' value='{$individuo->getIdusuario()}'/></td>
                                            <td class='celIDUsuario'><a href='./usuario.php?opcao=1&idusuario={$individuo->getIdusuario()}'>{$individuo->getIdusuario()}</a></td>
                                            <td class='celNome'><a href='./usuario.php?opcao=1&idusuario={$individuo->getIdusuario()}'>{$individuo->getNome()}</a></td>
                                            <td class='celNivelAcesso'><a href='./usuario.php?opcao=1&idusuario={$individuo->getIdusuario()}'>{$individuo->getNivel_acesso()}</a></td>
                                            <td class='celDataCadastro'><a href='./usuario.php?opcao=1&idusuario={$individuo->getIdusuario()}'>{$dataCadastro}</a></td>
                                        </tr>";
                                        }
                                    } else {
                                        echo "<h3>ERRO AO LISTAR USUARIOS</h3>";
                                    }
                                }
                            }
                            ?>
                        </table>
                    </div>
                </form>

                <div id='paginacao'>
                    <?php
                    // exibir painel de navegacao
                    echo $oPaginacao->getSPainelNavegacao();
                    ?>
                </div>

            </div>

            <div id='menu_inferior'>
                <ul>
                    <li><a href="../perfil/index.php" target="_self">PERFIL</a></li>
                    <li><a href="../forum/index.php" target="_self">F&Oacute;RUM</a></li>
                    <?php if ($sNivelAcesso == "Administrador" || $sNivelAcesso == "Coordenador" || $sNivelAcesso == "Secretaria") { ?>
                    <li><a href="../noticias/index.php" target="_self">NOT&Iacute;CIAS</a></li>
                    <?php } ?>
                    <li><a href="../portal/index.php" target="_self">SAIR</a></li>						
                </ul>
            </div>

        </div>
    </body>
</html>