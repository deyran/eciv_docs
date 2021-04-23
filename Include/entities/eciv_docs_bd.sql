-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 22-Abr-2021 às 21:48
-- Versão do servidor: 5.7.31
-- versão do PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `eciv_docs_bd`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `fin_entrada`
--

DROP TABLE IF EXISTS `fin_entrada`;
CREATE TABLE IF NOT EXISTS `fin_entrada` (
  `ID_FIN` int(10) NOT NULL,
  `ID_PES` int(10) NOT NULL,
  `DATA_PG` date NOT NULL,
  `VALOR_TOTAL` float(10,2) NOT NULL,
  PRIMARY KEY (`ID_FIN`),
  KEY `ID_PES` (`ID_PES`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fin_entrada_forma`
--

DROP TABLE IF EXISTS `fin_entrada_forma`;
CREATE TABLE IF NOT EXISTS `fin_entrada_forma` (
  `ID_FIN_FOR` int(10) NOT NULL,
  `DESCRICAO` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_FIN_FOR`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `fin_entrada_forma`
--

INSERT INTO `fin_entrada_forma` (`ID_FIN_FOR`, `DESCRICAO`) VALUES
(0, 'Em espécie'),
(1, 'débito'),
(2, 'Boleto'),
(3, 'Crédito à vista'),
(4, 'Crédito parcelado'),
(5, 'Pix'),
(6, 'Antecipado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fin_entrada_iten`
--

DROP TABLE IF EXISTS `fin_entrada_iten`;
CREATE TABLE IF NOT EXISTS `fin_entrada_iten` (
  `ID_FIN_ITEN` int(10) NOT NULL,
  `ID_FIN` int(10) NOT NULL,
  `ID_FIN_FOR` int(10) NOT NULL,
  `TIPO_PG` int(2) NOT NULL,
  `ID_ORG` int(2) NOT NULL,
  `DESCRICAO` varchar(100) NOT NULL,
  `DESC_CONTROLE` varchar(100) NOT NULL,
  `VALOR` float(10,2) NOT NULL,
  PRIMARY KEY (`ID_FIN_ITEN`),
  KEY `ID_FIN` (`ID_FIN`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fin_entrada_mens`
--

DROP TABLE IF EXISTS `fin_entrada_mens`;
CREATE TABLE IF NOT EXISTS `fin_entrada_mens` (
  `ID_FIN_MENS` int(10) NOT NULL,
  `ID_FIN_ITEN` int(10) NOT NULL,
  `ID_TUR_AL` int(10) NOT NULL,
  `ID_ORG` int(10) NOT NULL,
  `PARCELA` int(10) NOT NULL,
  PRIMARY KEY (`ID_FIN_MENS`),
  KEY `ID_FIN_ITEN` (`ID_FIN_ITEN`),
  KEY `ID_TUR_AL` (`ID_TUR_AL`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fin_entrada_origem`
--

DROP TABLE IF EXISTS `fin_entrada_origem`;
CREATE TABLE IF NOT EXISTS `fin_entrada_origem` (
  `ID_ORG` int(10) NOT NULL,
  `DESCRICAO` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_ORG`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `fin_entrada_origem`
--

INSERT INTO `fin_entrada_origem` (`ID_ORG`, `DESCRICAO`) VALUES
(0, 'Mensalidade'),
(1, 'Uniforme'),
(2, 'Cantina'),
(3, 'Negociação De Débito(s)'),
(4, 'Outros');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

DROP TABLE IF EXISTS `pessoa`;
CREATE TABLE IF NOT EXISTS `pessoa` (
  `ID_PES` int(10) NOT NULL,
  `DESCRICAO` varchar(43) DEFAULT NULL,
  PRIMARY KEY (`ID_PES`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pessoa`
--

INSERT INTO `pessoa` (`ID_PES`, `DESCRICAO`) VALUES
(0, 'Saad Alshaar'),
(1, 'Paulo Felipe Correa Junior'),
(2, 'Luccas Bryan Santos da Silva Paiva'),
(3, 'Mateus Henrique de Lima Farias'),
(4, 'Lívia Beatriz Menezes Lopes'),
(5, 'Maria Eduarda Soares Lima '),
(6, 'Ana Luiza Sarmento Maia'),
(7, 'Lucas Gabriel Marques Barreto'),
(8, 'João Rafael Oliveira Evangelista'),
(9, 'Luna Yasmin Ribeiro Bernardes'),
(10, 'Ana Sophia Coelho Santos da Silva'),
(11, 'Eduarda Cavaleiro de Macedo Moreira '),
(12, 'Elisa Rosa Mendonça dos Santos'),
(13, 'Kayla Gemaque de Almeida'),
(14, 'Davi Silva Quadros Oliveira'),
(15, 'Thiago Arthur Prazeres Santana '),
(16, 'Asafe Kefa Diniz Carvalho'),
(17, 'Thomaz da Rocha de Souza'),
(18, 'Fernando Denison Vaz Moraes'),
(19, 'Alice Beatriz Silva Medeiros'),
(20, 'Icaro Leonardo Menezes de Miranda'),
(21, 'Alícia Raissa Brito da Silva'),
(22, 'Enzo Luan da Luz Monteiro'),
(23, 'Wellington Gabriel Silva de Oliveira'),
(24, 'Carlos Alexandre Antunes e Silva Lourenço'),
(25, 'Sarah Raquel Lopes Barros'),
(26, 'Betania Beatriz Souza de Sousa'),
(27, 'Lorena dos Reis Jucá'),
(28, 'Jhully Emelly Nascimento Corrêa'),
(29, 'João Paulo Serejo Araujo'),
(30, 'Ivone Evellyn Reis da Silva '),
(31, 'José Gabriel Pantoja Maciel'),
(32, 'Lya Sophia Marques Barreto'),
(33, 'Caio Eduardo Monteiro da Cunha '),
(34, 'Ana Beatriz Carrera Alves da Rocha'),
(35, 'Debora Cristina Cunha Laranjeira'),
(36, 'Dominique Cristal da Costa Medeiros'),
(37, 'Emilly Emanuela de Abreu Cunha'),
(38, 'Júlia Barros de Sousa'),
(39, 'Sofia Hadassa Cardoso Lima'),
(40, 'Taney Ronyere de Araújo de Oliveira Borges'),
(41, 'Laura Rafaela Sarmento Maia'),
(42, 'João Paulo Gomes Holanda '),
(43, 'Lucas Fontelles dos Santos'),
(44, 'Davi Pereira Torres'),
(45, 'Pedro Henrique Soares Ferreira'),
(46, 'Adrian kalleb Serra da Vera Cruz'),
(47, 'Rebeca Leticia Cavalcante da Luz'),
(48, 'Italo Gabriel  do Mar de Oliveira'),
(49, 'Bruno César Pinheiro de Carvalho '),
(50, 'Erick Davi Souza de Assis da Silva'),
(51, 'Stefany Santos Costa'),
(52, 'Carlos Felipe Amaral Costa'),
(53, 'Suhanny Yasmin Ataide de Souza'),
(54, 'Eduardo Nunes de Brito'),
(55, 'Kayla Adriely Oliveira de Brito'),
(56, 'João Mykeias Atayde da Silva'),
(57, 'Maria Beatriz Domingues Costa'),
(58, 'Bruno de Brito Oliveira'),
(59, 'Querén Hapuque de Souza Morais dos Santos'),
(60, 'Ramsés Melo Ferreira '),
(61, 'Valter Artur Oliveira de Melo'),
(62, 'Tiago Silva Quadros Oliveira'),
(63, 'Anna Clara Moraes Moreira'),
(64, 'Fernanda Graziella de Souza de Souza'),
(65, 'Lauanne Beatriz Teixeira dos Santos'),
(66, 'Myguel Guimarães Atayde da Silva'),
(67, 'Sofia Brito Soeiro Martins'),
(68, 'Matheus Oliveira Dos Santos Teixeira'),
(69, 'Asafe Emanuel Morais dos Santos'),
(70, 'Marllon Cohen Barros'),
(71, 'João Pedro Pinheiro Dias'),
(72, 'Ycaro Kauã Gomes da Silva'),
(73, 'Esther Dorotéia de Deus da Silva '),
(74, 'Gabriel Gomes Rodrigues'),
(75, 'João Victor Pinheiro '),
(76, 'Maria Luiza de Souza Batista '),
(77, 'Leticia Cristina dos Santos Freitas'),
(78, 'Lucas Paulo Nunes Maia '),
(79, 'Nicolly Victória Padilha da Silva'),
(80, 'Letícia de Freitas Valente '),
(81, 'Luis Otávio de Sousa Ribeiro'),
(82, 'Kauanny Sofia Ataide de Souza'),
(83, 'Adria Samara de Lima Mendes '),
(84, 'Kelwin Orlando de Souza Oliveira'),
(85, 'Yulle Gabriele de Oliveira Silva'),
(86, 'Neyla Geovanna Martins Durans'),
(87, 'Cláudia Lohane Santos Freitas'),
(88, 'Kássya Letícia Leal Maciel'),
(89, 'Marcella Thalya Segtowick Souza de Carvalho'),
(90, 'Geovana do Nascimento Cardoso Vivas'),
(91, 'Emilly Helena dos Santos Amaral Silva'),
(92, 'Ananda Celine Raiol Monteiro'),
(93, 'Emanuele Silva do Rosário '),
(94, 'Beatriz Monteiro Rodrigues'),
(95, 'Lucas Vinicius Viana de Cristo'),
(96, 'João Henrique da Silva Baldez'),
(97, 'Liandra Victoria dos Santos Ruivo Leoncio'),
(98, 'Kauêr Kleinlein Nunes Pinheiro'),
(99, 'Pedro Rodrigues de Brito Neto'),
(100, 'Arthur da Silva Gonçalves '),
(101, 'Rykelmy de Oliveira Ferreira Santos'),
(102, 'Gabrielly Micaella do Nascimento de Macedo'),
(103, 'Geicyane Micaelle do Nascimento de Macedo'),
(104, 'Giovanna Cota Suzuki'),
(105, 'Daniela Oliveira Rodrigues '),
(106, 'Ludmila Gomes Oliveira'),
(107, 'Ana Clara Souza Pinheiro'),
(108, 'Diego Robert Silva Carneiro'),
(109, 'Edneia de Souza Lima Reis'),
(110, 'Laura Victoria Bezerra Correa'),
(111, 'Melquisedeque Regis Paiva da Silva'),
(112, 'Kelly de Lima Farias '),
(113, 'Anderson Monteiro Lopes'),
(114, 'Francisco Fernandes Mora'),
(115, 'Wellington Nunes Maia'),
(116, 'Valmir Silva Barreto'),
(117, 'Rafael Monteiro Evangelista'),
(118, 'Darlan Diniz Bernardes'),
(119, 'Eduardo Campos Moreira '),
(120, 'Joyce  Marlene Mourão Mendonça'),
(121, 'Dinelma Gemaque de Lima '),
(122, 'Eudenise Madalena Muniz de Souza '),
(123, 'Jôse Emanuelle da Rocha de Souza '),
(124, 'Denize Gonçalves Vaz'),
(125, 'Paulo Sérgio Marques Medeiros'),
(126, 'Igor Alberto Oliveira de Miranda'),
(127, 'Maria de Jesus Brito da Silva'),
(128, 'Maria Eduiza Amaral Monteiro'),
(129, 'Wellinghton Brito de Oliveira '),
(130, 'Karla Danyella Antunes e Silva '),
(131, 'Artur Rodrigo Pereira '),
(132, 'Jose Carlos Souza'),
(133, 'Moisés Lima Jucá '),
(134, 'Roselene dos Santos Lopes '),
(135, 'Marlos Augusto Silva Araujo '),
(136, 'Izaias Ferreira da Silva '),
(137, 'Fátima Nazaré Duarte Maciel'),
(138, 'Mayk Hael Kleinlein Pinheiro'),
(139, 'Irleivani Regina Silva Da Rocha Dias '),
(140, 'Erivelto da Costa Laranjeira '),
(141, 'Valeria Moraes de Melo '),
(142, 'Edinair Pinto De Barros  '),
(143, 'Roberta Teofilo de Araújo '),
(144, 'Renata Monteiro Gomes '),
(145, 'Fabrícia do Socorro Gomes Holanda'),
(146, 'Ladislau Rosario dos Santos '),
(147, 'Célia Silva Pereira '),
(148, 'Renil de Araújo Ferreira '),
(149, 'Maria Helena Ferreira da Natividade '),
(150, 'Emerson Ataide da Luz '),
(151, 'Zilda Viviane Correa De Oliveira '),
(152, 'Cassio Clei Rodrigues Pinheiro '),
(153, 'Marcelo de Assis da Silva'),
(154, 'Cláudio Luciano Freitas Costa'),
(155, 'Delma Lucineida da Paixão Costa'),
(156, 'Filomena Silva Ataide'),
(157, 'Carla Daniele Coelho Santos '),
(158, 'José Anderson Rollo de Brito '),
(159, 'Viviane Guimaraes Da Silva '),
(160, 'Cristiane Domingues da Costa '),
(161, 'Adnor Silva de Oliveira'),
(162, 'Paulo Guilherme Cunha Dos Santos '),
(163, 'Airton Antonio Azevedo Ferreira '),
(164, 'Luana Cristina Silva Oliveira '),
(165, 'Maria Lindalva de Lima Monteiro'),
(166, 'Eli Claudia Brito De Moraes '),
(167, 'Giuseppe Lopes de Souza '),
(168, 'Diego Tavares dos Santos '),
(169, 'Waleson Silva Salazar'),
(170, 'Maria Madalena Brito Soeiro Martins '),
(171, 'Osvaldo Drago Teixeira Neto '),
(172, 'Irenilce Morais dos Santos '),
(173, 'Antonio Barros Júnior '),
(174, 'Cleisiane Costa Pinheiro '),
(175, 'Agenor Batista GomesDebito '),
(176, 'Fabiana Oliveira de Deus '),
(177, 'Raquel Monteiro Gomes Rodrigues '),
(178, 'João Evando Ramos Dias '),
(179, 'Josiany de Nazaré Prazeres Silva '),
(180, 'Paulo de Oliveira Maia '),
(181, 'Mayla Valéria Leal Padilha '),
(182, 'Marta Luiza Ferreira de Freitas '),
(183, 'Paulo Rogério Pinto Ribeiro'),
(184, 'Samela Rodrigues Cardoso '),
(185, 'Kleberson Alberto Melo Mendes '),
(186, 'Bruno Calixto dos Santos Silva '),
(187, 'Maria Rosa Ferreira Asevedo'),
(188, 'Lucelia De Paula Martins '),
(189, 'Rosenilce Baeta Diniz da Conceição '),
(190, 'Elaine Brito de Abreu Cunha '),
(191, 'Roseni Silva de Souza'),
(192, 'George Wilson Oliveira Vivas '),
(193, 'Walmira Geremias Souza da Silva '),
(194, 'Givanildo Lima dos Santos '),
(195, 'Maria Lucidea Silva Ferro '),
(196, 'Danielli Monteiro da Silva '),
(197, 'Venancio Braz Ferreira de Cristo '),
(198, 'Solange Tavares Da Silva '),
(199, 'Livia Cristina dos Santos   '),
(200, 'Catarina de Sena Monteiro Nunes '),
(201, 'Aline Silva Gonçalves  '),
(202, 'Max Ivanilson Moura de Macedo '),
(203, 'Larissa Carneiro Pinheiro '),
(204, 'Renata Cota Suzuki '),
(205, 'João Rafael Colares Rodrigues '),
(206, 'Claudenor Brasil Pinheiro ');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa_vinc`
--

DROP TABLE IF EXISTS `pessoa_vinc`;
CREATE TABLE IF NOT EXISTS `pessoa_vinc` (
  `ID_ALUNO` int(10) NOT NULL,
  `ID_PES` int(10) NOT NULL,
  `ID_TIPO_VINC` int(10) NOT NULL,
  PRIMARY KEY (`ID_ALUNO`,`ID_PES`,`ID_TIPO_VINC`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pessoa_vinc`
--

INSERT INTO `pessoa_vinc` (`ID_ALUNO`, `ID_PES`, `ID_TIPO_VINC`) VALUES
(0, 109, 0),
(1, 110, 0),
(2, 111, 0),
(3, 112, 0),
(4, 113, 0),
(5, 114, 0),
(6, 115, 0),
(7, 116, 0),
(8, 117, 0),
(9, 118, 0),
(10, 157, 0),
(11, 119, 0),
(12, 120, 0),
(13, 121, 0),
(14, 122, 0),
(15, 179, 0),
(16, 189, 0),
(17, 123, 0),
(18, 124, 0),
(19, 125, 0),
(20, 126, 0),
(21, 127, 0),
(22, 128, 0),
(23, 129, 0),
(24, 130, 0),
(25, 131, 0),
(26, 132, 0),
(27, 133, 0),
(28, 134, 0),
(29, 135, 0),
(30, 136, 0),
(31, 137, 0),
(32, 116, 0),
(33, 165, 0),
(34, 139, 0),
(35, 140, 0),
(36, 141, 0),
(37, 190, 0),
(38, 142, 0),
(39, 184, 0),
(40, 143, 0),
(41, 115, 0),
(42, 145, 0),
(43, 146, 0),
(44, 147, 0),
(45, 148, 0),
(46, 149, 0),
(47, 150, 0),
(48, 151, 0),
(49, 152, 0),
(50, 153, 0),
(51, 154, 0),
(52, 155, 0),
(53, 156, 0),
(54, 200, 0),
(55, 158, 0),
(56, 159, 0),
(57, 160, 0),
(58, 161, 0),
(59, 162, 0),
(60, 163, 0),
(61, 164, 0),
(62, 122, 0),
(63, 166, 0),
(64, 167, 0),
(65, 168, 0),
(66, 159, 0),
(67, 170, 0),
(68, 171, 0),
(69, 172, 0),
(70, 173, 0),
(71, 174, 0),
(72, 175, 0),
(73, 176, 0),
(74, 177, 0),
(75, 203, 0),
(76, 178, 0),
(77, 154, 0),
(78, 180, 0),
(79, 181, 0),
(80, 182, 0),
(81, 183, 0),
(82, 156, 0),
(83, 185, 0),
(84, 186, 0),
(85, 151, 0),
(86, 188, 0),
(87, 154, 0),
(88, 137, 0),
(89, 191, 0),
(90, 192, 0),
(91, 193, 0),
(92, 194, 0),
(93, 195, 0),
(94, 196, 0),
(95, 197, 0),
(96, 198, 0),
(97, 199, 0),
(98, 138, 0),
(99, 200, 0),
(100, 201, 0),
(101, 169, 0),
(102, 202, 0),
(103, 202, 0),
(104, 204, 0),
(105, 205, 0),
(106, 144, 0),
(107, 206, 0),
(108, 187, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa_vinc_tipo`
--

DROP TABLE IF EXISTS `pessoa_vinc_tipo`;
CREATE TABLE IF NOT EXISTS `pessoa_vinc_tipo` (
  `ID_VINC` int(10) NOT NULL,
  `DESCRICAO` varchar(22) DEFAULT NULL,
  PRIMARY KEY (`ID_VINC`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pessoa_vinc_tipo`
--

INSERT INTO `pessoa_vinc_tipo` (`ID_VINC`, `DESCRICAO`) VALUES
(0, 'Responsável financeiro'),
(1, 'Pai'),
(2, 'Mãe'),
(3, 'Avô paterno'),
(4, 'Avô Materno'),
(5, 'Avó paterno'),
(6, 'Avó Materno'),
(7, 'Padrinho'),
(8, 'Madrinha'),
(9, 'Amigo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma`
--

DROP TABLE IF EXISTS `turma`;
CREATE TABLE IF NOT EXISTS `turma` (
  `ID_TURMA` int(10) NOT NULL,
  `DESCRICAO` varchar(30) DEFAULT NULL,
  `DESCRICAO_ABV` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID_TURMA`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `turma`
--

INSERT INTO `turma` (`ID_TURMA`, `DESCRICAO`, `DESCRICAO_ABV`) VALUES
(0, 'Maternal', 'MT'),
(1, 'Jardim 1', 'JD-1'),
(2, 'Jardim 2', 'JD-2'),
(3, '1º ANO', '1A'),
(4, '2º ANO', '2A'),
(5, '3º ANO', '3A'),
(6, '4º ANO', '4A'),
(7, '5º ANO', '5A'),
(8, '6º ANO', '6A'),
(9, '7º ANO', '7A'),
(10, '8º ANO', '8A'),
(11, '9º ANO', '9A'),
(12, '1º ANO DO ENSINO MÉDIO', '1A-M');

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma_aluno`
--

DROP TABLE IF EXISTS `turma_aluno`;
CREATE TABLE IF NOT EXISTS `turma_aluno` (
  `ID_TUR_AL` int(10) NOT NULL,
  `ID_TURMA` int(10) DEFAULT NULL,
  `ANO` int(4) DEFAULT NULL,
  `ID_ALUNO` int(10) DEFAULT NULL,
  `ID_RESP_F` int(10) DEFAULT NULL,
  PRIMARY KEY (`ID_TUR_AL`),
  KEY `ID_ALUNO` (`ID_ALUNO`),
  KEY `ID_RESP_F` (`ID_RESP_F`),
  KEY `ID_TURMA` (`ID_TURMA`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `turma_aluno`
--

INSERT INTO `turma_aluno` (`ID_TUR_AL`, `ID_TURMA`, `ANO`, `ID_ALUNO`, `ID_RESP_F`) VALUES
(0, 1, 2021, 0, 109),
(1, 1, 2021, 1, 110),
(2, 1, 2021, 2, 111),
(3, 2, 2021, 3, 112),
(4, 2, 2021, 4, 113),
(5, 2, 2021, 5, 114),
(6, 2, 2021, 6, 115),
(7, 2, 2021, 7, 116),
(8, 2, 2021, 8, 117),
(9, 3, 2021, 9, 118),
(10, 3, 2021, 10, 157),
(11, 3, 2021, 11, 119),
(12, 3, 2021, 12, 120),
(13, 4, 2021, 13, 121),
(14, 4, 2021, 14, 122),
(15, 4, 2021, 15, 179),
(16, 4, 2021, 16, 189),
(17, 4, 2021, 17, 123),
(18, 4, 2021, 18, 124),
(19, 4, 2021, 19, 125),
(20, 4, 2021, 20, 126),
(21, 4, 2021, 21, 127),
(22, 4, 2021, 22, 128),
(23, 5, 2021, 23, 129),
(24, 5, 2021, 24, 130),
(25, 5, 2021, 25, 131),
(26, 5, 2021, 26, 132),
(27, 5, 2021, 27, 133),
(28, 5, 2021, 28, 134),
(29, 5, 2021, 29, 135),
(30, 5, 2021, 30, 136),
(31, 5, 2021, 31, 137),
(32, 5, 2021, 32, 116),
(33, 5, 2021, 33, 165),
(34, 6, 2021, 34, 139),
(35, 6, 2021, 35, 140),
(36, 6, 2021, 36, 141),
(37, 6, 2021, 37, 190),
(38, 6, 2021, 38, 142),
(39, 6, 2021, 39, 184),
(40, 6, 2021, 40, 143),
(41, 6, 2021, 41, 115),
(42, 6, 2021, 42, 145),
(43, 7, 2021, 43, 146),
(44, 7, 2021, 44, 147),
(45, 7, 2021, 45, 148),
(46, 7, 2021, 46, 149),
(47, 7, 2021, 47, 150),
(48, 7, 2021, 48, 151),
(49, 7, 2021, 49, 152),
(50, 7, 2021, 50, 153),
(51, 7, 2021, 51, 154),
(52, 7, 2021, 52, 155),
(53, 7, 2021, 53, 156),
(54, 8, 2021, 54, 200),
(55, 8, 2021, 55, 158),
(56, 8, 2021, 56, 159),
(57, 8, 2021, 57, 160),
(58, 8, 2021, 58, 161),
(59, 8, 2021, 59, 162),
(60, 9, 2021, 60, 163),
(61, 9, 2021, 61, 164),
(62, 9, 2021, 62, 122),
(63, 9, 2021, 63, 166),
(64, 9, 2021, 64, 167),
(65, 9, 2021, 65, 168),
(66, 9, 2021, 66, 159),
(67, 9, 2021, 67, 170),
(68, 9, 2021, 68, 171),
(69, 9, 2021, 69, 172),
(70, 9, 2021, 70, 173),
(71, 9, 2021, 71, 174),
(72, 9, 2021, 72, 175),
(73, 9, 2021, 73, 176),
(74, 9, 2021, 74, 177),
(75, 9, 2021, 75, 203),
(76, 9, 2021, 76, 178),
(77, 9, 2021, 77, 154),
(78, 9, 2021, 78, 180),
(79, 9, 2021, 79, 181),
(80, 9, 2021, 80, 182),
(81, 9, 2021, 81, 183),
(82, 9, 2021, 82, 156),
(83, 10, 2021, 83, 185),
(84, 10, 2021, 84, 186),
(85, 10, 2021, 85, 151),
(86, 10, 2021, 86, 188),
(87, 10, 2021, 87, 154),
(88, 10, 2021, 88, 137),
(89, 10, 2021, 89, 191),
(90, 11, 2021, 90, 192),
(91, 11, 2021, 91, 193),
(92, 11, 2021, 92, 194),
(93, 11, 2021, 93, 195),
(94, 11, 2021, 94, 196),
(95, 11, 2021, 95, 197),
(96, 11, 2021, 96, 198),
(97, 11, 2021, 97, 199),
(98, 11, 2021, 98, 138),
(99, 12, 2021, 99, 200),
(100, 12, 2021, 100, 201),
(101, 12, 2021, 101, 169),
(102, 12, 2021, 102, 202),
(103, 12, 2021, 103, 202),
(104, 12, 2021, 104, 204),
(105, 12, 2021, 105, 205),
(106, 12, 2021, 106, 144),
(107, 12, 2021, 107, 206),
(108, 12, 2021, 108, 187);

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma_aluno_val`
--

DROP TABLE IF EXISTS `turma_aluno_val`;
CREATE TABLE IF NOT EXISTS `turma_aluno_val` (
  `ID_TUR_VAL` int(3) NOT NULL,
  `ID_TUR_AL` int(3) DEFAULT NULL,
  `VALOR` decimal(3,2) DEFAULT NULL,
  `TIPO` int(1) DEFAULT NULL,
  PRIMARY KEY (`ID_TUR_VAL`),
  KEY `ID_TUR_AL` (`ID_TUR_AL`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `turma_aluno_val`
--

INSERT INTO `turma_aluno_val` (`ID_TUR_VAL`, `ID_TUR_AL`, `VALOR`, `TIPO`) VALUES
(0, 0, '0.00', 0),
(1, 1, '0.00', 0),
(2, 2, '0.00', 0),
(3, 3, '0.00', 0),
(4, 4, '0.00', 0),
(5, 5, '0.00', 0),
(6, 6, '0.00', 0),
(7, 7, '0.00', 0),
(8, 8, '0.00', 0),
(9, 9, '0.00', 0),
(10, 10, '0.00', 0),
(11, 11, '0.00', 0),
(12, 12, '0.00', 0),
(13, 13, '0.00', 0),
(14, 14, '0.00', 0),
(15, 15, '0.00', 0),
(16, 16, '0.00', 0),
(17, 17, '0.00', 0),
(18, 18, '0.00', 0),
(19, 19, '0.00', 0),
(20, 20, '0.00', 0),
(21, 21, '0.00', 0),
(22, 22, '0.00', 0),
(23, 23, '0.00', 0),
(24, 24, '0.00', 0),
(25, 25, '0.00', 0),
(26, 26, '0.00', 0),
(27, 27, '0.00', 0),
(28, 28, '0.00', 0),
(29, 29, '0.00', 0),
(30, 30, '0.00', 0),
(31, 31, '0.00', 0),
(32, 32, '0.00', 0),
(33, 33, '0.00', 0),
(34, 34, '0.00', 0),
(35, 35, '0.00', 0),
(36, 36, '0.00', 0),
(37, 37, '0.00', 0),
(38, 38, '0.00', 0),
(39, 39, '0.00', 0),
(40, 40, '0.00', 0),
(41, 41, '0.00', 0),
(42, 42, '0.00', 0),
(43, 43, '0.00', 0),
(44, 44, '0.00', 0),
(45, 45, '0.00', 0),
(46, 46, '0.00', 0),
(47, 47, '0.00', 0),
(48, 48, '0.00', 0),
(49, 49, '0.00', 0),
(50, 50, '0.00', 0),
(51, 51, '0.00', 0),
(52, 52, '0.00', 0),
(53, 53, '0.00', 0),
(54, 54, '0.00', 0),
(55, 55, '0.00', 0),
(56, 56, '0.00', 0),
(57, 57, '0.00', 0),
(58, 58, '0.00', 0),
(59, 59, '0.00', 0),
(60, 60, '0.00', 0),
(61, 61, '0.00', 0),
(62, 62, '0.00', 0),
(63, 63, '0.00', 0),
(64, 64, '0.00', 0),
(65, 65, '0.00', 0),
(66, 66, '0.00', 0),
(67, 67, '0.00', 0),
(68, 68, '0.00', 0),
(69, 69, '0.00', 0),
(70, 70, '0.00', 0),
(71, 71, '0.00', 0),
(72, 72, '0.00', 0),
(73, 73, '0.00', 0),
(74, 74, '0.00', 0),
(75, 75, '0.00', 0),
(76, 76, '0.00', 0),
(77, 77, '0.00', 0),
(78, 78, '0.00', 0),
(79, 79, '0.00', 0),
(80, 80, '0.00', 0),
(81, 81, '0.00', 0),
(82, 82, '0.00', 0),
(83, 83, '0.00', 0),
(84, 84, '0.00', 0),
(85, 85, '0.00', 0),
(86, 86, '0.00', 0),
(87, 87, '0.00', 0),
(88, 88, '0.00', 0),
(89, 89, '0.00', 0),
(90, 90, '0.00', 0),
(91, 91, '0.00', 0),
(92, 92, '0.00', 0),
(93, 93, '0.00', 0),
(94, 94, '0.00', 0),
(95, 95, '0.00', 0),
(96, 96, '0.00', 0),
(97, 97, '0.00', 0),
(98, 98, '0.00', 0),
(99, 99, '0.00', 0),
(100, 100, '0.00', 0),
(101, 101, '0.00', 0),
(102, 102, '0.00', 0),
(103, 103, '0.00', 0),
(104, 104, '0.00', 0),
(105, 105, '0.00', 0),
(106, 106, '0.00', 0),
(107, 107, '0.00', 0),
(108, 108, '0.00', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
