-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Tempo de geração: 28/12/2018 às 17:27
-- Versão do servidor: 5.6.37
-- Versão do PHP: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `solarbid_panel`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `dummy` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `audit`
--

CREATE TABLE IF NOT EXISTS `audit` (
  `id` int(11) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `action_desc` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `audit`
--

INSERT INTO `audit` (`id`, `ip`, `action_desc`, `created_at`, `user_id`) VALUES
(1, '::1', 'Efetuou login', '2018-12-21 13:46:28', 1),
(2, '::1', 'Efetuou login', '2018-12-21 16:51:07', 1),
(3, '::1', 'Efetuou login', '2018-12-21 17:12:18', 1),
(4, '::1', 'Efetuou login', '2018-12-26 13:00:19', 1),
(5, '::1', 'Efetuou login', '2018-12-26 13:35:51', 1),
(6, '::1', 'Efetuou login', '2018-12-26 16:40:00', 1),
(7, '::1', 'Efetuou login', '2018-12-26 16:59:39', 1),
(8, '::1', 'Efetuou login', '2018-12-28 16:07:41', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `core`
--

CREATE TABLE IF NOT EXISTS `core` (
  `id` int(11) NOT NULL,
  `version` char(10) NOT NULL DEFAULT '0',
  `domain` varchar(65) NOT NULL,
  `contact` varchar(80) NOT NULL,
  `do_not_reply` varchar(65) NOT NULL,
  `currency` varchar(20) NOT NULL DEFAULT 'BRL',
  `language` varchar(10) NOT NULL DEFAULT 'pt-BR'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `core`
--

INSERT INTO `core` (`id`, `version`, `domain`, `contact`, `do_not_reply`, `currency`, `language`) VALUES
(1, '0.0.1', 'http://localhost/', 'solarbid@ownergy.com.br', 'naoresponda@solarbid.com.br', 'BRL', 'pt-BR');

-- --------------------------------------------------------

--
-- Estrutura para tabela `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `id` int(11) NOT NULL,
  `description` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `country`
--

INSERT INTO `country` (`id`, `description`) VALUES
(1, 'Brasil');

-- --------------------------------------------------------

--
-- Estrutura para tabela `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `dummy` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `fisical_person`
--

CREATE TABLE IF NOT EXISTS `fisical_person` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `nickname` varchar(45) NOT NULL,
  `social_security` varchar(45) NOT NULL,
  `national_card` varchar(45) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `integrator`
--

CREATE TABLE IF NOT EXISTS `integrator` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `dummy` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `language`
--

CREATE TABLE IF NOT EXISTS `language` (
  `id` int(11) NOT NULL,
  `description` varchar(45) NOT NULL,
  `code` varchar(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `language`
--

INSERT INTO `language` (`id`, `description`, `code`) VALUES
(1, 'Português brasileiro', 'pt-BR');

-- --------------------------------------------------------

--
-- Estrutura para tabela `legal_person`
--

CREATE TABLE IF NOT EXISTS `legal_person` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `registered_number` varchar(45) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `log_application`
--

CREATE TABLE IF NOT EXISTS `log_application` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `log_server`
--

CREATE TABLE IF NOT EXISTS `log_server` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `log_user`
--

CREATE TABLE IF NOT EXISTS `log_user` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `log_user`
--

INSERT INTO `log_user` (`id`, `description`, `created_at`, `user_id`) VALUES
(1, 'Efetuou login na plataforma', '2018-12-21 13:46:28', 1),
(2, 'Efetuou login na plataforma', '2018-12-21 16:51:07', 1),
(3, 'Efetuou login na plataforma', '2018-12-21 17:12:18', 1),
(4, 'Efetuou login na plataforma', '2018-12-26 13:00:19', 1),
(5, 'Efetuou login na plataforma', '2018-12-26 13:35:51', 1),
(6, 'Efetuou login na plataforma', '2018-12-26 16:40:00', 1),
(7, 'Efetuou login na plataforma', '2018-12-26 16:59:39', 1),
(8, 'Efetuou login na plataforma', '2018-12-28 16:07:41', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `registry_type`
--

CREATE TABLE IF NOT EXISTS `registry_type` (
  `id` int(11) NOT NULL,
  `description` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `registry_type`
--

INSERT INTO `registry_type` (`id`, `description`) VALUES
(1, 'fisical_person'),
(2, 'legal_person');

-- --------------------------------------------------------

--
-- Estrutura para tabela `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL,
  `description` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `role`
--

INSERT INTO `role` (`id`, `description`) VALUES
(1, 'admin'),
(2, 'customer'),
(3, 'integrator');

-- --------------------------------------------------------

--
-- Estrutura para tabela `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `role_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `registry_type_id` int(11) NOT NULL,
  `mail_notification` varchar(10000) NOT NULL DEFAULT '{"loggedIn":true,"passwordChanged":true}',
  `activated` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Ativação por e-mail'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `created_at`, `updated_at`, `role_id`, `country_id`, `language_id`, `registry_type_id`, `mail_notification`, `activated`) VALUES
(1, 'thiago', '$2y$10$Ojpb8dZJNNpePUGp1nxbpu5JyDbI2JNTGFz7ynXTfpB68dVaNuSrm', 'thiagopac@gmail.com', '2018-11-29 17:35:20', '2018-12-26 13:00:04', 1, 1, 1, 1, '{"loggedIn":true,"passwordChanged":false}', 1),
(2, 'cliente', '$2y$10$Z7LiFGwms5bxVZWllxgR2er56XcM4EGiz4kycK7XcGLtZ97eMjO4O', 'cliente@cliente.com.br', '2018-12-03 19:15:59', '2018-12-03 19:28:54', 2, 1, 1, 1, '{"loggedIn":true,"passwordChanged":true}', 1),
(3, 'empresa', '$2y$10$EvhRtf02r1JWtDVp4QxyOeRdyvrVbKt4z6rgVbbsdgNIZ71XNdsvG', 'empresa@empresa.com.br', '2018-12-03 19:28:31', '2018-12-03 19:29:32', 3, 1, 1, 2, '{"loggedIn":true,"passwordChanged":true}', 1);

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_admin_user1_idx` (`user_id`);

--
-- Índices de tabela `audit`
--
ALTER TABLE `audit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_audit_user1_idx` (`user_id`);

--
-- Índices de tabela `core`
--
ALTER TABLE `core`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_customer_user1_idx` (`user_id`);

--
-- Índices de tabela `fisical_person`
--
ALTER TABLE `fisical_person`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_fisical_person_user1_idx` (`user_id`);

--
-- Índices de tabela `integrator`
--
ALTER TABLE `integrator`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_provider_user1_idx` (`user_id`);

--
-- Índices de tabela `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `legal_person`
--
ALTER TABLE `legal_person`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_legal_person_user1_idx` (`user_id`);

--
-- Índices de tabela `log_application`
--
ALTER TABLE `log_application`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `log_server`
--
ALTER TABLE `log_server`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `log_user`
--
ALTER TABLE `log_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_log_user_user1_idx` (`user_id`);

--
-- Índices de tabela `registry_type`
--
ALTER TABLE `registry_type`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_role_idx` (`role_id`),
  ADD KEY `fk_user_country1_idx` (`country_id`),
  ADD KEY `fk_user_language1_idx` (`language_id`),
  ADD KEY `fk_user_registry_type1_idx` (`registry_type_id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `audit`
--
ALTER TABLE `audit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de tabela `core`
--
ALTER TABLE `core`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de tabela `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de tabela `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `fisical_person`
--
ALTER TABLE `fisical_person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `integrator`
--
ALTER TABLE `integrator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `language`
--
ALTER TABLE `language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de tabela `legal_person`
--
ALTER TABLE `legal_person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `log_application`
--
ALTER TABLE `log_application`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `log_server`
--
ALTER TABLE `log_server`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `log_user`
--
ALTER TABLE `log_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de tabela `registry_type`
--
ALTER TABLE `registry_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de tabela `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `fk_admin_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `audit`
--
ALTER TABLE `audit`
  ADD CONSTRAINT `fk_audit_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `fk_customer_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `fisical_person`
--
ALTER TABLE `fisical_person`
  ADD CONSTRAINT `fk_fisical_person_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `integrator`
--
ALTER TABLE `integrator`
  ADD CONSTRAINT `fk_provider_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `legal_person`
--
ALTER TABLE `legal_person`
  ADD CONSTRAINT `fk_legal_person_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `log_user`
--
ALTER TABLE `log_user`
  ADD CONSTRAINT `fk_log_user_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_country1` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_language1` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_registry_type1` FOREIGN KEY (`registry_type_id`) REFERENCES `registry_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_role` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
