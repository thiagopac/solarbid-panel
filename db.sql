-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Tempo de geração: 17/01/2019 às 16:46
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
-- Estrutura para tabela `auction`
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
-- Fazendo dump de dados para tabela `auction`
--

INSERT INTO `auction` (`id`, `owner`, `winner`, `desired_value`, `currency_id`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 2500.00, 1, '2019-01-07 18:39:06', '2019-01-07 18:40:05');

-- --------------------------------------------------------

--
-- Estrutura para tabela `audit`
--

CREATE TABLE IF NOT EXISTS `audit` (
  `id` int(11) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `action_desc` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `audit`
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
(18, '::1', 'Efetuou login', '2019-01-08 02:15:49', 1),
(19, '::1', 'Efetuou login', '2019-01-08 11:39:55', 1),
(20, '::1', 'Efetuou login', '2019-01-09 11:29:45', 1),
(21, '::1', 'Efetuou login', '2019-01-09 11:31:01', 1),
(22, '::1', 'Efetuou login', '2019-01-09 12:17:41', 1),
(23, '::1', 'Efetuou login', '2019-01-09 14:47:35', 1),
(24, '::1', 'Efetuou login', '2019-01-09 14:48:02', 1),
(25, '::1', 'Efetuou login', '2019-01-09 14:48:41', 1),
(26, '::1', 'Efetuou login', '2019-01-09 18:33:36', 1),
(27, '::1', 'Efetuou login', '2019-01-09 18:55:27', 1),
(28, '::1', 'Efetuou login', '2019-01-10 17:04:48', 1),
(29, '::1', 'Efetuou login', '2019-01-10 17:05:02', 1),
(30, '::1', 'Efetuou login', '2019-01-10 17:06:12', 1),
(31, '::1', 'Efetuou login', '2019-01-10 17:07:02', 1),
(32, '::1', 'Efetuou login', '2019-01-10 17:07:28', 1),
(33, '::1', 'Efetuou login', '2019-01-10 17:11:20', 1),
(34, '::1', 'Efetuou login', '2019-01-10 17:18:56', 1),
(35, '::1', 'Efetuou login', '2019-01-10 17:23:42', 1),
(36, '::1', 'Efetuou login', '2019-01-11 11:25:19', 1),
(37, '::1', 'Efetuou login', '2019-01-11 11:26:34', 1),
(38, '::1', 'Efetuou login', '2019-01-11 11:27:10', 1),
(39, '::1', 'Efetuou login', '2019-01-11 11:27:29', 1),
(40, '::1', 'Efetuou login', '2019-01-11 11:27:50', 1),
(41, '::1', 'Efetuou login', '2019-01-11 11:28:03', 1),
(42, '::1', 'Efetuou login', '2019-01-11 11:29:37', 1),
(43, '::1', 'Efetuou login', '2019-01-11 11:29:59', 1),
(44, '::1', 'Efetuou login', '2019-01-11 11:30:18', 1),
(45, '::1', 'Efetuou login', '2019-01-11 11:32:24', 1),
(46, '::1', 'Efetuou login', '2019-01-11 11:35:16', 1),
(47, '::1', 'Efetuou login', '2019-01-11 11:37:11', 1),
(48, '::1', 'Efetuou login', '2019-01-11 11:37:27', 1),
(49, '::1', 'Efetuou login', '2019-01-11 13:09:14', 1),
(50, '::1', 'Efetuou login', '2019-01-11 13:29:37', 1),
(51, '::1', 'Efetuou login', '2019-01-11 13:30:01', 4),
(52, '::1', 'Efetuou login', '2019-01-11 13:30:39', 1),
(53, '::1', 'Efetuou login', '2019-01-11 13:32:46', 1),
(54, '::1', 'Efetuou login', '2019-01-11 13:40:13', 4),
(55, '::1', 'Efetuou login', '2019-01-11 13:42:06', 1),
(56, '::1', 'Efetuou login', '2019-01-11 14:27:40', 2),
(57, '::1', 'Efetuou login', '2019-01-11 16:02:08', 3),
(58, '::1', 'Efetuou login', '2019-01-11 16:54:19', 3),
(59, '::1', 'Efetuou login', '2019-01-11 16:55:20', 3),
(60, '::1', 'Efetuou login', '2019-01-11 17:25:20', 3),
(61, '::1', 'Efetuou login', '2019-01-11 17:26:35', 3),
(62, '::1', 'Efetuou login', '2019-01-11 18:53:52', 3),
(63, '::1', 'Efetuou login', '2019-01-11 18:57:51', 3),
(64, '::1', 'Efetuou login', '2019-01-11 18:59:29', 3),
(65, '::1', 'Efetuou login', '2019-01-11 19:02:18', 3),
(66, '::1', 'Efetuou login', '2019-01-11 19:09:14', 3),
(67, '::1', 'Efetuou login', '2019-01-11 19:17:35', 3),
(68, '::1', 'Efetuou login', '2019-01-11 19:21:14', 3),
(69, '::1', 'Efetuou login', '2019-01-11 19:24:20', 3),
(70, '::1', 'Efetuou login', '2019-01-11 19:25:35', 1),
(71, '::1', 'Efetuou login', '2019-01-11 19:25:50', 1),
(72, '::1', 'Efetuou login', '2019-01-11 19:36:35', 3),
(73, '::1', 'Efetuou login', '2019-01-11 19:37:00', 3),
(74, '::1', 'Efetuou login', '2019-01-11 19:37:11', 3),
(75, '::1', 'Efetuou login', '2019-01-11 19:37:32', 3),
(76, '::1', 'Efetuou login', '2019-01-11 19:39:50', 3),
(77, '::1', 'Efetuou login', '2019-01-11 19:39:59', 1),
(78, '::1', 'Efetuou login', '2019-01-11 19:40:25', 3),
(79, '::1', 'Efetuou login', '2019-01-11 19:41:56', 2),
(80, '::1', 'Efetuou login', '2019-01-11 19:42:34', 2),
(81, '::1', 'Efetuou login', '2019-01-11 19:43:06', 2),
(82, '::1', 'Efetuou login', '2019-01-11 19:43:30', 2),
(83, '::1', 'Efetuou login', '2019-01-14 11:35:32', 2),
(84, '::1', 'Efetuou login', '2019-01-14 18:10:03', 2),
(85, '::1', 'Efetuou login', '2019-01-15 15:44:32', 1),
(86, '::1', 'Efetuou login', '2019-01-15 15:44:41', 2),
(87, '::1', 'Efetuou login', '2019-01-15 15:48:56', 1),
(88, '::1', 'Efetuou login', '2019-01-15 15:54:08', 2),
(89, '::1', 'Efetuou login', '2019-01-17 13:27:07', 2),
(90, '::1', 'Concluiu o cadastro da conta', '2019-01-17 13:41:17', 2),
(91, '::1', 'Efetuou login', '2019-01-17 15:37:52', 2),
(92, '::1', 'Efetuou login', '2019-01-17 15:38:24', 2),
(93, '::1', 'Efetuou login', '2019-01-17 15:39:18', 2),
(94, '::1', 'Efetuou login', '2019-01-17 15:41:04', 2),
(95, '::1', 'Efetuou login', '2019-01-17 15:55:50', 2),
(96, '::1', 'Concluiu o cadastro da conta', '2019-01-17 16:01:52', 2),
(97, '::1', 'Concluiu o cadastro da conta', '2019-01-17 16:02:51', 2),
(98, '::1', 'Concluiu o cadastro da conta', '2019-01-17 16:04:04', 2),
(99, '::1', 'Concluiu o cadastro da conta', '2019-01-17 16:04:46', 2),
(100, '::1', 'Concluiu o cadastro da conta', '2019-01-17 16:07:13', 2),
(101, '::1', 'Concluiu o cadastro da conta', '2019-01-17 16:09:24', 2),
(102, '::1', 'Efetuou login', '2019-01-17 16:19:11', 2),
(103, '::1', 'Concluiu o cadastro da conta', '2019-01-17 16:19:58', 2),
(104, '::1', 'Efetuou login', '2019-01-17 16:23:13', 2),
(105, '::1', 'Efetuou login', '2019-01-17 16:28:08', 2),
(106, '::1', 'Concluiu o cadastro da conta', '2019-01-17 16:30:49', 2),
(107, '::1', 'Efetuou login', '2019-01-17 16:31:30', 1),
(108, '::1', 'Concluiu o cadastro da conta', '2019-01-17 16:32:21', 1),
(109, '::1', 'Efetuou login', '2019-01-17 16:39:02', 1),
(110, '::1', 'Concluiu o cadastro da conta', '2019-01-17 16:42:28', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `bid`
--

CREATE TABLE IF NOT EXISTS `bid` (
  `id` int(11) NOT NULL,
  `value` decimal(10,2) NOT NULL,
  `bidder` int(11) NOT NULL,
  `auction_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'CURRENT_TIMESTAMP'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `bid`
--

INSERT INTO `bid` (`id`, `value`, `bidder`, `auction_id`, `created_at`) VALUES
(1, 8750.00, 3, 1, '2019-01-07 18:40:45');

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
  `language` varchar(10) NOT NULL DEFAULT 'pt_BR'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `core`
--

INSERT INTO `core` (`id`, `version`, `domain`, `contact`, `do_not_reply`, `language`) VALUES
(1, '0.0.1', 'http://localhost/', 'solarbid@ownergy.com.br', 'naoresponda@solarbid.com.br', 'pt_BR');

-- --------------------------------------------------------

--
-- Estrutura para tabela `currency`
--

CREATE TABLE IF NOT EXISTS `currency` (
  `id` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `name` varchar(45) NOT NULL,
  `symbol` varchar(45) NOT NULL,
  `locale` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `currency`
--

INSERT INTO `currency` (`id`, `code`, `name`, `symbol`, `locale`) VALUES
(1, 'BRL', 'Real brasileiro', 'R$', 'pt_BR');

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
  `phone` varchar(45) NOT NULL,
  `street` varchar(45) NOT NULL,
  `number` varchar(45) NOT NULL,
  `neighborhood` varchar(45) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(2) NOT NULL,
  `country` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `fisical_person`
--

INSERT INTO `fisical_person` (`id`, `fullname`, `nickname`, `social_security`, `phone`, `street`, `number`, `neighborhood`, `city`, `state`, `country`, `user_id`) VALUES
(1, 'Thiago Pires Alves de Castro', 'Thiago', '06956141698', '(31)98888-6463', 'Rua Alberto de Oliveira', '427', 'Santa Mônica', 'Belo Horizonte', 'MG', 'Brasil', 1),
(2, 'Cliente Exemplo', 'Cliente', '12345678900', '(31)99999-9999', 'Rua do Cliente', '100', 'Bairro do Cliente', 'Belo Horizonte', 'MG', 'Brasil', 2);

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
-- Estrutura para tabela `legal_person`
--

CREATE TABLE IF NOT EXISTS `legal_person` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `registered_number` varchar(45) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `legal_person`
--

INSERT INTO `legal_person` (`id`, `company_name`, `registered_number`, `user_id`) VALUES
(1, 'Nome da Empresa', '12345678000199', 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `log_application`
--

CREATE TABLE IF NOT EXISTS `log_application` (
  `id` int(11) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `type` varchar(10) DEFAULT 'secondary',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `log_application`
--

INSERT INTO `log_application` (`id`, `description`, `type`, `created_at`, `status`) VALUES
(1, 'Funcionalidade de configuração de alertas por e-mail liberada em breve.', 'info', '2019-01-06 10:35:23', ''),
(2, '11 bugs foram corrigidos', 'warning', '2019-01-07 10:39:13', 'Importante');

-- --------------------------------------------------------

--
-- Estrutura para tabela `log_server`
--

CREATE TABLE IF NOT EXISTS `log_server` (
  `id` int(11) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `type` varchar(10) DEFAULT 'secondary',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `log_server`
--

INSERT INTO `log_server` (`id`, `description`, `type`, `created_at`, `status`) VALUES
(1, 'Manutenção do servidor entre 10h e 12h de domingo (14/01/2019)', 'warning', '2019-01-08 12:27:32', ''),
(2, 'Instabilidade detectada nos servidores entre 01/01/2019 e 05/01/2019', 'danger', '2019-01-08 12:27:34', 'Atenção');

-- --------------------------------------------------------

--
-- Estrutura para tabela `log_user`
--

CREATE TABLE IF NOT EXISTS `log_user` (
  `id` int(11) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `log_user`
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
(14, 'Efetuou login na plataforma', '2019-01-08 02:15:49', 1),
(15, 'Efetuou login na plataforma', '2019-01-08 11:39:55', 1),
(16, 'Efetuou login na plataforma', '2019-01-09 11:29:45', 1),
(17, 'Efetuou login na plataforma', '2019-01-09 11:31:01', 1),
(18, 'Efetuou login na plataforma', '2019-01-09 12:17:41', 1),
(19, 'Efetuou login na plataforma', '2019-01-09 14:47:35', 1),
(20, 'Efetuou login na plataforma', '2019-01-09 14:48:02', 1),
(21, 'Efetuou login na plataforma', '2019-01-09 14:48:41', 1),
(22, 'Efetuou login na plataforma', '2019-01-09 18:33:36', 1),
(23, 'Efetuou login na plataforma', '2019-01-09 18:55:27', 1),
(24, 'Efetuou login na plataforma', '2019-01-10 17:04:48', 1),
(25, 'Efetuou login na plataforma', '2019-01-10 17:05:02', 1),
(26, 'Efetuou login na plataforma', '2019-01-10 17:06:12', 1),
(27, 'Efetuou login na plataforma', '2019-01-10 17:07:02', 1),
(28, 'Efetuou login na plataforma', '2019-01-10 17:07:28', 1),
(29, 'Efetuou login na plataforma', '2019-01-10 17:11:20', 1),
(30, 'Efetuou login na plataforma', '2019-01-10 17:18:56', 1),
(31, 'Efetuou login na plataforma', '2019-01-10 17:23:42', 1),
(32, 'Efetuou login na plataforma', '2019-01-11 11:25:19', 1),
(33, 'Efetuou login na plataforma', '2019-01-11 11:26:34', 1),
(34, 'Efetuou login na plataforma', '2019-01-11 11:27:10', 1),
(35, 'Efetuou login na plataforma', '2019-01-11 11:27:29', 1),
(36, 'Efetuou login na plataforma', '2019-01-11 11:27:50', 1),
(37, 'Efetuou login na plataforma', '2019-01-11 11:28:03', 1),
(38, 'Efetuou login na plataforma', '2019-01-11 11:29:37', 1),
(39, 'Efetuou login na plataforma', '2019-01-11 11:29:59', 1),
(40, 'Efetuou login na plataforma', '2019-01-11 11:30:18', 1),
(41, 'Efetuou login na plataforma', '2019-01-11 11:32:24', 1),
(42, 'Efetuou login na plataforma', '2019-01-11 11:35:16', 1),
(43, 'Efetuou login na plataforma', '2019-01-11 11:37:11', 1),
(44, 'Efetuou login na plataforma', '2019-01-11 11:37:27', 1),
(45, 'Efetuou login na plataforma', '2019-01-11 13:09:14', 1),
(46, 'Efetuou login na plataforma', '2019-01-11 13:29:37', 1),
(47, 'Efetuou login na plataforma', '2019-01-11 13:30:01', 4),
(48, 'Efetuou login na plataforma', '2019-01-11 13:30:39', 1),
(49, 'Efetuou login na plataforma', '2019-01-11 13:32:46', 1),
(50, 'Efetuou login na plataforma', '2019-01-11 13:40:13', 4),
(51, 'Efetuou login na plataforma', '2019-01-11 13:42:06', 1),
(52, 'Efetuou login na plataforma', '2019-01-11 14:27:40', 2),
(53, 'Efetuou login na plataforma', '2019-01-11 16:02:08', 3),
(54, 'Efetuou login na plataforma', '2019-01-11 16:54:19', 3),
(55, 'Efetuou login na plataforma', '2019-01-11 16:55:20', 3),
(56, 'Efetuou login na plataforma', '2019-01-11 17:25:20', 3),
(57, 'Efetuou login na plataforma', '2019-01-11 17:26:35', 3),
(58, 'Efetuou login na plataforma', '2019-01-11 18:53:52', 3),
(59, 'Efetuou login na plataforma', '2019-01-11 18:57:51', 3),
(60, 'Efetuou login na plataforma', '2019-01-11 18:59:29', 3),
(61, 'Efetuou login na plataforma', '2019-01-11 19:02:18', 3),
(62, 'Efetuou login na plataforma', '2019-01-11 19:09:14', 3),
(63, 'Efetuou login na plataforma', '2019-01-11 19:17:35', 3),
(64, 'Efetuou login na plataforma', '2019-01-11 19:21:14', 3),
(65, 'Fez logout na plataforma', '2019-01-11 19:24:12', 3),
(66, 'Efetuou login na plataforma', '2019-01-11 19:24:20', 3),
(67, 'Fez logout na plataforma', '2019-01-11 19:25:29', 3),
(68, 'Efetuou login na plataforma', '2019-01-11 19:25:35', 1),
(69, 'Fez logout na plataforma', '2019-01-11 19:25:45', 1),
(70, 'Efetuou login na plataforma', '2019-01-11 19:25:50', 1),
(71, 'Fez logout na plataforma', '2019-01-11 19:26:00', 1),
(72, 'Efetuou login na plataforma', '2019-01-11 19:36:35', 3),
(73, 'Efetuou login na plataforma', '2019-01-11 19:37:00', 3),
(74, 'Efetuou login na plataforma', '2019-01-11 19:37:11', 3),
(75, 'Efetuou login na plataforma', '2019-01-11 19:37:32', 3),
(76, 'Efetuou login na plataforma', '2019-01-11 19:39:50', 3),
(77, 'Fez logout na plataforma', '2019-01-11 19:39:55', 3),
(78, 'Efetuou login na plataforma', '2019-01-11 19:39:59', 1),
(79, 'Fez logout na plataforma', '2019-01-11 19:40:04', 1),
(80, 'Efetuou login na plataforma', '2019-01-11 19:40:25', 3),
(81, 'Efetuou login na plataforma', '2019-01-11 19:41:56', 2),
(82, 'Fez logout na plataforma', '2019-01-11 19:42:30', 2),
(83, 'Efetuou login na plataforma', '2019-01-11 19:42:34', 2),
(84, 'Efetuou login na plataforma', '2019-01-11 19:43:06', 2),
(85, 'Fez logout na plataforma', '2019-01-11 19:43:13', 2),
(86, 'Efetuou login na plataforma', '2019-01-11 19:43:30', 2),
(87, 'Efetuou login na plataforma', '2019-01-14 11:35:32', 2),
(88, 'Efetuou login na plataforma', '2019-01-14 18:10:03', 2),
(89, 'Efetuou login na plataforma', '2019-01-15 15:44:32', 1),
(90, 'Fez logout na plataforma', '2019-01-15 15:44:37', 1),
(91, 'Efetuou login na plataforma', '2019-01-15 15:44:41', 2),
(92, 'Efetuou login na plataforma', '2019-01-15 15:48:56', 1),
(93, 'Fez logout na plataforma', '2019-01-15 15:54:03', 1),
(94, 'Efetuou login na plataforma', '2019-01-15 15:54:08', 2),
(95, 'Efetuou login na plataforma', '2019-01-17 13:27:07', 2),
(96, 'Concluiu o cadastro da conta', '2019-01-17 13:41:17', 2),
(97, 'Efetuou login na plataforma', '2019-01-17 15:37:52', 2),
(98, 'Efetuou login na plataforma', '2019-01-17 15:38:24', 2),
(99, 'Efetuou login na plataforma', '2019-01-17 15:39:18', 2),
(100, 'Efetuou login na plataforma', '2019-01-17 15:41:04', 2),
(101, 'Efetuou login na plataforma', '2019-01-17 15:55:50', 2),
(102, 'Concluiu o cadastro da conta', '2019-01-17 16:01:52', 2),
(103, 'Concluiu o cadastro da conta', '2019-01-17 16:02:51', 2),
(104, 'Concluiu o cadastro da conta', '2019-01-17 16:04:04', 2),
(105, 'Concluiu o cadastro da conta', '2019-01-17 16:04:46', 2),
(106, 'Concluiu o cadastro da conta', '2019-01-17 16:07:13', 2),
(107, 'Concluiu o cadastro da conta', '2019-01-17 16:09:24', 2),
(108, 'Efetuou login na plataforma', '2019-01-17 16:19:11', 2),
(109, 'Concluiu o cadastro da conta', '2019-01-17 16:19:58', 2),
(110, 'Efetuou login na plataforma', '2019-01-17 16:23:13', 2),
(111, 'Fez logout na plataforma', '2019-01-17 16:24:10', 2),
(112, 'Efetuou login na plataforma', '2019-01-17 16:28:08', 2),
(113, 'Concluiu o cadastro da conta', '2019-01-17 16:30:49', 2),
(114, 'Fez logout na plataforma', '2019-01-17 16:31:25', 2),
(115, 'Efetuou login na plataforma', '2019-01-17 16:31:30', 1),
(116, 'Concluiu o cadastro da conta', '2019-01-17 16:32:21', 1),
(117, 'Efetuou login na plataforma', '2019-01-17 16:39:02', 1),
(118, 'Concluiu o cadastro da conta', '2019-01-17 16:42:28', 1),
(119, 'Fez logout na plataforma', '2019-01-17 16:45:47', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(11) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` varchar(10) DEFAULT 'secondary',
  `status` varchar(20) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `is_read` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `notification`
--

INSERT INTO `notification` (`id`, `description`, `created_at`, `type`, `status`, `user_id`, `is_read`) VALUES
(1, 'Notificação de teste 1', '2019-01-09 11:26:30', 'danger', 'Atenção', 1, 1),
(2, 'Notificação de teste 2', '2019-01-09 09:19:33', 'secondary', NULL, 1, 1),
(3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sit amet lacinia eros, at pellentesque libero. Aliquam erat volutpat. Nunc at leo vitae tortor pretium eleifend vel id lacus.', '2019-01-09 18:27:52', 'secondary', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `privacy_policy`
--

CREATE TABLE IF NOT EXISTS `privacy_policy` (
  `id` int(11) NOT NULL,
  `text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `language` varchar(10) NOT NULL DEFAULT 'pt_BR'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `privacy_policy`
--

INSERT INTO `privacy_policy` (`id`, `text`, `created_at`, `language`) VALUES
(1, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sodales ligula in libero. </p>\r\n\r\n<p>Sed dignissim lacinia nunc. Curabitur tortor. Pellentesque nibh. Aenean quam. In scelerisque sem at dolor. Maecenas mattis. Sed convallis tristique sem. Proin ut ligula vel nunc egestas porttitor. Morbi lectus risus, iaculis vel, suscipit quis, luctus non, massa. Fusce ac turpis quis ligula lacinia aliquet. Mauris ipsum. Nulla metus metus, ullamcorper vel, tincidunt sed, euismod in, nibh. Quisque volutpat condimentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. </p>\r\n\r\n<p>Nam nec ante. <i>Curabitur tortor</i>. Sed lacinia, urna non tincidunt mattis, tortor neque adipiscing diam, a cursus ipsum ante quis turpis. Nulla facilisi. Ut fringilla. Suspendisse potenti. Nunc feugiat mi a tellus consequat imperdiet. Vestibulum sapien. Proin quam. Etiam ultrices. <b>Nulla metus metus, ullamcorper vel, tincidunt sed, euismod in, nibh</b>. Suspendisse in justo eu magna luctus suscipit. Sed lectus. Integer euismod lacus luctus magna. Quisque cursus, metus vitae pharetra auctor, sem massa mattis sem, at interdum magna augue eget diam. </p>\r\n\r\n<p><b>Ut fringilla</b>. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Morbi lacinia molestie dui. Praesent blandit dolor. <i>Morbi lectus risus, iaculis vel, suscipit quis, luctus non, massa</i>. Sed non quam. In vel mi sit amet augue congue elementum. Morbi in ipsum sit amet pede facilisis laoreet. Donec lacus nunc, viverra nec, blandit vel, egestas et, augue. Vestibulum tincidunt malesuada tellus. Ut ultrices ultrices enim. <i>Nulla metus metus, ullamcorper vel, tincidunt sed, euismod in, nibh</i>. Curabitur sit amet mauris. <b>Sed non quam</b>. Morbi in dui quis est pulvinar ullamcorper. Nulla facilisi. Integer lacinia sollicitudin massa. Cras metus. </p>\r\n\r\n<p>Sed aliquet risus a tortor. Integer id quam. Morbi mi. <i>Sed non quam</i>. Quisque nisl felis, venenatis tristique, dignissim in, ultrices sit amet, augue. Proin sodales libero eget ante. Nulla quam. Aenean laoreet. Vestibulum nisi lectus, commodo ac, facilisis ac, ultricies eu, pede. Ut orci risus, accumsan porttitor, cursus quis, aliquet eget, justo. Sed pretium blandit orci. <i>Sed non quam</i>. Ut eu diam at pede suscipit sodales. Aenean lectus elit, fermentum non, convallis id, sagittis at, neque. Nullam mauris orci, aliquet et, iaculis et, viverra vitae, ligula. Nulla ut felis in purus aliquam imperdiet. </p>', '2019-01-15 13:52:08', 'pt_BR');

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
-- Estrutura para tabela `terms_of_use`
--

CREATE TABLE IF NOT EXISTS `terms_of_use` (
  `id` int(11) NOT NULL,
  `text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `language` varchar(10) NOT NULL DEFAULT 'pt_BR'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `terms_of_use`
--

INSERT INTO `terms_of_use` (`id`, `text`, `created_at`, `language`) VALUES
(1, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sodales ligula in libero. </p>\r\n\r\n<p>Sed dignissim lacinia nunc. Curabitur tortor. Pellentesque nibh. Aenean quam. In scelerisque sem at dolor. Maecenas mattis. Sed convallis tristique sem. Proin ut ligula vel nunc egestas porttitor. Morbi lectus risus, iaculis vel, suscipit quis, luctus non, massa. Fusce ac turpis quis ligula lacinia aliquet. Mauris ipsum. Nulla metus metus, ullamcorper vel, tincidunt sed, euismod in, nibh. Quisque volutpat condimentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. </p>\r\n\r\n<p>Nam nec ante. <i>Curabitur tortor</i>. Sed lacinia, urna non tincidunt mattis, tortor neque adipiscing diam, a cursus ipsum ante quis turpis. Nulla facilisi. Ut fringilla. Suspendisse potenti. Nunc feugiat mi a tellus consequat imperdiet. Vestibulum sapien. Proin quam. Etiam ultrices. <b>Nulla metus metus, ullamcorper vel, tincidunt sed, euismod in, nibh</b>. Suspendisse in justo eu magna luctus suscipit. Sed lectus. Integer euismod lacus luctus magna. Quisque cursus, metus vitae pharetra auctor, sem massa mattis sem, at interdum magna augue eget diam. </p>\r\n\r\n<p><b>Ut fringilla</b>. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Morbi lacinia molestie dui. Praesent blandit dolor. <i>Morbi lectus risus, iaculis vel, suscipit quis, luctus non, massa</i>. Sed non quam. In vel mi sit amet augue congue elementum. Morbi in ipsum sit amet pede facilisis laoreet. Donec lacus nunc, viverra nec, blandit vel, egestas et, augue. Vestibulum tincidunt malesuada tellus. Ut ultrices ultrices enim. <i>Nulla metus metus, ullamcorper vel, tincidunt sed, euismod in, nibh</i>. Curabitur sit amet mauris. <b>Sed non quam</b>. Morbi in dui quis est pulvinar ullamcorper. Nulla facilisi. Integer lacinia sollicitudin massa. Cras metus. </p>\r\n\r\n<p>Sed aliquet risus a tortor. Integer id quam. Morbi mi. <i>Sed non quam</i>. Quisque nisl felis, venenatis tristique, dignissim in, ultrices sit amet, augue. Proin sodales libero eget ante. Nulla quam. Aenean laoreet. Vestibulum nisi lectus, commodo ac, facilisis ac, ultricies eu, pede. Ut orci risus, accumsan porttitor, cursus quis, aliquet eget, justo. Sed pretium blandit orci. <i>Sed non quam</i>. Ut eu diam at pede suscipit sodales. Aenean lectus elit, fermentum non, convallis id, sagittis at, neque. Nullam mauris orci, aliquet et, iaculis et, viverra vitae, ligula. Nulla ut felis in purus aliquam imperdiet. </p>', '2019-01-15 13:51:47', 'pt_BR');

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
  `language` varchar(10) NOT NULL DEFAULT 'pt_BR',
  `registry_type_id` int(11) NOT NULL,
  `mail_notification` varchar(10000) NOT NULL DEFAULT '[{"name":"loggedIn","state":true},{"name":"passwordChanged","state":true}]',
  `activated` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Ativação por e-mail',
  `last_seen` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `privacy_policy_id` int(11) DEFAULT NULL,
  `terms_of_use_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `created_at`, `updated_at`, `role_id`, `language`, `registry_type_id`, `mail_notification`, `activated`, `last_seen`, `privacy_policy_id`, `terms_of_use_id`) VALUES
(1, 'thiago', '$2y$10$Ojpb8dZJNNpePUGp1nxbpu5JyDbI2JNTGFz7ynXTfpB68dVaNuSrm', 'thiagopac@gmail.com', '2018-11-29 17:35:20', '2019-01-17 16:39:02', 1, 'pt_BR', 1, '[{"name":"loggedIn","state":false},{"name":"passwordChanged","state":true}]', 1, '2019-01-17 16:39:02', 1, 1),
(2, 'cliente', '$2y$10$Z7LiFGwms5bxVZWllxgR2er56XcM4EGiz4kycK7XcGLtZ97eMjO4O', 'txttthiago@gmail.com', '2018-12-03 19:15:59', '2019-01-17 16:28:08', 2, 'pt_BR', 1, '[{"name":"loggedIn","state":false},{"name":"passwordChanged","state":true}]', 1, '2019-01-17 16:28:08', 1, 1),
(3, 'empresa', '$2y$10$EvhRtf02r1JWtDVp4QxyOeRdyvrVbKt4z6rgVbbsdgNIZ71XNdsvG', 'zenit@ownergy.com.br', '2018-12-03 19:28:31', '2019-01-11 19:40:25', 3, 'pt_BR', 2, '[{"name":"loggedIn","state":false},{"name":"passwordChanged","state":true}]', 1, '2019-01-11 19:40:25', NULL, NULL),
(4, 'ingred', '$2y$10$4tsZq8ecA1p4VsGoNqw.Zu.J/I4eLyRwgX4YQs1pkhSBoNCRhiolC', 'thiago.pires@ownergy.com.br', '2018-12-28 19:39:50', '2019-01-11 13:40:13', 2, 'pt_BR', 1, '[{"name":"loggedIn","state":false},{"name":"passwordChanged","state":true}]', 1, '2019-01-11 13:40:13', NULL, NULL);

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
-- Índices de tabela `auction`
--
ALTER TABLE `auction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_auction_user1_idx` (`owner`),
  ADD KEY `fk_auction_user2_idx` (`winner`),
  ADD KEY `fk_auction_currency1_idx` (`currency_id`);

--
-- Índices de tabela `audit`
--
ALTER TABLE `audit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_audit_user1_idx` (`user_id`);

--
-- Índices de tabela `bid`
--
ALTER TABLE `bid`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_bid_user1_idx` (`bidder`),
  ADD KEY `fk_bid_auction1_idx` (`auction_id`);

--
-- Índices de tabela `core`
--
ALTER TABLE `core`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `currency`
--
ALTER TABLE `currency`
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
-- Índices de tabela `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_notification_user1_idx` (`user_id`);

--
-- Índices de tabela `privacy_policy`
--
ALTER TABLE `privacy_policy`
  ADD PRIMARY KEY (`id`);

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
-- Índices de tabela `terms_of_use`
--
ALTER TABLE `terms_of_use`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_role_idx` (`role_id`),
  ADD KEY `fk_user_registry_type1_idx` (`registry_type_id`),
  ADD KEY `fk_user_privacy_policy1_idx` (`privacy_policy_id`),
  ADD KEY `fk_user_terms_of_use1_idx` (`terms_of_use_id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `auction`
--
ALTER TABLE `auction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de tabela `audit`
--
ALTER TABLE `audit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=111;
--
-- AUTO_INCREMENT de tabela `bid`
--
ALTER TABLE `bid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de tabela `core`
--
ALTER TABLE `core`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de tabela `currency`
--
ALTER TABLE `currency`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de tabela `integrator`
--
ALTER TABLE `integrator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `legal_person`
--
ALTER TABLE `legal_person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de tabela `log_application`
--
ALTER TABLE `log_application`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de tabela `log_server`
--
ALTER TABLE `log_server`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de tabela `log_user`
--
ALTER TABLE `log_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=120;
--
-- AUTO_INCREMENT de tabela `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de tabela `privacy_policy`
--
ALTER TABLE `privacy_policy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
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
-- AUTO_INCREMENT de tabela `terms_of_use`
--
ALTER TABLE `terms_of_use`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `fk_admin_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `auction`
--
ALTER TABLE `auction`
  ADD CONSTRAINT `fk_action_user2` FOREIGN KEY (`winner`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_auction_currency1` FOREIGN KEY (`currency_id`) REFERENCES `currency` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_auction_user1` FOREIGN KEY (`owner`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `audit`
--
ALTER TABLE `audit`
  ADD CONSTRAINT `fk_audit_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `bid`
--
ALTER TABLE `bid`
  ADD CONSTRAINT `fk_bid_auction1` FOREIGN KEY (`auction_id`) REFERENCES `auction` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_bid_user1` FOREIGN KEY (`bidder`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
-- Restrições para tabelas `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `fk_notification_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_privacy_policy1` FOREIGN KEY (`privacy_policy_id`) REFERENCES `privacy_policy` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_registry_type1` FOREIGN KEY (`registry_type_id`) REFERENCES `registry_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_role` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_terms_of_use1` FOREIGN KEY (`terms_of_use_id`) REFERENCES `terms_of_use` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
