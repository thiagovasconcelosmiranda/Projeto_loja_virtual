-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30-Out-2024 às 14:46
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_loja_virtual`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `installments`
--

CREATE TABLE `installments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `qtd_parc` int(11) NOT NULL,
  `parc_price` decimal(8,2) NOT NULL,
  `data_venc` varchar(80) NOT NULL,
  `sale_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `installments`
--

INSERT INTO `installments` (`id`, `qtd_parc`, `parc_price`, `data_venc`, `sale_id`, `created_at`, `updated_at`) VALUES
(15, 8, 875.00, '2024-10-31', 27, '2024-10-28 01:40:17', '2024-10-28 01:40:17'),
(17, 1, 2460.00, '2024-10-31', 29, '2024-10-28 04:46:17', '2024-10-28 04:46:17'),
(18, 8, 1312.50, '2024-10-31', 30, '2024-10-28 04:47:13', '2024-10-28 04:47:13'),
(19, 1, 7000.00, '2024-10-31', 31, '2024-10-28 05:24:57', '2024-10-28 05:24:57'),
(20, 1, 2460.00, '2024-10-28', 32, '2024-10-28 17:54:06', '2024-10-28 17:54:06'),
(21, 1, 0.00, '2024-11-01', 33, '2024-10-28 17:55:07', '2024-10-28 17:55:38'),
(22, 6, 583.33, '2024-10-23', 34, '2024-10-30 15:57:57', '2024-10-30 15:57:57'),
(23, 7, 71.43, '3/9/2024', 36, '2024-10-30 16:37:51', '2024-10-30 16:37:51');

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 2),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(5, '2024_10_25_224337_create_products_table', 2),
(6, '2024_10_25_230654_create_sales_table', 3),
(7, '2024_10_25_232801_create_buys_table', 4),
(8, '2024_10_26_010051_create_installments_table', 5),
(9, '2024_10_28_122333_create_seller_table', 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(100) NOT NULL,
  `name_product` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `qtd` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `products`
--

INSERT INTO `products` (`id`, `image`, `name_product`, `description`, `price`, `qtd`, `created_at`, `updated_at`) VALUES
(1, 'product1.jpg', 'Console PlayStantion 5', 'PlayStation 5 Console [videogame]', 3500.00, 50, '2024-10-26 12:56:10', '2024-10-26 12:56:10'),
(2, 'product2.jpg', 'Console Xbox serie S', 'Xbox Series S 550GB acompanha cabos e controle cor branco', 3500.00, 100, '2024-10-26 13:12:30', '2024-10-26 13:12:30'),
(3, 'product3.jpg', 'Console Nintendo Switch OLED', 'Console Nintendo Switch OLED - Azul e Vermelho Neon', 2460.00, 100, '2024-10-26 13:03:42', '2024-10-26 13:03:42'),
(4, 'product4.jpg', 'Jogo PlayStation 5 Sniper Elite 5', 'Cd Jogo PlayStation 5 Sniper Elite 5, acompanha manual.', 350.00, 500, '2024-10-26 13:05:07', '2024-10-26 13:05:07'),
(5, 'product5.jpg', 'Jogo Mortal Combate 11', 'Cd Jogo Mortal Combate 11 acompanha manual', 250.00, 500, '2024-10-26 13:13:07', '2024-10-26 13:13:07');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `form_pag` varchar(80) NOT NULL,
  `qtd_product` int(11) NOT NULL,
  `subtotal_product` decimal(8,2) NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `seller_id` bigint(11) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `sales`
--

INSERT INTO `sales` (`id`, `form_pag`, `qtd_product`, `subtotal_product`, `product_id`, `seller_id`, `user_id`, `created_at`, `updated_at`) VALUES
(27, 'Cartão de Crédito', 2, 7000.00, 2, 2, 1, '2024-10-28 01:40:17', '2024-10-28 01:40:17'),
(29, 'Pix', 1, 2460.00, 3, 0, 1, '2024-10-28 04:46:16', '2024-10-28 04:46:16'),
(30, 'Cartão de Crédito', 3, 10500.00, 1, 3, 1, '2024-10-28 04:47:12', '2024-10-28 04:47:12'),
(31, 'Boleto', 2, 7000.00, 2, 1, 1, '2024-10-28 05:24:57', '2024-10-28 05:24:57'),
(32, 'undefined', 1, 2460.00, 3, 1, 2, '2024-10-28 17:54:05', '2024-10-28 17:54:05'),
(33, 'Boleto', 2, 4920.00, 3, 3, 2, '2024-10-28 17:55:07', '2024-10-28 17:55:38'),
(34, 'Cartão de Crédito', 1, 3500.00, 1, 1, 1, '2024-10-30 15:57:56', '2024-10-30 15:57:56'),
(35, 'Cartão de Crédito', 2, 500.00, 5, 2, 1, '2024-10-30 16:22:16', '2024-10-30 16:22:16'),
(36, 'Cartão de Crédito', 2, 500.00, 5, 2, 1, '2024-10-30 16:37:51', '2024-10-30 16:37:51');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sellers`
--

CREATE TABLE `sellers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_seller` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `sellers`
--

INSERT INTO `sellers` (`id`, `name_seller`, `created_at`, `updated_at`) VALUES
(1, 'Luiz Oliveira', '2024-10-28 12:35:30', '2024-10-28 12:35:30'),
(2, 'Nicole Nascimento', '2024-10-28 12:35:30', '2024-10-28 12:35:30'),
(3, 'Rosana Pais', '2024-10-28 12:36:30', '2024-10-28 12:36:30');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'thiago', 'thiago@gmail.com', NULL, '$2y$12$xGwPhwZjZ5UHc31nUj6pAeP.PpSGB8lfsD/6WqE9qOXJJfz2sXJJe', '', '2024-10-26 14:59:13', '2024-10-26 14:59:13'),
(2, 'teste', 'teste@gmail.com', NULL, '$2y$12$kv9fo6.vIUzjUgXn0yU2G.ACiFTfC6qHIO.YU17zcfVn7CEotX.BK', NULL, '2024-10-28 05:21:58', '2024-10-28 05:21:58');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Índices para tabela `installments`
--
ALTER TABLE `installments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `installments_sale_id_foreign` (`sale_id`);

--
-- Índices para tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Índices para tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Índices para tabela `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_product_id_foreign` (`product_id`),
  ADD KEY `sales_user_id_foreign` (`user_id`);

--
-- Índices para tabela `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `installments`
--
ALTER TABLE `installments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de tabela `sellers`
--
ALTER TABLE `sellers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `installments`
--
ALTER TABLE `installments`
  ADD CONSTRAINT `installments_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`);

--
-- Limitadores para a tabela `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `sales_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
