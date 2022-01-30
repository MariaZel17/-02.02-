-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 30 2022 г., 19:27
-- Версия сервера: 5.6.37
-- Версия PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `z_db`
--
CREATE DATABASE IF NOT EXISTS `z_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `z_db`;

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name_c` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `name_c`) VALUES
(1, 'смартфон'),
(2, 'планшет');

-- --------------------------------------------------------

--
-- Структура таблицы `characteristic`
--

DROP TABLE IF EXISTS `characteristic`;
CREATE TABLE `characteristic` (
  `id` int(11) NOT NULL,
  `memory` varchar(255) NOT NULL,
  `screen` varchar(255) NOT NULL,
  `camera` varchar(255) NOT NULL,
  `battery_capacity` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `characteristic`
--

INSERT INTO `characteristic` (`id`, `memory`, `screen`, `camera`, `battery_capacity`) VALUES
(1, '256ГБ ', '3200 x 1440 (Quad HD+)', 'Разрешение 40.0 МП', 'Емкость аккумулятора (мАч, типичное значение) 5000'),
(3, '128 ГБ/8 ГБ', 'Разрешение экрана 1080 x 840', 'Емкость аккумулятора (мАч, типичное значение) 4500', 'Основная камера - Разрешение (значения) 64.0 MП + 12.0 MП + 5.0 MП + 5.0 MП'),
(5, 'Объем ОЗУ (ГБ) 1.5 ГБ Встроенная память (ГБ) 16 ГБ', 'Тип экрана Super AMOLED Разрешение экрана 396 x 396', 'нет', 'Емкость аккумулятора (мАч, типичное значение) 247 мАч');

-- --------------------------------------------------------

--
-- Структура таблицы `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `type_cus` varchar(50) NOT NULL,
  `name_cus` varchar(255) NOT NULL,
  `adres` varchar(255) NOT NULL,
  `phone` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `customer`
--

INSERT INTO `customer` (`id`, `type_cus`, `name_cus`, `adres`, `phone`) VALUES
(5, 'Физическое лицо', 'ООО Леони Русь', 'г. Заволжье', '89547541265'),
(7, 'Физическое лицо', 'Бабак Виктор Андреевич', 'г. Заволжье, ул. Грунина 1', '89547541265'),
(8, 'Юридическое лицо', 'ООО ЗМЗ', 'г. Заволжье', '89547545126'),
(9, 'Физическое лицо', 'Дурманчаев Богдан Дмитриевич', 'г. Заволжье, ул. Гидростроительная 8', '89547542130'),
(10, 'Физическое лицо', 'Кокурин Максим Алексеевич', 'г. Городец, ул. Мирная 15', '85475412654');

-- --------------------------------------------------------

--
-- Структура таблицы `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `status` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `login`
--

INSERT INTO `login` (`id`, `name`, `login`, `password`, `salt`, `status`) VALUES
(1, 'Мария', 'admin', 'c9c3fb756712d028bc1ae82094054632b40e60bdcc14e9e8d5b3911a796a488c', 'dc4ec7e97a915769cfcff755f1914b64', 'admin'),
(2, 'Максим', 'user', '665bfb026797f0717bdbb502bf6384b2bea0bfd13dbcb62bdb83240fffddcea7', 'f1710babf03d84e637f6eab0dde4ad06', 'user');

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name_p` varchar(100) NOT NULL,
  `category` varchar(50) NOT NULL,
  `price` int(6) NOT NULL,
  `description` text NOT NULL,
  `img` blob NOT NULL,
  `availability` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `name_p`, `category`, `price`, `description`, `img`, `availability`) VALUES
(3, 'Galaxy A52', 'Смартфон', 24900, 'Попрощайтесь с нечеткими снимками и видео. OIS (Оптическая стабилизация изображения) помогает стабилизировать процесс съемки, сгладив дрожание рук и обеспечив четкие снимки даже в условиях низкой освещенности. Камера воспринимает больше света, чтобы ваши снимки были более яркими.', 0x4135325f417765736f6d65426c61636b5f50726f647563744b565f50435f696d672e6a7067, 10),
(5, 'Galaxy Watch4', 'Часы', 19900, 'Отслеживайте свой прогресс в фитнесе при помощи первых Galaxy Watch, которые умеют анализировать состав тела. Узнайте, какое количество жира, скелетных мышц, воды содержится в вашем организме и другие данные, которые помогут достичь поставленных целей. Датчик Samsung BioActive и наш самый быстрый процессор являются инновационными решениями для новых Galaxy Watch.', 0x373230783732305f47616c6178795f5761746368345f436c61737369635f34365f6d6d5f626c61636b312e6a7067, 8);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `characteristic`
--
ALTER TABLE `characteristic`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `characteristic`
--
ALTER TABLE `characteristic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT для таблицы `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
