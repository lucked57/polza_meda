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

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
