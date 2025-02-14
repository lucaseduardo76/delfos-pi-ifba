-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06/02/2025 às 03:32
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `delfosdb`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `agenda_aula`
--

CREATE TABLE `agenda_aula` (
  `id` int(11) NOT NULL,
  `data` date NOT NULL,
  `hora` varchar(10) NOT NULL,
  `aluno` int(11) NOT NULL,
  `professor` int(11) NOT NULL,
  `confirmada` tinyint(1) NOT NULL DEFAULT 0,
  `dificuldade_aluno` text NOT NULL,
  `link_aula` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `areas`
--

CREATE TABLE `areas` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `mensagem_destinatario`
--

CREATE TABLE `mensagem_destinatario` (
  `id` int(11) NOT NULL,
  `titulo` varchar(45) NOT NULL,
  `corpo` text NOT NULL,
  `remetente` int(11) NOT NULL,
  `destinatario` int(11) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `mensagem_remetente`
--

CREATE TABLE `mensagem_remetente` (
  `id` int(11) NOT NULL,
  `titulo` varchar(45) NOT NULL,
  `corpo` text NOT NULL,
  `remetente` int(11) NOT NULL,
  `destinatario` int(11) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `professor_aluno`
--

CREATE TABLE `professor_aluno` (
  `professor_id` int(11) NOT NULL,
  `aluno_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_professor`
--

CREATE TABLE `tb_professor` (
  `id` int(11) NOT NULL,
  `preco_aula` decimal(10,2) NOT NULL,
  `area` int(11) DEFAULT NULL,
  `quantidade_aulas_aplicadas` int(11) NOT NULL,
  `descricao` text DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `senha` varchar(60) NOT NULL,
  `telefone` varchar(30) DEFAULT NULL,
  `linkFoto` varchar(100) DEFAULT NULL,
  `token` varchar(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `agenda_aula`
--
ALTER TABLE `agenda_aula`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_agenda_aluno` (`aluno`),
  ADD KEY `fk_agenda_professor` (`professor`);

--
-- Índices de tabela `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `mensagem_destinatario`
--
ALTER TABLE `mensagem_destinatario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `remetente` (`remetente`),
  ADD KEY `destinatario` (`destinatario`);

--
-- Índices de tabela `mensagem_remetente`
--
ALTER TABLE `mensagem_remetente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `remetente` (`remetente`),
  ADD KEY `destinatario` (`destinatario`);

--
-- Índices de tabela `professor_aluno`
--
ALTER TABLE `professor_aluno`
  ADD PRIMARY KEY (`professor_id`,`aluno_id`),
  ADD KEY `aluno_id` (`aluno_id`);

--
-- Índices de tabela `tb_professor`
--
ALTER TABLE `tb_professor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `fk_area` (`area`);

--
-- Índices de tabela `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agenda_aula`
--
ALTER TABLE `agenda_aula`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `areas`
--
ALTER TABLE `areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `mensagem_destinatario`
--
ALTER TABLE `mensagem_destinatario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `mensagem_remetente`
--
ALTER TABLE `mensagem_remetente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_professor`
--
ALTER TABLE `tb_professor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `agenda_aula`
--
ALTER TABLE `agenda_aula`
  ADD CONSTRAINT `fk_agenda_aluno` FOREIGN KEY (`aluno`) REFERENCES `tb_user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_agenda_professor` FOREIGN KEY (`professor`) REFERENCES `tb_professor` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `mensagem_destinatario`
--
ALTER TABLE `mensagem_destinatario`
  ADD CONSTRAINT `mensagem_destinatario_ibfk_1` FOREIGN KEY (`remetente`) REFERENCES `tb_user` (`id`),
  ADD CONSTRAINT `mensagem_destinatario_ibfk_2` FOREIGN KEY (`destinatario`) REFERENCES `tb_user` (`id`);

--
-- Restrições para tabelas `mensagem_remetente`
--
ALTER TABLE `mensagem_remetente`
  ADD CONSTRAINT `mensagem_remetente_ibfk_1` FOREIGN KEY (`remetente`) REFERENCES `tb_user` (`id`),
  ADD CONSTRAINT `mensagem_remetente_ibfk_2` FOREIGN KEY (`destinatario`) REFERENCES `tb_user` (`id`);

--
-- Restrições para tabelas `professor_aluno`
--
ALTER TABLE `professor_aluno`
  ADD CONSTRAINT `professor_aluno_ibfk_1` FOREIGN KEY (`professor_id`) REFERENCES `tb_professor` (`id`),
  ADD CONSTRAINT `professor_aluno_ibfk_2` FOREIGN KEY (`aluno_id`) REFERENCES `tb_user` (`id`);

--
-- Restrições para tabelas `tb_professor`
--
ALTER TABLE `tb_professor`
  ADD CONSTRAINT `fk_area` FOREIGN KEY (`area`) REFERENCES `areas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_professor_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tb_user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
