-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29-Maio-2020 às 18:45
-- Versão do servidor: 10.4.8-MariaDB
-- versão do PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `siac`
--
CREATE DATABASE `siac`;
USE `siac`;
-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `idusuario` int(11) NOT NULL,
  `num_matricula` varchar(12) NOT NULL,
  `turma_idturma` int(11) NOT NULL,
  `necessidades_especiais` text DEFAULT NULL,
  `raca` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`idusuario`, `num_matricula`, `turma_idturma`, `necessidades_especiais`, `raca`) VALUES
(1, '200940905465', 1, 'nenhuma', 'negra');

-- --------------------------------------------------------

--
-- Estrutura da tabela `arquivo`
--

CREATE TABLE `arquivo` (
  `idarquivo` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nome_arquivo` varchar(150) DEFAULT NULL,
  `data_envio` datetime DEFAULT NULL,
  `endereco` text DEFAULT NULL,
  `descricao` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `arquivo`
--

INSERT INTO `arquivo` (`idarquivo`, `id_usuario`, `nome_arquivo`, `data_envio`, `endereco`, `descricao`) VALUES
(5, 1, 'china-pandas-eyes-turned-white-in-sichuan-2018-e1525405988661.jpg', '2020-05-19 22:41:39', '../Arquivos/china-pandas-eyes-turned-white-in-sichuan-2018-e1525405988661.jpg', 'Foto de um panda bunitinhuu'),
(6, 1, 'AtualizaçõesSFL.pdf', '2020-05-19 22:42:29', '../Arquivos/AtualizaçõesSFL.pdf', 'Atualizacoes');

-- --------------------------------------------------------

--
-- Estrutura da tabela `arquivo_has_turma`
--

CREATE TABLE `arquivo_has_turma` (
  `arquivo_idarquivo` int(11) NOT NULL,
  `turma_idturma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `banido`
--

CREATE TABLE `banido` (
  `usuario_idusuario` int(11) NOT NULL,
  `moderador_usuario_idusuario` int(11) NOT NULL,
  `data_banido` datetime DEFAULT NULL,
  `motivo` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `banido`
--

INSERT INTO `banido` (`usuario_idusuario`, `moderador_usuario_idusuario`, `data_banido`, `motivo`) VALUES
(3, 1, '2009-12-03 16:18:41', 'porque eu quero ^^'),
(6, 2, '2009-12-03 16:13:00', 'teste');

-- --------------------------------------------------------

--
-- Estrutura da tabela `canal`
--

CREATE TABLE `canal` (
  `idcanal` int(11) NOT NULL,
  `visibilidade` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `esquerda` int(11) DEFAULT NULL,
  `direita` int(11) DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `descricao` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `canal`
--

INSERT INTO `canal` (`idcanal`, `visibilidade`, `esquerda`, `direita`, `nome`, `descricao`) VALUES
(1, 0, 1, 2, 'GERAL', 'Noticias de ambito geral');

-- --------------------------------------------------------

--
-- Estrutura da tabela `canal_has_noticia`
--

CREATE TABLE `canal_has_noticia` (
  `canal_idcanal` int(11) NOT NULL,
  `noticia_idnoticia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `idcategoria` int(11) NOT NULL,
  `nome_categoria` varchar(45) DEFAULT NULL,
  `descricao` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`idcategoria`, `nome_categoria`, `descricao`) VALUES
(1, 'Informatica', 'Curso Tecnico - topicos sobre tecnologia e outros assuntos relacionados'),
(2, 'Administracao de Empresas', 'Curso Tecnico na area de administracao de empresas'),
(3, 'Modelagem do Vestuario', 'x'),
(4, 'Hospedagem', 'x'),
(5, 'Audio e Video', 'x'),
(6, 'Categoria de teste', 'Categoria de teste');

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentario`
--

CREATE TABLE `comentario` (
  `idcomentario` int(11) NOT NULL,
  `usuario_idusuario` int(11) NOT NULL,
  `topico_idtopico` int(11) NOT NULL,
  `conteudo` text DEFAULT NULL,
  `dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `comentario`
--

INSERT INTO `comentario` (`idcomentario`, `usuario_idusuario`, `topico_idtopico`, `conteudo`, `dt`) VALUES
(1, 2, 2, 'Sugest?es de bons livros para come?ar a aprender s?o bem-vindas!!!', '2009-12-03 03:12:55'),
(2, 1, 3, 'Vou deixar um coment?rio.... esqueci o que eu ia escrever xD', '2010-04-26 09:03:43'),
(3, 1, 2, 'Testando coment?rios de <b>f?rum</b>', '2010-04-29 20:25:22'),
(4, 1, 2, 'oie', '2019-10-28 12:08:31');

-- --------------------------------------------------------

--
-- Estrutura da tabela `coordenador`
--

CREATE TABLE `coordenador` (
  `idprofessor` int(10) NOT NULL,
  `idcurso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

CREATE TABLE `curso` (
  `idcurso` int(11) NOT NULL,
  `nome_curso` varchar(100) DEFAULT NULL,
  `carga_horaria_curso` varchar(45) DEFAULT NULL,
  `carga_horaria_estagio` varchar(45) DEFAULT NULL,
  `turno` varchar(10) DEFAULT NULL,
  `qtd_modulos` smallint(11) DEFAULT NULL,
  `estagio_obrigatorio` tinyint(1) DEFAULT NULL,
  `amparo_legal` text DEFAULT NULL,
  `sobre` text DEFAULT NULL,
  `perfil_profissional` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `curso`
--

INSERT INTO `curso` (`idcurso`, `nome_curso`, `carga_horaria_curso`, `carga_horaria_estagio`, `turno`, `qtd_modulos`, `estagio_obrigatorio`, `amparo_legal`, `sobre`, `perfil_profissional`) VALUES
(1, 'Informatica', '1000', '200', 'matutino', 4, 1, '<p>teste</p>', '<p>teste</p>', '<p>teste</p>'),
(2, 'Modelagem do Vestuario', '1200', '200', 'matutino', 4, 0, '<p>O curso est&aacute; em conformidade com o disposto na Lei de Diretrizes e Bases da Educa&ccedil;&atilde;o Nacional &ndash; Lei n.&ordm; 9.394/1996, Resolu&ccedil;&atilde;o CNE/CEB n&ordm;04/1999, Parecer CNE/CEB n&ordm;16/1999, Decreto n.&ordm; 5.154/2004, Parecer CNE/CEB n&ordm;39/2004, Resolu&ccedil;&atilde;o CNE/CEB n.&ordm; 1/2005 e Resolu&ccedil;&atilde;o do Conselho Estadual de Educa&ccedil;&atilde;o-ES N&ordm; 1935/2009 D.O. 05/05/2009 que aprovou o funcionamento do curso</p>', '<p>A tend&ecirc;ncia crescente de comercializa&ccedil;&atilde;o at&eacute; em &acirc;mbito internacional de confec&ccedil;&otilde;es passou a exigir profissionais de moda especializados e com perfil diferenciado, que dominam os processos de cria&ccedil;&atilde;o, produ&ccedil;&atilde;o e gest&atilde;o. O p&oacute;lo de confec&ccedil;&otilde;es capixaba emprega, hoje, mais de 20 mil profissionais. &Eacute; formado por ind&uacute;strias e lojas de atacado e varejo nos munic&iacute;pios de Vila Velha (Gl&oacute;ria), Colatina, Linhares, S&atilde;o Gabriel da Palha e Cachoeiro de Itapemirim. O Curso T&eacute;cnico em Modelagem do Vestu&aacute;rio formar&aacute; um profissional habilitado para atuar no setor de confec&ccedil;&atilde;o na &aacute;rea de desenvolvimento do produto. O T&eacute;cnico em Modelagem desempenhar&aacute; com compet&ecirc;ncia e habilidade atividades de supervis&atilde;o de confec&ccedil;&atilde;o e modelagem industrial de pe&ccedil;as do vestu&aacute;rio com conhecimento de inform&aacute;tica voltada para a confec&ccedil;&atilde;o, sendo capaz tanto de operacionalizar os projetos como de atuar na supervis&atilde;o da produ&ccedil;&atilde;o. O Plano de Curso do curso T&eacute;cnico em Modelagem do Vestu&aacute;rio objetiva formar um profissional voltado para o desenvolvimento cient&iacute;fico, tecnol&oacute;gico, e s&oacute;cio-econ&ocirc;mico-cultural, promovendo sempre o bem estar da sociedade e assim garantindo melhoria da qualidade de vida, com express&atilde;o individual e o cumprimento da verdade. Preparar o profissional para desempenhar com compet&ecirc;ncia e habilidade atividades ligadas ao desenvolvimento dos produtos de confec&ccedil;&atilde;o. Aliar o conhecimento te&oacute;rico /pr&aacute;tico da &aacute;rea de produ&ccedil;&atilde;o, habilitando-o a atuar como T&eacute;cnico em Modelagem do Vestu&aacute;rio, podendo ocupar os seguintes postos de trabalho: - Supervisor de produ&ccedil;&atilde;o - Modelista - Operador do sistema informatizado de corte e modelagem - Montagem de ficha t&eacute;cnica O T&eacute;cnico em Modelagem do Vestu&aacute;rio dever&aacute; costurar, desenvolver modelagens manuais e computadorizadas, desenvolver fichas t&eacute;cnicas com desenhos computadorizados, coordenar o desenvolvimento de produtos com planejamento, programa&ccedil;&atilde;o e controle de produ&ccedil;&atilde;o na Ind&uacute;stria de Confec&ccedil;&atilde;o. Este profissional deve atuar com criatividade, iniciativa, sociabilidade, desenvoltura social e cultural. O t&eacute;cnico em modelagem do vestu&aacute;rio trabalha na operacionaliza&ccedil;&atilde;o de projetos de moda, atua na &aacute;rea de produ&ccedil;&atilde;o e/ou modelagem.</p>', '<p>O T&eacute;cnico em&nbsp;Modelagem do Vestu&aacute;rio dever&aacute; costurar desenvolver modelagens manuais e computadorizadas, desenvolver fichas t&eacute;cnicas com desenhos computadorizados, coordenar o desenvolvimento de produtos com planejamento, programa&ccedil;&atilde;o e controle de produ&ccedil;&atilde;o na Ind&uacute;stria de Confec&ccedil;&atilde;o.</p>'),
(3, 'Administracao de Empresas', '1200', '200', 'matutino', 3, 0, '<p>O curso est&aacute; em conformidade com o disposto na Lei de Diretrizes e Bases da Educa&ccedil;&atilde;o Nacional &ndash; Lei n.&ordm; 9.394/1996, Resolu&ccedil;&atilde;o CNE/CEB n&ordm;04/1999, Parecer CNE/CEB n&ordm;16/1999, Decreto n.&ordm; 5.154/2004, Parecer CNE/CEB n&ordm;39/2004, Resolu&ccedil;&atilde;o CNE/CEB n.&ordm; 1/2005 e Resolu&ccedil;&atilde;o do Conselho Estadual de Educa&ccedil;&atilde;o-ES N&ordm; 1920/2009 D.O 31/03/2009 que aprovou o funcionamento do curso</p>', '<p>O Esp&iacute;rito Santo passa hoje por um grande crescimento econ&ocirc;mico, se mostrando como um Estado bastante promissor. Cada vez mais empresas de grande, m&eacute;dio e pequeno porte se instalam aqui no intuito de que bons neg&oacute;cios sejam realizados. O mercado requer profissionais qualificados capazes de acompanhar as mudan&ccedil;as que ocorrem no processo produtivo em n&iacute;veis nacional e internacional. Para tanto, as organiza&ccedil;&otilde;es necessitam de administradores aptos a lidarem com essas transforma&ccedil;&otilde;es mediante tomada de decis&otilde;es que garantam o seu sucesso. Neste contexto, o CEET Vasco Coutinho amplia o leque de oferta de cursos de n&iacute;vel t&eacute;cnico, de modo a facilitar o acesso dos seus participantes &agrave;s conquistas cient&iacute;ficas e tecnol&oacute;gicas de uma sociedade globalizada e aos benef&iacute;cios sociais e econ&ocirc;micos desta era do conhecimento propondo a realiza&ccedil;&atilde;o do curso T&eacute;cnico em Administra&ccedil;&atilde;o. O T&eacute;cnico em Administra&ccedil;&atilde;o tem suas a&ccedil;&otilde;es direcionadas para a compreens&atilde;o das tecnologias associadas aos instrumentos, t&eacute;cnicas e estrat&eacute;gias utilizadas na busca da qualidade, produtividade e competitividade das organiza&ccedil;&otilde;es, planejamento, avalia&ccedil;&atilde;o e gerenciamento de pessoas e processos referentes &agrave; gest&atilde;o, neg&oacute;cios e servi&ccedil;os presentes em organiza&ccedil;&otilde;es do terceiro setor, p&uacute;blicas e privadas. Com vistas a contribuir para a forma&ccedil;&atilde;o desse profissional, o Centro Estadual de Educa&ccedil;&atilde;o T&eacute;cnica Vasco Coutinho objetiva oferecer uma s&oacute;lida forma&ccedil;&atilde;o t&eacute;cnico-cient&iacute;fica e human&iacute;stica &agrave;queles que optarem pelo curso T&eacute;cnico em Administra&ccedil;&atilde;o.</p>', '<p>Com uma vis&atilde;o global e pluralista proveniente de uma forma&ccedil;&atilde;o multidisciplinar, o t&eacute;cnico em Administra&ccedil;&atilde;o, formado pelo CEET Vasco Coutinho, estar&aacute; capacitado a exercer, desenvolver e desempenhar: todas as fun&ccedil;&otilde;es referentes cl&aacute;ssicas da administra&ccedil;&atilde;o como: planejar, organizar, coordenar, comandar e controlar; identifica&ccedil;&atilde;o e avalia&ccedil;&atilde;o dos tipos e modelos de gest&atilde;o e neg&oacute;cio, buscando atualiza&ccedil;&atilde;o e inova&ccedil;&atilde;o; caracter&iacute;stica e metodologia de pesquisa econ&ocirc;mica, de mercado e tecnol&oacute;gica; estrat&eacute;gia de marketing e venda; diretrizes do planejamento estrat&eacute;gico, do planejamento t&aacute;tico e do plano diretor, aplic&aacute;veis &agrave; gest&atilde;o organizacional; esp&iacute;rito cr&iacute;tico e iniciativa solidamente desenvolvidos; trabalho em equipe, relacionando-se multidisciplinarmente; habilidades que possibilitem a pr&aacute;tica a partir de uma fundamenta&ccedil;&atilde;o consistente e continuada; pol&iacute;ticas de recursos humanos, seus objetivos e abrang&ecirc;ncias, identificando os elementos que as comp&otilde;em. Para tanto, far-se-&aacute; necess&aacute;rio que o aluno seja criativo, pr&oacute;-ativo, inovador, empreendedor, e tenha vis&atilde;o de futuro que o permita contribuir para o desenvolvimento de novos modelos de administra&ccedil;&atilde;o. As caracter&iacute;sticas que contribuem para a forma&ccedil;&atilde;o do perfil do profissional desejado envolvem habilidades de: - Comunica&ccedil;&atilde;o interpessoal e express&atilde;o correta nos documentos t&eacute;cnicos espec&iacute;ficos e de interpreta&ccedil;&atilde;o da realidade das organiza&ccedil;&otilde;es; - Utiliza&ccedil;&atilde;o de racioc&iacute;nio l&oacute;gico, cr&iacute;tico e anal&iacute;tico, operando com valores e formula&ccedil;&otilde;es matem&aacute;ticas, estabelecendo rela&ccedil;&otilde;es formais e causais entre fen&ocirc;menos; - Interagir criativamente face aos diferentes contextos organizacionais e sociais; - Demonstrar compreens&atilde;o do todo administrativo, de modo integrado, sist&ecirc;mico e estrat&eacute;gico, bem como de suas rela&ccedil;&otilde;es com o ambiente externo; - Lidar com modelos de gest&atilde;o inovadores; - Resolver situa&ccedil;&otilde;es com flexibilidade e adaptabilidade diante de problemas e desafios organizacionais; - Ordenar atividades e programas, de decidir entre alternativas e de identificar e dimensionar riscos; - Selecionar estrat&eacute;gias adequadas de a&ccedil;&atilde;o, visando a atender interesses interpessoais e institucionais; -Estabelecer crit&eacute;rios e procedimentos para implementa&ccedil;&atilde;o do modelo de gest&atilde;o; -Exercer a &eacute;tica profissional, respeitando as normas da empresa e a necessidade do mercado e do cliente. Organiza&ccedil;&atilde;o Curricular Turno Diurno: O Curso T&eacute;cnico em Administra&ccedil;&atilde;o do CEET Vasco Coutinho &eacute; constitu&iacute;do por 03 (tr&ecirc;s) m&oacute;dulos. A conclus&atilde;o dos m&oacute;dulos I, II e III que totalizam 1200 horas, acrescida da carga hor&aacute;ria do cumprimento do Est&aacute;gio Supervisionado, de 100 horas, que poder&aacute; ser feito durante os m&oacute;dulos, garante a obten&ccedil;&atilde;o de um Diploma de T&eacute;cnico em Administra&ccedil;&atilde;o, desde que comprovada &agrave; conclus&atilde;o de curso de Ensino M&eacute;dio ou equivalente.</p>'),
(4, 'teste', '100', '100', 'matutino', 1, 1, '<p>teste</p>', '<p>teste</p>', '<p>teste</p>'),
(5, 'teste', '100', '100', 'matutino', 1, 1, '<p>teste</p>', '<p>teste</p>', '<p>teste</p>'),
(6, 'Informatica', '1000', '200', 'matutino', 3, 1, '<p>O curso est&aacute; em conformidade com o disposto na Lei de Diretrizes e Bases da Educa&ccedil;&atilde;o Nacional &ndash; Lei n.&ordm; 9.394/1996, Resolu&ccedil;&atilde;o CNE/CEB n&ordm;04/1999, Parecer CNE/CEB n&ordm;16/1999, Decreto n.&ordm; 5.154/2004, Parecer CNE/CEB n&ordm;39/2004, Resolu&ccedil;&atilde;o CNE/CEB n.&ordm; 1/2005 e Resolu&ccedil;&atilde;o do Conselho Estadual de Educa&ccedil;&atilde;o-ES N&ordm; 1342/2006 D.O. 02/10/2006 que aprovou o funcionamento do curso.</p>', '<p>O curso t&eacute;cnico em Inform&aacute;tica, visa formar programadores. As disciplinas do curso tem disposi&ccedil;&atilde;o tal que &eacute; poss&iacute;vel o aluno iniciar na inform&aacute;tica no primeiro m&oacute;dulo.</p>\r\n<p>O curso &eacute; composto de 3 m&oacute;dulos nos turnos diurnos e 4 m&oacute;dulos no turno noturno, durante o dia s&atilde;o 4 aulas di&aacute;rias de 60 minutos que ao final de cada m&oacute;dulo totalizam 400 horas, somando ent&atilde;o 1.200 horas de curso, no per&iacute;odo noturno s&atilde;o 3 aulas di&aacute;rias que ao final de cada m&oacute;dulo totalizam 300 horas, somando ent&atilde;o as mesmas 1.200 horas de curso.</p>\r\n<p>A forma&ccedil;&atilde;o do curso tem eixo principal na programa&ccedil;&atilde;o, desenvolvimento de softwares para empresas e desenvolvimento de softwares via Web, mas tem tamb&eacute;m seu enfoque em outras &aacute;reas para complementar a forma&ccedil;&atilde;o do programador, disciplinas que visam conhecer o computador, instalar softwares, desenvolver conhecimento b&aacute;sico administrativo e um bom enfoque em redes de computadores complementam a forma&ccedil;&atilde;o do aluno t&eacute;cnico em inform&aacute;tica.</p>\r\n<p>O curso tem previsto em sua ementa 200 horas de est&aacute;gio, que devem ser cumpridas durante o curso e n&atilde;o ap&oacute;s o t&eacute;rmino do mesmo.</p>\r\n<p>O mercado de trabalho para o profissional da &aacute;rea &eacute; muito amplo, o aluno formado pode trabalhar por conta pr&oacute;pria empreendendo com o aprendizado do curso, pode encontrar em empresas na grande Vit&oacute;ria vagas para estar desenvolvendo software, pode desenvolver aplica&ccedil;&otilde;es e sites, pode implantar redes de computadores e pode tamb&eacute;m lecionar inform&aacute;tica entre tantas e tantas outras oportunidades.</p>\r\n<p>O perfil do aluno do Curso T&eacute;cnico em Inform&aacute;tica deve ser de quem gosta de pesquisa, aluno engajado no estudo, com esp&iacute;rito empreendedor, a criatividade &eacute; notadamente uma caracteristica marcante, o estudo e gosto de disciplinas de exatas &eacute; necess&aacute;rio, sua atitude perante o desafio deve ser de entusiasmo a disciplina e atitude correta norteia seu caminho. Com este perfil sua forma&ccedil;&atilde;o &eacute; um sucesso completo devido as caracteristicas do Curso T&eacute;cnico em Inform&aacute;tica do CEET - Vasco Coutinho.</p>', '<p>O T&eacute;cnico em Desenvolvimento de Software, formado pelo CEET &ldquo;Vasco Coutinho&rdquo;, est&aacute; capacitado &agrave;:</p>\r\n<ol>\r\n    <li>Desenvolver algoritmos atrav&eacute;s de divis&atilde;o modular e refinamentos sucessivos.</li>\r\n    <li>Distinguir e avaliar linguagens e ambientes de programa&ccedil;&atilde;o, aplicando-os no desenvolvimento de software.</li>\r\n    <li>Interpretar pseudoc&oacute;digos, algoritmos e outras especifica&ccedil;&otilde;es para codificar programas.</li>\r\n    <li>Avaliar resultados e testes dos programas desenvolvidos.</li>\r\n    <li>Compreender o paradigma de orienta&ccedil;&atilde;o por objeto e sua aplica&ccedil;&atilde;o em programa&ccedil;&atilde;o.</li>\r\n    <li>Interpretar e analisar o resultado da modelagem de dados.</li>\r\n    <li>Compreender o paradigma de orienta&ccedil;&atilde;o por objeto e da arquitetura cliente servidor, aplicando-os em bancos de dados.</li>\r\n    <li>Compreender a tecnologia multicamadas.</li>\r\n    <li>Interpretar e avaliar documenta&ccedil;&atilde;o de an&aacute;lise e projeto de sistemas.</li>\r\n    <li>Interpretar e analisar modelos de dados.</li>\r\n    <li>Conhecer t&eacute;cnicas de modelagem de dados.</li>\r\n    <li>Conhecer as t&eacute;cnicas da Documenta&ccedil;&atilde;o de sistemas e Programas.</li>\r\n    <li>Interpretar documenta&ccedil;&atilde;o de Sistemas e Programas.</li>\r\n    <li>Articular comunica&ccedil;&atilde;o t&eacute;cnica com express&atilde;o escrita em l&iacute;ngua portuguesa.</li>\r\n</ol>');

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina`
--

CREATE TABLE `disciplina` (
  `iddisciplina` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `curso_idcurso` int(11) NOT NULL DEFAULT 0,
  `carga_horaria` int(4) NOT NULL,
  `modulo` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `disciplina`
--

INSERT INTO `disciplina` (`iddisciplina`, `nome`, `curso_idcurso`, `carga_horaria`, `modulo`) VALUES
(1, 'Matem?tica', 1, 100, 1),
(2, 'Montagem e Configura??o de Computadores', 1, 100, 1),
(3, 'Hist?ria da Moda', 2, 100, 1),
(4, 'Matem?tica Financeira', 1, 100, 1),
(5, 'teste', 2, 100, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina_has_professor`
--

CREATE TABLE `disciplina_has_professor` (
  `disciplina_iddisciplina` int(11) NOT NULL,
  `professor_idfuncionario` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ementa`
--

CREATE TABLE `ementa` (
  `idementa` int(11) NOT NULL,
  `disciplina_iddisciplina` int(11) NOT NULL,
  `carga_horaria` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `funcionario_idusuario` int(11) NOT NULL,
  `carteiraTrabalho` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`funcionario_idusuario`, `carteiraTrabalho`) VALUES
(1, '12134567'),
(2, '00000000'),
(3, ''),
(4, ''),
(5, '44444'),
(6, '9999');

-- --------------------------------------------------------

--
-- Estrutura da tabela `matriz_curricular`
--

CREATE TABLE `matriz_curricular` (
  `idmatriz_curricular` int(11) NOT NULL,
  `curso_idcurso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensagem`
--

CREATE TABLE `mensagem` (
  `idmensagem` int(11) NOT NULL,
  `remetente` int(11) NOT NULL,
  `destinatario` int(11) NOT NULL,
  `conteudo` text DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `data_envio` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `moderador`
--

CREATE TABLE `moderador` (
  `usuario_idusuario` int(11) NOT NULL,
  `privilegio` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `moderador`
--

INSERT INTO `moderador` (`usuario_idusuario`, `privilegio`) VALUES
(1, '*'),
(2, '*'),
(5, '*');

-- --------------------------------------------------------

--
-- Estrutura da tabela `moderador_has_categoria`
--

CREATE TABLE `moderador_has_categoria` (
  `moderador_usuario_idusuario` int(11) NOT NULL,
  `categoria_idcategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `moderador_has_categoria`
--

INSERT INTO `moderador_has_categoria` (`moderador_usuario_idusuario`, `categoria_idcategoria`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(2, 1),
(5, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `noticia`
--

CREATE TABLE `noticia` (
  `idnoticia` int(11) NOT NULL,
  `funcionario_idusuario` int(11) NOT NULL,
  `titulo` varchar(150) DEFAULT NULL,
  `resumo` text DEFAULT NULL,
  `noticia_completa` text DEFAULT NULL,
  `data_noticia` datetime DEFAULT NULL,
  `destaque` tinyint(1) NOT NULL DEFAULT 0,
  `status` varchar(30) NOT NULL,
  `visibilidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `noticia`
--

INSERT INTO `noticia` (`idnoticia`, `funcionario_idusuario`, `titulo`, `resumo`, `noticia_completa`, `data_noticia`, `destaque`, `status`, `visibilidade`) VALUES
(1, 2, 'Vasco Coutinho divulga gabarito oficial do processo seletivo realizado neste domingo (29)', '<p><span style=\"font-size: x-small;\">O Centro Estadual de Educa&ccedil;&atilde;o T&eacute;cnica (CEET) Vasco Coutinho divulgou nesta segunda-feira (30) o gabarito oficial da prova de sele&ccedil;&atilde;o para os cursos t&eacute;cnicos em Administra&ccedil;&atilde;o, Hospedagem, Inform&aacute;tica e Modelagem do Vestu&aacute;rio, realizada neste domingo (29). <br />\r\n<br />\r\nDos 1.677 inscritos, 1.336 candidatos comparecerem &agrave; avalia&ccedil;&atilde;o, o que corresponde a um &iacute;ndice de presen&ccedil;a de 79,66%. Ao todo, 319 alunos faltaram &agrave; prova e 22 inscri&ccedil;&otilde;es foram indeferidas. A prova teve 40 quest&otilde;es objetivas de interpreta&ccedil;&atilde;o de textos e resolu&ccedil;&atilde;o de problemas envolvendo racioc&iacute;nio l&oacute;gico-matem&aacute;tico. <br />\r\n<br />\r\nA classifica&ccedil;&atilde;o dos aprovados ser&aacute; divulgada no dia 14 de dezembro, no site da Secretaria de Estado da Educa&ccedil;&atilde;o (Sedu) &ndash; www.sedu.es.gov.br, e na pr&oacute;pria institui&ccedil;&atilde;o de ensino. J&aacute; as matr&iacute;culas ser&atilde;o realizadas no CEET Vasco Coutinho, de 21 a 23 de dezembro, e nos dias 28 e 29, tamb&eacute;m do m&ecirc;s que vem.<br />\r\n<br />\r\n<strong>Processo Seletivo</strong><br />\r\n<br />\r\nAs escolas selecionadas para aplicar a prova neste processo seletivo, al&eacute;m do Vasco Coutinho, foram: Escola Estadual de Ensino M&eacute;dio Godofredo Schneider; Escola Estadual de Ensino Fundamental e M&eacute;dio Francelina Carneiro Set&uacute;bal, Escola Estadual de Ensino M&eacute;dio Professor Agenor Roriz (todas localizadas no munic&iacute;pio de Vila Velha). <br />\r\n<br />\r\nEst&atilde;o sendo disponibilizadas 450 vagas para os quatro cursos t&eacute;cnicos-profissionais. S&atilde;o 135 vagas para os cursos de Administra&ccedil;&atilde;o e Modelagem do Vestu&aacute;rio, divididas entre os turnos matutino, vespertino e noturno, e 90 vagas para os cursos de Hospedagem e Inform&aacute;tica, com aulas no matutino e no vespertino. </span></p>', '<p><span style=\"font-size: x-small;\">O Centro Estadual de Educa&ccedil;&atilde;o T&eacute;cnica (CEET) Vasco Coutinho divulgou nesta segunda-feira (30) o gabarito oficial da prova de sele&ccedil;&atilde;o para os cursos t&eacute;cnicos em Administra&ccedil;&atilde;o, Hospedagem, Inform&aacute;tica e Modelagem do Vestu&aacute;rio, realizada neste domingo (29). <br />\r\n<br />\r\nDos 1.677 inscritos, 1.336 candidatos comparecerem &agrave; avalia&ccedil;&atilde;o, o que corresponde a um &iacute;ndice de presen&ccedil;a de 79,66%. Ao todo, 319 alunos faltaram &agrave; prova e 22 inscri&ccedil;&otilde;es foram indeferidas. A prova teve 40 quest&otilde;es objetivas de interpreta&ccedil;&atilde;o de textos e resolu&ccedil;&atilde;o de problemas envolvendo racioc&iacute;nio l&oacute;gico-matem&aacute;tico. <br />\r\n<br />\r\nA classifica&ccedil;&atilde;o dos aprovados ser&aacute; divulgada no dia 14 de dezembro, no site da Secretaria de Estado da Educa&ccedil;&atilde;o (Sedu) &ndash; www.sedu.es.gov.br, e na pr&oacute;pria institui&ccedil;&atilde;o de ensino. J&aacute; as matr&iacute;culas ser&atilde;o realizadas no CEET Vasco Coutinho, de 21 a 23 de dezembro, e nos dias 28 e 29, tamb&eacute;m do m&ecirc;s que vem.<br />\r\n<br />\r\n<strong>Processo Seletivo</strong><br />\r\n<br />\r\nAs escolas selecionadas para aplicar a prova neste processo seletivo, al&eacute;m do Vasco Coutinho, foram: Escola Estadual de Ensino M&eacute;dio Godofredo Schneider; Escola Estadual de Ensino Fundamental e M&eacute;dio Francelina Carneiro Set&uacute;bal, Escola Estadual de Ensino M&eacute;dio Professor Agenor Roriz (todas localizadas no munic&iacute;pio de Vila Velha). <br />\r\n<br />\r\nEst&atilde;o sendo disponibilizadas 450 vagas para os quatro cursos t&eacute;cnicos-profissionais. S&atilde;o 135 vagas para os cursos de Administra&ccedil;&atilde;o e Modelagem do Vestu&aacute;rio, divididas entre os turnos matutino, vespertino e noturno, e 90 vagas para os cursos de Hospedagem e Inform&aacute;tica, com aulas no matutino e no vespertino. </span></p>', '2009-12-02 09:00:09', 1, 'ABERTA', 3),
(2, 2, 'Vel incidunt non delectus sit temporibus id aut quia quia.', 'Corporis dolor expedita qui exercitationem velit. Qui eum et eveniet. Consequatur et tempora et rem ab. Reprehenderit in rem delectus.', '<p>Accusamus iste neque distinctio quisquam voluptatibus officia magni. Reprehenderit velit consequuntur possimus itaque voluptatum et sit. Earum quas nulla quaerat. Rem esse cum et voluptates aut nulla unde.</p><p>Cupiditate commodi voluptatibus qui fugit. Occaecati ipsa facere error sint qui. Eaque magnam sunt tempora facilis rerum expedita. Fugit odio sint laborum modi sunt placeat commodi. Et voluptatem quam tempore voluptate quisquam.</p><p>Unde aut ipsam ea. Fuga deleniti quas distinctio velit ut. Dolores voluptas dolore dolore architecto. Accusantium nobis eum ut.</p><p>Qui et voluptatem dolorem molestiae ipsam. Rerum rerum aut impedit veniam ad. Officia hic totam cumque deleniti cupiditate.</p><p>Natus quis autem impedit. Debitis dolor facere omnis odio qui officiis ipsam minus. Aut atque repellat accusamus et qui aspernatur tempore. Doloribus nam illo molestiae esse at aliquid qui.</p><p>Vero aut sunt ullam optio minus. Magni recusandae enim aliquid sit nostrum aspernatur ut. Distinctio earum ad sint maxime ullam alias.</p><p>Deserunt quod quod velit et ea magnam maxime molestias. Harum dolore sed cum dolorem. Et porro voluptates fuga ut pariatur. Labore et earum laboriosam maxime quia quae voluptatem.</p><p>Suscipit tempora ut rem. Omnis qui sit voluptatem quae reprehenderit et sed ut. Voluptatibus perspiciatis pariatur et maxime suscipit sint unde architecto.</p>', '2020-05-21 18:55:38', 1, 'ABERTA', 3),
(3, 2, 'Voluptas eum dolores qui quia voluptate doloribus omnis corporis autem.', 'Et voluptatum accusantium eos magnam quia. Consequatur dignissimos sed blanditiis. Aut non earum qui autem minima.', '<p>Cumque dolorem sint dolore voluptatem nulla quod. Totam sint sequi modi odio qui. Autem iure debitis et non enim maiores fugit est.</p><p>Minus quia sunt est dolorem vel. Distinctio distinctio fuga aliquid voluptatem voluptatem aut repudiandae. Rerum voluptatibus odio et ea. Sunt voluptas sed eligendi neque quisquam et.</p><p>Aliquam id consectetur facere atque non aspernatur. Ratione et non eum.</p><p>Et necessitatibus nisi corporis sint et. Ratione velit alias voluptatibus ut minus fugit cumque. Voluptatem quia quod consectetur doloremque est. Et commodi minus et eaque distinctio in.</p><p>Odio officiis ut non. Voluptatem atque voluptatibus debitis cumque quidem aut accusantium. Explicabo cupiditate aliquid aliquam recusandae iure dolorem ea soluta. Hic praesentium in et aut.</p><p>Commodi cum atque dicta aut et assumenda qui. Molestiae ipsum voluptates saepe ipsa. Quasi earum tempore non repellendus reiciendis. Voluptate cupiditate fugiat ratione qui illum qui.</p><p>Eum iure voluptas quis voluptatem. Aut aut repellat iste. Dolor expedita ipsa illum quos inventore eum et.</p><p>Neque assumenda eaque non et ex repellendus. Nostrum sit laborum similique ex dolor repellendus. Deserunt maxime unde et est magnam id culpa. Recusandae quia neque ad quas sunt sunt. Inventore laudantium quo alias aspernatur esse dolores exercitationem.</p>', '2020-05-21 18:55:38', 1, 'ABERTA', 3),
(4, 2, 'Quod voluptatem est quia est laboriosam doloribus.', 'Error minima magni est consequatur quod odit cum ab. Sint laborum enim et quasi et.', '<p>Praesentium nisi numquam a esse animi voluptatem est. Labore magni possimus quam nisi quasi voluptate saepe. Culpa sit ut ipsum ea quae explicabo atque. A rem maxime consequuntur recusandae debitis sed.</p><p>Deserunt eligendi praesentium officiis laboriosam odit non amet. Et velit rerum perspiciatis assumenda perferendis laudantium. Consectetur nostrum dolores velit occaecati ut ea.</p><p>Molestiae necessitatibus adipisci voluptas natus. Repellendus perspiciatis est facilis. Minus quasi maxime ducimus numquam est qui est.</p><p>Ullam perspiciatis voluptatem sunt dolorem esse sed. Et dignissimos et ea et quas iste doloribus. Excepturi assumenda neque dignissimos sit nam consequatur quae quibusdam.</p><p>Dignissimos voluptas quos nulla temporibus nisi. Ipsa qui sequi eaque sit. Occaecati maiores sunt aperiam laborum neque consectetur eum. Quis nisi corporis totam et.</p><p>Nostrum recusandae soluta commodi. Quidem qui animi voluptate consequatur doloremque. Eius id cumque sit in quia ipsum magnam.</p><p>Aut labore qui quod sint saepe consectetur labore. Consectetur recusandae quae qui magni inventore pariatur. Voluptatem molestiae non hic.</p><p>Eos similique eos voluptatem est placeat. Assumenda quo earum quia occaecati et voluptatem rerum.</p>', '2020-05-21 18:55:38', 1, 'ABERTA', 3),
(5, 2, 'Deserunt adipisci ipsa architecto laudantium sit molestiae non deleniti vitae a.', 'Placeat et id suscipit nihil. Iure voluptate dicta vero eligendi aut. Aut consequatur facilis ut placeat et. Eum ex rerum alias inventore. Quas est doloremque nobis id qui.', '<p>Soluta sequi ut iure voluptatum corporis et ea. Aut odio est alias aut sint. Hic eaque facere fugit dicta consequatur voluptate.</p><p>Laboriosam alias quos qui aut accusantium provident nobis. Velit officia perferendis dicta error exercitationem ullam. Officia et dicta aut iusto. Velit dolorem eos soluta quod provident.</p><p>Et possimus non laudantium dolorum alias quas nisi. Et et et sit tenetur neque iure. Eum nihil debitis eligendi numquam et.</p><p>Aut rem iusto cum aut culpa vel et. Tempora harum quod consectetur. Iure id velit esse aut magnam.</p><p>Quis reiciendis dicta vel at. Perferendis qui est cupiditate. Est ut aspernatur qui error dolore corrupti. Temporibus ullam eos magnam ex mollitia consequatur dolor.</p><p>Pariatur ab sed libero aliquam iusto est tempora magnam. Sit in magnam laboriosam praesentium quibusdam ut.</p><p>Explicabo distinctio sint blanditiis non fugit. Itaque et est reiciendis dolor sunt. Nesciunt expedita et excepturi ducimus architecto sint nihil enim. Nulla harum sit et ipsam aut quia. Impedit non non impedit nostrum.</p><p>Est et amet rem velit placeat dolor. Ullam eius excepturi minus voluptatibus quo. Provident omnis aliquid facere voluptatem nam. Facere consequatur qui vel laboriosam quas fugiat.</p>', '2020-05-21 18:55:38', 1, 'ABERTA', 3),
(6, 2, 'Voluptatem et laboriosam possimus repellat magnam dignissimos.', 'Aut voluptatibus tenetur error dignissimos. Autem saepe ipsam et quasi et ex. Et error quaerat laborum odio qui quis quod eligendi.', '<p>Temporibus facere in enim animi alias quia. Explicabo cumque deleniti ea laboriosam consequatur eos. Qui optio tenetur ratione fugiat qui. Et aliquam debitis provident. Nisi sapiente ipsam voluptatibus rem.</p><p>Eaque rerum cum quae. Beatae eius laboriosam velit natus dolores quo libero aut. Iure error ut et harum tenetur consequatur exercitationem. Maxime laboriosam iure autem voluptatem.</p><p>Natus est eius voluptate voluptatum sed et. Facere rem ipsa ad quia voluptas laudantium. Quaerat quidem voluptatem possimus aliquid occaecati natus ab.</p><p>Delectus minima harum cum debitis ratione ullam aut. Iste et nihil nihil eius praesentium dolorem. Est delectus voluptatibus nihil dolorem. Ut laboriosam quisquam perspiciatis consectetur quam.</p><p>Rerum perferendis amet et repudiandae sequi autem beatae. Eaque vero alias deserunt rem aspernatur nesciunt quos. Velit similique aut voluptas odio pariatur consequatur repellendus. Officiis natus voluptas minima rerum odit numquam voluptatem.</p><p>Ducimus et tenetur magni minima deserunt architecto. Nam animi dolor dolores non. Beatae ducimus molestias voluptatem dolore quo facilis numquam. Soluta quis et cupiditate dolor eius.</p><p>Non et ipsum adipisci error. Enim et consequatur consequatur a eum quis. Quis ut assumenda aspernatur dolor.</p><p>Modi qui qui vel sit est nobis deleniti. Molestiae consectetur et culpa dolor non. Saepe architecto temporibus cupiditate cumque quo est iure. Ex veniam animi accusantium nesciunt hic eveniet.</p>', '2020-05-21 18:55:38', 1, 'ABERTA', 3),
(7, 2, 'Officiis quidem rerum exercitationem dicta voluptates cum in laudantium possimus voluptate impedit.', 'Rem blanditiis labore et odio atque ea assumenda adipisci. Consequuntur rem quis quas enim dolorem ex. Ut non tempore sapiente at natus quo. Non animi suscipit quidem.', '<p>Dolor ratione voluptas omnis molestiae ut sed. Dolore sint voluptatem laudantium aliquid dolorum. Est similique numquam harum quia similique ex dolorem.</p><p>Illum vitae recusandae commodi eum corrupti et ullam qui. Unde ea asperiores veniam nihil reprehenderit numquam assumenda repellat. Vel non tenetur nobis quisquam. Inventore voluptates et nostrum.</p><p>Eos excepturi accusantium consequuntur praesentium et quas voluptas. Laborum unde porro enim aut. Et quia suscipit eos ducimus enim tenetur unde. Quis culpa harum voluptas earum nisi dignissimos in.</p><p>Ex sunt voluptates repudiandae sequi nisi ullam impedit. Sint esse sed quibusdam. Aut quidem nulla eveniet.</p><p>Eum ratione recusandae impedit in animi. Id debitis sed porro id ut. Consequatur quisquam itaque qui aperiam aspernatur.</p><p>Quo saepe atque aut at vel nobis. Maxime qui magnam odit ratione expedita vel. Voluptatem asperiores dignissimos illum quam quod necessitatibus rerum dolor. Est molestiae quaerat vero occaecati voluptatem.</p><p>Provident minus pariatur id saepe vitae. Modi voluptatem quibusdam est ratione quae. Sunt ducimus ut reiciendis.</p><p>Omnis doloribus minus necessitatibus corporis voluptatum. Qui illo quibusdam aut et. Doloremque praesentium qui reprehenderit et.</p>', '2020-05-21 18:55:38', 1, 'ABERTA', 3),
(8, 2, 'Labore asperiores nisi adipisci eum nihil aut sint.', 'Vero est beatae provident ipsum. Maxime ut omnis alias eos rerum magni fugiat. Laborum voluptas minima inventore omnis. Reiciendis est quam deleniti consequuntur laboriosam et sed.', '<p>Magni sit rerum et. Odio illum esse voluptas aut officia aliquam. Velit reiciendis accusantium esse non facilis nisi. Quo at similique consequatur iusto officia est ea. Fuga at et corporis necessitatibus.</p><p>Tempore tenetur qui quae aut ratione. Illo est eum id reiciendis quidem animi. Tenetur est repellat non accusamus labore temporibus quibusdam.</p><p>Velit mollitia debitis doloremque quae sed et ut. Aut omnis reprehenderit vero placeat. Natus qui rem minima optio consequatur.</p><p>Ut excepturi recusandae dicta repudiandae quibusdam. Eos dignissimos aperiam omnis unde. Possimus odio harum harum ut.</p><p>Voluptas omnis dicta impedit rerum minus. Et nemo at delectus in. Voluptatem recusandae sit ullam aut et velit aliquam. Autem qui ipsa eum ipsam explicabo dolorem.</p><p>Officiis qui eligendi commodi enim suscipit assumenda. Qui aut inventore voluptates rerum aperiam consequatur. Nostrum est culpa amet voluptatibus sed sint.</p><p>Perspiciatis fugit nulla ratione sit ab voluptas dolorem. Et cum nisi ea eveniet nihil ex ad. Voluptatum numquam voluptas vitae nostrum rerum temporibus.</p><p>Quas consequuntur dolores eos et repellat voluptatem rerum. Qui quas voluptas iure repudiandae odit nobis. Fugit aut eos officia laboriosam distinctio tempore. Quo aut quod excepturi quos. At est quasi et ex odit.</p>', '2020-05-21 18:55:38', 1, 'ABERTA', 3),
(9, 2, 'Harum et sit est libero asperiores consectetur.', 'Nesciunt iste culpa est voluptates ipsam aut. Velit praesentium dolor commodi ipsa. Dolor laborum vel blanditiis alias. Esse earum quia nihil maxime molestiae quam.', '<p>Consequuntur unde odio aperiam saepe dolorum voluptatem nam dolores. Aliquid ea eius et nostrum. Omnis deleniti voluptatem totam odio deleniti quibusdam.</p><p>Autem eius est praesentium voluptatem ut minus. Ut incidunt eos vitae assumenda aut qui eligendi accusantium. Aut excepturi minima incidunt voluptatum. Voluptatum necessitatibus quidem explicabo modi.</p><p>Veritatis iusto saepe veniam enim voluptas quia laudantium. Et veritatis consequatur molestiae quia. Qui ut optio voluptatem et.</p><p>Sunt illo iste amet nisi ipsam est. Repellendus accusantium tenetur laudantium reprehenderit quisquam modi sint. Inventore autem consectetur voluptates aut quasi. Non eveniet occaecati harum blanditiis.</p><p>Animi ut sint omnis tenetur in. Nulla nemo ratione nulla laboriosam quidem. Accusantium ex eaque deleniti reiciendis dolores deserunt. Atque fuga ad odio ea.</p><p>Architecto nobis voluptatem odio sunt qui. Aut minima quidem similique maiores quia consequatur dolorem est. Quaerat nobis voluptatem amet mollitia. Tenetur nihil optio debitis blanditiis aut nam dolores eaque.</p><p>At sint est a pariatur magnam ad. Commodi et illum molestiae esse. Aut ex quod enim neque illo. Culpa ut temporibus similique dolorem eveniet quod modi.</p><p>Dolores aperiam consequatur voluptas ducimus esse ducimus quidem. Qui quia provident velit illo. Iure est error molestiae ex quasi.</p>', '2020-05-21 18:55:38', 1, 'ABERTA', 3),
(10, 2, 'Et vero aut quam adipisci optio et error qui autem.', 'Quaerat deleniti natus ad enim voluptates. Incidunt ipsam non quia.', '<p>Id illum quia corrupti quis similique odit. Autem perspiciatis in iste maiores laboriosam et debitis. Qui ipsam quod itaque recusandae voluptatem voluptatum voluptate. Perspiciatis quo fuga nulla ut.</p><p>Commodi temporibus aliquam quisquam odit dolore aut et consequatur. Esse qui sint molestias sit. Aspernatur voluptatibus impedit repellat quam odit reprehenderit nesciunt.</p><p>Quae ut consequatur voluptatum inventore earum voluptatem. Et dolores nisi voluptate facilis dolorem. Maxime sint aut ea nostrum.</p><p>Ipsum voluptatum minima et praesentium. Consequatur deleniti unde quo vel. Ut repellat voluptatem non ut quod.</p><p>Illo at ut laborum aut aut porro voluptas. Aliquid voluptatem optio exercitationem id reprehenderit. Ut fuga est architecto quia molestiae.</p><p>Unde vel non qui rem mollitia est fugit nulla. Ducimus et adipisci exercitationem quo blanditiis. Aliquam voluptas voluptatem qui explicabo.</p><p>Perferendis dolore odit consequatur dicta dolores. Enim ducimus vel voluptates doloremque id. Quaerat consequatur rerum enim esse facilis minus. Quis non commodi ad officiis aperiam.</p><p>Perspiciatis quia eligendi repellendus porro qui reprehenderit. Aut eaque quae dolores voluptatem et consequatur vero. Aut modi corrupti quia ipsa facilis deserunt quo.</p>', '2020-05-21 18:55:38', 1, 'ABERTA', 3),
(11, 2, 'Laboriosam et beatae adipisci non eius aut rem et.', 'Aut necessitatibus delectus qui aut. Pariatur quos rerum nesciunt illo voluptatem sequi. Occaecati commodi in sint maxime. Dicta quos iusto culpa ut eius. Eaque nesciunt enim vitae autem omnis rerum.', '<p>Neque culpa aspernatur sunt ducimus maiores neque. Consectetur quos necessitatibus sed beatae dicta quae eveniet. Eum fuga est unde deserunt. Impedit animi facere omnis eius consequuntur excepturi sit.</p><p>Quia reprehenderit omnis quia. Adipisci pariatur atque doloremque et molestias. Autem quas dolorem velit placeat qui omnis. Nam minus quos nihil vel magni ut.</p><p>Fugit consequuntur sint et assumenda. Necessitatibus cum natus voluptates fuga repellendus et. Omnis ipsam veniam dolorem beatae enim dolores.</p><p>Vitae in et iste commodi quod. Molestias sunt qui et sit molestiae omnis. Quis quos atque porro enim sit temporibus eos quia. Quo molestias expedita non.</p><p>At facere quia ut nobis et. Est perspiciatis explicabo porro sint consequatur. Ducimus sit porro ipsa voluptatem ipsam eum accusamus.</p><p>Et aut animi ducimus eaque minus. Rerum velit expedita non nam aut quasi. Officiis nulla similique architecto quidem fugiat.</p><p>Quos et esse consequatur quo beatae consequatur aut. Sed molestias deleniti libero sint id. Beatae accusantium id et possimus aut aperiam cumque voluptatem.</p><p>Quisquam veritatis consequuntur quidem neque magni tempore reiciendis. Recusandae suscipit et similique sint ab ducimus officiis. Sint natus ut deleniti dolorem commodi repellendus illum.</p>', '2020-05-21 18:55:38', 1, 'ABERTA', 3),
(12, 2, 'Rerum qui molestiae consectetur dolorem voluptatum quisquam a.', 'Temporibus tenetur repellat explicabo. Laudantium dolore architecto dolorum voluptate debitis eos. Tempore molestias et corporis qui unde dolores voluptas commodi.', '<p>Iusto velit consequatur rem accusamus quam consequatur distinctio. Est odit id voluptatum assumenda optio. Sequi possimus assumenda iste odio animi ullam.</p><p>Atque natus qui non laudantium. Est atque minus sed dolorem aliquid exercitationem qui. Tenetur fuga temporibus ducimus deleniti deleniti labore. Harum corporis et illum sed ullam esse nulla. Ipsum est recusandae est at.</p><p>Amet assumenda nesciunt consequuntur repellendus. Error doloremque provident sit omnis velit. Sint molestiae id libero sed dolorum. Optio consequuntur ipsa iste consequatur laboriosam.</p><p>Quia veritatis est est sint voluptatem voluptatum voluptatem. Quos nam qui incidunt saepe adipisci. Ex fuga ut quaerat commodi.</p><p>Praesentium nemo est maiores. Perferendis nesciunt quos est. Consequatur officiis itaque repudiandae sequi consequatur maxime modi.</p><p>Repellat quia aliquam delectus. Aut tempore voluptas eveniet ipsum architecto omnis et deserunt. Nihil neque officia dolorum.</p><p>Velit et quaerat rem vel autem. Asperiores aliquid est itaque culpa.</p><p>Et officia quia dolores labore exercitationem. Esse voluptatem iusto sit quis corrupti. Voluptas quae praesentium eum ab est id.</p>', '2020-05-21 18:55:38', 1, 'ABERTA', 3),
(13, 2, 'Quos molestias doloribus facere quasi id maiores dolore repellat neque.', 'Voluptatibus ratione numquam enim fugit placeat illum. Id itaque ad ea ducimus. Odit et sed est et.', '<p>Voluptas quod aliquam nisi molestias. Natus tempora odit est non. Ea illo nihil ipsa ipsa. Corporis quo minima repudiandae est itaque omnis nobis.</p><p>Dolore unde tempora sunt est molestiae quia. Cumque aspernatur qui a impedit error. Doloribus nihil praesentium libero sequi asperiores. Qui doloremque est hic quibusdam hic nihil impedit sunt.</p><p>Dolores aspernatur omnis laborum quisquam. Esse eaque rem assumenda omnis placeat ea. Et ex magnam consectetur. Iure rerum natus recusandae officiis dolore.</p><p>Consequuntur optio deleniti qui dolor corrupti eos. Sunt qui ut error et atque quia numquam molestias. Fugiat dicta qui vitae nostrum.</p><p>Cumque eum architecto dolorem officia id magni dolorum et. Iure voluptatem dolor aut et enim sunt quia. Sint possimus repellendus dignissimos dolor aspernatur temporibus. Aliquam tempore quam reiciendis eum minus est.</p><p>Consequatur sit est autem adipisci. Deleniti tempore sequi vero sunt assumenda dolore veritatis. Ut voluptas sed quasi harum molestiae iusto. Doloribus repudiandae rem sit sunt dicta mollitia porro rerum. Consequuntur magni vel omnis ut voluptatem quis.</p><p>Dolores fugiat ea inventore ipsam. Enim tempora est tempore et voluptatem saepe. Reiciendis et asperiores aut repellendus illum adipisci. Et quibusdam eaque est aut non sit voluptatem.</p><p>Dolores illum rerum sit rerum non voluptate sequi. In qui amet necessitatibus quis repellat. Ad ut ipsa iure quia sit modi. Natus iure ut temporibus doloremque.</p>', '2020-05-21 18:55:39', 1, 'ABERTA', 3),
(14, 2, 'Aperiam et quis delectus placeat officia totam similique explicabo ratione laboriosam.', 'Totam et eveniet non eaque qui. Recusandae in ut consequuntur sed quia. Quasi dolorem error omnis blanditiis.', '<p>Quas est voluptas sint. Officia enim magni sed exercitationem. Sed aut autem eos alias itaque.</p><p>Et qui saepe aliquam impedit quos corporis dolorem. Ipsam mollitia maxime id corporis quidem ratione. Totam pariatur delectus ea amet. Laboriosam magni qui itaque debitis dolorum. Ipsam sed nostrum veniam repellat incidunt illum blanditiis.</p><p>Dolorem maiores harum fugit. Nesciunt quia itaque excepturi quia corporis sed quae autem. Omnis accusantium sint quia neque. Itaque quasi facere ea provident architecto ratione provident.</p><p>Deleniti voluptas ducimus qui iusto. Nihil consequatur assumenda ut ea neque. Harum debitis quis atque alias velit nulla. Sit excepturi nulla qui fugit maxime delectus.</p><p>Quia vitae nesciunt similique. Et architecto id sunt aliquid unde laudantium ratione perspiciatis. Ut accusantium iusto eos dolore aut. Quasi veritatis possimus ad voluptas et.</p><p>Placeat architecto repellat repudiandae ut quae. Sint quibusdam quisquam est quia delectus et. Provident repellat cupiditate dignissimos minima repudiandae iusto.</p><p>Error ipsa quia quia et. Dolorem aut consequatur occaecati tempore consectetur officia. Quod ducimus quidem provident molestiae aspernatur praesentium neque labore. Rem eos beatae est perspiciatis tenetur veritatis. Ad ut ipsum molestias.</p><p>Modi assumenda fugit quae necessitatibus facilis dolorem iusto. Porro possimus aut et perspiciatis. Sed quae amet corporis voluptate accusamus praesentium nulla.</p>', '2020-05-21 18:55:39', 1, 'ABERTA', 3),
(15, 2, 'Magni veritatis magni ut et.', 'Sint ullam quo tempore. Assumenda commodi et ut numquam aut. Et repellat fuga perferendis nesciunt fugiat repudiandae non.', '<p>Laborum quas quod numquam et quisquam aliquam. Laboriosam voluptatibus assumenda et asperiores voluptates. Totam quo et occaecati nisi dolorem enim. Iure est ipsam soluta.</p><p>Quibusdam maxime nisi et iste quaerat. Voluptas consequatur debitis fuga itaque id ea. Explicabo architecto sunt quis illum et. Ipsa asperiores vero quidem explicabo molestias consequatur perferendis. Nesciunt et est tenetur vel est eos.</p><p>Nulla veritatis amet repellendus iste fugiat incidunt voluptatem aut. Quidem porro sed laudantium labore omnis iste. Non tempore quidem delectus. Praesentium sed omnis suscipit esse.</p><p>Est molestiae corporis illo sed. Aut unde numquam tempore et quibusdam et. Possimus provident repellat eligendi.</p><p>Molestias nam commodi et beatae quis. Magnam id consequatur harum magnam. Repellendus tempore non eius accusamus totam error eaque. In facilis recusandae nulla vitae similique corrupti temporibus.</p><p>Aliquid voluptas numquam expedita blanditiis explicabo. Voluptatem facere et quia et fugiat eius sit sint. Itaque et necessitatibus reprehenderit voluptate sint quisquam recusandae. Eaque voluptas quod maxime rem minus.</p><p>Placeat debitis maxime dolorem. Velit minus non dignissimos sed numquam in beatae molestiae. Delectus sapiente ut praesentium non possimus dolorum.</p><p>Deserunt iste laboriosam et corporis. Autem ex voluptate dolores molestiae dolor assumenda praesentium. Quidem earum eaque harum.</p>', '2020-05-21 18:55:39', 1, 'ABERTA', 3),
(16, 2, 'Non doloremque explicabo aut repellendus non.', 'Provident nemo ut id repellat dolore totam modi. Eligendi ullam et minima ratione quisquam. Aperiam architecto reprehenderit est aut.', '<p>Perspiciatis dicta iste iure. Illum qui neque qui. Voluptatem et corporis facere illo qui.</p><p>Nisi delectus facilis occaecati suscipit reiciendis sed. Est dignissimos rem itaque consectetur. Neque quisquam vel qui quia at id assumenda. Enim dignissimos rem architecto quisquam.</p><p>Molestias nemo quas quibusdam cum. Et alias nobis nisi ad error aut autem. Velit eos quis maiores dicta consequatur.</p><p>Explicabo earum enim illum quia quae similique porro. Eos occaecati deleniti quis laudantium id recusandae quia vero. Quia ipsa hic deserunt labore. Aut et dignissimos magni.</p><p>Ipsam exercitationem molestiae delectus quia. Consectetur ratione aut hic vero quos quia. Aut ea ipsam aut molestiae et qui nihil.</p><p>Tempore dolor dicta qui. Amet molestiae consequatur aperiam molestiae id fugit et. Illo enim perspiciatis voluptatibus qui illo.</p><p>Vitae ea necessitatibus nihil quae non recusandae quidem. Nihil dolores autem harum similique dolores consectetur quasi.</p><p>Nobis asperiores quod officia enim dolorem. Molestiae blanditiis cupiditate et quia vero nesciunt accusantium. Et ut laudantium quisquam libero sint non id consequatur.</p>', '2020-05-21 18:55:39', 1, 'ABERTA', 3),
(17, 2, 'Modi molestiae unde omnis reprehenderit aut et.', 'Et beatae temporibus sit a. Aperiam maiores sit eveniet rerum inventore. Omnis ratione dolorem aspernatur sit autem occaecati. Delectus distinctio fugit quasi cupiditate placeat incidunt tenetur.', '<p>Labore et et vero et vero. Magnam est quia corrupti ipsum et perferendis dolorum omnis. Voluptas qui recusandae voluptate adipisci. Iusto quaerat est ea recusandae doloremque amet.</p><p>Consequatur quidem rerum quo sit aut corrupti. Esse earum incidunt delectus eos quia. Iusto itaque cum odit et.</p><p>Et atque maiores sit non ut voluptate minus. Corrupti voluptates porro odit et. Et voluptatibus neque eos. Tempore sit ipsum et reprehenderit natus est praesentium.</p><p>Velit aspernatur quia iste deleniti corrupti. Tenetur ipsum nisi et totam autem eius. Natus officiis laboriosam adipisci ad. Dolorum corrupti similique nobis quia aut repudiandae.</p><p>Eligendi aliquam mollitia quia voluptatem delectus occaecati. Et nisi omnis deserunt vero omnis. Fugit facilis ab libero autem.</p><p>Nam aperiam quis aut sint temporibus est beatae soluta. Aut qui dicta rem dolore ad in. Adipisci sit consectetur fugiat voluptatem eos ut velit et.</p><p>Itaque rem accusamus aspernatur at suscipit in porro. Explicabo itaque labore numquam a quasi delectus assumenda. Tempore pariatur aut fugiat. Numquam sit et non repellendus et.</p><p>Asperiores ea nihil nostrum vel voluptas. Nihil animi perspiciatis vel doloribus cum nihil. At eos magnam error et. Deserunt vel aut nam ea facere deserunt.</p>', '2020-05-21 18:55:39', 1, 'ABERTA', 3),
(18, 2, 'Nesciunt non et explicabo qui unde placeat quae itaque.', 'Qui vel delectus amet enim. Velit iusto magni quos esse aspernatur qui. Harum officia facilis ducimus voluptatem. Odit aut ullam saepe accusantium eveniet quaerat possimus similique.', '<p>Perferendis laudantium animi accusamus. Quisquam beatae quia aut suscipit aut ipsum.</p><p>Vel earum iusto omnis vel. Voluptatem velit corporis consequatur quaerat laboriosam. Reprehenderit possimus dolorem velit ipsa. Ut et libero eum.</p><p>Laborum dolorum neque laboriosam tempore occaecati iusto voluptatem deleniti. Quibusdam omnis quibusdam sit quaerat quis. Deleniti voluptatem quam sed quidem quia impedit. Id cumque maxime voluptatem veniam illum et facere. Laudantium voluptates vel mollitia doloribus doloribus.</p><p>Tempore sunt ex sed modi maiores expedita consequatur. Ullam veniam deserunt itaque rerum ut. Illum omnis aut ipsum. Quia et architecto adipisci ut nesciunt sed corrupti. Natus modi voluptas eum non iste.</p><p>Omnis omnis pariatur architecto sunt molestiae expedita. Natus repudiandae illum ab. Fugiat enim eaque autem tempora provident rerum optio.</p><p>Temporibus inventore quod saepe velit et et aliquam. Dolores enim reiciendis quisquam velit iusto omnis. Consequatur dolor sit iste. Voluptatibus est perferendis facere quos cupiditate id.</p><p>Possimus dolor et quia in aspernatur. Molestias nihil ea est sed unde sit numquam. Sint beatae officia blanditiis minima sequi. Dicta voluptatem omnis exercitationem veritatis quasi quo et.</p><p>Nesciunt a exercitationem dicta sit. Quo dicta ex dolorum et exercitationem voluptate architecto. Quod odit ut magnam et voluptates at. Rerum et corrupti nulla aliquam.</p>', '2020-05-21 18:55:39', 1, 'ABERTA', 3),
(19, 2, 'Quaerat sequi dolor et cum placeat vitae molestiae nulla ab recusandae.', 'Dolorum necessitatibus sunt velit autem aut et est ut. Repellat dolorum adipisci veritatis sapiente. Magnam atque tenetur non sed quibusdam. Magnam nemo earum quia doloribus ut.', '<p>Et voluptates eos aut accusantium reiciendis sint. Atque cupiditate laboriosam voluptatem optio dolorem tempora quam. Vero possimus delectus sunt eius quisquam similique. Est aperiam voluptates eos et voluptatem vel.</p><p>Quidem animi voluptatem repudiandae dignissimos necessitatibus voluptate. Rerum quia provident facere doloribus. Rerum quo rerum delectus eos tempore voluptate asperiores rerum.</p><p>Inventore iste officiis non reiciendis ducimus asperiores. Quidem repellendus dolor impedit distinctio deserunt. Commodi voluptatem assumenda et vel aliquid iusto reiciendis.</p><p>Aliquid sint fugiat iusto suscipit corporis. Voluptas ea dolor est et eaque quasi. Sint rem repellat temporibus minus id fuga aut. Et magnam consequatur inventore qui.</p><p>Magnam quam sit inventore molestiae adipisci. Id enim vel corrupti molestias autem. Et odio aut sunt praesentium deleniti laborum quae. Tenetur omnis consequatur delectus et quia vel quia.</p><p>Rerum est voluptas sequi ut est nisi laborum et. Et dolorem numquam at rem. Debitis sit magni saepe numquam. Est facere sapiente odit delectus aspernatur totam.</p><p>Sit nulla totam voluptatem sapiente quaerat nobis velit. Quia qui nobis similique qui reiciendis totam. Minima ratione quia qui deleniti tempora. Quam dolorem consequatur consequuntur reprehenderit autem.</p><p>Quia vel exercitationem sint est reprehenderit repellat. Debitis mollitia doloremque veritatis molestias nostrum sed.</p>', '2020-05-21 18:55:39', 1, 'ABERTA', 3),
(20, 2, 'Nihil tempore omnis atque enim nulla excepturi fugit saepe id.', 'Perferendis laudantium tempora autem dicta esse et officiis sed. Aliquid id repudiandae aut tempore explicabo. Vel consequatur molestiae voluptatum libero id.', '<p>Voluptas doloremque magnam ipsa ut. Aut blanditiis consectetur veniam. Explicabo qui praesentium voluptatem nihil voluptate.</p><p>Laborum quis omnis itaque. Odit delectus explicabo fugit dicta in repellendus. Omnis iure praesentium quia non commodi. Sit non assumenda impedit voluptas et rerum itaque.</p><p>Deserunt quia rerum deleniti magni nesciunt eos. Quam deserunt ducimus eum eum voluptatem aut harum. Dolorem blanditiis architecto a enim pariatur. Magnam non et laborum autem qui voluptas voluptatem.</p><p>Numquam et aliquid quasi deserunt fugiat cumque totam. Consectetur sit numquam tenetur. Ut voluptates nam nam dolores dolores.</p><p>Quae ut quia inventore vero nemo sit. Nobis aut hic vitae enim ut. Aspernatur non quaerat ab inventore quisquam libero est. Necessitatibus est maxime ab expedita aut.</p><p>Voluptatibus delectus repellat odit velit. Ipsa cum nobis nostrum doloribus cum ullam officia et. Vel assumenda repellendus assumenda ipsam nisi laborum quae repellendus.</p><p>Veniam ipsam quia nisi dolor. Sint esse explicabo fuga repellat fugit enim et magnam. Explicabo impedit aut officia libero rerum et modi. Nam ea dignissimos cupiditate quo ut adipisci dolorum.</p><p>Aut molestias aut accusantium sapiente minima aut possimus. Aut nostrum ut corrupti maxime. Est explicabo impedit eos earum cumque aspernatur delectus id. Rerum voluptas hic eum vel.</p>', '2020-05-21 18:55:39', 1, 'ABERTA', 3),
(21, 2, 'Dolorum ut corporis et facilis et corrupti voluptas quod cum.', 'Ut suscipit dolor minima non ipsam et fugit voluptates. Mollitia suscipit architecto ut aut molestiae iste. Non et earum voluptatem sit est. Ut sint et deleniti sint.', '<p>Et et voluptate saepe aut aliquam nostrum itaque. Aut deleniti delectus provident minima sit voluptatem. Et modi et fugit consequatur quibusdam ab ea.</p><p>Est dolore deleniti necessitatibus ea. Repudiandae impedit adipisci dolor ab nesciunt et minima ut. Ratione laborum aliquid cumque odit et. Iste dignissimos in ea.</p><p>Consequuntur deserunt et ut expedita autem quisquam odio excepturi. Labore consequatur et et numquam vitae aspernatur. Aspernatur sit in repellat in necessitatibus neque. Illum nulla sit voluptatibus possimus harum maxime earum.</p><p>Tempora corporis laborum esse eum deserunt. Ut non qui molestiae culpa esse delectus provident.</p><p>Rerum consectetur suscipit quasi omnis qui ratione voluptatem. Dolorem qui nulla molestias iure sapiente. Molestias sint omnis quos quaerat tenetur voluptas.</p><p>Dicta provident saepe molestias sint autem optio aliquid. Maiores porro aut et est repudiandae. Qui rerum sit harum libero quis veritatis. Voluptatem ut debitis doloremque maiores magnam.</p><p>Facilis sequi iure nam in explicabo nihil enim. Culpa modi harum aut reiciendis eius quia. Molestiae libero in quis atque aut veniam qui. Temporibus eius omnis corporis quae.</p><p>Laborum eligendi dolore non et deserunt est consequatur dolor. Est animi et minus quaerat odio. Nemo officia alias et dolore ipsa. Inventore non voluptates porro.</p>', '2020-05-21 18:55:39', 1, 'ABERTA', 3),
(22, 2, 'Quo delectus eius quia itaque asperiores quaerat asperiores.', 'Vero voluptas rem perspiciatis aut doloremque. Rerum accusantium error totam rerum. Non voluptatem velit ea eligendi autem quod. Dolores rerum omnis a aut aspernatur et numquam velit.', '<p>Debitis esse quis veritatis sequi odit libero. Alias perspiciatis quis accusamus maiores accusantium cumque. Vero nam exercitationem autem tempora id iste culpa.</p><p>Ea sequi nesciunt nemo asperiores aperiam fuga. Harum sed laboriosam quisquam accusamus iure voluptas quo. Unde suscipit sint amet sed nihil temporibus.</p><p>Reprehenderit id enim non molestiae repellendus quis officiis. Aut enim ex facere id cumque quisquam. Sed repudiandae eum laborum quae quis nostrum sed accusantium. Qui aliquid qui maiores omnis.</p><p>Dolor illo est nam ut. Magni accusantium impedit cupiditate optio velit aut rerum necessitatibus.</p><p>Dolorem nisi quaerat dicta perspiciatis at molestiae. Quo iste est voluptatem voluptatem error. Explicabo dolor dolores at harum ex ea.</p><p>Quia sed consequuntur ipsa modi optio ut reprehenderit eum. Porro placeat quia consequuntur placeat incidunt at velit. Incidunt vel non reiciendis. Quam corporis consequatur optio blanditiis ipsum non autem.</p><p>Quidem velit laborum suscipit minus quae. Fugiat numquam ea facilis deleniti. Officia illo error quo minus.</p><p>Possimus quia corrupti deserunt debitis in praesentium culpa voluptas. Sit voluptas dolores ipsum vitae explicabo illum. Enim quasi libero fugiat ut. Quod consequatur molestiae nulla sint.</p>', '2020-05-21 18:55:39', 1, 'ABERTA', 3),
(23, 2, 'Quam dolores ut in nihil quia dolores.', 'Maxime non quisquam fugit numquam. Sed ducimus assumenda sunt. Accusamus ipsa quia atque optio dolorum aut. Quo iusto vel rerum quibusdam temporibus.', '<p>Vel at consequatur rerum odit praesentium. Ad ut nesciunt ab omnis sed. Qui vel modi quo recusandae voluptate.</p><p>Quo accusamus vitae voluptate voluptas ut ea. Id in possimus excepturi tempora quidem.</p><p>Omnis minus tenetur hic doloribus et repudiandae. Officia repellendus perspiciatis officia voluptatum perferendis. Officiis omnis architecto modi perferendis sint explicabo. Saepe quaerat repellat consequatur ut dicta blanditiis sequi.</p><p>Quo fugit aut beatae est. Libero voluptatem sed temporibus rerum. Numquam sint nisi est modi sed ducimus. Molestiae maiores perspiciatis beatae blanditiis eum. Et accusamus qui vel sapiente aut.</p><p>Deserunt ullam commodi rem quo vel nobis quia. Ut necessitatibus quae ratione labore fugit amet consequuntur. Laboriosam vero illum doloremque illum. Perferendis laudantium doloremque consequatur vero quisquam.</p><p>Voluptatem occaecati beatae ipsam ex modi ut. Sint neque architecto molestiae unde quod. Et minus voluptatem odit voluptatem rerum debitis.</p><p>Ipsam magnam magnam omnis earum vero aspernatur. Dicta est aut eos dolorem. Quos et reprehenderit et maiores sapiente et voluptas.</p><p>Consectetur dolorem molestias officiis omnis nostrum vel. Autem reiciendis praesentium dolore laudantium accusantium hic voluptatibus. Maiores et perspiciatis commodi consectetur qui non. Sit sequi totam molestias mollitia voluptatem.</p>', '2020-05-21 18:55:39', 1, 'ABERTA', 3),
(24, 2, 'Est impedit voluptatem tenetur est molestiae facere nihil ipsa aut quia.', 'Tenetur quia aperiam laborum soluta a qui nisi. Vel eum dolorum quam velit. Sapiente sed molestiae error repellat.', '<p>Et velit at pariatur qui mollitia. Voluptatum suscipit non dicta pariatur. Voluptas voluptates dolorem asperiores quibusdam hic.</p><p>Rerum magnam maiores repellendus et ducimus non quasi. Ex enim aut dicta iste. Quia occaecati in consequatur sint velit et.</p><p>Amet totam dolorem voluptatem ex illum enim. Architecto voluptas et porro expedita quidem est. Voluptatem quasi provident est impedit et expedita dignissimos. Aut veniam ut tenetur.</p><p>A omnis enim vitae inventore. Explicabo perspiciatis quidem provident molestias. Voluptas tempore omnis non ab. Et sunt rerum odio qui rerum voluptatum est.</p><p>Aut ut eum inventore quaerat unde. Modi quia inventore voluptates quidem. Delectus velit ea ut quidem voluptas ut. Ut facilis hic omnis.</p><p>Neque voluptate in soluta ipsa temporibus eligendi. Odio et doloribus et et natus aliquam. Enim facilis vel expedita dignissimos nihil dolores. Iure explicabo est nam in vel.</p><p>Maiores accusantium est iusto nesciunt similique velit maiores deleniti. Itaque rerum amet nisi aut non suscipit. Unde ad quo dolor omnis et. Eos non ex voluptatum blanditiis.</p><p>Delectus voluptatem expedita ut saepe. Aut reiciendis dolor itaque. Vero vel deleniti sed.</p>', '2020-05-21 18:55:39', 1, 'ABERTA', 3),
(25, 2, 'Consequuntur illum corporis mollitia eius tempore qui accusamus.', 'Ut consequatur sit libero. Et inventore exercitationem animi repudiandae et asperiores neque. Impedit officia nemo labore ut. Quis veniam quaerat nulla sit.', '<p>Reprehenderit pariatur eum ipsam dolorem. Veritatis architecto beatae nesciunt vel asperiores unde perferendis. Delectus quo vitae omnis quia.</p><p>Error omnis numquam iste laboriosam ea non qui quo. Consequatur sunt ipsam id dicta praesentium nulla voluptatem. Excepturi id possimus qui qui illum debitis autem doloremque.</p><p>Dignissimos nulla in voluptatum aut. Rerum et possimus quo nulla pariatur ea. Perferendis veritatis doloremque ut repudiandae.</p><p>Accusantium blanditiis non incidunt. Similique sint voluptas voluptates et voluptatum sequi ipsam. Et autem fuga culpa quia.</p><p>Suscipit exercitationem repellendus sint et. Voluptatem atque est dolor fugit itaque qui. Nihil non magnam facere. Temporibus consequatur odit consequatur qui quo et dolorum quam.</p><p>Magnam accusamus inventore occaecati quia. Qui enim at et sit. Officiis sapiente ut nihil veniam ex. Totam laborum neque provident similique rerum.</p><p>Quibusdam incidunt minus ea ea tempora delectus est tempora. Sunt aut sed accusantium corrupti unde animi consectetur. Alias quae repellendus cum accusantium at.</p><p>Fugiat voluptatem placeat et eum est totam. Libero eligendi totam et exercitationem mollitia. Ratione unde quia libero numquam consequatur praesentium. Ut et et voluptas dolorem maxime animi. Cumque temporibus animi cupiditate repellat facere.</p>', '2020-05-21 18:55:39', 1, 'ABERTA', 3),
(26, 2, 'Animi suscipit aut itaque quisquam repudiandae id numquam ex.', 'Sapiente nesciunt aliquid ipsa reiciendis laudantium. Perspiciatis commodi omnis ipsa magni. Mollitia et eum repudiandae quas voluptas facilis.', '<p>Enim molestiae nemo mollitia. Rerum possimus quibusdam nihil. Aut sequi doloribus ea cupiditate qui nam.</p><p>At optio id earum error sit qui. Quia unde odio rerum. Reiciendis non sunt fugiat rem cupiditate dolorum quia.</p><p>Aspernatur laboriosam saepe occaecati laboriosam sunt. Natus praesentium ipsum corporis sunt ut aut. Asperiores quis ut labore repellendus deleniti maiores laboriosam.</p><p>Nesciunt provident corporis quisquam voluptatem omnis maxime. Earum dolorem distinctio molestiae ullam ut impedit. Cupiditate dolor pariatur ut autem voluptatem qui inventore. Voluptatem aut aliquid magnam libero commodi.</p><p>Ea labore molestiae reprehenderit. Et qui eligendi tenetur repudiandae. Architecto excepturi nihil id reprehenderit delectus earum. Vel ipsam esse rerum qui.</p><p>Sed soluta hic aperiam vitae quis ab. Praesentium est et est. Magni minus earum sapiente. Atque rerum voluptatem veritatis consequuntur neque. Vel placeat qui corporis magni accusantium eos dolores placeat.</p><p>Optio dolor dolore rerum maiores enim omnis voluptatem. Sed necessitatibus deleniti molestiae commodi dolorum quasi dolor beatae. Velit vel rerum nam ex illum aliquam dicta.</p><p>Beatae dolores doloribus nostrum asperiores assumenda aut. Ab eius rerum enim et sint asperiores. Possimus omnis iste expedita dolorum numquam sed sapiente. Error debitis nihil doloremque aspernatur commodi.</p>', '2020-05-21 18:55:39', 1, 'ABERTA', 3),
(27, 2, 'Fugit adipisci eius ut dolores reprehenderit similique animi eum deserunt provident.', 'Ut laudantium iste assumenda ratione tenetur voluptatem. Dolorem ratione neque possimus illo quibusdam ut tempore. Alias harum dolores reiciendis earum itaque ullam.', '<p>Ratione ad tenetur laborum nisi. Voluptas dolor vero est libero et. Voluptates itaque enim repellat vel modi assumenda.</p><p>Harum dolorem laboriosam saepe unde qui. Veritatis voluptates eum necessitatibus culpa. Quia iure repellendus eos dolore. Dicta laboriosam ut exercitationem non ut non voluptatem.</p><p>Dolorum sint earum quas ipsa deserunt. Recusandae voluptatum expedita assumenda occaecati cum consequatur. Molestias hic incidunt voluptatem omnis. Impedit ut dolor consequatur quia cum ducimus libero.</p><p>Sunt quam at quia et. Molestiae impedit deleniti qui illum quidem ea. Error hic et suscipit placeat et qui. Aut nostrum recusandae et quo error architecto natus.</p><p>Hic ea et voluptatem neque consequatur repellat eum. Perferendis consequatur qui recusandae sed facere laborum illum eveniet. Ducimus odit saepe quaerat iure. Quos rerum qui et.</p><p>Magni magnam nesciunt qui illum. Qui nam consequatur dolores voluptatem nam. Qui consectetur reprehenderit odio numquam.</p><p>Veniam quaerat vel expedita doloremque. Eius dolore assumenda necessitatibus quia commodi quia et. Nostrum quia doloremque qui error ab et omnis ullam.</p><p>Veritatis ea non quasi aut ut. Cumque voluptatem quam aliquam nobis accusantium. A consectetur ut voluptatum non porro necessitatibus.</p>', '2020-05-21 18:55:39', 1, 'ABERTA', 3),
(28, 2, 'Tempora et a qui sit aliquid non quae et blanditiis.', 'Omnis suscipit in voluptatem culpa molestias facere quia. Cupiditate dolore ex delectus tempore natus. Quos placeat eaque et autem. Accusamus ut placeat repudiandae et voluptatem quia est.', '<p>Quasi officia totam est numquam iusto sunt eos sit. Nam aut voluptatem laboriosam hic qui. Culpa occaecati quia qui recusandae quia accusantium recusandae perferendis.</p><p>Molestias consectetur dignissimos at est eligendi dignissimos. Nisi quaerat alias voluptates. Quia labore autem harum eligendi blanditiis totam.</p><p>A ad nesciunt id enim voluptatem totam laudantium. Et id eius reiciendis id quo aliquid totam nam. Ad consectetur incidunt nulla qui.</p><p>Rerum aut eos ea praesentium tempora aut. Autem qui ad voluptas. Tenetur modi voluptas quia officia in quia.</p><p>Ratione dolore nam voluptas eum eos. Nisi nulla nihil tempora modi natus sed magni. Quia temporibus et facilis. Cupiditate quasi doloribus nisi debitis sunt sint officiis.</p><p>Quia fugit at tempora consequuntur aut non. Nobis id nulla est excepturi. Modi voluptatem molestiae a suscipit.</p><p>Beatae et reprehenderit qui recusandae ducimus similique. Consequatur quos at est culpa autem. Quibusdam reiciendis qui aut. Quidem ipsum repellat ullam assumenda est neque id.</p><p>Enim ut aspernatur molestiae facilis sunt. Debitis non enim ut sunt aut eum. Ut impedit velit qui qui est.</p>', '2020-05-21 18:55:39', 1, 'ABERTA', 3),
(29, 2, 'Accusantium non nobis nulla provident nulla labore omnis.', 'Ipsam officia maxime magni dolorem et. Quidem voluptatum et vel quas sequi exercitationem quis. Quia ut sequi dolore perspiciatis.', '<p>Rem aut recusandae iste sapiente est maxime itaque. Consequatur rerum magnam ipsa quo nesciunt. Soluta molestias autem enim velit. Neque deserunt magnam inventore nulla dolorem eius vel.</p><p>Doloremque quisquam iusto est eos. Officia commodi error et quo rem. Voluptas placeat adipisci eos. Dolorum adipisci id vero ut asperiores amet.</p><p>Illo quae eaque doloribus et explicabo. Tempore quod neque ea repellat tempore laborum tempore. Accusamus eius repellendus culpa doloremque enim. Aut aut corporis explicabo qui.</p><p>Labore exercitationem optio corrupti at eos iure. Dolor aut similique facere nemo rem corrupti corporis ea. Hic neque quo ab et corporis dolorem incidunt laboriosam. Non mollitia at quidem ab sit rerum omnis.</p><p>Et consequatur quasi cum qui. Et iste vitae aut. In saepe voluptate et omnis recusandae.</p><p>Officia voluptatem illo enim voluptatem tempore alias quisquam eos. Est deleniti nam quidem sed id et. Error voluptatem id officia officia.</p><p>Quidem et id eos magnam corporis. Necessitatibus iste consequuntur quia et non deserunt. Laboriosam non dignissimos optio sit modi velit placeat. Labore provident dolor necessitatibus ad molestiae id.</p><p>Hic ex beatae quod voluptatem. Dolor sit architecto quibusdam voluptate debitis eveniet dicta. Consectetur fuga qui perferendis et numquam. Est architecto molestiae itaque ratione.</p>', '2020-05-21 18:55:39', 1, 'ABERTA', 3);
INSERT INTO `noticia` (`idnoticia`, `funcionario_idusuario`, `titulo`, `resumo`, `noticia_completa`, `data_noticia`, `destaque`, `status`, `visibilidade`) VALUES
(30, 2, 'A animi quo eligendi illo nulla ratione doloremque hic omnis qui omnis.', 'Beatae sint et sint deleniti. Ut sint maxime voluptatem ea quae autem. Reiciendis delectus veniam qui hic.', '<p>Fuga sed natus ratione reiciendis. Eius doloremque asperiores quisquam doloremque et et perferendis. Distinctio reiciendis adipisci deleniti porro assumenda neque. Modi reprehenderit totam sint fugiat omnis id.</p><p>Pariatur quis sed dolor autem officia. Cum consequatur ipsam possimus ut eius dolorem molestiae. Ex dolor iure ea ex autem.</p><p>Quas reprehenderit recusandae eum sed nihil quae quo natus. Aut voluptatibus veniam dolorem enim itaque et. Soluta similique voluptatem harum quia. Quidem sit fugit et fugiat et molestiae id natus.</p><p>Veniam placeat quia cumque unde asperiores vel. Voluptas nesciunt sit doloribus excepturi ad consequatur. Nesciunt quam voluptatem et omnis sit laboriosam ab.</p><p>Aut quia aut quasi nihil placeat ut voluptatum. Et totam sint consectetur reiciendis molestias nihil enim non. Excepturi deserunt est distinctio animi aut. Soluta accusantium qui velit officia.</p><p>Dolorem iure laudantium non voluptatem perspiciatis possimus officiis. Sed cumque rerum repellat quis. Facere occaecati qui ut ut.</p><p>Facere provident debitis qui laborum. Necessitatibus voluptas eveniet aut optio praesentium occaecati dolore magni. Eos id optio nemo est voluptatem eveniet quasi tempora.</p><p>Non ut nostrum quod dignissimos officia in. Illum ipsa asperiores expedita saepe aut non. Quas enim aliquam reiciendis fugit nostrum. Aliquid odit molestiae magni. Maiores rerum et cumque blanditiis ea.</p>', '2020-05-21 18:55:39', 1, 'ABERTA', 3),
(31, 2, 'Qui fuga in et sit ut.', 'Aut nobis quia voluptatem similique iure. Sequi ipsa recusandae et est expedita. In est quia autem exercitationem maiores dolor quis. Aut et pariatur officia quia soluta autem.', '<p>Qui voluptatem ea nostrum eum. Aut doloribus quo fuga ullam iste. Eos et aut consequatur consectetur ut. In non dolores quia nobis. Non est et aut placeat velit laudantium.</p><p>Impedit assumenda hic rerum mollitia tempore officiis architecto. Temporibus quod voluptatem dolorum sit ea. Et minus consequatur nihil tempora.</p><p>Ut voluptas ea incidunt aut. Vitae ipsa quidem fugit eveniet labore. Impedit facere et atque ullam. Beatae iste velit minus libero aut repellendus.</p><p>Quis ut eum et nobis quia repudiandae cumque architecto. Vitae eos consequuntur est autem. Aut dolorem qui omnis est. Neque tenetur debitis explicabo. Officia corrupti quidem aut non fugit.</p><p>Vitae eos sit libero vel. Voluptas ea consequuntur mollitia illo. Non et est voluptates est rerum. Facilis totam doloribus quos soluta laudantium.</p><p>Quibusdam illum voluptates ullam beatae. Accusantium accusantium at aut molestias. Consectetur vel quia exercitationem rerum esse rerum fuga ipsa.</p><p>Et molestiae doloribus earum. Ut dolores doloremque maxime excepturi illo suscipit. Laudantium quo culpa eos et eum. Aliquam quia reprehenderit aut magnam.</p><p>Dicta magnam incidunt expedita iusto. Qui nisi beatae nam est. Et cupiditate nobis inventore hic maxime. Voluptatem dolores sed corporis ex ipsum tenetur recusandae.</p>', '2020-05-21 18:55:39', 1, 'ABERTA', 3),
(32, 1, 'Quos molestias doloribus facere quasi id maiores dolore repellat neque.', '<p><strong><span style=\"font-size: large;\">Voluptatibus ratione numquam enim fugit placeat illum. Id itaque ad ea ducimus. Odit et sed est et.</span></strong></p>', '', '2020-05-23 15:22:43', 1, 'ABERTA', 3),
(33, 1, 'Vasco Coutinho divulga gabarito oficial do processo seletivo realizado neste domingo (29)', '<p><span style=\"font-size: medium;\">O Centro Estadual de Educa&ccedil;&atilde;o T&eacute;cnica (CEET) Vasco Coutinho divulgou nesta segunda-feira (30) o gabarito oficial da prova de sele&ccedil;&atilde;o para os cursos t&eacute;cnicos em Administra&ccedil;&atilde;o, Hospedagem, Inform&aacute;tica e Modelagem do Vestu&aacute;rio, realizada neste domingo (29). <br />\r\n<br />\r\nDos 1.677 inscritos, 1.336 candidatos comparecerem &agrave; avalia&ccedil;&atilde;o, o que corresponde a um &iacute;ndice de presen&ccedil;a de 79,66%. Ao todo, 319 alunos faltaram &agrave; prova e 22 inscri&ccedil;&otilde;es foram indeferidas. A prova teve 40 quest&otilde;es objetivas de interpreta&ccedil;&atilde;o de textos e resolu&ccedil;&atilde;o de problemas envolvendo racioc&iacute;nio l&oacute;gico-matem&aacute;tico. <br />\r\n<br />\r\nA classifica&ccedil;&atilde;o dos aprovados ser&aacute; divulgada no dia 14 de dezembro, no site da Secretaria de Estado da Educa&ccedil;&atilde;o (Sedu) &ndash; www.sedu.es.gov.br, e na pr&oacute;pria institui&ccedil;&atilde;o de ensino. J&aacute; as matr&iacute;culas ser&atilde;o realizadas no CEET Vasco Coutinho, de 21 a 23 de dezembro, e nos dias 28 e 29, tamb&eacute;m do m&ecirc;s que vem.<br />\r\n<br />\r\n<strong>Processo Seletivo</strong><br />\r\n<br />\r\nAs escolas selecionadas para aplicar a prova neste processo seletivo, al&eacute;m do Vasco Coutinho, foram: Escola Estadual de Ensino M&eacute;dio Godofredo Schneider; Escola Estadual de Ensino Fundamental e M&eacute;dio Francelina Carneiro Set&uacute;bal, Escola Estadual de Ensino M&eacute;dio Professor Agenor Roriz (todas localizadas no munic&iacute;pio de Vila Velha). <br />\r\n<br />\r\nEst&atilde;o sendo disponibilizadas 450 vagas para os quatro cursos t&eacute;cnicos-profissionais. S&atilde;o 135 vagas para os cursos de Administra&ccedil;&atilde;o e Modelagem do Vestu&aacute;rio, divididas entre os turnos matutino, vespertino e noturno, e 90 vagas para os cursos de Hospedagem e Inform&aacute;tica, com aulas no matutino e no vespertino.</span><span style=\"font-size: x-small;\"> </span></p>', '<p><span style=\"font-size: x-small;\">O Centro Estadual de Educa&ccedil;&atilde;o T&eacute;cnica (CEET) Vasco Coutinho divulgou nesta segunda-feira (30) o gabarito oficial da prova de sele&ccedil;&atilde;o para os cursos t&eacute;cnicos em Administra&ccedil;&atilde;o, Hospedagem, Inform&aacute;tica e Modelagem do Vestu&aacute;rio, realizada neste domingo (29). <br />\r\n<br />\r\nDos 1.677 inscritos, 1.336 candidatos comparecerem &agrave; avalia&ccedil;&atilde;o, o que corresponde a um &iacute;ndice de presen&ccedil;a de 79,66%. Ao todo, 319 alunos faltaram &agrave; prova e 22 inscri&ccedil;&otilde;es foram indeferidas. A prova teve 40 quest&otilde;es objetivas de interpreta&ccedil;&atilde;o de textos e resolu&ccedil;&atilde;o de problemas envolvendo racioc&iacute;nio l&oacute;gico-matem&aacute;tico. <br />\r\n<br />\r\nA classifica&ccedil;&atilde;o dos aprovados ser&aacute; divulgada no dia 14 de dezembro, no site da Secretaria de Estado da Educa&ccedil;&atilde;o (Sedu) &ndash; www.sedu.es.gov.br, e na pr&oacute;pria institui&ccedil;&atilde;o de ensino. J&aacute; as matr&iacute;culas ser&atilde;o realizadas no CEET Vasco Coutinho, de 21 a 23 de dezembro, e nos dias 28 e 29, tamb&eacute;m do m&ecirc;s que vem.<br />\r\n<br />\r\n<strong>Processo Seletivo</strong><br />\r\n<br />\r\nAs escolas selecionadas para aplicar a prova neste processo seletivo, al&eacute;m do Vasco Coutinho, foram: Escola Estadual de Ensino M&eacute;dio Godofredo Schneider; Escola Estadual de Ensino Fundamental e M&eacute;dio Francelina Carneiro Set&uacute;bal, Escola Estadual de Ensino M&eacute;dio Professor Agenor Roriz (todas localizadas no munic&iacute;pio de Vila Velha). <br />\r\n<br />\r\nEst&atilde;o sendo disponibilizadas 450 vagas para os quatro cursos t&eacute;cnicos-profissionais. S&atilde;o 135 vagas para os cursos de Administra&ccedil;&atilde;o e Modelagem do Vestu&aacute;rio, divididas entre os turnos matutino, vespertino e noturno, e 90 vagas para os cursos de Hospedagem e Inform&aacute;tica, com aulas no matutino e no vespertino. </span></p>', '2020-05-23 18:02:05', 1, 'ABERTA', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor`
--

CREATE TABLE `professor` (
  `idfuncionario` int(11) NOT NULL,
  `numero_funcional` varchar(45) DEFAULT NULL,
  `coordenador` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `professor`
--

INSERT INTO `professor` (`idfuncionario`, `numero_funcional`, `coordenador`) VALUES
(3, ' ', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `subcategoria`
--

CREATE TABLE `subcategoria` (
  `idsubcategoria` int(11) NOT NULL,
  `categoria_idcategoria` int(11) NOT NULL,
  `nome_subcategoria` varchar(45) DEFAULT NULL,
  `descricao` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `subcategoria`
--

INSERT INTO `subcategoria` (`idsubcategoria`, `categoria_idcategoria`, `nome_subcategoria`, `descricao`) VALUES
(1, 1, 'Programa??o', 'Linguagens de Programa??o'),
(2, 1, 'Redes', 'Topologias, Equipamentos e Documenta??o'),
(3, 1, 'Outros', 'Assuntos Diversos'),
(4, 1, 'Virtualiza??o', 'M?quinas Virtuais e Softwares'),
(5, 1, 'Documenta??o', 'Modelos de documenta??o, normas e exemplos'),
(6, 1, 'Projetos', 'Padr?es para desenvolvimento de projetos'),
(7, 2, 'Matem?tica Financeira', 'C?lculos Num?ricos'),
(8, 1, 'Eventos', 'Eventos realizados pelo curso de Inform?tica'),
(9, 3, 'Hist?ria da Moda', 'Hist?ria da evolu??o da moda ao longo do tempo'),
(10, 4, 'Atendimento ao Cliente', 'Tecnicas de atendimento'),
(11, 5, 'Editora??o de Imagens', 'Softwares e outros relacionados'),
(12, 6, 'Sub-Categoria de teste', 'Sub-Categoria de teste');

-- --------------------------------------------------------

--
-- Estrutura da tabela `topico`
--

CREATE TABLE `topico` (
  `idtopico` int(11) NOT NULL,
  `usuario_idusuario` int(11) NOT NULL,
  `subcategoria_idsubcategoria` int(11) NOT NULL,
  `titulo` varchar(150) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `topico`
--

INSERT INTO `topico` (`idtopico`, `usuario_idusuario`, `subcategoria_idsubcategoria`, `titulo`, `descricao`, `dt`) VALUES
(1, 2, 3, 'O que voc? achou do sistema?', 'Deixe aqui sua opini?o sobre o que achou do sistema, duvidas, sugest?es... sinta-se ? vontade para deixar um coment?rio. :)', '2009-12-02 10:11:58'),
(2, 2, 1, 'D?vidas sobre C', 'Este t?pico destina-se a todos as d?vidas sobre a linguagem de programa??o C', '2009-12-03 03:10:47'),
(3, 1, 4, 'T?pico de teste', 'Qualquer coisa pra testar essa merdaaaaaa!!!!', '2010-04-26 09:02:59'),
(4, 1, 1, 'Teste de cria??o de t?pico', 'xxx a b c d e f g h i j kl m n o p q r s t u v x z ', '2010-04-29 20:26:13');

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma`
--

CREATE TABLE `turma` (
  `idturma` int(11) NOT NULL,
  `curso_idcurso` int(11) NOT NULL,
  `inicio` varchar(20) DEFAULT NULL,
  `encerramento` varchar(20) DEFAULT NULL,
  `turno` varchar(45) NOT NULL,
  `modulo` varchar(20) NOT NULL,
  `nome` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `turma`
--

INSERT INTO `turma` (`idturma`, `curso_idcurso`, `inicio`, `encerramento`, `turno`, `modulo`, `nome`) VALUES
(1, 1, '2009/1', '2010/1', 'MATUTINO', '', 'INFOMAT01'),
(2, 2, '2009/1', '2010/1', 'MATUTINO', '', 'MODEMAT01'),
(3, 3, '2009/1', '2010/1', 'MATUTINO', '', 'ADMIMAT01'),
(4, 1, '2009/1', '2010/1', 'MATUTINO', '', 'INFOMAT02'),
(5, 1, '2009/1', '2010/1', 'NOTURNO', '', 'INFONOT02');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `login` varchar(45) DEFAULT NULL,
  `senha` varchar(45) DEFAULT NULL,
  `nivel_acesso` varchar(45) DEFAULT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `rua` text DEFAULT NULL,
  `numero` varchar(6) DEFAULT NULL,
  `bairro` varchar(45) DEFAULT NULL,
  `municipio` varchar(45) DEFAULT NULL,
  `estado` varchar(2) DEFAULT NULL,
  `cep` varchar(10) DEFAULT NULL,
  `nacionalidade` varchar(45) DEFAULT NULL,
  `uf_origem` varchar(45) DEFAULT NULL,
  `pai` varchar(45) DEFAULT NULL,
  `mae` varchar(45) DEFAULT NULL,
  `rg` varchar(12) DEFAULT NULL,
  `cpf` varchar(12) DEFAULT NULL,
  `data_cadastro` datetime DEFAULT NULL,
  `telefone_fixo` varchar(11) DEFAULT NULL,
  `telefone_celular` varchar(11) DEFAULT NULL,
  `telefone_recado` varchar(11) DEFAULT NULL,
  `email` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`idusuario`, `login`, `senha`, `nivel_acesso`, `nome`, `rua`, `numero`, `bairro`, `municipio`, `estado`, `cep`, `nacionalidade`, `uf_origem`, `pai`, `mae`, `rg`, `cpf`, `data_cadastro`, `telefone_fixo`, `telefone_celular`, `telefone_recado`, `email`) VALUES
(1, 'admin', '1234', 'Administrador', 'Leandro Souza Ferreira', 'Jos? de Souza', '150', 'Vila Garrido', 'Vila Velha', 'ES', '29116-240', 'Brasileiro', 'ES', 'Alvino Jos? Ferreira', 'Iracema de Souza Leite', '0000000', '0000000', '2009-12-01 03:01:04', '2733692066', '2733692066', '2733692066', 'leandrosouzaferreira.es@gmail.com'),
(2, 'francisca', 'francisca', 'Administrador', 'Francisca', '*', '*', '*', '*', 'ES', '*-*', '*', 'ES', '*', '*', '*', '*', '2009-12-02 07:43:10', '***', '***', '***', '*'),
(3, 'marcelo', 'marcelo', 'Professor', 'Marcelo', '*', '*', '*', '*', 'ES', '*-*', '*', 'ES', '*', '*', '*', '*', '2009-12-02 07:45:08', '***', '***', '***', '*'),
(4, 'luciana', 'luciana', 'Usu?rio', 'Luciana', '*', '*', '*', '*', 'ES', '*-*', '*', 'ES', '*', '*', '*', '*', '2009-12-02 07:59:46', '***', '***', '***', '*'),
(5, 'silvio', 'silvio', 'Professor', 'Silvio', 'x', 'x', 'x', 'x', 'ES', 'x-x', 'x', 'ES', 'x', 'x', 'x', 'x', '2009-12-02 08:03:27', 'xxx', 'xxx', 'xxx', 'x'),
(6, 'teste', 'teste', 'Professor', 'Teste', 'x', 'x', 'x', 'x', 'ES', 'x-x', 'x', 'ES', 'x', 'x', 'x', 'x', '2009-12-02 08:09:43', 'xxx', 'xxx', 'xxxx', 'x'),
(7, 'testes', 'testes', 'Usu?rio', 'testes', 'x', 'x', 'x', 'xx', 'ES', 'x-x', 'x', 'ES', 'x', 'x', 'x', 'x', '2009-12-07 16:52:53', 'xxx', 'xxx', 'xxx', 'x'),
(8, 'r', 'r', 'Usu?rio', 'rrr', 'r', 'r', 'r', 'r', 'RJ', 'r-r', 'r', 'RJ', 'r', 'r', 'r', 'r', '2009-12-07 17:06:33', 'rrr', 'rrr', 'rrrr', 'rr'),
(9, 'r', 'r', 'Usu?rio', 'rarara', 'r', 'r', 'r', 'r', 'RJ', 'r-r', 'r', 'RJ', 'r', 'r', 'r', 'r', '2009-12-07 17:07:25', 'rrr', 'rrr', 'rrr', 'r'),
(10, 'anonimo', 'anonimo', 'Usu?rio', 'anonimo', 'x', 'x', 'x', 'x', 'AC', 'x-x', 'x', 'AC', 'x', 'x', 'x', 'x', '2010-05-03 22:19:08', 'xxx', 'xxx', 'xxx', 'x'),
(11, 'mais', 'mais', 'Usu?rio', 'mais um', 'x', 'x', 'x', 'x', 'AC', 'x-x', 'x', 'AC', 'x', 'x', 'x', 'x', '2010-05-09 00:14:23', 'xxx', 'xxx', 'xxx', 'x');

-- --------------------------------------------------------

--
-- Estrutura da tabela `visibilidade`
--

CREATE TABLE `visibilidade` (
  `idvisibilidade` int(11) NOT NULL,
  `descricao` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`idusuario`,`turma_idturma`,`num_matricula`),
  ADD KEY `fk_usuario` (`idusuario`),
  ADD KEY `fk_Aluno_Turma1` (`turma_idturma`);

--
-- Índices para tabela `arquivo`
--
ALTER TABLE `arquivo`
  ADD PRIMARY KEY (`idarquivo`,`id_usuario`),
  ADD KEY `fk_arquivo_Professor1` (`id_usuario`);

--
-- Índices para tabela `arquivo_has_turma`
--
ALTER TABLE `arquivo_has_turma`
  ADD PRIMARY KEY (`arquivo_idarquivo`,`turma_idturma`),
  ADD KEY `fk_arquivo_has_turma_arquivo1` (`arquivo_idarquivo`),
  ADD KEY `fk_arquivo_has_turma_turma1` (`turma_idturma`);

--
-- Índices para tabela `banido`
--
ALTER TABLE `banido`
  ADD PRIMARY KEY (`moderador_usuario_idusuario`,`usuario_idusuario`),
  ADD KEY `fk_banido_moderador1` (`moderador_usuario_idusuario`),
  ADD KEY `fk_banido_usuario1` (`usuario_idusuario`);

--
-- Índices para tabela `canal`
--
ALTER TABLE `canal`
  ADD PRIMARY KEY (`idcanal`);

--
-- Índices para tabela `canal_has_noticia`
--
ALTER TABLE `canal_has_noticia`
  ADD PRIMARY KEY (`canal_idcanal`,`noticia_idnoticia`),
  ADD KEY `fk_canal_has_noticia_canal1` (`canal_idcanal`),
  ADD KEY `fk_canal_has_noticia_noticia1` (`noticia_idnoticia`);

--
-- Índices para tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idcategoria`);

--
-- Índices para tabela `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`idcomentario`,`topico_idtopico`,`usuario_idusuario`),
  ADD KEY `fk_comentario_topico1` (`topico_idtopico`),
  ADD KEY `fk_comentario_Usuario1` (`usuario_idusuario`);

--
-- Índices para tabela `coordenador`
--
ALTER TABLE `coordenador`
  ADD PRIMARY KEY (`idprofessor`),
  ADD KEY `idcurso` (`idcurso`);

--
-- Índices para tabela `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`idcurso`);

--
-- Índices para tabela `disciplina`
--
ALTER TABLE `disciplina`
  ADD PRIMARY KEY (`iddisciplina`,`curso_idcurso`),
  ADD KEY `FK_disciplina_1` (`curso_idcurso`);

--
-- Índices para tabela `disciplina_has_professor`
--
ALTER TABLE `disciplina_has_professor`
  ADD PRIMARY KEY (`disciplina_iddisciplina`,`professor_idfuncionario`),
  ADD KEY `FK_disciplina_has_professor_2` (`professor_idfuncionario`);

--
-- Índices para tabela `ementa`
--
ALTER TABLE `ementa`
  ADD PRIMARY KEY (`idementa`,`disciplina_iddisciplina`),
  ADD KEY `fk_ementa_disciplina1` (`disciplina_iddisciplina`);

--
-- Índices para tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`funcionario_idusuario`);

--
-- Índices para tabela `matriz_curricular`
--
ALTER TABLE `matriz_curricular`
  ADD PRIMARY KEY (`idmatriz_curricular`,`curso_idcurso`),
  ADD KEY `fk_matriz_curricular_curso1` (`curso_idcurso`);

--
-- Índices para tabela `mensagem`
--
ALTER TABLE `mensagem`
  ADD PRIMARY KEY (`idmensagem`,`remetente`,`destinatario`),
  ADD KEY `fk_mensagem_usuario1` (`remetente`),
  ADD KEY `fk_mensagem_usuario2` (`destinatario`);

--
-- Índices para tabela `moderador`
--
ALTER TABLE `moderador`
  ADD PRIMARY KEY (`usuario_idusuario`),
  ADD KEY `fk_moderador_usuario1` (`usuario_idusuario`);

--
-- Índices para tabela `moderador_has_categoria`
--
ALTER TABLE `moderador_has_categoria`
  ADD PRIMARY KEY (`moderador_usuario_idusuario`,`categoria_idcategoria`),
  ADD KEY `fk_moderador_has_categoria_moderador1` (`moderador_usuario_idusuario`),
  ADD KEY `fk_moderador_has_categoria_categoria1` (`categoria_idcategoria`);

--
-- Índices para tabela `noticia`
--
ALTER TABLE `noticia`
  ADD PRIMARY KEY (`idnoticia`) USING BTREE;

--
-- Índices para tabela `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`idfuncionario`),
  ADD KEY `FK_professor_1` (`coordenador`);

--
-- Índices para tabela `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD PRIMARY KEY (`idsubcategoria`,`categoria_idcategoria`),
  ADD KEY `fk_subcategoria_categoria1` (`categoria_idcategoria`);

--
-- Índices para tabela `topico`
--
ALTER TABLE `topico`
  ADD PRIMARY KEY (`idtopico`,`usuario_idusuario`,`subcategoria_idsubcategoria`),
  ADD KEY `fk_topico_Usuario1` (`usuario_idusuario`),
  ADD KEY `fk_topico_subcategoria1` (`subcategoria_idsubcategoria`);

--
-- Índices para tabela `turma`
--
ALTER TABLE `turma`
  ADD PRIMARY KEY (`idturma`,`curso_idcurso`),
  ADD KEY `fk_Turma_Curso1` (`curso_idcurso`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`);

--
-- Índices para tabela `visibilidade`
--
ALTER TABLE `visibilidade`
  ADD PRIMARY KEY (`idvisibilidade`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aluno`
--
ALTER TABLE `aluno`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `arquivo`
--
ALTER TABLE `arquivo`
  MODIFY `idarquivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `canal`
--
ALTER TABLE `canal`
  MODIFY `idcanal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `comentario`
--
ALTER TABLE `comentario`
  MODIFY `idcomentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `curso`
--
ALTER TABLE `curso`
  MODIFY `idcurso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `disciplina`
--
ALTER TABLE `disciplina`
  MODIFY `iddisciplina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `ementa`
--
ALTER TABLE `ementa`
  MODIFY `idementa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `matriz_curricular`
--
ALTER TABLE `matriz_curricular`
  MODIFY `idmatriz_curricular` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `mensagem`
--
ALTER TABLE `mensagem`
  MODIFY `idmensagem` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `noticia`
--
ALTER TABLE `noticia`
  MODIFY `idnoticia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de tabela `subcategoria`
--
ALTER TABLE `subcategoria`
  MODIFY `idsubcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `topico`
--
ALTER TABLE `topico`
  MODIFY `idtopico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `turma`
--
ALTER TABLE `turma`
  MODIFY `idturma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `visibilidade`
--
ALTER TABLE `visibilidade`
  MODIFY `idvisibilidade` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `aluno_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`);

--
-- Limitadores para a tabela `coordenador`
--
ALTER TABLE `coordenador`
  ADD CONSTRAINT `coordenador_ibfk_1` FOREIGN KEY (`idcurso`) REFERENCES `curso` (`idcurso`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `coordenador_ibfk_2` FOREIGN KEY (`idprofessor`) REFERENCES `professor` (`idfuncionario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `disciplina`
--
ALTER TABLE `disciplina`
  ADD CONSTRAINT `FK_disciplina_1` FOREIGN KEY (`curso_idcurso`) REFERENCES `curso` (`idcurso`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `disciplina_has_professor`
--
ALTER TABLE `disciplina_has_professor`
  ADD CONSTRAINT `FK_disciplina_has_professor_1` FOREIGN KEY (`disciplina_iddisciplina`) REFERENCES `disciplina` (`iddisciplina`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_disciplina_has_professor_2` FOREIGN KEY (`professor_idfuncionario`) REFERENCES `professor` (`idfuncionario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD CONSTRAINT `funcionario_ibfk_1` FOREIGN KEY (`funcionario_idusuario`) REFERENCES `usuario` (`idusuario`);

--
-- Limitadores para a tabela `professor`
--
ALTER TABLE `professor`
  ADD CONSTRAINT `FK_professor_1` FOREIGN KEY (`coordenador`) REFERENCES `curso` (`idcurso`),
  ADD CONSTRAINT `professor_ibfk_1` FOREIGN KEY (`idfuncionario`) REFERENCES `funcionario` (`funcionario_idusuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
