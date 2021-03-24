-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24-Mar-2021 às 04:12
-- Versão do servidor: 10.4.14-MariaDB
-- versão do PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `hpj`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `bedrooms`
--

CREATE TABLE `bedrooms` (
  `id` int(11) NOT NULL,
  `number` int(3) NOT NULL,
  `description` varchar(100) NOT NULL,
  `floor` int(1) DEFAULT NULL,
  `extension_phone` int(11) DEFAULT NULL,
  `capacity` int(2) NOT NULL,
  `comments` text DEFAULT NULL,
  `type` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `permission_groups`
--

CREATE TABLE `permission_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `permission_groups`
--

INSERT INTO `permission_groups` (`id`, `name`) VALUES
(1, 'Desenvolvedor'),
(2, 'Administrativo'),
(3, 'Gerência'),
(4, 'Funcionários');

-- --------------------------------------------------------

--
-- Estrutura da tabela `permission_items`
--

CREATE TABLE `permission_items` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `type` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `permission_items`
--

INSERT INTO `permission_items` (`id`, `name`, `slug`, `type`) VALUES
(1, 'Permissões', 'permissions_view', 1),
(2, 'Permissões', 'permissions_add', 2),
(3, 'Permissões', 'permissions_edit', 3),
(4, 'Permissões', 'permissions_del', 4),
(5, 'Usuários', 'users_view', 1),
(6, 'Usuários', 'users_add', 2),
(7, 'Usuários', 'users_edit', 3),
(8, 'Usuários', 'users_del', 4),
(9, 'Produtos', 'products_view', 1),
(10, 'Produtos', 'products_add', 2),
(11, 'Produtos', 'products_edit', 3),
(12, 'Produtos', 'products_del', 4),
(13, 'Serviços', 'services_view', 1),
(14, 'Serviços', 'services_add', 2),
(15, 'Serviços', 'services_edit', 3),
(16, 'Serviços', 'services_del', 4),
(17, 'Quartos', 'bedrooms_view', 1),
(18, 'Quartos', 'bedrooms_add', 2),
(19, 'Quartos', 'bedrooms_edit', 3),
(20, 'Quartos', 'bedrooms_del', 4),
(21, 'Reservar/Hospedar', 'hosting_view', 1),
(22, 'Reservar/Hospedar', 'hosting_add', 2),
(23, 'Reservar/Hospedar', 'hosting_edit', 3),
(24, 'Reservar/Hospedar', 'hosting_del', 4),
(25, 'Administrativo', 'management_view', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `permission_links`
--

CREATE TABLE `permission_links` (
  `id` int(11) NOT NULL,
  `id_permission_group` int(11) NOT NULL,
  `id_permission_item` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `permission_links`
--

INSERT INTO `permission_links` (`id`, `id_permission_group`, `id_permission_item`) VALUES
(33, 1, 1),
(34, 1, 5),
(35, 1, 9),
(36, 1, 13),
(37, 1, 17),
(38, 1, 21),
(39, 1, 25),
(40, 1, 2),
(41, 1, 6),
(42, 1, 10),
(43, 1, 14),
(44, 1, 18),
(45, 1, 22),
(46, 1, 3),
(47, 1, 7),
(48, 1, 11),
(49, 1, 15),
(50, 1, 19),
(51, 1, 23),
(52, 1, 4),
(53, 1, 8),
(54, 1, 12),
(55, 1, 16),
(56, 1, 20),
(57, 1, 24);

-- --------------------------------------------------------

--
-- Estrutura da tabela `products`
--

CREATE TABLE `products` (
  `id` int(10) NOT NULL,
  `description` varchar(200) NOT NULL,
  `price` float NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `products`
--

INSERT INTO `products` (`id`, `description`, `price`, `status`) VALUES
(1, 'agua mineral 500 ml', 2.7, 1),
(2, 'Coca-cola lata 330ml', 4, 2),
(3, 'Suco', 7, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `services`
--

CREATE TABLE `services` (
  `id` int(10) NOT NULL,
  `description` varchar(200) NOT NULL,
  `price` float NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `services`
--

INSERT INTO `services` (`id`, `description`, `price`, `status`) VALUES
(1, 'Hospedagem Simples', 50, 1),
(2, 'Café da Manhã', 13, 1),
(3, 'Almoço', 17, 1),
(4, 'Hospedagem com café', 60, 2),
(5, 'Jantar', 15, 1),
(6, 'Hospedagem Mensal com café da manhã', 1250, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_permission` int(11) NOT NULL,
  `email` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  `name` varchar(100) DEFAULT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `token` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `id_permission`, `email`, `password`, `name`, `admin`, `token`) VALUES
(1, 1, 'admin1@admin.com.br', 'e10adc3949ba59abbe56e057f20f883e', 'Admin1', 1, '3dfb54de3b6fbafb41b884445d5e08df'),
(2, 1, 'admin2@admin.com', 'd0f82e1046ccbd597c7f2a7bfba9e7dd', 'Admin2', 1, 'c0312ce739656110ddad5d6feab67cf6');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `bedrooms`
--
ALTER TABLE `bedrooms`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `permission_groups`
--
ALTER TABLE `permission_groups`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `permission_items`
--
ALTER TABLE `permission_items`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `permission_links`
--
ALTER TABLE `permission_links`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `services`
--
ALTER TABLE `services`
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
-- AUTO_INCREMENT de tabela `bedrooms`
--
ALTER TABLE `bedrooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `permission_groups`
--
ALTER TABLE `permission_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `permission_items`
--
ALTER TABLE `permission_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `permission_links`
--
ALTER TABLE `permission_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
