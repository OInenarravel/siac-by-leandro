<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <title>..:::.. CEET VASCO COUTINHO - HOME..:::..</title>
        <link rel='stylesheet' href='css/estilo_site.css' type='text/css' media='screen'/>
        <!--<link rel="stylesheet" href="./Estilos/menu_style.css" type="text/css" media='screen'/>-->
        <script type='text/javascript'>
            function validar() {
                var login = document.formulario.login.value;
                var senha = document.formulario.senha.value;

                if (login == '' || senha == '') {
                    alert('Login e senha necessarios para acesso!\nVerifique os dados informados e tente novamente');
                    return false;
                } else {
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
                        
                    </div>
                </div>

                <div id='menu_superior' class="menu bubplastic horizontal orange">
                    <form name='formSearch' class='formSearch' action='./pesquisar.php' method='get'>
                        <input type='text' class='campoTexto' name='campoTexto' value='Digite sua busca aqui...' onClick='value = ""'/>&nbsp;
                        <input type='submit' class='botaoProcurar' value='Procurar' src='./Imagens/search.png'/>
                    </form>
                </div>

            </div>

            <div id='boxLateral'>

                <div id='menu_lateral'>
                    <center><h2>Portal da Institui&ccedil;&atilde;o</h2></center>
                    <form name='formulario' method='post' action='service/validar_login.php' onSubmit='return validar()'>
                        <table class='tabelaAcessoPortal'>
                            <tr>
                                <td>Login:</td>
                                <td><input class='campo_login' type='text' name='login'  onClick='value = ""'/></td>
                            </tr>
                            <tr>
                                <td>Senha:</td>
                                <td><input class='campo_senha' type='password' name='senha' value='' onClick='value = ""'/></td>
                            </tr>
                            <tr>
                                <td colspan=2 align='center'><input type='submit' value='Entrar'/></td>
                            </tr>
                        </table>
                    </form>

                    <br/>
                    <hr/>
                    <br/>


                    Principal
                    <ul>
                        <li><span><a href='./index.php'><span>Home</span></a></span></li>
                        <li><a href='./sobre.php'>Sobre</a></li>
                        <li><a href=''>Contato</a></li>
                    </ul>

                    Cursos
                    <?php
                    require_once("./models/Curso.php");
                    $oCurso = new Curso();

                    $listaDeCursos = $oCurso->listarTodos();

                    if(sizeof($listaDeCursos) > 0) {
                        echo "<ul>";
                        foreach ($listaDeCursos as $curso) {
                            echo "<li><a href='./curso.php?idcurso=".$curso->getIdcurso()."'>T&eacute;cnico em ".$curso->getNome_curso()."</a></li>";
                        }
                        echo "</ul>";
                    } else {
                        echo "<h3>ERRO AO LISTAR CURSOS</h3>";
                    }
                    ?>
                    <br/>
                    <hr/>
                    <br/>

                    Parceiros<br/><br/>
                    <center><a href='http://www.educacao.es.gov.br/'><img src='img/sedu.jpg'/></a></center><br/>
                </div>

            </div>

            <div id='noticias'>

                <div id='conteudoNoticia'>
                    <h1>INSTITUCIONAL</h1>

                    <p class='paragrafo'>O Vasco Coutinho foi fundado em 1931. A primeira unidade da escola foi denominada Escolas Reunidas Vasco Coutinho
                        e estava localizado na Rua Dom Jorge de Menezes, na Prainha de Vila Velha. Em 1932 foi iniciada a constru&ccedil;&atilde;o do 
                        pr&eacute;dio atual, que ficou pronto um ano depois. Durante 69 anos a escola funcionou no mesmo local at&eacute; ser abandonada
                        no ano 2000. Desse ano at&eacute; 2002 o local abrigou uma secretaria escolar que atendia aos antigos alunos. No final do
                        ano, entretanto, a escola fechou as portas e a antiga administra&ccedil;&atilde;o estadual doou o pr&eacute;dio para a Justi&ccedil;a. A 
                        escola foi depredada e saqueada e chegou a ser invadida. Em 2003, no primeiro ano do atual Governo, a escola 
                        voltou a pertencer ao Estado, que elaborou um projeto pedag&oacute;gico e arquitet&ocirc;nico para o col&eacute;gio. A ordem de servi&ccedil;o
                        para o in&iacute;cio da transforma&ccedil;&atilde;o da antiga unidade de ensino em um Centro T&eacute;cnico foi dada em 21 de abril de 2004.</p><br/>

                    <center><img src='img/sobre.jpg' width='401px' height='152px'/></center><br/>

                    <p class='paragrafo'>Al&eacute;m do Centro Estadual de Educa&ccedil;&atilde;o T&eacute;cnica (CEET), a Secretaria da Educa&ccedil;&atilde;o (SEDU) est&aacute; 
                        investindo em um projeto de parceria com escolas de ensino t&eacute;cnico profissional de outras redes de ensino. A medida
                        visa garantir vagas para alunos de escolas p&uacute;blicas em escolas profissionais. O edital para selecionar as escolas que 
                        atendam aos crit&eacute;rios de qualidade e os objetivos pedag&oacute;gicos da SEDU j&aacute; est&aacute; sendo encaminhado para an&aacute;lise da 
                        Procuradoria Geral do Estado (PGE). J&aacute; no ensino m&eacute;dio, a SEDU consolidou cerca de 6 mil vagas este ano, principalmente
                        no interior do Estado, por meio da transforma&ccedil;&atilde;o de antigas escolas de ensino fundamental em unidades capazes de atender 
                        tamb&eacute;m ao ensino m&eacute;dio. A medida tem sido aplicada em todo o Esp&iacute;rito Santo, mas principalmente na zona rural, onde os 
                        estudantes passam por grandes dificuldades para chegar at&eacute; &agrave;s escolas.</p>

                    <p class='paragrafo'>Confira alguns detalhes da hist&oacute;ria do Vasco Coutinho:</p>

                    <ul class='sobre'>
                        <li class='liSobre'>Em 1930 o governo nomeava professores que iam &agrave; casa dos alunos para lecionar, n&atilde;o havendo, portanto, um local espec&iacute;fico para as aulas;</li>
                        <li class='liSobre'>Neste mesmo ano o grupo passa a concentrar em uma pequena casa localizada &agrave; Rua Dom Jorge Menezes. A partir da&iacute; o grupo recebe a denomina&ccedil;&atilde;o de &quot;Escolas Reunidas Vasco Coutinho&quot;;</li>
                        <li class='liSobre'>Em 1931, surge o Grupo Escolar &quot;Vasco Coutinho&quot;, pelo Decreto n&deg; 1.720 de 23 de outubro. O diretor de ent&atilde;o era Fl&aacute;vio Moraes;</li>
                        <li class='liSobre'>Em 1932 &eacute; iniciada a constru&ccedil;&atilde;o do pr&eacute;dio atual da escola, que faz face &agrave; Pra&ccedil;a Duque de Caxias e quem assume a dire&ccedil;&atilde;o &eacute; o professor Aflord&iacute;zio de Carvalho. O pr&eacute;dio fica pronto em 1933;</li>
                        <li class='liSobre'>Em outubro de 1933 assume a dire&ccedil;&atilde;o o professor Ernani de Souza, que fica no cargo at&eacute; 1947;</li>
                        <li class='liSobre'>No final de 1947, o Vasco Coutinho contava com mais de 600 alunos, funcionando em tr&ecirc;s turnos, e 15 professores formavam o corpo docente;</li>
                        <li class='liSobre'>A Portaria de n&deg; 2197 de 5 de dezembro de 1985 criou os cursos t&eacute;cnicos de Qu&iacute;mica e Administra&ccedil;&atilde;o. A escola funcionava ent&atilde;o em tr&ecirc;s turnos, sendo 900 alunos no primeiro turno, 1&deg; a 4&deg; s&eacute;rie, 850 no segundo turno, 5&deg; a 8&deg; s&eacute;rie, e 500 no turno noturno, 2&deg; grau e Qu&iacute;mica e Administra&ccedil;&atilde;o;</li>
                        <li class='liSobre'>A escola fecha suas portas em 2000;</li>
                        <li class='liSobre'>Desse per&iacute;odo at&eacute; 2002 funcionou em suas instala&ccedil;&otilde;es apenas uma secretaria escolar;</li>
                        <li class='liSobre'>A Secretaria da Educa&ccedil;&atilde;o do Governo do Estado inicia as obras de reforma completa da escola em 21 de abril de 2004;</li>
                        <li class='liSobre'>A escola &eacute; reinaugurada em 30 de setembro de 2005 e passa a se chamar &quot;Centro Estadual de Educa&ccedil;&atilde;o T&eacute;cnica Vasco Coutinho&quot;, primeira unidade estadual voltada para o ensino profissional.</li>
                    </ul>
                </div>

            </div>

            <?php
            require_once("./service/rodape.php");
            ?>
        </div>
    </body>
</html>
