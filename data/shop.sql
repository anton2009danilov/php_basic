-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 25 2019 г., 01:41
-- Версия сервера: 5.7.23
-- Версия PHP: 7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `shop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `feedback` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `feedback`
--

INSERT INTO `feedback` (`id`, `item_id`, `name`, `feedback`) VALUES
(27, 1, 'Антон', 'Класс!'),
(29, 4, 'ЗЕЛЕНЫЙ ЧЕЛОВЕЧЕК', 'Какой зелёный, нравится'),
(30, 3, 'Антон', 'Привет, Единорожка!'),
(31, 3, 'Лунтик', 'Хочу такого друга )'),
(33, 2, 'Антон', 'Мишка-Милашка!!!');

-- --------------------------------------------------------

--
-- Структура таблицы `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `size` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  `likes` int(11) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `item_name` varchar(30) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `gallery`
--

INSERT INTO `gallery` (`id`, `size`, `name`, `views`, `likes`, `description`, `item_name`, `price`) VALUES
(1, 54519, 'frog.jpg', 22, 21, 'Весёлая, зелёная, квакает. Лягуха!', 'Лягушка', 150),
(2, 88369, 'item1.jpg', 230, 58, 'Белый, мягкий, д-о-о-о-брый. Медведь!', 'Белый медведь', 200),
(3, 16057, 'item2.jpg', 125, 2, 'Миленький единорожка. Любит играть!', 'Белый единорожка', 190),
(4, 19954, 'item3.jpg', 140, 24, 'Маленький мягонький крокодильчик. Не кусается!', 'Крокодильчик', 150),
(5, 102459, 'pikachu-cook.jpg', 4, 0, 'Знаменитый Повар Пикачу. Готовит быстро и мягко!', 'Повар Пикачу', 220),
(6, 33226, 'pikachu-detective.jpg', 39, 9, 'Гениальный Детектив Пикачу. Любит загадки и головоломки!', 'Детектив Пикачу', 250);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT для таблицы `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
