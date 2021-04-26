-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 26 2021 г., 09:53
-- Версия сервера: 8.0.19
-- Версия PHP: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `oop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` tinyint UNSIGNED NOT NULL,
  `name` varchar(40) NOT NULL,
  `surname` varchar(40) NOT NULL,
  `email` varchar(60) NOT NULL,
  `birthday` year NOT NULL,
  `gender` enum('M','F') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `code` varchar(80) NOT NULL COMMENT 'Уникальный код для каждого пользователя'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `birthday`, `gender`, `code`) VALUES
(1, 'Эмиль', 'Гусейнов', 'emilhuseynov86@gmail.com', 1986, 'M', '^}LPt5yi?8sloj^z9kS5$H%dDKEu6MNJzYM9TXD[DrOH^+M.NUea331PEOuxVAFPZOMmoSSYdL,cDG2*'),
(2, 'Заур', 'Гусейнов', 'mister.zaur@gmail.com', 1984, 'M', 'aKg3!.nMOyP$%sLn~iMh6~t`.5S+j*ToUTemkZXz^3*~I+KY~r-4d8i9.%OK%0LkFUs?jgCKDb1ut[%C'),
(3, 'Эльчин', 'Гусейнов', 'aze994@mail.ru', 1988, 'M', 'P]BN+DfvKk2Ha{%59?Kmba((7K7soS?3}*z[7zX6hJ60)PDOHT?pCPcxB49tgXm[o0c~s3e),9kF-hdX');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` tinyint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
