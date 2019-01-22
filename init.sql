-- phpMyAdmin SQL Dump
-- version 4.1.13
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Янв 22 2019 г., 15:11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

-- --------------------------------------------------------

--
-- Структура таблицы `yx_active_guests`
--

CREATE TABLE IF NOT EXISTS `yx_active_guests` (
  `ip` varchar(15) NOT NULL,
  `timestamp` int(11) unsigned NOT NULL,
  PRIMARY KEY (`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `yx_active_guests`
--

-- --------------------------------------------------------

--
-- Структура таблицы `yx_active_users`
--

CREATE TABLE IF NOT EXISTS `yx_active_users` (
  `username` varchar(30) NOT NULL,
  `timestamp` int(11) unsigned NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `yx_banned_users`
--

CREATE TABLE IF NOT EXISTS `yx_banned_users` (
  `username` varchar(30) NOT NULL,
  `timestamp` int(11) unsigned NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `yx_module_native_comments`
--

CREATE TABLE IF NOT EXISTS `yx_module_native_comments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `module_name_id` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `module_id` (`module_name_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Дамп данных таблицы `yx_module_native_comments`
--

INSERT INTO `yx_module_native_comments` (`id`, `module_name_id`) VALUES
(17, 'kistokam.researches.research.32'),
(18, 'kistokam.researches.research.31'),
(4, 'kistokam.sources.source.4'),
(5, 'kistokam.sources.source.5'),
(6, 'kistokam.sources.source.6'),
(16, 'kistokam.researches.research.30'),
(15, 'kistokam.researches.research.29');

-- --------------------------------------------------------

--
-- Структура таблицы `yx_module_native_comments_comment`
--

CREATE TABLE IF NOT EXISTS `yx_module_native_comments_comment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `module_id` int(11) unsigned DEFAULT '0',
  `parent_id` int(11) unsigned DEFAULT '0',
  `author_id` varchar(30) DEFAULT NULL,
  `title` text,
  `text` text NOT NULL,
  `datetime` datetime NOT NULL,
  `rating_sum` int(11) NOT NULL DEFAULT '0',
  `rating_num` int(11) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `module_id` (`module_id`),
  KEY `author_id` (`author_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=119 ;

--
-- Дамп данных таблицы `yx_module_native_comments_comment`
--

INSERT INTO `yx_module_native_comments_comment` (`id`, `module_id`, `parent_id`, `author_id`, `title`, `text`, `datetime`, `rating_sum`, `rating_num`) VALUES
(105, 5, 0, 'guest', 'hgnxghnhm', 'тест123', '2011-09-07 16:18:16', 0, 0),
(107, 4, 0, 'guest', '', 'Test', '2011-11-14 01:12:43', 0, 0),
(109, 6, 0, 'guest', '', 'вапгшрщорс....', '2011-12-26 23:15:28', 54, 1),
(110, 6, 109, 'jure123', '› ', 'укравеч и sytj syj', '2011-12-26 23:17:19', 0, 0),
(111, 0, 0, 'guest', 'test', 'test  нео еу не', '2012-01-11 12:24:15', 17, 1),
(112, 0, 111, 'guest', '› test', 'ке7швеглвлгнагл', '2012-02-17 13:33:21', -41, 1),
(113, 0, 0, 'guest', 'dk,kj,', 'keuky;   jgj;lo', '2012-04-16 15:04:41', 0, 0),
(114, 0, 111, 'guest', '› test', 'tktui', '2012-04-19 11:06:57', 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `yx_module_native_comments_comment_rating`
--

CREATE TABLE IF NOT EXISTS `yx_module_native_comments_comment_rating` (
  `comment_id` int(11) unsigned NOT NULL,
  `user_id` varchar(30) NOT NULL DEFAULT '',
  `rating_value` tinyint(11) DEFAULT '0',
  PRIMARY KEY (`comment_id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `yx_module_native_comments_comment_rating`
--

INSERT INTO `yx_module_native_comments_comment_rating` (`comment_id`, `user_id`, `rating_value`) VALUES
(42, 'abc', 5),
(42, 'guest', -100),
(1, 'guest', -48),
(1, 'jure456', 92),
(9, 'jure456', 100),
(16, 'jure456', 100),
(33, 'jure456', -18),
(34, 'jure456', -20),
(35, 'jure456', 46),
(36, 'jure456', 42),
(4, 'jure456', 44),
(2, 'jure456', -40),
(5, 'jure456', -100),
(109, 'jure123', 54),
(111, 'jure123', 17),
(112, 'jure123', -41);

-- --------------------------------------------------------

--
-- Структура таблицы `yx_module_native_navtree`
--

CREATE TABLE IF NOT EXISTS `yx_module_native_navtree` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `module_id` int(11) unsigned DEFAULT '0',
  `parent_id` int(11) unsigned DEFAULT NULL,
  `link_external` varchar(256) NOT NULL,
  `link_module_name` varchar(256) DEFAULT NULL,
  `link_module_id` int(11) DEFAULT '0',
  `title` varchar(256) DEFAULT NULL,
  `item_order` tinyint(2) unsigned DEFAULT '0',
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `userlevels` set('0','1','5','9') NOT NULL DEFAULT '0,1,5,9',
  PRIMARY KEY (`id`),
  KEY `pid` (`parent_id`),
  KEY `menu_id` (`module_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Дамп данных таблицы `yx_module_native_navtree`
--

INSERT INTO `yx_module_native_navtree` (`id`, `module_id`, `parent_id`, `link_external`, `link_module_name`, `link_module_id`, `title`, `item_order`, `visible`, `userlevels`) VALUES
(1, 0, 0, '', 'native.welcome', 0, 'Добро пожаловать', 10, 1, '0,1,5,9'),
(2, 0, 0, '', 'native.register', 0, 'Регистрация', 100, 1, '0'),
(3, 0, 0, '', NULL, 0, 'Разделы', 20, 0, '0,1,5,9'),
(4, 0, 3, '', 'native.page', 444, 'Страница 1', 0, 1, '0,1,5,9'),
(5, 0, 3, '', 'native.page', 333, 'Страница 2', 0, 1, '0,1,5,9'),
(6, 0, 5, '', 'native.comments', 0, 'Комментарии', 0, 0, '0,1,5,9'),
(11, 0, 0, '', 'native.user', 0, 'Профиль', 100, 1, '1,5,9'),
(12, 0, 11, '', 'native.profile', 0, 'Редактировать', 20, 1, '1,5,9'),
(15, 0, 0, '', NULL, 0, 'Ссылки', 110, 1, '0,1,5,9'),
(16, 0, 15, 'http://test.ru', NULL, 0, 'test&nbsp;test2', 40, 1, '0,1,5,9'),


-- --------------------------------------------------------

--
-- Структура таблицы `yx_users`
--

CREATE TABLE IF NOT EXISTS `yx_users` (
  `username` varchar(30) NOT NULL,
  `password` varchar(32) DEFAULT NULL,
  `userid` varchar(32) DEFAULT NULL,
  `userlevel` tinyint(1) unsigned NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `timestamp` int(11) unsigned NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `yx_users`
--

INSERT INTO `yx_users` (`username`, `password`, `userid`, `userlevel`, `email`, `timestamp`, `firstname`, `lastname`) VALUES
('jure123', '00000000000000000000000000000000', 'a6fc3185003ed06e22a850c2bc87430a', 9, 'test@test.ru', 1343225200, 'test', 'test'),
('jure456', '11111111111111111111111111111111', 'fe806182f5916c96d76f328cb8cd04f6', 1, 'test2@test.ru', 1286376730, 'test2', 'test2');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
