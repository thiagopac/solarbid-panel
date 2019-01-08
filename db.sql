-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 08-Jan-2019 às 02:23
-- Versão do servidor: 5.6.37
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `solarbid_panel`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `dummy` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `auction`
--

CREATE TABLE IF NOT EXISTS `auction` (
  `id` int(11) NOT NULL,
  `owner` int(11) NOT NULL,
  `winner` int(11) DEFAULT NULL,
  `desired_value` decimal(10,2) DEFAULT NULL,
  `currency_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `auction`
--

INSERT INTO `auction` (`id`, `owner`, `winner`, `desired_value`, `currency_id`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 2500.00, 1, '2019-01-07 18:39:06', '2019-01-07 18:40:05');

-- --------------------------------------------------------

--
-- Estrutura da tabela `audit`
--

CREATE TABLE IF NOT EXISTS `audit` (
  `id` int(11) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `action_desc` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `audit`
--

INSERT INTO `audit` (`id`, `ip`, `action_desc`, `created_at`, `user_id`) VALUES
(1, '::1', 'Se cadastrou', '2018-12-28 19:39:51', 4),
(2, '::1', 'Ativou a conta', '2018-12-28 19:40:53', 4),
(3, '::1', 'Efetuou login', '2018-12-28 19:41:48', 4),
(4, '::1', 'Ativou a conta', '2018-12-28 19:43:02', 4),
(5, '::1', 'Alterou a senha', '2018-12-28 19:44:46', 4),
(6, '::1', 'Efetuou login', '2019-01-07 18:21:31', 1),
(7, '::1', 'Efetuou login', '2019-01-07 21:39:59', 1),
(8, '::1', 'Efetuou login', '2019-01-07 22:26:10', 1),
(9, '::1', 'Efetuou login', '2019-01-07 23:04:12', 1),
(10, '::1', 'Efetuou login', '2019-01-07 23:06:17', 1),
(11, '::1', 'Efetuou login', '2019-01-07 23:06:40', 1),
(12, '::1', 'Efetuou login', '2019-01-07 23:06:54', 1),
(13, '::1', 'Efetuou login', '2019-01-07 23:07:30', 1),
(14, '::1', 'Efetuou login', '2019-01-07 23:12:20', 1),
(15, '::1', 'Efetuou login', '2019-01-08 02:00:00', 1),
(16, '::1', 'Efetuou login', '2019-01-08 02:02:18', 1),
(17, '::1', 'Efetuou login', '2019-01-08 02:02:57', 1),
(18, '::1', 'Efetuou login', '2019-01-08 02:15:49', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `bid`
--

CREATE TABLE IF NOT EXISTS `bid` (
  `id` int(11) NOT NULL,
  `value` decimal(10,2) NOT NULL,
  `bidder` int(11) NOT NULL,
  `auction_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'CURRENT_TIMESTAMP'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `bid`
--

INSERT INTO `bid` (`id`, `value`, `bidder`, `auction_id`, `created_at`) VALUES
(1, 8750.00, 3, 1, '2019-01-07 18:40:45');

-- --------------------------------------------------------

--
-- Estrutura da tabela `core`
--

CREATE TABLE IF NOT EXISTS `core` (
  `id` int(11) NOT NULL,
  `version` char(10) NOT NULL DEFAULT '0',
  `domain` varchar(65) NOT NULL,
  `contact` varchar(80) NOT NULL,
  `do_not_reply` varchar(65) NOT NULL,
  `language` varchar(10) NOT NULL DEFAULT 'pt_BR'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `core`
--

INSERT INTO `core` (`id`, `version`, `domain`, `contact`, `do_not_reply`, `language`) VALUES
(1, '0.0.1', 'http://localhost/', 'solarbid@ownergy.com.br', 'naoresponda@solarbid.com.br', 'pt_BR');

-- --------------------------------------------------------

--
-- Estrutura da tabela `currency`
--

CREATE TABLE IF NOT EXISTS `currency` (
  `id` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `name` varchar(45) NOT NULL,
  `symbol` varchar(45) NOT NULL,
  `locale` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `currency`
--

INSERT INTO `currency` (`id`, `code`, `name`, `symbol`, `locale`) VALUES
(1, 'BRL', 'Real brasileiro', 'R$', 'pt_BR');

-- --------------------------------------------------------

--
-- Estrutura da tabela `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `dummy` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fisical_person`
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
-- Estrutura da tabela `integrator`
--

CREATE TABLE IF NOT EXISTS `integrator` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `dummy` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `legal_person`
--

CREATE TABLE IF NOT EXISTS `legal_person` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `registered_number` varchar(45) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `log_application`
--

CREATE TABLE IF NOT EXISTS `log_application` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `type` varchar(10) DEFAULT 'info',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `log_application`
--

INSERT INTO `log_application` (`id`, `description`, `type`, `created_at`) VALUES
(1, 'Funcionalidade de configuração de alertas por e-mail liberada em breve.', 'info', '2019-01-08 02:10:19'),
(2, '11 bugs foram corrigidos', 'warning', '2019-01-08 02:10:19');

-- --------------------------------------------------------

--
-- Estrutura da tabela `log_server`
--

CREATE TABLE IF NOT EXISTS `log_server` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `type` varchar(10) DEFAULT 'info',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `log_server`
--

INSERT INTO `log_server` (`id`, `description`, `type`, `created_at`) VALUES
(1, 'Manutenção do servidor entre 10h e 12h de domingo (14/01/2019)', 'warning', '2019-01-08 02:11:50'),
(2, 'Instabilidade detectada nos servidores entre 01/01/2019 e 05/01/2019', 'danger', '2019-01-08 02:11:50');

-- --------------------------------------------------------

--
-- Estrutura da tabela `log_user`
--

CREATE TABLE IF NOT EXISTS `log_user` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `log_user`
--

INSERT INTO `log_user` (`id`, `description`, `created_at`, `user_id`) VALUES
(1, 'Efetuou login na plataforma', '2018-12-28 19:41:48', 4),
(2, 'Efetuou login na plataforma', '2019-01-07 18:21:31', 1),
(3, 'Efetuou login na plataforma', '2019-01-07 21:39:59', 1),
(4, 'Efetuou login na plataforma', '2019-01-07 22:26:10', 1),
(5, 'Efetuou login na plataforma', '2019-01-07 23:04:12', 1),
(6, 'Efetuou login na plataforma', '2019-01-07 23:06:17', 1),
(7, 'Efetuou login na plataforma', '2019-01-07 23:06:40', 1),
(8, 'Efetuou login na plataforma', '2019-01-07 23:06:54', 1),
(9, 'Efetuou login na plataforma', '2019-01-07 23:07:30', 1),
(10, 'Efetuou login na plataforma', '2019-01-07 23:12:20', 1),
(11, 'Efetuou login na plataforma', '2019-01-08 02:00:00', 1),
(12, 'Efetuou login na plataforma', '2019-01-08 02:02:18', 1),
(13, 'Efetuou login na plataforma', '2019-01-08 02:02:57', 1),
(14, 'Efetuou login na plataforma', '2019-01-08 02:15:49', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `type` varchar(10) DEFAULT 'info',
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `notification`
--

INSERT INTO `notification` (`id`, `description`, `created_at`, `type`, `status`) VALUES
(1, 'Notificação de teste 1', '2019-01-07 18:37:11', 'danger', 'Cuidado'),
(2, 'Notificação de teste 2', '2019-01-07 18:37:30', 'warning', 'Atenção');

-- --------------------------------------------------------

--
-- Estrutura da tabela `registry_type`
--

CREATE TABLE IF NOT EXISTS `registry_type` (
  `id` int(11) NOT NULL,
  `description` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `registry_type`
--

INSERT INTO `registry_type` (`id`, `description`) VALUES
(1, 'fisical_person'),
(2, 'legal_person');

-- --------------------------------------------------------

--
-- Estrutura da tabela `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL,
  `description` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `role`
--

INSERT INTO `role` (`id`, `description`) VALUES
(1, 'admin'),
(2, 'customer'),
(3, 'integrator');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `role_id` int(11) NOT NULL,
  `language` varchar(10) NOT NULL DEFAULT 'pt_BR',
  `registry_type_id` int(11) NOT NULL,
  `mail_notification` varchar(10000) NOT NULL DEFAULT '{"loggedIn":true,"passwordChanged":true}',
  `activated` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Ativação por e-mail',
  `country` varchar(45) NOT NULL DEFAULT 'Brasil'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `created_at`, `updated_at`, `role_id`, `language`, `registry_type_id`, `mail_notification`, `activated`, `country`) VALUES
(1, 'thiago', '$2y$10$Ojpb8dZJNNpePUGp1nxbpu5JyDbI2JNTGFz7ynXTfpB68dVaNuSrm', 'thiagopac@gmail.com', '2018-11-29 17:35:20', '2019-01-08 02:15:31', 1, 'pt_BR', 1, '[{"name":"loggedIn","state":true},{"name":"passwordChanged","state":true}]', 1, 'Brasil'),
(2, 'cliente', '$2y$10$Z7LiFGwms5bxVZWllxgR2er56XcM4EGiz4kycK7XcGLtZ97eMjO4O', 'cliente@cliente.com.br', '2018-12-03 19:15:59', '2019-01-08 01:59:41', 2, 'pt_BR', 1, '[{"name":"loggedIn","state":true},{"name":"passwordChanged","state":true}]', 1, 'Brasil'),
(3, 'empresa', '$2y$10$EvhRtf02r1JWtDVp4QxyOeRdyvrVbKt4z6rgVbbsdgNIZ71XNdsvG', 'empresa@empresa.com.br', '2018-12-03 19:28:31', '2019-01-08 01:59:43', 3, 'pt_BR', 2, '[{"name":"loggedIn","state":true},{"name":"passwordChanged","state":true}]', 1, 'Brasil'),
(4, 'ingred', '$2y$10$4tsZq8ecA1p4VsGoNqw.Zu.J/I4eLyRwgX4YQs1pkhSBoNCRhiolC', 'thiago.pires@ownergy.com.br', '2018-12-28 19:39:50', '2019-01-08 01:59:44', 2, 'pt_BR', 1, '[{"name":"loggedIn","state":true},{"name":"passwordChanged","state":true}]', 1, 'Brasil');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_admin_user1_idx` (`user_id`);

--
-- Indexes for table `auction`
--
ALTER TABLE `auction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_auction_user1_idx` (`owner`),
  ADD KEY `fk_auction_user2_idx` (`winner`),
  ADD KEY `fk_auction_currency1_idx` (`currency_id`);

--
-- Indexes for table `audit`
--
ALTER TABLE `audit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_audit_user1_idx` (`user_id`);

--
-- Indexes for table `bid`
--
ALTER TABLE `bid`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_bid_user1_idx` (`bidder`),
  ADD KEY `fk_bid_auction1_idx` (`auction_id`);

--
-- Indexes for table `core`
--
ALTER TABLE `core`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_customer_user1_idx` (`user_id`);

--
-- Indexes for table `fisical_person`
--
ALTER TABLE `fisical_person`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_fisical_person_user1_idx` (`user_id`);

--
-- Indexes for table `integrator`
--
ALTER TABLE `integrator`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_provider_user1_idx` (`user_id`);

--
-- Indexes for table `legal_person`
--
ALTER TABLE `legal_person`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_legal_person_user1_idx` (`user_id`);

--
-- Indexes for table `log_application`
--
ALTER TABLE `log_application`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_server`
--
ALTER TABLE `log_server`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_user`
--
ALTER TABLE `log_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_log_user_user1_idx` (`user_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registry_type`
--
ALTER TABLE `registry_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_role_idx` (`role_id`),
  ADD KEY `fk_user_registry_type1_idx` (`registry_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `auction`
--
ALTER TABLE `auction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `audit`
--
ALTER TABLE `audit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `bid`
--
ALTER TABLE `bid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `core`
--
ALTER TABLE `core`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fisical_person`
--
ALTER TABLE `fisical_person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `integrator`
--
ALTER TABLE `integrator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `legal_person`
--
ALTER TABLE `legal_person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `log_application`
--
ALTER TABLE `log_application`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `log_server`
--
ALTER TABLE `log_server`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `log_user`
--
ALTER TABLE `log_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `registry_type`
--
ALTER TABLE `registry_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `fk_admin_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `auction`
--
ALTER TABLE `auction`
  ADD CONSTRAINT `fk_action_user2` FOREIGN KEY (`winner`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_auction_currency1` FOREIGN KEY (`currency_id`) REFERENCES `currency` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_auction_user1` FOREIGN KEY (`owner`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `audit`
--
ALTER TABLE `audit`
  ADD CONSTRAINT `fk_audit_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `bid`
--
ALTER TABLE `bid`
  ADD CONSTRAINT `fk_bid_auction1` FOREIGN KEY (`auction_id`) REFERENCES `auction` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_bid_user1` FOREIGN KEY (`bidder`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `fk_customer_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `fisical_person`
--
ALTER TABLE `fisical_person`
  ADD CONSTRAINT `fk_fisical_person_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `integrator`
--
ALTER TABLE `integrator`
  ADD CONSTRAINT `fk_provider_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `legal_person`
--
ALTER TABLE `legal_person`
  ADD CONSTRAINT `fk_legal_person_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `log_user`
--
ALTER TABLE `log_user`
  ADD CONSTRAINT `fk_log_user_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_registry_type1` FOREIGN KEY (`registry_type_id`) REFERENCES `registry_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_role` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
