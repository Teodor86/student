-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 23 2020 г., 09:20
-- Версия сервера: 5.7.29
-- Версия PHP: 7.4.5

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
  `uid` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(40) NOT NULL,
  `surname` varchar(40) NOT NULL,
  `email` varchar(60) NOT NULL,
  `birthday` year(4) NOT NULL,
  `gender` enum('M','W') NOT NULL,
  `code` varchar(80) NOT NULL COMMENT 'Уникальный код для каждого пользователя'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`uid`, `name`, `surname`, `email`, `birthday`, `gender`, `code`) VALUES
(1, 'Эмиль', 'Гусейнов', 'admin@codecourse.info', 1986, 'M', '}GlLJvDUdtZcHYMJA62$tJ^de63N$j?kKI~G)-6.4gMN!R~L%X{Zz}(,iXs^OA1ZiKcM+F``VH^auIHE'),
(2, 'Элчин', 'Гусейнов', 'aze994@mail.ru', 1988, 'M', 'm%OL-8LO@CJ).A5(i^P~[Hik8AZ3L7PSgYvh{-lYIj~BD.5l8v.MghG)4}FR{{nJ9HezI!ykHc8y*){p'),
(3, 'Заур', 'Гусейнов', 'mister.zaur@gmail.com', 1984, 'M', 'ZVpiaNkahgmIRe~KVv}LafB*,{.UI@^zt0H9]v^KNcX+H`vpUlKz`lOKkrbA0+,Hta{Kh{cM`(KUT]6h'),
(4, 'Фаил', 'Гусейнов', 'fail@gmail.com', 1962, 'M', '@HV3sR@KA}JFc+%Yt!BVH[5DiK0KIKGahcrX4$7E^Tfdc7,Vn%oXI-V556!^2z8C%Di6z%nVNE0^].tC'),
(5, 'Фаил', 'Гусейнов', 'emilhuseynov86@gmail.com', 1962, 'M', 'm%C}rEe`+ouBn0mF!*1vFBA@90!.iGza}Xo1yPN`HxlcCL7r0LBXVox~1jNG~u{rZTTt!y{l%KdB!vJV');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `uid` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
