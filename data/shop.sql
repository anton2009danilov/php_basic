-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 30 2019 г., 20:54
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
-- Структура таблицы `basket`
--

CREATE TABLE `basket` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `session` text NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `basket`
--

INSERT INTO `basket` (`id`, `item_id`, `user_id`, `session`, `quantity`) VALUES
(21, 2, 1, '', 7),
(24, 3, 1, '', 2),
(25, 4, 1, '', 1),
(26, 5, 1, '', 1),
(48, 2, NULL, 'hjt7np3t1u4qtkp1d72a8b24o9s44gnm', 8),
(50, 3, NULL, 'hjt7np3t1u4qtkp1d72a8b24o9s44gnm', 4),
(51, 5, NULL, 'hjt7np3t1u4qtkp1d72a8b24o9s44gnm', 3),
(52, 1, NULL, 'hjt7np3t1u4qtkp1d72a8b24o9s44gnm', 1),
(53, 2, 2, '', 1),
(54, 1, 2, '', 1),
(55, 3, 2, '', 1),
(56, 4, 3, '', 1),
(58, 5, 3, '', 1);

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
(31, 3, 'Лунтик', 'Хочу такого друга )'),
(33, 2, 'Антон', 'Мишка-Милашка!'),
(36, 3, 'Антон', 'Привет, Единорожка! Скоро поедешь ко мне!\r\n\r\n'),
(38, 4, 'Тоха', 'Зубастик. Очень понравился.'),
(40, 6, 'Антон', 'Мне повар больше понравился. Этот какой-то мелкий'),
(41, 6, 'Миша', 'Мой любимый Пикачу!');

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
(2, 88369, 'item1.jpg', 247, 59, 'Белый, мягкий, д-о-о-о-брый. Медведь!', 'Белый медведь', 200),
(3, 16057, 'item2.jpg', 175, 25, 'Миленький единорожка. Любит играть!', 'Белый единорожка', 190),
(4, 19954, 'item3.jpg', 205, 28, 'Маленький мягонький крокодильчик. Не кусается!', 'Крокодильчик', 150),
(5, 102459, 'pikachu-cook.jpg', 12, 6, 'Знаменитый Повар Пикачу. Готовит быстро и мягко!', 'Повар Пикачу', 220),
(6, 33226, 'pikachu-detective.jpg', 67, 14, 'Гениальный Детектив Пикачу. Любит загадки и головоломки!', 'Детектив Пикачу', 250);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` text NOT NULL,
  `pass` text NOT NULL,
  `hash` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `pass`, `hash`) VALUES
(1, 'admin', '$2y$10$y78FPsfAJdWU0.93smb87O3flh3aFLox424I1SLeJ/nZitrzQFV1K', '72047995d1553c4877bd8.15807765'),
(2, 'user1', '$2y$10$y78FPsfAJdWU0.93smb87O3flh3aFLox424I1SLeJ/nZitrzQFV1K', '72047995d1553c4877bd8.15807765'),
(3, 'user2', '$2y$10$y78FPsfAJdWU0.93smb87O3flh3aFLox424I1SLeJ/nZitrzQFV1K', '72047995d1553c4877bd8.15807765');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`id`);

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
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `basket`
--
ALTER TABLE `basket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT для таблицы `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT для таблицы `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
