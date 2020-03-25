-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 25 2020 г., 22:34
-- Версия сервера: 5.7.25
-- Версия PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `category`) VALUES
(1, 'Юмор'),
(2, 'История'),
(3, 'Сатира');

-- --------------------------------------------------------

--
-- Структура таблицы `joke`
--

CREATE TABLE `joke` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `text` text NOT NULL,
  `date` date NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `joke`
--

INSERT INTO `joke` (`id`, `id_user`, `id_category`, `text`, `date`, `status`) VALUES
(1, 1, 2, '— Папочка! Можно я тебя поцелую?! — Денег нет! Меня уже мама поцеловала.', '2020-03-05', 1),
(2, 2, 2, '— Папочка! Можно я тебя поцелую?! — Денег нет! Меня уже мама поцеловала.', '2020-03-05', 1),
(3, 3, 2, '— Папочка! Можно я тебя поцелую?! — Денег нет! Меня уже мама поцеловала.', '2020-03-05', 1),
(4, 1, 2, '— Папочка! Можно я тебя поцелую?! — Денег нет! Меня уже мама поцеловала.', '2020-03-05', 1),
(6, 2, 2, '— Папочка! Можно я тебя поцелую?! — Денег нет! Меня уже мама поцеловала.', '2020-03-17', 1),
(8, 1, 2, '— Папочка! Можно я тебя поцелую?! — Денег нет! Меня уже мама поцеловала.', '2020-03-17', 1),
(9, 5, 1, 'Ещё одна неделя карантина - и маска будет мне мала...', '2020-03-25', 1),
(10, 5, 2, 'Я с каждым разом все сильнее убеждаюсь, что самая важная игра для мальчиков в детстве - это игра, в которой требуется найти 10 различий на картинках. Именно благодаря приобретенным навыкам от этой игры, в последующим, можно всего за пару секунд найти одинаковую пару носков среди остальных разбросанных десятков пар...', '2020-03-25', 1),
(11, 5, 3, 'Прочитал новость, что хотят запретить делать ремонт на время карантина. Да это удар ниже пояса! Я четыре года обещал жене, что завтра прикручу плинтус в коридоре, три года, что перевешу зеркало в ванной и восемь лет, что добавлю новых полочек в кладовке для ее солений, но как-только это «завтра» наступило, вы хотите мне испортить этот день.', '2020-03-25', 1),
(12, 5, 1, 'Раньше при просмотре российского ТВ создавалось впечатление, что в стране работает один Путин. Теперь, когда мы все сидим дома из-за коронавируса, а Путин продолжает работать - я окончательно в этом убедился.', '2020-03-25', 1),
(13, 5, 2, 'За столом семья: папа, мама и ребенок.\r\nДесятый день карантина: на завтрак гречка, на обед гречка, на ужин гречка.\r\nРебенку уже не лезет.\r\n- Мам, а мясо есть?\r\n- А мясо только тем, кто хорошо кушает!', '2020-03-25', 1),
(14, 4, 1, 'Жители Техаса любят хвастаться величием своего штата:\r\n\"Комаров у нас ловят капканами, канарейки поют басом, а апельсины такие большие, что 9 штук уже дюжина\".', '2020-03-25', 1),
(15, 4, 3, '- Вот видишь, сынок, я же тебе говорила, что настанет время, когда в магазинах ничего не купишь, а у нас гречка с тушенкой есть!\r\n- Да успокойся, мам, три часа ночи на улице. Магазин с восьми открывается.', '2020-03-25', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `statuses`
--

CREATE TABLE `statuses` (
  `id` int(11) NOT NULL,
  `name` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `statuses`
--

INSERT INTO `statuses` (`id`, `name`) VALUES
(1, 'user'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `login` varchar(256) NOT NULL,
  `id_status` int(11) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `banned` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `login`, `id_status`, `password`, `banned`, `email`) VALUES
(1, 'admin', 2, '$2y$10$xEYpAeJthTKWKy4xOexIHua0B2KAUvImCA5nKfb/JSovUvSRgJv0O', 0, 'skkarma@mail.ru'),
(2, 'goga', 1, '$2y$10$xjddpemV2oaZ203qltO3t.DNo8Anf360chk/rR5HwC8L48qd49Upa', 0, 'kanstantsinas@gmail.com'),
(3, 'john', 1, '$2y$10$9pVyRTDnjkm2ftY4QGrD2uw4cuiSwHtte4Bf9LusbH8TXzRrg2Rse', 0, 'lozl@mail.ru'),
(4, 'kas', 1, '$2y$10$uX00Jnj78Aujt76x8Vpd9u88/vfAlPX6GBGTK2h/lpXM3bKcjlGnG', 0, 'lele@mail.ru'),
(5, 'wood', 1, '$2y$10$kkk3bFm9/E.UvLwp/QZhLOX.KuhrQxpO/KfXmgGZjQBg93EBR2zlO', 0, 'sssa@mail.ru');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `joke`
--
ALTER TABLE `joke`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `joke`
--
ALTER TABLE `joke`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
