-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Сен 23 2021 г., 19:37
-- Версия сервера: 8.0.18
-- Версия PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `productshop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `basket`
--

CREATE TABLE `basket` (
  `basketID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `date` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `characteristic`
--

CREATE TABLE `characteristic` (
  `characteristicID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `nameCharac` varchar(40) NOT NULL,
  `textCharac` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `characteristic`
--

INSERT INTO `characteristic` (`characteristicID`, `productID`, `nameCharac`, `textCharac`) VALUES
(1, 1, 'nameCharac1', 'кушайте на здоровье  :)');

-- --------------------------------------------------------

--
-- Структура таблицы `manufacturers`
--

CREATE TABLE `manufacturers` (
  `manufacturerID` int(11) NOT NULL,
  `nameM` varchar(50) NOT NULL,
  `email` varchar(70) NOT NULL,
  `logo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `manufacturers`
--

INSERT INTO `manufacturers` (`manufacturerID`, `nameM`, `email`, `logo`) VALUES
(1, 'Айрес', 'meat@mail.ru', '1.jpg'),
(2, 'Домик в деревне', 'homeinvillage@ya.ru', '2.jpg'),
(3, 'Нестле', 'nestle@work.ru', 'nestle.jpg'),
(4, 'Бабушкина Каша', 'porrige@cooperation.com', 'porrige.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `orderID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `products` varchar(200) NOT NULL,
  `date` varchar(11) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `address` text,
  `comment` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `productID` int(11) NOT NULL,
  `nameProduct` varchar(50) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `photo` text NOT NULL,
  `typeID` int(11) NOT NULL,
  `manufacturerID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`productID`, `nameProduct`, `price`, `photo`, `typeID`, `manufacturerID`) VALUES
(1, 'Филе индейки', '199.00', '3.jpg', 1, 1),
(2, 'Молоко', '50.00', '4.jpg', 5, 2),
(3, 'Сметана', '65.00', '5.jpg', 5, 2),
(5, 'Говяжья вырезка', '399.00', '8736.jpg', 1, 1),
(6, 'Ряженка', '48.00', '654.jpg', 5, 2),
(7, 'Гречка отборная', '89.00', '1298.jpg', 2, 4),
(8, 'Напиток газированный', '55.00', '05.jpg', 3, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `type`
--

CREATE TABLE `type` (
  `typeID` int(11) NOT NULL,
  `nameType` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `type`
--

INSERT INTO `type` (`typeID`, `nameType`) VALUES
(1, 'Мясо'),
(2, 'Бакалея'),
(3, 'Напитки'),
(4, 'Снеки'),
(5, 'Молочные продукты');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `login` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` text CHARACTER SET utf8 COLLATE utf8_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`userID`, `name`, `lastname`, `login`, `password`, `email`) VALUES
(1, 'Василий', 'Минералов', 'uservasia', '1234', 'email.ru'),
(2, 'Надежда', 'Авдеева', 'nanja645', '4567', 'rkchiki.ru'),
(3, 'test', 'test', 'test', '1234', '1xbet.com'),
(4, 'New Pol', 'Pol', 'New', '123', 'newpochta.com'),
(5, '', '', '', '', 'maska.239'),
(7, 'Rikitaru', 'Rikitaru', 'Rikitaru', '12345', 'dan@ya.ru'),
(9, 'Rikitiki', 'Korobko', 'Rikitikitaki', '1234567890', '1234567890@mail.ru');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`basketID`),
  ADD KEY `userID` (`userID`,`productID`),
  ADD KEY `productID` (`productID`);

--
-- Индексы таблицы `characteristic`
--
ALTER TABLE `characteristic`
  ADD PRIMARY KEY (`characteristicID`),
  ADD KEY `productID` (`productID`);

--
-- Индексы таблицы `manufacturers`
--
ALTER TABLE `manufacturers`
  ADD PRIMARY KEY (`manufacturerID`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `userID` (`userID`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productID`),
  ADD KEY `typeID` (`typeID`,`manufacturerID`),
  ADD KEY `manufacturerID` (`manufacturerID`);

--
-- Индексы таблицы `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`typeID`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `basket`
--
ALTER TABLE `basket`
  MODIFY `basketID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT для таблицы `characteristic`
--
ALTER TABLE `characteristic`
  MODIFY `characteristicID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `manufacturers`
--
ALTER TABLE `manufacturers`
  MODIFY `manufacturerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `type`
--
ALTER TABLE `type`
  MODIFY `typeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `basket`
--
ALTER TABLE `basket`
  ADD CONSTRAINT `basket_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
