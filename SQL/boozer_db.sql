-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04/11/2023 às 01:31
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `boozer_db`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `bz_book`
--

CREATE TABLE `bz_book` (
  `BOOK_ID` int(11) NOT NULL,
  `BOOK_VISIBLE` tinyint(1) NOT NULL,
  `BOOK_TITULO` varchar(255) NOT NULL,
  `BOOK_AUTOR` varchar(255) DEFAULT NULL,
  `BOOK_ANO_PUBLICACAO` date DEFAULT NULL,
  `BOOK_PRECO` decimal(10,2) DEFAULT NULL,
  `BOOK_PRECO_DESC` decimal(10,2) DEFAULT NULL,
  `BOOK_EDITORA` varchar(100) DEFAULT NULL,
  `BOOK_GENERO` varchar(255) DEFAULT NULL,
  `BOOK_CLASSIFICACAO` int(11) DEFAULT NULL,
  `BOOK_IDIOMA` varchar(50) DEFAULT NULL,
  `BOOK_FORMATO` varchar(50) DEFAULT NULL,
  `BOOK_DISPONIBILIDADE` varchar(50) DEFAULT NULL,
  `BOOK_PUBLICO_ALVO` varchar(50) DEFAULT NULL,
  `BOOK_IMG` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `bz_book`
--

INSERT INTO `bz_book` (`BOOK_ID`, `BOOK_VISIBLE`, `BOOK_TITULO`, `BOOK_AUTOR`, `BOOK_ANO_PUBLICACAO`, `BOOK_PRECO`, `BOOK_PRECO_DESC`, `BOOK_EDITORA`, `BOOK_GENERO`, `BOOK_CLASSIFICACAO`, `BOOK_IDIOMA`, `BOOK_FORMATO`, `BOOK_DISPONIBILIDADE`, `BOOK_PUBLICO_ALVO`, `BOOK_IMG`) VALUES
(6, 0, 'Teste', 'Miguel', '2023-11-01', 60.00, 100.00, 'GIlberto', 'ficcao', 1, 'portugues', 'capa-dura', 'estoque', 'criancas', NULL),
(7, 0, 'Teste', 'Miguel', '2023-11-01', 60.00, 100.00, 'GIlberto', 'ficcao', 2, 'portugues', 'capa-dura', 'estoque', 'criancas', NULL),
(8, 0, 'Livro', 'Kaike', '2022-07-04', 200.00, 230.00, 'Reginaldo', 'aventura', 3, 'espanhol', 'capa-dura', 'estoque', 'adultos', NULL),
(9, 0, 'Livro', 'Kaike', '2022-07-04', 200.00, 230.00, 'Reginaldo', 'aventura', 4, 'espanhol', 'capa-dura', 'estoque', 'adultos', NULL),
(10, 0, 'Pedro 2', 'Duda', '2017-06-20', 40.00, 60.00, 'Mariana', 'amor', 5, 'portugues', 'capa-dura', 'pre-venda', 'criancas', NULL),
(11, 0, 'Batata', 'Miguel', '2023-11-02', 400.00, 401.00, 'Maria', 'religiao', 5, 'ingles', 'capa-dura', 'estoque', 'adultos', NULL),
(12, 0, 'Banana. O retorno', 'Maria', '2023-11-04', 400.00, 402.00, 'Miguel Editors', 'religiao', 5, 'ingles', 'capa-dura', 'pre-venda', 'adultos', NULL),
(13, 0, 'Brocolis 3', 'Flavio', '2023-11-02', 100.00, 102.00, 'Adeline Livros', 'misterio-suspense', 4, 'espanhol', 'capa-flexivel', 'estoque', 'adolecentes', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `bz_user`
--

CREATE TABLE `bz_user` (
  `USER_ID` int(11) NOT NULL,
  `USER_TYPE` tinyint(1) NOT NULL,
  `USER_STATUS` varchar(50) DEFAULT NULL,
  `USER_CPFCNPJ` varchar(14) DEFAULT NULL,
  `USER_NAME` varchar(255) DEFAULT NULL,
  `USER_EMAIL` varchar(255) DEFAULT NULL,
  `USER_PASSWORD` varchar(255) DEFAULT NULL,
  `USER_REGISTER_TIME` timestamp NOT NULL DEFAULT current_timestamp(),
  `USER_RG` varchar(14) DEFAULT NULL,
  `USER_DTNASC` date DEFAULT NULL,
  `USER_CEP` varchar(14) DEFAULT NULL,
  `USER_END` varchar(55) DEFAULT NULL,
  `USER_ENDNUM` varchar(14) DEFAULT NULL,
  `USER_UF` varchar(2) DEFAULT NULL,
  `USER_CIDADE` varchar(55) DEFAULT NULL,
  `USER_BAIRRO` varchar(55) DEFAULT NULL,
  `USER_COMPLE` varchar(55) DEFAULT NULL,
  `USER_TEL` varchar(14) DEFAULT NULL,
  `USER_CEL` varchar(14) DEFAULT NULL,
  `USER_EMAIL_CON` varchar(55) DEFAULT NULL,
  `USER_EMAIL2_CON` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `bz_user`
--

INSERT INTO `bz_user` (`USER_ID`, `USER_TYPE`, `USER_STATUS`, `USER_CPFCNPJ`, `USER_NAME`, `USER_EMAIL`, `USER_PASSWORD`, `USER_REGISTER_TIME`, `USER_RG`, `USER_DTNASC`, `USER_CEP`, `USER_END`, `USER_ENDNUM`, `USER_UF`, `USER_CIDADE`, `USER_BAIRRO`, `USER_COMPLE`, `USER_TEL`, `USER_CEL`, `USER_EMAIL_CON`, `USER_EMAIL2_CON`) VALUES
(3, 1, '1', NULL, 'admin.teste', 'admin@gmail', '$2y$10$hxOudpePkkRAdJOBqTs58Ojatb2Yz4PoX8tjp8Lel1SwWOYAqIEZK', '2023-10-16 19:17:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 1, '1', '2147483647', 'tereza', 'aa@rr', '$2y$10$/uXheRDwxnwCqC0sHTidauDo9FzisDAQWRiZsyqsN0.8oBjAXqJeq', '2023-10-27 19:24:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 0, '1', '2147483647', 'Miguel', 'miguelanperibeiro@gmail.com', '$2y$10$HtVuuW35CQTo0FAUDqclh.1RWXIasr.K3ZUtkjQ6pW34KlB0MHbni', '2023-10-27 19:28:45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 1, '1', '2147483647', 'admin', 'admin@gmail.com', '$2y$10$CSUiSyITl0tR48StzwJgsuaM9Up2K1U03iQq.kzNQobyt4pD2/c6u', '2023-10-30 18:41:31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 1, '1', '22333444111100', 'teste', 'teste@teste', '$2y$10$0QH/V7nn6Hd9uNh4TmJCDuncUsW4MtgnWdTxA64/.5g0eBTRiVoz2', '2023-10-30 18:47:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 1, '1', '33333333333333', 'CNPJ', 'cnpj@gmail', '$2y$10$ZkDXuhBGWge9RbvHFneR1O.CW0zfSlLipWuY5hokaPnAzzNY9aKEm', '2023-10-30 18:58:54', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Acionadores `bz_user`
--
DELIMITER $$
CREATE TRIGGER `set_user_status` BEFORE INSERT ON `bz_user` FOR EACH ROW BEGIN
    SET NEW.USER_STATUS = 1;
END
$$
DELIMITER ;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `bz_book`
--
ALTER TABLE `bz_book`
  ADD PRIMARY KEY (`BOOK_ID`);

--
-- Índices de tabela `bz_user`
--
ALTER TABLE `bz_user`
  ADD PRIMARY KEY (`USER_ID`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `bz_book`
--
ALTER TABLE `bz_book`
  MODIFY `BOOK_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `bz_user`
--
ALTER TABLE `bz_user`
  MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
