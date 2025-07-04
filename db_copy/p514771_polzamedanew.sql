-- phpMyAdmin SQL Dump
-- version 5.2.1-1.el8
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Июн 23 2025 г., 08:49
-- Версия сервера: 8.0.41-32
-- Версия PHP: 7.2.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `p514771_polzamedanew`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel_07fffc0a4799e197dffff9d2696b17325c686c88', 'i:1;', 1750566388),
('laravel_07fffc0a4799e197dffff9d2696b17325c686c88:timer', 'i:1750566388;', 1750566388),
('laravel_356a192b7913b04c54574d18c28d46e6395428ab', 'i:1;', 1750664626),
('laravel_356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1750664626;', 1750664626),
('laravel_d9bf051a87e82937b3491353a3d9e6830073c00e', 'i:1;', 1750664654),
('laravel_d9bf051a87e82937b3491353a3d9e6830073c00e:timer', 'i:1750664654;', 1750664654);

-- --------------------------------------------------------

--
-- Структура таблицы `gallery`
--

CREATE TABLE `gallery` (
  `id` int NOT NULL,
  `img_full` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `img_min` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `gallery`
--

INSERT INTO `gallery` (`id`, `img_full`, `img_min`, `created_at`, `updated_at`, `title`) VALUES
(4, 'images_folder/gallery/1750581152_6857bfa0a79d1.jpeg', 'images_folder/gallery/1750581152_6857bfa0a79d1_min.jpeg', '2025-06-22 05:32:32', '2025-06-22 05:32:32', NULL),
(5, 'images_folder/gallery/1750581152_6857bfa0bc8c4.jpeg', 'images_folder/gallery/1750581152_6857bfa0bc8c4_min.jpeg', '2025-06-22 05:32:32', '2025-06-22 05:32:32', NULL),
(6, 'images_folder/gallery/1750581152_6857bfa0cf602.jpeg', 'images_folder/gallery/1750581152_6857bfa0cf602_min.jpeg', '2025-06-22 05:32:32', '2025-06-22 05:32:32', NULL),
(7, 'images_folder/gallery/1750581152_6857bfa0e3ab4.jpeg', 'images_folder/gallery/1750581152_6857bfa0e3ab4_min.jpeg', '2025-06-22 05:32:32', '2025-06-22 05:32:32', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE `images` (
  `id` int NOT NULL,
  `page` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `imagename` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id`, `page`, `imagename`, `created_at`, `updated_at`) VALUES
(1, 'default', 'images//img_6857ae9d076b44.68569000_1750576797.jpg', '2025-06-22 01:48:19', '2025-06-22 04:19:57');

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` text NOT NULL,
  `main_img` varchar(255) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status_sold` tinyint DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'post',
  `img_path_1` varchar(255) DEFAULT NULL,
  `img_path_2` varchar(255) DEFAULT NULL,
  `img_path_3` varchar(255) DEFAULT NULL,
  `img_path_4` varchar(255) DEFAULT NULL,
  `img_path_5` varchar(255) DEFAULT NULL,
  `img_path_6` varchar(255) DEFAULT NULL,
  `img_path_7` varchar(255) DEFAULT NULL,
  `img_path_8` varchar(255) DEFAULT NULL,
  `img_path_9` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `title`, `description`, `main_img`, `email`, `created_at`, `updated_at`, `status_sold`, `type`, `img_path_1`, `img_path_2`, `img_path_3`, `img_path_4`, `img_path_5`, `img_path_6`, `img_path_7`, `img_path_8`, `img_path_9`) VALUES
(30, 'Деревянный боченок для меда', '<div class=\"col-12\">\r\n                                    <p class=\"display-4 text-primary text-card-type\">1 <small class=\"text-in-p\">шт.</small> (2 <small class=\"text-in-p\">кг.</small>) </p>\r\n                                    <p class=\"text-white text-card-price\">1190</p>\r\n                                    <p class=\"text-white\">руб.</p>\r\n                                </div>', 'images_folder/posts/img_6857e0b2bd3bc5.21393387_1750589618.png', NULL, '2025-06-22 07:53:38', '2025-06-22 07:53:38', 0, 'market', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 'Апельсиновый мёд', '<div class=\"col-6\">\r\n                                    <p class=\"display-4 text-primary text-card-type\">0.5 <small class=\"text-in-p\">л.</small> </p>\r\n                                    <p class=\"text-white text-card-price\">1000</p>\r\n                                    <p class=\"text-white\">руб.</p>\r\n                                </div>\r\n                                <div class=\"col-6\">\r\n                                    <p class=\"display-4 text-primary text-card-type\">1 <small class=\"text-in-p\">л.</small> </p>\r\n                                    <p class=\"text-white text-card-price\">1800</p>\r\n                                    <p class=\"text-white\">руб.</p>\r\n                                </div>', 'images_folder/posts/img_6857e1b2323b98.05495346_1750589874.png', NULL, '2025-06-22 07:57:54', '2025-06-22 07:57:54', 1, 'market', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 'Донниковый мед', '<div class=\"col-4\">\r\n                                    <p class=\"display-4 text-primary text-card-type\">0.5 <small class=\"text-in-p\">л.</small> </p>\r\n                                    <p class=\"text-white text-card-price\">400</p>\r\n                                    <p class=\"text-white\">руб.</p>\r\n                                </div>\r\n                                <div class=\"col-4\">\r\n                                    <p class=\"display-4 text-primary text-card-type\">1 <small class=\"text-in-p\">л.</small> </p>\r\n                                    <p class=\"text-white text-card-price\">700</p>\r\n                                    <p class=\"text-white\">руб.</p>\r\n                                </div>\r\n                                <div class=\"col-4\">\r\n                                    <p class=\"display-4 text-primary text-card-type\">2 <small class=\"text-in-p\">л.</small> </p>\r\n                                    <p class=\"text-white text-card-price\">1200</p>\r\n                                    <p class=\"text-white\">руб.</p>\r\n                                </div>', 'images_folder/posts/img_6857e1f44e4f48.41579789_1750589940.png', NULL, '2025-06-22 07:59:00', '2025-06-22 07:59:00', 1, 'market', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 'Гречишный мед', '<div class=\"col-4\">\r\n                                    <p class=\"display-4 text-primary text-card-type\">0.5 <small class=\"text-in-p\">л.</small> </p>\r\n                                    <p class=\"text-white text-card-price\">400</p>\r\n                                    <p class=\"text-white\">руб.</p>\r\n                                </div>\r\n                                <div class=\"col-4\">\r\n                                    <p class=\"display-4 text-primary text-card-type\">1 <small class=\"text-in-p\">л.</small> </p>\r\n                                    <p class=\"text-white text-card-price\">700</p>\r\n                                    <p class=\"text-white\">руб.</p>\r\n                                </div>\r\n                                <div class=\"col-4\">\r\n                                    <p class=\"display-4 text-primary text-card-type\">2 <small class=\"text-in-p\">л.</small> </p>\r\n                                    <p class=\"text-white text-card-price\">1200</p>\r\n                                    <p class=\"text-white\">руб.</p>\r\n                                </div>', 'images_folder/posts/img_6857e20e4a09c1.30202033_1750589966.png', NULL, '2025-06-22 07:59:26', '2025-06-22 07:59:26', 1, 'market', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 'Польза меда', 'Мед обладает множеством полезных свойств для организма, включая укрепление иммунитета, улучшение пищеварения, ускорение заживления ран, снижение уровня холестерина и антиоксидантную защиту. Он также может быть полезен для кожи и обладает расслабляющим действием. \r\nБолее подробно о пользе меда:\r\nУкрепление иммунитета:\r\nМед содержит витамины (в том числе группы В, С, К, Е, провитамин А) и минералы (фосфор, калий, кальций, магний, натрий, железо, цинк), которые необходимы для нормальной работы иммунной системы. \r\nУлучшение пищеварения:\r\nМед помогает улучшить работу желудка и кишечника, а также может оказывать противовоспалительное действие. \r\nАнтиоксидантные свойства:\r\nМед богат антиоксидантами, которые защищают организм от повреждения свободными радикалами и снижают риск развития сердечно-сосудистых заболеваний и онкологических заболеваний. \r\nЗаживление ран и ожогов:\r\nМед обладает антибактериальными и противовоспалительными свойствами, что способствует ускоренному заживлению ран и ожогов. \r\nУлучшение состояния кожи:\r\nМед может улучшить состояние кожи, сделать ее более чистой и сияющей. \r\nСнижение уровня холестерина:\r\nМед может помочь снизить уровень холестерина в крови. \r\nУлучшение сна и расслабление:\r\nМед может способствовать расслаблению и улучшению качества сна. \r\nПовышение энергии:\r\nУпотребление меда может повысить уровень энергии и улучшить концентрацию. \r\nПомощь при простуде:\r\nМед может облегчить симптомы простуды и кашля. \r\nЗамена сахара:\r\nНекоторые исследования показывают, что замена сахара медом может помочь предотвратить увеличение веса и снизить уровень сахара в крови. \r\nРекомендации по употреблению меда:\r\nВзрослым рекомендуется употреблять 100-150 г меда в день, разделенных на несколько приемов. \r\nДля лучшего усвоения мед лучше принимать за 1,5-2 часа до еды или через 3 часа после. \r\nМед можно добавлять в чай, воду, каши или употреблять в чистом виде. \r\nВажно: Несмотря на все полезные свойства, мед может вызывать аллергические реакции у некоторых людей. Также, людям с сахарным диабетом следует употреблять мед с осторожностью и проконсультироваться с врачом.', 'images_folder/posts/img_6858f9a0d3f154.64487283_1750661536.jpg', NULL, '2025-06-23 03:52:16', '2025-06-23 03:52:16', 1, 'post', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 'Что такое Мёд?', 'Мед - это сладкое вещество, которое вырабатывается пчелами из нектара цветов или других сладких веществ. Он является популярным продуктом питания и используется в медицине, кулинарии и косметологии. \r\nБолее подробно о меде:\r\nСостав:\r\nМед состоит в основном из сахаров (глюкозы и фруктозы), воды, а также содержит витамины, минералы, ферменты и другие биологически активные вещества. \r\nПроизводство:\r\nПчелы собирают нектар с цветов и переносят его в улей, где он подвергается процессу обезвоживания и ферментативной обработке, превращаясь в мед. \r\nРазновидности:\r\nМед бывает разных видов, в зависимости от растений, с которых был собран нектар. Например, гречишный мед, липовый мед, цветочный мед. \r\nПольза:\r\nМед обладает противомикробными, противовоспалительными и антиоксидантными свойствами. Он также может использоваться для лечения простудных заболеваний, укрепления иммунитета и повышения энергии. \r\nПрименение:\r\nМед широко используется в пищевой промышленности (для выпечки, десертов, напитков), в медицине (для лечения ран, ожогов, простудных заболеваний) и в косметологии (в масках для лица и волос). \r\nПротивопоказания:\r\nМед не рекомендуется употреблять детям до 1 года, а также людям с аллергией на мед. \r\nСуточная норма:\r\nРекомендуемая суточная норма потребления меда для взрослого человека составляет не более 150 грамм.', 'images_folder/posts/img_685900b63d9d32.42602101_1750663350.webp', NULL, '2025-06-23 04:14:03', '2025-06-23 04:22:30', 1, 'post', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('1rzH8BDhsGKnT7BFzw9eppTHeee4GJ2jJbpPGcFh', NULL, '49.151.18.82', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoib05scURlUmVtZUdaMFFSMFhIbHNVSDNBczEyZHVwcmVRRk5tblJyeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHBzOi8vcGNoZWx5a29yb2xldi5tY2Rpci5ydS9hcGkvbWFya2V0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1750591527),
('2NEoG9r18x9dNFrETNvjgITGWDC2P31PA0YSj9Bw', NULL, '104.236.44.95', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:66.0) WhatCMS/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieDBzNm0yOTZzYjB5OEZBdUQyUDBXVVBxVkxiQmdPRFJXaDQ0cmdQbCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vcGNoZWx5a29yb2xldi5tY2Rpci5ydSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1750591422),
('3LTZiJDI1igU4PuZ9pas2geMz0LAADwMspjtL865', 2, '49.151.18.82', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoic05QTTVuOTd1UTlGRlJVTkg1Q0pBNk4xRFZ0UkMwbW13MXVSWTNDQyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0ODoiaHR0cHM6Ly9wY2hlbHlrb3JvbGV2Lm1jZGlyLnJ1L3JlZ2lzdGVyLzIvNDY3NDMwIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHBzOi8vcGNoZWx5a29yb2xldi5tY2Rpci5ydS9hcGkvaW1hZ2VzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1750566801),
('7w47NCJM1ptlgRTbt3abF2OovUFpGFh6wr1h68n7', NULL, '49.151.18.82', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidTA3VjZZQTRBdDN1dXRhVGpySWRVdEVHOGlsSlJxTjNnczNRYTNpbyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vcGNoZWx5a29yb2xldi5tY2Rpci5ydSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1750592368),
('CqWdvS3uq1YqVGD5xVrGe8vvnLwnGpWjXnEIOSPS', NULL, '49.151.18.82', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_4_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.4 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQmh2OUxLbUpZQ0s1WmtyVVRjMExYN0VGOFFKc3hPYkhtVkd1SUhLYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly9wY2hlbHlrb3JvbGV2Lm1jZGlyLnJ1Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1750664617),
('DYFQYV8XMKJ3uLtdXJk35HnckqsKoBDDNI9MaNOK', NULL, '49.151.18.82', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_4_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.4 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZXhtSk9iUG1zNFBLWXd3dFRSTW9scHdVTzRoQ1l5MXNqNml2SVdKeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly9wY2hlbHlrb3JvbGV2Lm1jZGlyLnJ1L2FwaS9nYWxsZXJ5Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1750579384),
('FSl1uP2Ru0hOm5OPSTJtcPuMbnkStlqr5iAG8KQR', 1, '49.151.18.82', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWEdpRm5BaG53S1dBN2xscjZSZkNzUTZ4RjR4M0NaeTRGc1pDUFpLbyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vcGNoZWx5a29yb2xldi5tY2Rpci5ydSI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1750664929),
('FwAU5SGpmTZCdpDrmZJErUk22EFeBLV1l6Uz6XD8', NULL, '103.125.244.69', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVXBDSzR3STVXQ3c5bkR6bHNHek5HUjd3OVRBTXVKN2NOejczT3Q0MCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDc6Imh0dHA6Ly9wY2hlbHlrb3JvbGV2Lm1jZGlyLnJ1L3JlZ2lzdGVyLzEvNTcwOTI4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1750566328),
('mo4RR4FFz50u5G18oBqmGfOhNA21hKD5dOgariKr', NULL, '49.151.18.82', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidDJzSUZvN3JJTTBwZjNrT056MkRINU9oT3U4RFBtd1pWSlUzV2Z2RSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHBzOi8vcGNoZWx5a29yb2xldi5tY2Rpci5ydS9hcGkvaW1hZ2VzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1750575657),
('MukuGU7SJLWYtfFuXTEOLm3I9pKF46s1p9lPOIl1', NULL, '49.151.18.82', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUnNuek4zNDJ3UG1Fck1rTFM3STQ5YzBlRlM4UExoOFBFeTdxREdJWCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHBzOi8vcGNoZWx5a29yb2xldi5tY2Rpci5ydS9hcGkvcG9zdHMiO319', 1750664857),
('zT60AQtLMjmaBjb2LBPlPA504bqhq7ubBQWRVtP9', NULL, '49.151.18.82', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQnh3aWdzT3dvZ3lnZVp3N1o1eUlac1I1d0VGUmxISkV1SzdibGY5ZiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHBzOi8vcGNoZWx5a29yb2xldi5tY2Rpci5ydS9hcGkvcG9zdHMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1750584394);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `failed_lockouts` int DEFAULT '0',
  `is_locked` tinyint(1) DEFAULT '0',
  `is_blocked_by_admin` tinyint(1) DEFAULT NULL,
  `email_verification_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `message_to_email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `is_admin`, `remember_token`, `created_at`, `updated_at`, `failed_lockouts`, `is_locked`, `is_blocked_by_admin`, `email_verification_code`, `message_to_email`) VALUES
(1, 'Admin', 'ip557799@gmail.com', '2025-06-22 01:25:07', '$2y$12$J9rTdfK2Y35mwzGMbR46wenYQpb4Y/0p8u3DFu/xaEDXTLVH.qPoe', 1, 'HUZUrjmISPSWdrzfORRxISNHdTXQELWucBCy5DAr0UphQ0ICALqdWMIJWAKc', '2025-06-22 01:24:46', '2025-06-23 06:59:40', 0, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `usertext`
--

CREATE TABLE `usertext` (
  `id` int NOT NULL,
  `text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `page` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `usertext`
--

INSERT INTO `usertext` (`id`, `text`, `page`, `created_at`, `updated_at`) VALUES
(1, 'Наша история началась в далеком 2009 году. Это было время активного развития пчеловодства и ярмарок меда в России. В то время мы увлеклись этой темой, посещали ярмарки, куда съезжались пчеловоды со всей России, чтобы представить свою продукцию. Мы много ездили, пробовали, покупали мед для себя и близких, общались с мастерами своего дела.', 'default', '0000-00-00 00:00:00', '2025-06-22 04:17:17');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Индексы таблицы `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Индексы таблицы `usertext`
--
ALTER TABLE `usertext`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `images`
--
ALTER TABLE `images`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `usertext`
--
ALTER TABLE `usertext`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
