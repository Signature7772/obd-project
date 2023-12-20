-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 20 2023 г., 09:51
-- Версия сервера: 10.4.28-MariaDB
-- Версия PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `lab1`
--

-- --------------------------------------------------------

--
-- Структура таблицы `airline`
--

CREATE TABLE `airline` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `airline`
--

INSERT INTO `airline` (`id`, `country`, `address`) VALUES
(1, 'USA', '1357 Blane Street, Saint Louis'),
(2, 'United Kingdom', '4996 Jadewood Farms, New Brunswick');

-- --------------------------------------------------------

--
-- Структура таблицы `crew`
--

CREATE TABLE `crew` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `position` varchar(30) NOT NULL,
  `airline_id` bigint(20) UNSIGNED NOT NULL,
  `flight_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `crew`
--

INSERT INTO `crew` (`id`, `position`, `airline_id`, `flight_id`) VALUES
(1, 'pilot', 2, 1),
(2, 'flight attendant', 2, 1),
(3, 'pilot', 1, 2),
(4, 'flight attendant', 1, 2),
(5, 'flight operator', 2, 1),
(6, 'flight operator', 1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `crew_flight`
--

CREATE TABLE `crew_flight` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_crew` bigint(20) UNSIGNED NOT NULL,
  `id_flight` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `flight`
--

CREATE TABLE `flight` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `place_departure` varchar(200) NOT NULL,
  `place_arrival` varchar(200) NOT NULL,
  `date_departure` datetime NOT NULL,
  `date_arrival` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `flight`
--

INSERT INTO `flight` (`id`, `place_departure`, `place_arrival`, `date_departure`, `date_arrival`) VALUES
(1, 'Birmingham', 'Kyiv', '2023-11-23 12:38:14', '2023-11-24 09:43:27'),
(2, 'Chicago', 'London', '2023-11-28 11:38:14', '2023-11-29 10:38:14');

-- --------------------------------------------------------

--
-- Структура таблицы `passengers`
--

CREATE TABLE `passengers` (
  `pass` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL,
  `phone` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `passengers`
--

INSERT INTO `passengers` (`pass`, `name`, `phone`) VALUES
(1, 'Ane O.P.', 563421980),
(2, 'John B.B.', 574434902),
(3, 'Bob D.A.', 998877661),
(4, 'Jack M.P.', 2147483622),
(5, 'Harry K.H.', 2147481111),
(6, 'Jacob P.A.', 1999111221),
(7, 'Charlie S.S.', 2111321113),
(8, 'Liam N.B.', 555533333),
(9, 'Mason K.J.', 534433331),
(10, 'William O.Q.', 665536753);

-- --------------------------------------------------------

--
-- Структура таблицы `tickets`
--

CREATE TABLE `tickets` (
  `number` bigint(20) UNSIGNED NOT NULL,
  `price` bigint(200) NOT NULL,
  `date` datetime NOT NULL,
  `pass_id` bigint(20) UNSIGNED NOT NULL,
  `flight_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `tickets`
--

INSERT INTO `tickets` (`number`, `price`, `date`, `pass_id`, `flight_id`) VALUES
(1, 300, '2023-11-17 12:45:36', 1, 1),
(2, 400, '2023-11-23 21:54:36', 3, 1),
(3, 1000, '2023-11-26 05:46:33', 2, 2),
(4, 599, '2023-11-03 13:38:04', 4, 1),
(5, 220, '2023-11-22 13:38:49', 5, 2),
(6, 300, '2023-11-21 13:38:49', 6, 1),
(7, 150, '2023-11-01 13:38:49', 7, 1),
(8, 600, '2023-11-26 18:38:49', 8, 2),
(9, 999, '2023-11-23 23:59:59', 9, 1),
(10, 350, '2023-11-04 23:17:49', 10, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `usertbl`
--

CREATE TABLE `usertbl` (
  `id` int(11) NOT NULL,
  `full_name` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `username` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `password` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `usertbl`
--

INSERT INTO `usertbl` (`id`, `full_name`, `email`, `username`, `password`) VALUES
(1, 'Maxim', 'signature7772@gmail.com', 'user', '111');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `airline`
--
ALTER TABLE `airline`
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `id_2` (`id`),
  ADD KEY `ID_3` (`id`);

--
-- Индексы таблицы `crew`
--
ALTER TABLE `crew`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `airline_id` (`airline_id`),
  ADD KEY `airline_id_2` (`airline_id`,`flight_id`),
  ADD KEY `flight_id` (`flight_id`);

--
-- Индексы таблицы `crew_flight`
--
ALTER TABLE `crew_flight`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_2` (`id`),
  ADD KEY `id_crew` (`id_crew`,`id_flight`),
  ADD KEY `id_flight` (`id_flight`);

--
-- Индексы таблицы `flight`
--
ALTER TABLE `flight`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Индексы таблицы `passengers`
--
ALTER TABLE `passengers`
  ADD PRIMARY KEY (`pass`),
  ADD UNIQUE KEY `passport` (`pass`);

--
-- Индексы таблицы `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`number`),
  ADD UNIQUE KEY `number` (`number`),
  ADD KEY `passport_id` (`pass_id`,`flight_id`),
  ADD KEY `flight_id` (`flight_id`);

--
-- Индексы таблицы `usertbl`
--
ALTER TABLE `usertbl`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `airline`
--
ALTER TABLE `airline`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `crew`
--
ALTER TABLE `crew`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `crew_flight`
--
ALTER TABLE `crew_flight`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `flight`
--
ALTER TABLE `flight`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `passengers`
--
ALTER TABLE `passengers`
  MODIFY `pass` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `tickets`
--
ALTER TABLE `tickets`
  MODIFY `number` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `usertbl`
--
ALTER TABLE `usertbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `crew`
--
ALTER TABLE `crew`
  ADD CONSTRAINT `crew_ibfk_1` FOREIGN KEY (`flight_id`) REFERENCES `flight` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `crew_ibfk_2` FOREIGN KEY (`airline_id`) REFERENCES `airline` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `crew_flight`
--
ALTER TABLE `crew_flight`
  ADD CONSTRAINT `crew_flight_ibfk_1` FOREIGN KEY (`id_crew`) REFERENCES `crew` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `crew_flight_ibfk_2` FOREIGN KEY (`id_flight`) REFERENCES `flight` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`pass_id`) REFERENCES `passengers` (`pass`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tickets_ibfk_2` FOREIGN KEY (`flight_id`) REFERENCES `flight` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
