-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 18 2023 г., 21:25
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `crud`
--

-- --------------------------------------------------------

--
-- Структура таблицы `crudUsers`
--

CREATE TABLE `crudUsers` (
  `id` int NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `flag` int DEFAULT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `crudUsers`
--

INSERT INTO `crudUsers` (`id`, `created_at`, `updated_at`, `name`, `email`, `password`, `flag`, `token`) VALUES
(23, '2023-02-18 21:12:36', '2023-02-18 21:16:47', 'denis', 'korbakovd@gmail.com', '123123123123213123121230000', 0, '3KYLUVTAS6'),
(24, '2023-02-18 21:12:57', '2023-02-18 21:12:57', 'dima', 'dima@gmail.com', '43634634634', 0, '3KYLUVTAS6'),
(25, '2023-02-18 21:14:07', '2023-02-18 21:14:36', 'alex', 'alex@gmail.com', '67967967961', 0, 'C2NF9OEJ8M'),
(26, '2023-02-18 21:14:26', '2023-02-18 21:14:26', 'oleg', 'oleg@gmail.com', '8435485748', 0, 'C2NF9OEJ8M');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `login` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `token`) VALUES
(2, 'deniskorbakov', '$2y$12$A7FJey1FVOPI8wteFUqSW.GqUiWiUdqXDQV6.IS71.vWAGQvRb3Lu', '3KYLUVTAS6'),
(5, 'deniskorbakov1', '$2y$12$4bjeqYC34rAeorEXMqsHretiayiTcT8cRyQkqT4tiKeYTyTunUJ3O', 'C2NF9OEJ8M');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `crudUsers`
--
ALTER TABLE `crudUsers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `crudUsers`
--
ALTER TABLE `crudUsers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
