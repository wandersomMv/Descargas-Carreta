-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20-Mar-2020 às 04:58
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ponto`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `acordo`
--

CREATE TABLE `acordo` (
  `id` int(11) NOT NULL,
  `temp_acordo` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `doca_acordo` int(11) NOT NULL,
  `nome_emp_acordo` varchar(40) NOT NULL,
  `placa_cart_acordo` varchar(40) NOT NULL,
  `placa_cav_acordo` varchar(40) NOT NULL,
  `valor_carga_acordo` float NOT NULL,
  `origem_acordo` varchar(40) NOT NULL,
  `manifesto_acordo` varchar(40) NOT NULL,
  `qtd_volume_acordo` decimal(10,0) NOT NULL,
  `equipe_acordo` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `acordo`
--

INSERT INTO `acordo` (`id`, `temp_acordo`, `doca_acordo`, `nome_emp_acordo`, `placa_cart_acordo`, `placa_cav_acordo`, `valor_carga_acordo`, `origem_acordo`, `manifesto_acordo`, `qtd_volume_acordo`, `equipe_acordo`) VALUES
(5, '2020-03-20 13:25:00', 5, 'MAIUTONS LTDA', 'NJA-1520', 'NKK-2056', 58, 'BAHIA', '155', '80000', 'Urla, kelyton e valmir ');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `qtd_dias` int(150) NOT NULL,
  `nome_emp` varchar(60) NOT NULL,
  `preco` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id`, `qtd_dias`, `nome_emp`, `preco`) VALUES
(1, 10, 'rede frota', 45),
(2, 22, 'marajo', 45),
(3, 120, 'lojas bandeiras', 45),
(4, 40, 'Ethos', 45),
(5, 50, 'Moda Jovem', 45);

-- --------------------------------------------------------

--
-- Estrutura da tabela `descarga`
--

CREATE TABLE `descarga` (
  `id` int(11) NOT NULL,
  `temp_op` date NOT NULL,
  `doca` int(11) NOT NULL,
  `op_inicio` time NOT NULL,
  `op_fim` time NOT NULL,
  `placa_carreta` varchar(40) NOT NULL,
  `placa_cavalo` varchar(40) NOT NULL,
  `valor_carga` float NOT NULL,
  `origem` varchar(40) NOT NULL,
  `manifesto` varchar(40) NOT NULL,
  `qtd_volume` decimal(10,0) NOT NULL,
  `equipe` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `descarga`
--

INSERT INTO `descarga` (`id`, `temp_op`, `doca`, `op_inicio`, `op_fim`, `placa_carreta`, `placa_cavalo`, `valor_carga`, `origem`, `manifesto`, `qtd_volume`, `equipe`) VALUES
(5, '2020-03-20', 1520, '15:20:00', '15:50:00', 'AAA-3020', 'ABC-2065', 50000, 'GOIÁS', '2020', '2012', 'Abreu, Irineu e Romeu');

-- --------------------------------------------------------

--
-- Estrutura da tabela `feriado`
--

CREATE TABLE `feriado` (
  `id` int(11) NOT NULL,
  `temp_feriado` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `doca_feriado` int(11) NOT NULL,
  `nome_feriado` varchar(60) NOT NULL,
  `placa_carreta_feriado` varchar(40) NOT NULL,
  `placa_cavalo_feriado` varchar(40) NOT NULL,
  `valor_carga_feriado` float NOT NULL,
  `origem_feriado` varchar(40) NOT NULL,
  `manifesto_feriado` varchar(40) NOT NULL,
  `qtd_volume_feriado` decimal(10,0) NOT NULL,
  `equipe_feriado` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `feriado`
--

INSERT INTO `feriado` (`id`, `temp_feriado`, `doca_feriado`, `nome_feriado`, `placa_carreta_feriado`, `placa_cavalo_feriado`, `valor_carga_feriado`, `origem_feriado`, `manifesto_feriado`, `qtd_volume_feriado`, `equipe_feriado`) VALUES
(3, '2020-03-20 13:05:00', 897, 'INDIANA JONES E HAPPY POTER EM BUSCA DO TESOURO FILOSOFAL', 'LLC-8802', 'UTL-8978', 10000, 'BELO HORIZONTE', '25', '2500', 'Paulo, David e Mateus ');

-- --------------------------------------------------------

--
-- Estrutura da tabela `folha`
--

CREATE TABLE `folha` (
  `id` int(11) NOT NULL,
  `funcionario_ponto` varchar(60) NOT NULL,
  `cpf_ponto` int(11) NOT NULL,
  `qtd_dias_trabalho` int(11) NOT NULL,
  `cargo_ponto` varchar(60) NOT NULL,
  `mes_ponto` varchar(40) NOT NULL,
  `ano_ponto` int(11) NOT NULL,
  `qtd_hora_comercial` int(11) NOT NULL,
  `qtd_hora_extra` int(11) NOT NULL,
  `turno_ponto` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `folha`
--

INSERT INTO `folha` (`id`, `funcionario_ponto`, `cpf_ponto`, `qtd_dias_trabalho`, `cargo_ponto`, `mes_ponto`, `ano_ponto`, `qtd_hora_comercial`, `qtd_hora_extra`, `turno_ponto`) VALUES
(1, 'Carla ', 345, 2323, 'admim', 'Janeiro', 2019, 120, 3, 'Vespertino - Noturno'),
(2, 'as', 700, 4, 'd', 'Janeiro', 2020, 4, 4, 'Matutino - Vespertino'),
(3, 'as', 700, 4, 'd', 'Janeiro', 2020, 4, 4, 'Matutino - Vespertino'),
(4, 'a', 700, 2, '2', 'Janeiro', 2, 2, 2, 'Matutino - Vespertino'),
(5, 'a', 700, 2, '2', 'Janeiro', 2, 2, 2, 'Matutino - Vespertino');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `id` int(11) NOT NULL,
  `nome_func` varchar(60) NOT NULL,
  `cpf_func` varchar(15) NOT NULL,
  `rg_func` int(11) NOT NULL,
  `n_conta_func` int(11) NOT NULL,
  `n_pis_func` int(11) NOT NULL,
  `idade_func` date NOT NULL,
  `end_func` varchar(60) NOT NULL,
  `tel_func` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`id`, `nome_func`, `cpf_func`, `rg_func`, `n_conta_func`, `n_pis_func`, `idade_func`, `end_func`, `tel_func`) VALUES
(5, 'funcionario numero 1', '2147483647', 11111, 1111, 11111, '2020-03-01', 'rua número 1', '1111111111'),
(6, 'funcionario numero 2', '2147483647', 22222, 22222, 2222, '2004-02-10', 'rua numero 2 ', '22222'),
(7, 'funcionario numero 3', '333333333', 333, 333, 33, '2003-03-03', 'rua numero 3 ', '333333');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `acordo`
--
ALTER TABLE `acordo`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `descarga`
--
ALTER TABLE `descarga`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `feriado`
--
ALTER TABLE `feriado`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `folha`
--
ALTER TABLE `folha`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `acordo`
--
ALTER TABLE `acordo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `descarga`
--
ALTER TABLE `descarga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `feriado`
--
ALTER TABLE `feriado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `folha`
--
ALTER TABLE `folha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
