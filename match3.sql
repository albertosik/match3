-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Фев 18 2014 г., 15:28
-- Версия сервера: 5.5.34
-- Версия PHP: 5.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `match3`
--

-- --------------------------------------------------------

--
-- Структура таблицы `shard`
--

CREATE TABLE IF NOT EXISTS `shard` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `host` varchar(200) NOT NULL,
  `db` varchar(200) NOT NULL,
  `size` int(11) NOT NULL DEFAULT '0',
  `wsserver` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `shard`
--

INSERT INTO `shard` (`id`, `host`, `db`, `size`, `wsserver`) VALUES
(1, 'localost', 'game1', 0, '5.175.194.139'),
(2, 'localost', 'game2', 0, '5.175.194.139');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `login` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `id_shard` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `name`, `login`, `password`, `id_shard`) VALUES
(1, 'Gregory House', 'gregory', '202cb962ac59075b964b07152d234b70', 1),
(2, 'Lisa Caddy', 'lisa', '202cb962ac59075b964b07152d234b70', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
