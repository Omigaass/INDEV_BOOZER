-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16/10/2023 às 22:46
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

--
-- Despejando dados para a tabela `bz_book`
--

INSERT INTO `bz_book` (`BOOK_ID`, `BOOK_TITULO`, `BOOK_AUTOR`, `BOOK_ANO_PUBLICACAO`, `BOOK_PRECO`, `BOOK_PRECO_DESC`, `BOOK_EDITORA`, `BOOK_GENERO`, `BOOK_CLASSIFICACAO`, `BOOK_IDIOMA`, `BOOK_FORMATO`, `BOOK_DISPONIBILIDADE`, `BOOK_PUBLICO_ALVO`, `IMG_ID`) VALUES
(1, 'teste', 'autor teste', '2023-01-01', 200.00, NULL, 'editora teste', 'romance', 0, 'Português', 'E-book', 'Em Estoque', 'Adolescentes', NULL),
(3, 'B', 'B', '2023-10-01', 1000.00, 2000.00, 'B', 'ficcao', 0, 'Inglês', 'Capa Dura', 'Em Estoque', 'Crianças', NULL);

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
  `USER_NAME` varchar(255) DEFAULT NULL,
  `USER_EMAIL` varchar(255) DEFAULT NULL,
  `USER_PASSWORD` varchar(255) DEFAULT NULL,
  `USER_REGISTER_TIME` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `bz_user`
--

INSERT INTO `bz_user` (`USER_ID`, `USER_TYPE`, `USER_NAME`, `USER_EMAIL`, `USER_PASSWORD`, `USER_REGISTER_TIME`) VALUES
(3, 1, 'admin.teste', 'admin@gmail', '$2y$10$hxOudpePkkRAdJOBqTs58Ojatb2Yz4PoX8tjp8Lel1SwWOYAqIEZK', '2023-10-16 19:17:36'),
(4, 0, 'user.teste', 'user@gmail', '$2y$10$z7N6Wg342jiaBs6p3lohT.4cDmor2nI5BrEr0nR8b/1YsDfzj.1uK', '2023-10-16 19:21:27');

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
  MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
