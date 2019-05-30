-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 30 2019 г., 13:24
-- Версия сервера: 5.7.20
-- Версия PHP: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `PHPMVC_FRAMEWORK`
--

-- --------------------------------------------------------

--
-- Структура таблицы `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `articles`
--

INSERT INTO `articles` (`id`, `author_id`, `name`, `text`, `created_at`) VALUES
(1, 1, 'Новое название статьи', 'Новый текст статьи', '2019-05-28 21:22:45'),
(2, 1, 'Второй пост', 'PHP это один из самых популярных языков для создания веб сайтов на сегодня. ', '2019-05-28 21:22:46'),
(3, 1, 'Новое название статьи2', 'Новый текст статьи2', '2019-05-29 17:13:07'),
(4, 1, 'Новое название статьи2', 'Новый текст статьи2', '2019-05-29 17:14:37');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nickname` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `is_confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `role` enum('admin','user') NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `auth_token` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `nickname`, `email`, `is_confirmed`, `role`, `password_hash`, `auth_token`, `created_at`) VALUES
(1, 'admin', 'admin@gmail.com', 1, 'admin', 'hash1', 'token1', '2019-05-29 13:15:10'),
(2, 'user', 'user@gmail.com', 1, 'user', 'hash2', 'token2', '2019-05-29 13:15:10'),
(4, 'sam', 'genkins@mail.ru', 0, 'user', '$2y$10$FrlcSxf7FavYlw/2P4Yaju8jthidx5xxgD/UPEgux01GhaiQ1DZwu', 'ea51194427ba65df50bb16d21545e5f30bcdc701ee5982ce8ac398d0ac28e944c01d9ead9d1388b0', '2019-05-30 11:45:07');

-- --------------------------------------------------------

--
-- Структура таблицы `users_activation_codes`
--

CREATE TABLE `users_activation_codes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users_activation_codes`
--

INSERT INTO `users_activation_codes` (`id`, `user_id`, `code`) VALUES
(1, 8, '725925cfec68a75b6709b1424a5004e5');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nickname` (`nickname`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Индексы таблицы `users_activation_codes`
--
ALTER TABLE `users_activation_codes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `users_activation_codes`
--
ALTER TABLE `users_activation_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
