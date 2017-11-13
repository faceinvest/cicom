-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 08 2017 г., 14:44
-- Версия сервера: 5.7.19
-- Версия PHP: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `cicom`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(200) NOT NULL,
  `theme_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `text` text NOT NULL,
  `parent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `title`, `theme_id`, `user_id`, `date`, `text`, `parent_id`) VALUES
(4, 'Lobortis nunc primis', 1, 4, '2017-11-07 14:34:00', 'Lobortis nunc primis. Ipsum nisi amet montes commodo suscipit fames duis primis cubilia tincidunt Quis tempor arcu dignissim odio ligula neque vulputate accumsan molestie ornare curabitur sagittis.', 1),
(7, 'Заголовок', 1, 3, '2017-11-08 08:38:38', 'Комментарий', 0),
(28, 'fgmn', 1, 2, '2017-11-08 13:04:17', 'ghm', 3),
(32, 'dfsb', 1, 2, '2017-11-08 13:26:10', 'dbdbdb', 2),
(33, 'sadvsadv', 1, 2, '2017-11-08 13:27:14', 'sdvsdvsv', 3),
(34, 'dsavcsav', 1, 2, '2017-11-08 13:28:22', 'sdvsdv', 2),
(35, 'gh,', 1, 2, '2017-11-08 13:28:51', 'h,hj,hj,', 1),
(36, 'h,ghj,', 1, 2, '2017-11-08 13:29:03', 'hj,hj,', 1),
(37, 'hjm,gj', 1, 2, '2017-11-08 13:29:12', 'usersghjm', 1),
(38, 'Заголовок 1', 1, 2, '2017-11-08 13:31:06', 'Комментарий 1', 0),
(39, 'Заголовок 2', 1, 2, '2017-11-08 13:31:52', 'Комментарий 2', 0),
(40, 'Заголовок 3', 1, 2, '2017-11-08 13:32:11', 'Комментарий 3', 0),
(41, 'Подзаголовок 1', 1, 2, '2017-11-08 13:32:52', 'Подкомментарий 1', 39),
(42, 'Заголовок 4', 1, 2, '2017-11-08 13:33:41', 'Комментарий 4', 0),
(43, 'Заголовок 5', 1, 2, '2017-11-08 13:34:31', 'Комментарий 5', 0),
(45, 'Подзаголовок 2', 1, 2, '2017-11-08 13:36:58', 'Подкомментарий 2', 44);

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`version`) VALUES
(20171102100537);

-- --------------------------------------------------------

--
-- Структура таблицы `theme`
--

CREATE TABLE `theme` (
  `id` int(11) NOT NULL,
  `theme_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `theme`
--

INSERT INTO `theme` (`id`, `theme_name`) VALUES
(1, 'Дизайн'),
(2, 'Front-end'),
(3, 'Back-end');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `date` datetime NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `date`, `email`, `password`) VALUES
(2, 'users', '2017-11-03 09:00:58', 'users@users.ru', '5c3df2fbe32edb24701b3cb73eaba4b3b57c2edc6a41129e50ab1bf2e6e5d66667a7f85f6233be0012f5bf2ebf9185f41f23a0e58af39fb8fea096dbb4882176UECFHbNYBVOZkhTzLs9BV2UVT+g+f+/aa9VFDlC6CPs='),
(3, 'users2', '2017-11-03 11:21:28', 'users2@users.ru', '0752482e6370f25c535c408394149067f7d2cb876ca51323280d48fa3a09f9e72e75fe56f9a0ad800b5efdf353bedc7a5ed2cd2d14954b6d01ac9cb33160ff88gQhsDrgXbaPV1VHK2FIfx+3SH7+IThS44Pv+ohDWAv8='),
(4, 'users3', '2017-11-07 11:58:05', 'users3@users.ru', '9b36bb63b3e5b2a4dc2df6f2089bf750355b86b8b4356e9e046b4b71480629c510ba40bd8b433ff3ff75a94b76044b300f958175514353d4ebc699ff24b236abMt93lZ7GkkmL9n+D/Hkm38pBMUm7i21WAufzC2AqBfE='),
(5, 'users4', '2017-11-07 11:58:48', 'users4@users.ru', '5c748f4eb5508fe6e7b9848780287d37de286b58616b529087cdda9eee0989acb8827be7c8fc07b975413edf92285c4d8ff9dfa1d6eb76c8ff5a82b86569a97ex3CmsWkSIv46MaONDjD9DFfR3Nz0TFB4tnXVorHog54='),
(6, 'users5', '2017-11-07 11:59:58', 'users5@users.ru', '58b8e007f834cb736f7c42fe15a57222464547180cf61dde5acfb463be9048659c866fd504b1f55aa24004d61a9c29085b4b6cef3b72082ecb1b70ec4ff6fb39euabASXi5UpskUkhPBVR7W0Cq17HTew4p/mgCK2Xl9I=');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `theme`
--
ALTER TABLE `theme`
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
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT для таблицы `theme`
--
ALTER TABLE `theme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
