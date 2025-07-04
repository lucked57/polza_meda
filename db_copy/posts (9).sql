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

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
