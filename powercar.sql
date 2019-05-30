-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 30-Maio-2019 às 02:37
-- Versão do servidor: 10.1.38-MariaDB
-- versão do PHP: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `powercar`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `budgets`
--

CREATE TABLE `budgets` (
  `id` int(10) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_price` decimal(8,2) DEFAULT NULL,
  `situation_id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `vehicle_id` int(10) UNSIGNED DEFAULT NULL,
  `employee_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `budgets`
--

INSERT INTO `budgets` (`id`, `description`, `total_price`, `situation_id`, `client_id`, `vehicle_id`, `employee_id`, `created_at`, `updated_at`) VALUES
(1, 'Teste', '3433.96', 9, 5, 2, 4, '2019-05-27 01:19:03', '2019-05-27 02:36:20'),
(4, 'Nova ordem de serviço para o Ricardo', '2392.64', 9, 6, 3, 4, '2019-05-29 19:42:45', '2019-05-29 19:42:45'),
(3, 'Nova OS para o Ricardo', '3245.00', 6, 6, 3, 4, '2019-05-29 08:05:38', '2019-05-29 08:05:38'),
(5, 'Nova OS para cliente', '1060.00', 9, 5, 1, 4, '2019-05-29 19:54:06', '2019-05-29 19:54:06'),
(6, 'Orçamento', '2952.64', 7, 7, 4, 4, '2019-05-30 01:50:05', '2019-05-30 01:50:05'),
(7, 'Descrição da OS', NULL, 9, 8, NULL, 4, '2019-05-30 01:55:38', '2019-05-30 01:55:38');

-- --------------------------------------------------------

--
-- Estrutura da tabela `budget_products`
--

CREATE TABLE `budget_products` (
  `budget_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `amount` int(11) NOT NULL,
  `value` decimal(8,2) NOT NULL,
  `total_value` decimal(8,2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `budget_products`
--

INSERT INTO `budget_products` (`budget_id`, `product_id`, `amount`, `value`, `total_value`) VALUES
(1, 2, 1, '1500.00', '1500.00'),
(4, 1, 2, '271.32', '542.64'),
(3, 2, 2, '1500.00', '3000.00'),
(5, 3, 1, '560.00', '560.00'),
(4, 2, 1, '1500.00', '1500.00'),
(1, 1, 3, '271.32', '813.96'),
(1, 3, 2, '560.00', '1120.00'),
(6, 1, 2, '271.32', '542.64'),
(6, 3, 1, '560.00', '560.00'),
(6, 2, 1, '1500.00', '1500.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `budget_services`
--

CREATE TABLE `budget_services` (
  `budget_id` int(10) UNSIGNED NOT NULL,
  `service_id` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `budget_services`
--

INSERT INTO `budget_services` (`budget_id`, `service_id`) VALUES
(5, 1),
(5, 2),
(3, 3),
(4, 1),
(6, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_04_20_181809_create_roles_table', 1),
(4, '2019_04_20_182225_create_permissions_table', 1),
(5, '2019_04_20_183023_create_permission_roles_table', 1),
(6, '2019_04_20_185041_create_table__role__user', 1),
(7, '2019_05_04_185546_create_profiles_table', 1),
(8, '2019_05_05_234119_create_services_table', 1),
(9, '2019_05_06_014013_create_products_table', 1),
(10, '2019_05_06_111748_create_vehicles_table', 1),
(11, '2019_05_10_025325_create_situations_table', 1),
(12, '2019_05_10_220641_add_color_table_situations', 1),
(13, '2019_05_14_120925_create_schedulings_table', 1),
(14, '2019_05_19_231128_add_description_table_schedulings', 1),
(15, '2019_05_23_030645_create_budgets_table', 2),
(16, '2019_05_23_032752_create_budget_services', 2),
(17, '2019_05_24_131303_create_budget_products', 2),
(19, '2019_05_27_235740_add_total_value_table_budget_products', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(99) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'list-user', 'Listar usuários', '2019-05-20 14:53:42', '2019-05-20 14:53:42'),
(2, 'create-user', 'Criar usuários', '2019-05-20 14:53:42', '2019-05-20 14:53:42'),
(3, 'edit-user', 'Editar usuários', '2019-05-20 14:53:42', '2019-05-20 14:53:42'),
(4, 'show-user', 'Visualizar usuários', '2019-05-20 14:53:42', '2019-05-20 14:53:42'),
(5, 'delete-user', 'Deletar usuários', '2019-05-20 14:53:42', '2019-05-20 14:53:42'),
(6, 'acl', 'Criar, editar, ou deletar funções e permissões', '2019-05-20 14:53:42', '2019-05-20 14:53:42'),
(7, 'list-order-service', 'Listar ordem de serviço', '2019-05-20 14:53:42', '2019-05-20 14:53:42'),
(8, 'list-employee', 'Listar funcionários', '2019-05-20 14:53:42', '2019-05-21 06:11:58'),
(9, 'list-client', 'Listar cliente', '2019-05-20 14:53:42', '2019-05-20 14:53:42'),
(10, 'create-client', 'Criar cliente', '2019-05-20 14:53:42', '2019-05-20 14:53:42'),
(11, 'delete-client', 'Deletar cliente', '2019-05-20 14:53:42', '2019-05-20 14:53:42'),
(12, 'show-client', 'Ver cliente', '2019-05-20 14:53:42', '2019-05-20 14:53:42'),
(13, 'edit-client', 'Editar cliente', '2019-05-20 14:53:42', '2019-05-20 14:53:42'),
(14, 'list-products-and-services', 'Listar produtos e serviços', '2019-05-20 14:53:42', '2019-05-20 14:53:42'),
(15, 'list-product', 'Listar produtos', '2019-05-20 14:53:42', '2019-05-20 14:53:42'),
(16, 'create-product', 'Criar produtos', '2019-05-20 14:53:42', '2019-05-20 14:53:42'),
(17, 'edit-product', 'edit produtos', '2019-05-20 14:53:42', '2019-05-20 14:53:42'),
(18, 'delete-product', 'Deletar produtos', '2019-05-20 14:53:42', '2019-05-20 14:53:42'),
(19, 'show-product', 'Ver produtos', '2019-05-20 14:53:42', '2019-05-20 14:53:42'),
(20, 'list-service', 'Listar serviços', '2019-05-20 14:53:42', '2019-05-20 14:53:42'),
(21, 'create-service', 'Criar serviços', '2019-05-20 14:53:42', '2019-05-20 14:53:42'),
(22, 'edit-service', 'edit serviços', '2019-05-20 14:53:42', '2019-05-20 14:53:42'),
(23, 'delete-service', 'Deletar serviços', '2019-05-20 14:53:42', '2019-05-20 14:53:42'),
(24, 'show-service', 'Ver serviços', '2019-05-20 14:53:42', '2019-05-20 14:53:42'),
(25, 'list-vehicle', 'Listar automóvies', '2019-05-20 14:53:42', '2019-05-20 14:53:42'),
(26, 'create-vehicle', 'Criar automóvies', '2019-05-20 14:53:42', '2019-05-20 14:53:42'),
(27, 'show-vehicle', 'Ver automóvies', '2019-05-20 14:53:42', '2019-05-20 14:53:42'),
(28, 'delete-vehicle', 'Deletar automóvies', '2019-05-20 14:53:42', '2019-05-20 14:53:42'),
(29, 'edit-vehicle', 'Editar automóvies', '2019-05-20 14:53:42', '2019-05-20 14:53:42'),
(30, 'list-scheduling', 'Listar agendamentos', '2019-05-20 14:53:42', '2019-05-20 14:53:42'),
(31, 'approve-scheduling', 'Aprovar agendamentos', '2019-05-20 14:53:42', '2019-05-20 14:53:42'),
(32, 'cancel-scheduling', 'cancelar agendamentos', '2019-05-20 14:53:42', '2019-05-20 14:53:42'),
(33, 'delete-scheduling', 'Deletar agendamentos', '2019-05-20 14:53:42', '2019-05-20 14:53:42'),
(34, 'edit-scheduling', 'Editar agendamentos', '2019-05-20 14:53:42', '2019-05-20 14:53:42'),
(35, 'create-scheduling', 'Criar agendamentos', '2019-05-20 14:53:42', '2019-05-20 14:53:42'),
(36, 'show-scheduling', 'Ver agendamentos', '2019-05-20 14:53:42', '2019-05-20 14:53:42'),
(37, 'create', 'Criar registro', '2019-05-21 05:42:49', '2019-05-21 05:42:49'),
(38, 'permission-basic', 'Acesso a funcionalidades básicas a todos os perfis', '2019-05-21 05:44:11', '2019-05-21 05:44:11'),
(39, 'create-situation', 'Criar tipos de situações', '2019-05-21 05:46:53', '2019-05-21 05:46:53'),
(40, 'create-employee', 'Cadastrar novos funcionários', '2019-05-21 05:47:59', '2019-05-21 05:47:59'),
(41, 'show-employee', 'Ver funcionário', '2019-05-21 05:49:20', '2019-05-21 05:49:20'),
(42, 'show-situation', 'Ver tipos de situações', '2019-05-21 05:49:34', '2019-05-21 05:49:34'),
(43, 'edit-employee', 'Editar funcionário', '2019-05-21 06:09:22', '2019-05-21 06:09:22'),
(44, 'edit-situation', 'Editar tipos de situações', '2019-05-21 06:09:38', '2019-05-21 06:09:38'),
(45, 'delete-employee', 'Deletar funcionário', '2019-05-21 06:10:23', '2019-05-21 06:10:23'),
(46, 'delete-situation', 'Deletar tipos de situações', '2019-05-21 06:10:34', '2019-05-21 06:10:34'),
(47, 'list-situation', 'Listar Situações', '2019-05-21 06:16:26', '2019-05-21 06:16:26'),
(48, 'list-budget', 'Listar orçamento', '2019-05-23 05:56:27', '2019-05-23 05:56:27'),
(49, 'edit-budget', 'Editar orçamento', '2019-05-23 05:56:56', '2019-05-23 05:56:56'),
(50, 'show-budget', 'Ver orçamento', '2019-05-23 05:57:05', '2019-05-23 05:57:05'),
(51, 'create-budget', 'Criar orçamentos', '2019-05-23 05:57:21', '2019-05-23 05:57:21'),
(52, 'delete-budget', 'Deletar orçamento', '2019-05-23 05:57:31', '2019-05-23 05:57:31'),
(53, 'add-product-service', 'Adicionar produtos e serviços', '2019-05-29 08:12:15', '2019-05-29 08:12:15'),
(54, 'ap-os', 'Aprovar OS', '2019-05-29 08:12:56', '2019-05-29 08:12:56'),
(55, 'cancel-os', 'Cancelar OS', '2019-05-29 08:13:12', '2019-05-29 08:13:12');

-- --------------------------------------------------------

--
-- Estrutura da tabela `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(41, 2),
(41, 3),
(12, 3),
(25, 5),
(30, 5),
(48, 5),
(29, 5),
(34, 5),
(50, 3),
(12, 2),
(12, 4),
(28, 5),
(26, 5),
(35, 5),
(32, 5),
(50, 4),
(25, 4),
(20, 4),
(30, 4),
(25, 3),
(20, 3),
(30, 3),
(14, 3),
(15, 3),
(7, 3),
(8, 3),
(50, 2),
(38, 2),
(25, 2),
(1, 2),
(47, 2),
(20, 2),
(30, 2),
(14, 4),
(15, 4),
(7, 4),
(9, 4),
(48, 4),
(9, 3),
(48, 3),
(22, 3),
(34, 3),
(17, 3),
(14, 2),
(15, 2),
(7, 2),
(8, 2),
(9, 2),
(22, 4),
(17, 4),
(49, 4),
(23, 4),
(18, 4),
(43, 3),
(13, 3),
(49, 3),
(23, 3),
(33, 3),
(48, 2),
(3, 2),
(44, 2),
(22, 2),
(34, 2),
(52, 4),
(21, 4),
(35, 4),
(18, 3),
(45, 3),
(11, 3),
(52, 3),
(21, 3),
(17, 2),
(43, 2),
(13, 2),
(49, 2),
(5, 2),
(16, 4),
(35, 3),
(10, 4),
(16, 3),
(40, 3),
(10, 3),
(51, 3),
(46, 2),
(23, 2),
(33, 2),
(18, 2),
(45, 2),
(11, 2),
(52, 2),
(2, 2),
(39, 2),
(21, 2),
(35, 2),
(16, 2),
(40, 2),
(10, 2),
(51, 2),
(37, 2),
(32, 2),
(31, 2),
(6, 2),
(55, 5),
(51, 4),
(32, 4),
(55, 4),
(31, 4),
(53, 4),
(54, 5),
(32, 3),
(55, 3),
(31, 3),
(54, 3),
(53, 3),
(19, 2),
(36, 2),
(24, 2),
(42, 2),
(4, 2),
(50, 5),
(27, 5),
(19, 4),
(24, 4),
(19, 3),
(36, 3),
(24, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` decimal(6,2) NOT NULL,
  `stock` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 's',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `value`, `stock`, `created_at`, `updated_at`) VALUES
(1, 'Amortecedor Traseiro', 'Amortecedor traseiro.', '271.32', 's', '2019-05-22 16:07:31', '2019-05-22 16:08:50'),
(2, 'Biela', 'Peça do motor', '1500.00', 's', '2019-05-28 15:36:14', '2019-05-28 15:36:14'),
(3, 'Bateria', 'Modelo RG43', '560.00', 's', '2019-05-29 06:43:22', '2019-05-29 06:43:22');

-- --------------------------------------------------------

--
-- Estrutura da tabela `profiles`
--

CREATE TABLE `profiles` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `cpf` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `neighborhood` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip_code` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `cpf`, `telephone`, `address`, `neighborhood`, `zip_code`, `created_at`, `updated_at`) VALUES
(1, 5, '32145678915', '61999668858', 'QNM 21 Conjunto F Lote 27', 'Ceilândia Sul', '72220204', '2019-05-22 16:11:40', '2019-05-22 16:11:40'),
(2, 7, '02678907542', '61986543656', 'QNM 21 CJ 12', 'Ceilândia Sul', '72215216', '2019-05-30 01:39:54', '2019-05-30 01:39:54');

-- --------------------------------------------------------

--
-- Estrutura da tabela `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', 'Função de administrador', '2019-05-20 14:53:42', '2019-05-20 14:53:42'),
(3, 'Gerente', 'Função de gerente', '2019-05-20 14:53:42', '2019-05-20 14:53:42'),
(4, 'Funcionario', 'Função de funcionario', '2019-05-20 14:53:42', '2019-05-20 14:53:42'),
(5, 'Cliente', 'Função de cliente', '2019-05-20 14:53:42', '2019-05-20 14:53:42');

-- --------------------------------------------------------

--
-- Estrutura da tabela `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 5),
(7, 5),
(8, 5),
(9, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `schedulings`
--

CREATE TABLE `schedulings` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `hour` time NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `situation_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `schedulings`
--

INSERT INTO `schedulings` (`id`, `date`, `hour`, `description`, `user_id`, `situation_id`, `created_at`, `updated_at`) VALUES
(1, '2019-05-23', '14:50:00', 'Alinhamento e Balanceamento.', 5, 7, '2019-05-22 16:12:56', '2019-05-22 16:21:29'),
(2, '2019-05-24', '14:50:00', 'Problema nos freios.', 5, 6, '2019-05-23 04:57:03', '2019-05-29 20:54:27'),
(3, '2019-05-30', '10:30:00', 'Problema no motor, mau funcionamento.', 5, 7, '2019-05-23 05:20:48', '2019-05-30 00:55:52'),
(4, '2019-05-30', '08:00:00', 'Meu carro está com um barulho estranho quando acelera e troca de marcha. E a porta ta ranjendo.', 7, 9, '2019-05-30 01:42:10', '2019-05-30 01:42:10'),
(5, '2019-06-01', '15:30:00', 'Estou com problemas no freio do carro e o pneu precisa trocar.', 7, 7, '2019-05-30 01:43:11', '2019-05-30 01:49:33'),
(6, '2019-05-31', '12:00:00', 'alinhamento', 9, 7, '2019-05-30 02:17:06', '2019-05-30 02:18:56');

-- --------------------------------------------------------

--
-- Estrutura da tabela `services`
--

CREATE TABLE `services` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` decimal(6,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `services`
--

INSERT INTO `services` (`id`, `name`, `description`, `value`, `created_at`, `updated_at`) VALUES
(1, 'Revisão Geral', 'Realizar troca de óleo, balanceamento etc.', '350.00', '2019-05-22 15:59:24', '2019-05-22 15:59:24'),
(2, 'Troca de Amortecedor', 'Realizar a troca do amortecedor.', '150.00', '2019-05-22 16:00:52', '2019-05-22 16:00:52'),
(3, 'Troca de Embreagem', 'Realizar a troca de embreagem.', '245.00', '2019-05-22 16:01:16', '2019-05-22 16:01:16');

-- --------------------------------------------------------

--
-- Estrutura da tabela `situations`
--

CREATE TABLE `situations` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `situations`
--

INSERT INTO `situations` (`id`, `name`, `description`, `color`, `created_at`, `updated_at`) VALUES
(1, 'Executando o serviço', 'o serviço está sendo executado neste momento.', 'info', '2019-05-22 15:26:07', '2019-05-22 15:26:07'),
(2, 'Serviço parado', 'O serviço está parado.', 'danger', '2019-05-22 15:26:29', '2019-05-22 15:26:29'),
(3, 'Supervisão', 'Serviço sendo supervisionado.', 'primary', '2019-05-22 15:27:20', '2019-05-22 15:27:20'),
(4, 'Oficina', 'Na oficina aguardando atendimento.', 'success', '2019-05-22 15:28:54', '2019-05-22 15:28:54'),
(5, 'Aguardando peças', 'Serviço aguardando peças.', 'warning', '2019-05-22 15:30:00', '2019-05-22 15:32:15'),
(6, 'Cancelado', 'Status cancelado.', 'danger', '2019-05-22 15:30:24', '2019-05-22 15:32:39'),
(7, 'Aprovado', 'Status aprovado.', 'success', '2019-05-22 15:30:47', '2019-05-22 15:33:52'),
(8, 'Indisponível', 'Status indisponível.', 'danger', '2019-05-22 15:33:01', '2019-05-22 15:34:13'),
(9, 'Pendente', 'Aguardando aprovação da oficina.', 'warning', '2019-05-22 15:34:52', '2019-05-22 15:34:52'),
(10, 'Serviço Concluído', 'O serviço foi concluído.', 'primary', '2019-05-29 19:40:29', '2019-05-29 19:40:29');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(99) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `image`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Dhemes Mota', 'dhemes.mota@gmail.com', NULL, '$2y$10$b0XmxJzbcFvkN4Q.cmZG4.OZTzwDrmSCchuL3T/CIFXO7iOURgZTy', '/perfils/padrao.png', 'kOqiBmCMN1b04VZg50TnRhJSypozYotUZTRfg6hNjERryFIC64WWdSUcNJzp', '2019-05-20 14:53:42', '2019-05-20 14:53:42'),
(6, 'Ricardo', 'ricardo@gmail.com', NULL, '$2y$10$QbNrP8qhxUQzOUpIImI1ceYbx6XDe/BIlXWeEqAg/YLF6ZHWf/zEK', '/perfils/padrao.png', 'IWTjsahQqV50JIH3IM7uB3Nlf5tz1u8uLUfr5Z0IfDAntdDLO0w6uRo3BU8S', '2019-05-29 08:05:14', '2019-05-29 08:05:14'),
(3, 'Usuário Gerente', 'gerente@gmail.com', NULL, '$2y$10$/hoe2GYzS.UjPycE./2EJeWU33X3/Wg5AOeWHAOPVLfrBS1dWQEN.', '/perfils/padrao.png', 'FOQ8orSpLMVmfz1Fvljj4oa9T8NRfxw9pVe6kyyP9aOfRD7VQ4a0CIRsNKEV', '2019-05-20 14:53:42', '2019-05-20 14:53:42'),
(4, 'Usuário Funcionário', 'funcionario@gmail.com', NULL, '$2y$10$gpSoY0DyFkjX1MQRRUPBTuy4GI1ibOlkwMqNB6T8aLoz7a/6rnZvO', '/perfils/padrao.png', '6PMoQkjqxJGRX5Te0fMO0yV3n4JqDG8J90yKKJg6KXOhvr3vfvZtSY1Vpb4L', '2019-05-20 14:53:42', '2019-05-20 14:53:42'),
(5, 'Usuario Cliente', 'cliente@gmail.com', NULL, '$2y$10$XeGB1.UazuZMEIvE6Hwqmu7IaNLbrpYBRWdG5Kf3/REpuK1R68aVG', '/perfils/padrao.png', 'uHD3OQyjEq8jf8FJ2h7gKIBpSmjHsCS1VTw3VYkz6xYevxyRkr6Iv00KFTE7', '2019-05-20 14:53:42', '2019-05-20 14:53:42'),
(7, 'Carol Mota', 'carol.mota@gmail.com', NULL, '$2y$10$eFcD4vL3UuMq39gGo/eJ.uZ.2GCDwl3Z2pciio24RSAgmRWcK8dqS', '/perfils/padrao.png', 'lbdILEqAS4AhkaG3yFUvtgG8zuluvcI4WruNVYvuXnl72dWI1pj8W4x7zsm1', '2019-05-30 01:36:25', '2019-05-30 01:36:25'),
(8, 'Juca', 'juca@gmail.com', NULL, '$2y$10$5DSQdC0OGkvzs6.2O9NaIuhlfr4eZdYmRbSNsl.Q.X2ZT.MA3zCeu', '/perfils/padrao.png', 'eI2CS6hjq8xILNq0gm0dwNL4QqOeBSFzde26YWj2vHBVyUPUYzKxIIq3FDTE', '2019-05-30 01:48:03', '2019-05-30 01:48:03');

-- --------------------------------------------------------

--
-- Estrutura da tabela `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(10) UNSIGNED NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `board` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `vehicles`
--

INSERT INTO `vehicles` (`id`, `model`, `color`, `year`, `board`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Honda Civic', 'Branco', '2018/2019', 'ASB4587', 5, '2019-05-22 16:14:12', '2019-05-22 16:14:12'),
(2, 'GOL G6', 'Preto', '2019/2019', 'BGC3423', 5, '2019-05-27 01:48:36', '2019-05-27 01:48:36'),
(3, 'HB20', 'Branco', '2019/2019', 'DHD4878', 6, '2019-05-29 16:14:04', '2019-05-29 16:14:04'),
(4, 'Honda Civic', 'Preto', '2019', 'PAE1456', 7, '2019-05-30 01:46:08', '2019-05-30 01:47:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `budgets`
--
ALTER TABLE `budgets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `budgets_situation_id_foreign` (`situation_id`),
  ADD KEY `budgets_client_id_foreign` (`client_id`),
  ADD KEY `budgets_vehicle_id_foreign` (`vehicle_id`),
  ADD KEY `budgets_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `budget_products`
--
ALTER TABLE `budget_products`
  ADD PRIMARY KEY (`budget_id`,`product_id`),
  ADD KEY `budget_products_budget_id_foreign` (`budget_id`),
  ADD KEY `budget_products_product_id_foreign` (`product_id`);

--
-- Indexes for table `budget_services`
--
ALTER TABLE `budget_services`
  ADD KEY `budget_services_budget_id_foreign` (`budget_id`),
  ADD KEY `budget_services_service_id_foreign` (`service_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD KEY `permission_role_permission_id_foreign` (`permission_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `profiles_cpf_unique` (`cpf`),
  ADD KEY `profiles_user_id_foreign` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD KEY `role_user_user_id_foreign` (`user_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `schedulings`
--
ALTER TABLE `schedulings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schedulings_user_id_foreign` (`user_id`),
  ADD KEY `schedulings_situation_id_foreign` (`situation_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `situations`
--
ALTER TABLE `situations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicles_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `budgets`
--
ALTER TABLE `budgets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `schedulings`
--
ALTER TABLE `schedulings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `situations`
--
ALTER TABLE `situations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
