-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 31/10/2023 às 21:40
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
  `IMG_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `bz_image`
--

CREATE TABLE `bz_image` (
  `IMG_ID` int(11) NOT NULL,
  `IMG_NAME` varchar(255) NOT NULL,
  `IMG_TYPE` varchar(100) NOT NULL,
  `IMG_INFO` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `USER_REGISTER_TIME` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `bz_user`
--

INSERT INTO `bz_user` (`USER_ID`, `USER_TYPE`, `USER_STATUS`, `USER_CPFCNPJ`, `USER_NAME`, `USER_EMAIL`, `USER_PASSWORD`, `USER_REGISTER_TIME`) VALUES
(3, 1, '1', NULL, 'admin.teste', 'admin@gmail', '$2y$10$hxOudpePkkRAdJOBqTs58Ojatb2Yz4PoX8tjp8Lel1SwWOYAqIEZK', '2023-10-16 19:17:36'),
(19, 1, '1', '2147483647', 'tereza', 'aa@rr', '$2y$10$/uXheRDwxnwCqC0sHTidauDo9FzisDAQWRiZsyqsN0.8oBjAXqJeq', '2023-10-27 19:24:19'),
(20, 0, '1', '2147483647', 'Miguel', 'miguelanperibeiro@gmail.com', '$2y$10$HtVuuW35CQTo0FAUDqclh.1RWXIasr.K3ZUtkjQ6pW34KlB0MHbni', '2023-10-27 19:28:45'),
(30, 1, '1', '2147483647', 'admin', 'admin@gmail.com', '$2y$10$CSUiSyITl0tR48StzwJgsuaM9Up2K1U03iQq.kzNQobyt4pD2/c6u', '2023-10-30 18:41:31'),
(31, 1, '1', '22333444111100', 'teste', 'teste@teste', '$2y$10$0QH/V7nn6Hd9uNh4TmJCDuncUsW4MtgnWdTxA64/.5g0eBTRiVoz2', '2023-10-30 18:47:02'),
(32, 1, '1', '33333333333333', 'CNPJ', 'cnpj@gmail', '$2y$10$ZkDXuhBGWge9RbvHFneR1O.CW0zfSlLipWuY5hokaPnAzzNY9aKEm', '2023-10-30 18:58:54'),
(33, 1, '1', '23232323232323', 'teste2', 'teste2@teste', '$2y$10$LoxpWH4kK6ygAj38lC8UOONQw3Zmeu8LAD.D.IJC..KShg9ElwdFe', '2023-10-30 20:38:47'),
(34, 1, '1', '44444444444444', 'Miguel', 'miguel@gmail', '$2y$10$8a6SVMKTlTS5ff6qmAmUx.FTwhTwTtXhK1tnkx.Mqu3CzldbKqNna', '2023-10-30 20:39:58');

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
  ADD PRIMARY KEY (`BOOK_ID`),
  ADD KEY `IMG_ID` (`IMG_ID`);

--
-- Índices de tabela `bz_image`
--
ALTER TABLE `bz_image`
  ADD PRIMARY KEY (`IMG_ID`);

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
  MODIFY `BOOK_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `bz_image`
--
ALTER TABLE `bz_image`
  MODIFY `IMG_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `bz_user`
--
ALTER TABLE `bz_user`
  MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `bz_book`
--
ALTER TABLE `bz_book`
  ADD CONSTRAINT `bz_book_ibfk_1` FOREIGN KEY (`IMG_ID`) REFERENCES `bz_image` (`IMG_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
