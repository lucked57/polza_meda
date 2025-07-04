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

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
