-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 15-Mar-2020 às 17:37
-- Versão do servidor: 10.3.16-MariaDB
-- versão do PHP: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `caixa`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `despesas`
--

CREATE TABLE `despesas` (
  `id` int(11) NOT NULL,
  `descricao` varchar(150) DEFAULT NULL,
  `data_despesa` varchar(50) DEFAULT NULL,
  `data1` varchar(10) DEFAULT NULL,
  `data2` varchar(10) DEFAULT NULL,
  `data3` varchar(10) DEFAULT NULL,
  `valor` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `despesas`
--

INSERT INTO `despesas` (`id`, `descricao`, `data_despesa`, `data1`, `data2`, `data3`, `valor`) VALUES
(18, 'Pagar as puta\n', '15/03/2020', '15', '3', '2020', 150),
(19, 'Ãˆ sÃ©rio tem que pagar mesmo \n', '15/03/2020', '15', '3', '2020', 100);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) DEFAULT NULL,
  `codigo` varchar(50) DEFAULT NULL,
  `valor` varchar(50) DEFAULT NULL,
  `medida` varchar(50) DEFAULT NULL,
  `data_cadastro` varchar(30) DEFAULT NULL,
  `quantidade` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `codigo`, `valor`, `medida`, `data_cadastro`, `quantidade`) VALUES
(71, 'Aveia', '2020', '4,90', 'Peso', '14/03/2020', '10'),
(72, 'PÃªra', '1010', '10,20', 'Peso', '14/03/2020', '20'),
(73, 'Sal do Himalaia', '3030', '9,80', 'Peso', '14/03/2020', '100'),
(74, 'Banana', '4040', '4,45', 'Peso', '14/03/2020', '100'),
(75, 'MaÃ§Ã¢', '1020', '8,20', 'Peso', '14/03/2020', '40');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `json` text NOT NULL,
  `total` double NOT NULL,
  `gateway` varchar(32) NOT NULL,
  `total_change` double NOT NULL,
  `day` varchar(10) NOT NULL,
  `month` varchar(10) NOT NULL,
  `year` varchar(10) NOT NULL,
  `date` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `sales`
--

INSERT INTO `sales` (`id`, `json`, `total`, `gateway`, `total_change`, `day`, `month`, `year`, `date`) VALUES
(31, '{\"1020\": {\"name\":\"MaÃ§Ã¢\",\"code\":1020,\"unity\":\"20.00\",\"price\":\"164.00\"},\"2020\": {\"name\":\"Aveia\",\"code\":2020,\"unity\":\"10\",\"price\":\"49\"},\"3030\": {\"name\":\"Sal do Himalaia\",\"code\":3030,\"unity\":\"10\",\"price\":\"98\"},\"4040\": {\"name\":\"Banana\",\"code\":4040,\"unity\":\"10\",\"price\":\"44.5\"}}', 355.5, 'Dinheiro', 10755.5, '15', '3', '2020', '15/03/2020'),
(30, '{\"1010\": {\"name\":\"PÃªra\",\"code\":1010,\"unity\":\"1\",\"price\":\"10.2\"},\"2020\": {\"name\":\"Aveia\",\"code\":2020,\"unity\":\"1\",\"price\":\"4.9\"},\"3030\": {\"name\":\"Sal do Himalaia\",\"code\":3030,\"unity\":\"1\",\"price\":\"9.8\"},\"4040\": {\"name\":\"Banana\",\"code\":4040,\"unity\":\"1\",\"price\":\"4.45\"},\"1020\": {\"name\":\"MaÃ§Ã¢\",\"code\":1020,\"unity\":\"1\",\"price\":\"8.2\"}}', 37.55, 'CartÃ£o', 37.55, '15', '3', '2020', '15/03/2020');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `senha` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `nome`, `email`, `senha`) VALUES
(1, 'admin', 'jaksuu', '123');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `despesas`
--
ALTER TABLE `despesas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `despesas`
--
ALTER TABLE `despesas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT de tabela `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
