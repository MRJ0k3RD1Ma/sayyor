-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2021 at 03:11 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sayyor`
--

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region_id` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `name`, `region_id`, `type`) VALUES
(15, 'Amudaryo tumani', 1, NULL),
(16, 'Beruniy tumani', 1, NULL),
(17, 'Kegayli tumani', 1, NULL),
(18, 'Qonliko‘l tumani', 1, NULL),
(19, 'Qorao‘zak tumani', 1, NULL),
(20, 'Qo‘ng‘irot tumani', 1, NULL),
(21, 'Mo‘ynoq tumani', 1, NULL),
(22, 'Nukus tumani', 1, NULL),
(23, 'Nukus shahri', 1, NULL),
(24, 'Taxtako‘pir tumani', 1, NULL),
(25, 'To‘rtko‘l tumani', 1, NULL),
(26, 'Xo‘jayli tumani', 1, NULL),
(27, 'CHimboy tumani', 1, NULL),
(28, 'SHumanay tumani', 1, NULL),
(29, 'Ellikqal‘a tumani', 1, NULL),
(30, 'Andijon shahri', 2, NULL),
(31, 'Andijon tumani', 2, NULL),
(32, 'Asaka tumani', 2, NULL),
(33, 'Baliqchi tumani', 2, NULL),
(34, 'Buloqboshi tumani', 2, NULL),
(35, 'Bo‘z tumani', 2, NULL),
(36, 'Jalaquduq tumani', 2, NULL),
(37, 'Izbosgan tumani', 2, NULL),
(38, 'Qorasuv shahri', 2, NULL),
(39, 'Qo‘rg‘ontepa tumani', 2, NULL),
(40, 'Marhamat tumani', 2, NULL),
(41, 'Oltinko‘l tumani', 2, NULL),
(42, 'Paxtaobod tumani', 2, NULL),
(43, 'Ulug‘nor tumani', 2, NULL),
(44, 'Xonabod tumani', 2, NULL),
(45, 'Xo‘jaobod shahri', 2, NULL),
(46, 'Shaxrixon tumani', 2, NULL),
(47, 'Buxoro shahri', 3, NULL),
(48, 'Buxoro tumani', 3, NULL),
(49, 'Vobkent tumani', 3, NULL),
(50, 'G‘ijduvon tumani', 3, NULL),
(51, 'Jondor tumani', 3, NULL),
(52, 'Kogon tumani', 3, NULL),
(53, 'Kogon shahri', 3, NULL),
(54, 'Qorako‘l tumani', 3, NULL),
(55, 'Qorovulbozor tumani', 3, NULL),
(56, 'Olot tumani', 3, NULL),
(57, 'Peshku tumani', 3, NULL),
(58, 'Romitan tumani', 3, NULL),
(59, 'Shofirkon tumani', 3, NULL),
(60, 'Arnasoy tumani', 4, NULL),
(61, 'Baxmal tumani', 4, NULL),
(62, 'G‘allaorol tumani', 4, NULL),
(63, 'Do‘stlik tumani', 4, NULL),
(64, 'Sh.Rashidov tumani', 4, NULL),
(65, 'Jizzax shahri', 4, NULL),
(66, 'Zarbdor tumani', 4, NULL),
(67, 'Zafarobod tumani', 4, NULL),
(68, 'Zomin tumani', 4, NULL),
(69, 'Mirzacho‘l tumani', 4, NULL),
(70, 'Paxtakor tumani', 4, NULL),
(71, 'Forish tumani', 4, NULL),
(72, 'Yangiobod tumani', 4, NULL),
(73, 'G‘uzor tumani', 5, NULL),
(74, 'Dehqonobod tumani', 5, NULL),
(75, 'Qamashi tumani', 5, NULL),
(76, 'Qarshi tumani', 5, NULL),
(77, 'Qarshi shahri', 5, NULL),
(78, 'Kasbi tumani', 5, NULL),
(79, 'Kitob tumani', 5, NULL),
(80, 'Koson tumani', 5, NULL),
(81, 'Mirishkor tumani', 5, NULL),
(82, 'Muborak tumani', 5, NULL),
(83, 'Nishon tumani', 5, NULL),
(84, 'Chiroqchi tumani', 5, NULL),
(85, 'Shahrisabz tumani', 5, NULL),
(86, 'Yakkabog‘ tumani', 5, NULL),
(87, 'Zarafshon shahri', 6, NULL),
(88, 'Karmana tumani', 6, NULL),
(89, 'Qiziltepa tumani', 6, NULL),
(90, 'Konimex tumani', 6, NULL),
(91, 'Navbahor tumani', 6, NULL),
(92, 'Navoiy shahri', 6, NULL),
(93, 'Nurota tumani', 6, NULL),
(94, 'Tomdi tumani', 6, NULL),
(95, 'Uchquduq tumani', 6, NULL),
(96, 'Xatirchi tumani', 6, NULL),
(97, 'Kosonsoy tumani', 7, NULL),
(98, 'Mingbuloq tumani', 7, NULL),
(99, 'Namangan tumani', 7, NULL),
(100, 'Namangan shahri', 7, NULL),
(101, 'Norin tumani', 7, NULL),
(102, 'Pop tumani', 7, NULL),
(103, 'To‘raqo‘rg‘on tumani', 7, NULL),
(104, 'Uychi tumani', 7, NULL),
(105, 'Uchqo‘rg‘on tumani', 7, NULL),
(106, 'Chortoq tumani', 7, NULL),
(107, 'Chust tumani', 7, NULL),
(108, 'Yangiqo‘rg‘on tumani', 7, NULL),
(109, 'Bulung‘ur tumani', 8, NULL),
(110, 'Jomboy tumani', 8, NULL),
(111, 'Ishtixon tumani', 8, NULL),
(112, 'Kattaqo‘rg‘on tumani', 8, NULL),
(113, 'Kattaqo‘rg‘on shahri', 8, NULL),
(114, 'Qo‘shrabot tumani', 8, NULL),
(115, 'Narpay tumani', 8, NULL),
(116, 'Nurabod tumani', 8, NULL),
(117, 'Oqdaryo tumani', 8, NULL),
(118, 'Payariq tumani', 8, NULL),
(119, 'Pastarg‘om tumani', 8, NULL),
(120, 'Paxtachi tumani', 8, NULL),
(121, 'Samarqand tumani', 8, NULL),
(122, 'Samarqand shahri', 8, NULL),
(123, 'Toyloq tumani', 8, NULL),
(124, 'Urgut tumani', 8, NULL),
(125, 'Angor tumani', 9, NULL),
(126, 'Boysun tumani', 9, NULL),
(127, 'Denov tumani', 9, NULL),
(128, 'Jarqo‘rg‘on tumani', 9, NULL),
(129, 'Qiziriq tumani', 9, NULL),
(130, 'Qo‘mqo‘rg‘on tumani', 9, NULL),
(131, 'Muzrabot tumani', 9, NULL),
(132, 'Oltinsoy tumani', 9, NULL),
(133, 'Sariosiy tumani', 9, NULL),
(134, 'Termiz tumani', 9, NULL),
(135, 'Termiz shahri', 9, NULL),
(136, 'Uzun tumani', 9, NULL),
(137, 'Sherobod tumani', 9, NULL),
(138, 'Sho‘rchi tumani', 9, NULL),
(139, 'Boyovut tumani', 10, NULL),
(140, 'Guliston tumani', 10, NULL),
(141, 'Guliston shahri', 10, NULL),
(142, 'Mirzaobod tumani', 10, NULL),
(143, 'Oqoltin tumani', 10, NULL),
(144, 'Sayxunobod tumani', 10, NULL),
(145, 'Sardoba tumani', 10, NULL),
(146, 'Sirdaryo tumani', 10, NULL),
(147, 'Xavos tumani', 10, NULL),
(148, 'Shirin shahri', 10, NULL),
(149, 'Yangier shahri', 10, NULL),
(150, 'Angiren shahri', 11, NULL),
(151, 'Bekabod tumani', 11, NULL),
(152, 'Bekabod shahri', 11, NULL),
(153, 'Bo‘ka tumani', 11, NULL),
(154, 'Bo‘stonliq tumani', 11, NULL),
(155, 'Zangiota tumani', 11, NULL),
(156, 'Qibray tumani', 11, NULL),
(157, 'Quyichirchiq tumani', 11, NULL),
(158, 'Oqqo‘rg‘on tumani', 11, NULL),
(159, 'Olmaliq shahri', 11, NULL),
(160, 'Ohangaron tumani', 11, NULL),
(161, 'Parkent tumani', 11, NULL),
(162, 'Piskent tumani', 11, NULL),
(163, 'O‘rtachirchiq tumani', 11, NULL),
(164, 'Chinoz tumani', 11, NULL),
(165, 'Chirchiq shahri', 11, NULL),
(166, 'Yuqorichirchiq tumani', 11, NULL),
(167, 'Yangiyo‘l tumani', 11, NULL),
(168, 'Beshariq tumani', 12, NULL),
(169, 'Bog‘dod tumani', 12, NULL),
(170, 'Buvayda tumani', 12, NULL),
(171, 'Dang‘ara tumani', 12, NULL),
(172, 'Yozyovon tumani', 12, NULL),
(173, 'Quva tumani', 12, NULL),
(174, 'Quvasoy shahri', 12, NULL),
(175, 'Qo‘qon shahri', 12, NULL),
(176, 'Qo‘shtepa tumani', 12, NULL),
(177, 'Marg‘ilon shahri', 12, NULL),
(178, 'Oltiariq tumani', 12, NULL),
(179, 'Rishton tumani', 12, NULL),
(180, 'So‘x tumani', 12, NULL),
(181, 'Toshloq tumani', 12, NULL),
(182, 'Uchko‘prik tumani', 12, NULL),
(183, 'O‘zbekiston tumani', 12, NULL),
(184, 'Farg‘ona tumani', 12, NULL),
(185, 'Farg‘ona shahri', 12, NULL),
(186, 'Furqat tumani', 12, NULL),
(187, 'Bog‘ot tumani', 13, NULL),
(188, 'Gurlan tumani', 13, NULL),
(189, 'Qo‘shko‘pir tumani', 13, NULL),
(190, 'Urganch tumani', 13, NULL),
(191, 'Urganch shahri', 13, NULL),
(192, 'Xiva tumani', 13, NULL),
(193, 'Xazarasp tumani', 13, NULL),
(194, 'Xonqa tumani', 13, NULL),
(195, 'Shavot tumani', 13, NULL),
(196, 'Yangiariq tumani', 13, NULL),
(197, 'Yangibozor tumani', 13, NULL),
(198, 'Bektimer tumani', 14, NULL),
(199, 'M.Ulug‘bek tumani', 14, NULL),
(200, 'Mirobod tumani', 14, NULL),
(201, 'Olmazor tumani', 14, NULL),
(202, 'Sergeli tumani', 14, NULL),
(203, 'Uchtepa tumani', 14, NULL),
(204, 'Yashnobod tumani', 14, NULL),
(205, 'Chilonzor tumani', 14, NULL),
(206, 'Shayxontohur tumani', 14, NULL),
(207, 'Yunusobod tumani', 14, NULL),
(208, 'Yakkasaroy tumani', 14, NULL),
(209, 'Taxiatosh shahri', 1, NULL),
(210, 'Asaka shahri', 2, NULL),
(211, 'Bandixon tumani', 9, NULL),
(212, 'Ohangaron shahri', 11, NULL),
(213, 'Yangiyo‘l shahri', 11, NULL),
(215, 'Toshkent tumani', 11, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Ходимлар жадвали. Рол, статус, ҳолатлар триггерларда тўлдирилади.';

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `email`, `phone`, `password`) VALUES
(1, 'Administrator', 'admin@gmail.com', '+998999670395', '$2y$13$ZKa/Z1lCi5QLt/oo2kRBNeE5jKtYKv5AgJsnfkZ.qAPClLUZRAF3y');

-- --------------------------------------------------------

--
-- Table structure for table `emp_posts`
--

CREATE TABLE `emp_posts` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL COMMENT 'Лавозими ёки статуси ўзгарган вақти. ',
  `state_id` int(11) DEFAULT NULL COMMENT 'Ходимнинг холати. Актив, ноактив',
  `status_id` int(11) DEFAULT NULL COMMENT 'Лавозим статуси :  асосий лавозим, вақтинчалик вазифасини бажарувчи, ва ҳ.к.',
  `org_id` int(11) DEFAULT NULL COMMENT 'Ташкилот (Бўлим)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Ходимларнинг лавозимлари.';

-- --------------------------------------------------------

--
-- Table structure for table `emp_posts_history`
--

CREATE TABLE `emp_posts_history` (
  `emp_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL COMMENT 'Лавозими ёки статуси ўзгарган вақти. ',
  `state_id` int(11) DEFAULT NULL COMMENT 'Ходимнинг холати. Актив, ноактив',
  `status_id` int(11) DEFAULT NULL COMMENT 'Лавозим статуси :  асосий лавозим, вақтинчалик вазифасини бажарувчи, ва ҳ.к.',
  `org_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Ходимларнинг фаолияти. Бу жадвалда emp_posts жадвалидаги ўзгаришлар сақланади. Қўлда тўлдирилмайди. (Триггер)';

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `language` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `translation` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `language`, `translation`) VALUES
(1, 'ru', 'Регионы'),
(2, 'ru', 'Создать регионы'),
(3, 'ru', 'ID'),
(4, 'ru', 'Name'),
(5, 'ru', 'Save'),
(6, 'ru', 'Update Regions: {name}'),
(7, 'oz', 'Update'),
(7, 'ru', 'Update'),
(8, 'oz', 'Viloyatlar'),
(8, 'ru', 'Viloyatlar'),
(9, 'oz', 'Tumanlar'),
(9, 'ru', 'Tumanlar'),
(10, 'ru', 'Language'),
(11, 'ru', 'Translation'),
(12, 'ru', 'Region ID'),
(13, 'ru', 'Type'),
(14, 'ru', 'Districts'),
(15, 'ru', 'Create Districts'),
(16, 'ru', 'Qoraqalpog‘iston Respublikasi'),
(17, 'ru', 'Andijon viloyati'),
(18, 'ru', 'Buxoro viloyati'),
(19, 'ru', 'Jizzax viloyati'),
(20, 'ru', 'Qashqadaryo viloyati'),
(21, 'ru', 'Navoiy viloyati'),
(22, 'ru', 'Namangan viloyati'),
(23, 'ru', 'Samarqand viloyati'),
(24, 'ru', 'Surxandaryo viloyati'),
(25, 'ru', 'Sirdaryo viloyati'),
(26, 'ru', 'Toshkent viloyati'),
(27, 'ru', 'Farg‘ona viloyati'),
(28, 'ru', 'Xorazm viloyati'),
(29, 'ru', 'Toshkent shahri'),
(30, 'oz', 'Dashboard'),
(30, 'ru', 'Dashboard'),
(31, 'oz', 'Elements'),
(31, 'ru', 'Elements'),
(32, 'oz', 'Sozlamalar'),
(32, 'ru', 'Sozlamalar'),
(33, 'oz', 'Foydalanuvchilar'),
(33, 'ru', 'Foydalanuvchilar'),
(34, 'oz', 'Tashkilotlar'),
(34, 'ru', 'Tashkilotlar'),
(35, 'oz', 'Create Organizations'),
(35, 'ru', 'Create Organizations'),
(36, 'oz', 'Organizations'),
(36, 'ru', 'Organizations'),
(37, 'oz', 'Viloyat'),
(37, 'ru', 'Viloyat'),
(38, 'oz', 'Turi'),
(38, 'ru', 'Turi'),
(39, 'oz', 'Qidiruv:'),
(39, 'ru', 'Qidiruv:'),
(40, 'oz', 'Tashkilot turlari'),
(40, 'ru', 'Tashkilot turlari'),
(41, 'oz', 'Create Organization Type'),
(41, 'ru', 'Create Organization Type'),
(42, 'oz', 'Organization Types'),
(42, 'ru', 'Organization Types'),
(43, 'ru', 'Are you sure you want to delete this item?'),
(44, 'oz', 'Ташкилотлар сони'),
(44, 'ru', 'Ташкилотлар сони'),
(45, 'oz', 'Export'),
(45, 'ru', 'Export'),
(46, 'oz', 'Excel'),
(46, 'ru', 'Excel'),
(47, 'oz', 'Pdf'),
(47, 'ru', 'Pdf'),
(48, 'oz', 'ta'),
(48, 'ru', 'ta'),
(49, 'oz', 'Update Organization Type: {name}'),
(50, 'oz', '-Tumanni tanlang-'),
(50, 'ru', '-Tumanni tanlang-'),
(51, 'ru', 'Viloyatni tanlang'),
(52, 'ru', 'Tumanni tanglang'),
(53, 'ru', 'Yuqori turuvchi tashkilot'),
(54, 'ru', 'Yuqori turuvchi tashkilot turini tanlang'),
(55, 'ru', 'Yuqori turuvchi tashkilotni tanlang'),
(56, 'uz', 'Organizations'),
(57, 'uz', 'Qidiruv:'),
(58, 'uz', 'Create Organizations'),
(59, 'uz', 'Viloyat'),
(60, 'uz', 'Turi'),
(61, 'uz', 'Dashboard'),
(62, 'uz', 'Elements'),
(63, 'uz', 'Viloyatlar'),
(64, 'uz', 'Tumanlar'),
(65, 'uz', 'Sozlamalar'),
(66, 'uz', 'Foydalanuvchilar'),
(67, 'uz', 'Tashkilotlar'),
(68, 'uz', 'Tashkilot turlari'),
(69, 'ru', 'Ma\'lumotnoma'),
(70, 'ru', 'Ichki'),
(71, 'ru', 'Tashqi'),
(72, 'ru', 'Категория животных');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1634305914),
('m150207_210500_i18n_init', 1634305916);

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE `organizations` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT -1,
  `state` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`id`, `name`, `parent_id`, `state`, `district_id`, `type_id`) VALUES
(1, 'O\'zbekiston Respublikasi Veterinariya va chorvachi', -1, 1, 198, 1);

-- --------------------------------------------------------

--
-- Table structure for table `organization_type`
--

CREATE TABLE `organization_type` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `organization_type`
--

INSERT INTO `organization_type` (`id`, `name`) VALUES
(-1, 'Yuqori turuvchi tashkiloti mavjud emas'),
(1, 'Respublika Vetkomita'),
(2, 'Vetkomita viloyat boshqarmasi'),
(3, 'Vetkomita tuman bo\'limi'),
(4, 'Qushxona'),
(5, 'Chegara postlari'),
(6, 'Labaratoriya (alohida)'),
(7, 'Tadbirkorlik subyektlari');

-- --------------------------------------------------------

--
-- Table structure for table `post_list`
--

CREATE TABLE `post_list` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `def_role` int(11) DEFAULT NULL COMMENT 'Лавозимнинг ҳуқуқи (Default role)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Лавозимлар руйхати.';

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `name`) VALUES
(1, 'Qoraqalpog‘iston Respublikasi'),
(2, 'Andijon viloyati'),
(3, 'Buxoro viloyati'),
(4, 'Jizzax viloyati'),
(5, 'Qashqadaryo viloyati'),
(6, 'Navoiy viloyati'),
(7, 'Namangan viloyati'),
(8, 'Samarqand viloyati'),
(9, 'Surxandaryo viloyati'),
(10, 'Sirdaryo viloyati'),
(11, 'Toshkent viloyati'),
(12, 'Farg‘ona viloyati'),
(13, 'Xorazm viloyati'),
(14, 'Toshkent shahri');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Роллар сақланадиган таблица. Роллар ташкилот ходимларига берилади. Масалан: Суперадмин, бўлим админи... Тахминан шундай.';

-- --------------------------------------------------------

--
-- Table structure for table `source_message`
--

CREATE TABLE `source_message` (
  `id` int(11) NOT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `source_message`
--

INSERT INTO `source_message` (`id`, `category`, `message`) VALUES
(1, 'app', 'Regions'),
(2, 'app', 'Create Regions'),
(3, 'app', 'ID'),
(4, 'app', 'Name'),
(5, 'app', 'Save'),
(6, 'app', 'Update Regions: {name}'),
(7, 'app', 'Update'),
(8, 'app', 'Viloyatlar'),
(9, 'app', 'Tumanlar'),
(10, 'app', 'Language'),
(11, 'app', 'Translation'),
(12, 'app', 'Region ID'),
(13, 'app', 'Type'),
(14, 'app', 'Districts'),
(15, 'app', 'Create Districts'),
(16, 'app', 'Qoraqalpog‘iston Respublikasi'),
(17, 'app', 'Andijon viloyati'),
(18, 'app', 'Buxoro viloyati'),
(19, 'app', 'Jizzax viloyati'),
(20, 'app', 'Qashqadaryo viloyati'),
(21, 'app', 'Navoiy viloyati'),
(22, 'app', 'Namangan viloyati'),
(23, 'app', 'Samarqand viloyati'),
(24, 'app', 'Surxandaryo viloyati'),
(25, 'app', 'Sirdaryo viloyati'),
(26, 'app', 'Toshkent viloyati'),
(27, 'app', 'Farg‘ona viloyati'),
(28, 'app', 'Xorazm viloyati'),
(29, 'app', 'Toshkent shahri'),
(30, 'cp.menu', 'Dashboard'),
(31, 'cp.menu', 'Elements'),
(32, 'cp.menu', 'Sozlamalar'),
(33, 'cp.menu', 'Foydalanuvchilar'),
(34, 'cp.menu', 'Tashkilotlar'),
(35, 'cp', 'Create Organizations'),
(36, 'cp', 'Organizations'),
(37, 'cp', 'Viloyat'),
(38, 'cp', 'Turi'),
(39, 'cp', 'Qidiruv:'),
(40, 'cp.menu', 'Tashkilot turlari'),
(41, 'cp', 'Create Organization Type'),
(42, 'cp', 'Organization Types'),
(43, 'cp', 'Are you sure you want to delete this item?'),
(44, 'cp', 'Ташкилотлар сони'),
(45, 'cp', 'Export'),
(46, 'cp', 'Excel'),
(47, 'cp', 'Pdf'),
(48, 'cp', 'ta'),
(49, 'cp', 'Update Organization Type: {name}'),
(50, 'cp', '-Tumanni tanlang-'),
(51, 'cp', 'Viloyatni tanlang'),
(52, 'cp', 'Tumanni tanglang'),
(53, 'cp', 'Yuqori turuvchi tashkilot'),
(54, 'cp', 'Yuqori turuvchi tashkilot turini tanlang'),
(55, 'cp', 'Yuqori turuvchi tashkilotni tanlang'),
(56, 'cp', 'Organizations'),
(57, 'cp', 'Qidiruv:'),
(58, 'cp', 'Create Organizations'),
(59, 'cp', 'Viloyat'),
(60, 'cp', 'Turi'),
(61, 'cp.menu', 'Dashboard'),
(62, 'cp.menu', 'Elements'),
(63, 'cp.menu', 'Viloyatlar'),
(64, 'cp.menu', 'Tumanlar'),
(65, 'cp.menu', 'Sozlamalar'),
(66, 'cp.menu', 'Foydalanuvchilar'),
(67, 'cp.menu', 'Tashkilotlar'),
(68, 'cp.menu', 'Tashkilot turlari'),
(69, 'cp.menu', 'Ma\'lumotnoma'),
(70, 'cp.menu', 'Ichki'),
(71, 'cp.menu', 'Tashqi'),
(72, 'cp', 'Категория животных');

-- --------------------------------------------------------

--
-- Table structure for table `state_list`
--

CREATE TABLE `state_list` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Холатлар рўйхати. Масалан, актив, ноактив ва ҳ.к.';

--
-- Dumping data for table `state_list`
--

INSERT INTO `state_list` (`id`, `name`) VALUES
(1, 'Aktiv'),
(2, 'Disaktiv'),
(3, 'kutish rejimida');

-- --------------------------------------------------------

--
-- Table structure for table `status_list`
--

CREATE TABLE `status_list` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Статуслар рўйхати. Масалан: доимий, вақтинчалик вазифасини бажарувчи, ходатайство ва ҳ.к.';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_districts_regions_id` (`region_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_posts`
--
ALTER TABLE `emp_posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UK_emp_posts_emp_id` (`emp_id`),
  ADD KEY `FK_emp_posts` (`status_id`),
  ADD KEY `FK_emp_posts2` (`org_id`),
  ADD KEY `FK_emp_posts_post_list_id` (`post_id`),
  ADD KEY `FK_emp_posts_state_list_id` (`state_id`);

--
-- Indexes for table `emp_posts_history`
--
ALTER TABLE `emp_posts_history`
  ADD KEY `FK_emp_posts_history_emp_posts_emp_id` (`emp_id`),
  ADD KEY `FK_emp_posts_history_organizations_id` (`org_id`),
  ADD KEY `FK_emp_posts_history_post_list_id` (`post_id`),
  ADD KEY `FK_emp_posts_history_state_list_id` (`state_id`),
  ADD KEY `FK_emp_posts_history_status_list_id` (`status_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`,`language`),
  ADD KEY `idx_message_language` (`language`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `organizations`
--
ALTER TABLE `organizations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_organizations_districts_id` (`district_id`),
  ADD KEY `FK_organizations_state_list_id` (`state`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `organization_type`
--
ALTER TABLE `organization_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_list`
--
ALTER TABLE `post_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_post_list_roles_id` (`def_role`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `source_message`
--
ALTER TABLE `source_message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_source_message_category` (`category`);

--
-- Indexes for table `state_list`
--
ALTER TABLE `state_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_list`
--
ALTER TABLE `status_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=216;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `emp_posts`
--
ALTER TABLE `emp_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `organizations`
--
ALTER TABLE `organizations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `organization_type`
--
ALTER TABLE `organization_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `post_list`
--
ALTER TABLE `post_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `source_message`
--
ALTER TABLE `source_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `state_list`
--
ALTER TABLE `state_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `status_list`
--
ALTER TABLE `status_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `districts`
--
ALTER TABLE `districts`
  ADD CONSTRAINT `FK_districts_regions_id` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `emp_posts`
--
ALTER TABLE `emp_posts`
  ADD CONSTRAINT `FK_emp_posts` FOREIGN KEY (`status_id`) REFERENCES `status_list` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_emp_posts2` FOREIGN KEY (`org_id`) REFERENCES `organizations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_emp_posts_post_list_id` FOREIGN KEY (`post_id`) REFERENCES `post_list` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_emp_posts_state_list_id` FOREIGN KEY (`state_id`) REFERENCES `state_list` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_emp_roles_employees_id` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `emp_posts_history`
--
ALTER TABLE `emp_posts_history`
  ADD CONSTRAINT `FK_emp_posts_history_emp_posts_emp_id` FOREIGN KEY (`emp_id`) REFERENCES `emp_posts` (`emp_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_emp_posts_history_organizations_id` FOREIGN KEY (`org_id`) REFERENCES `organizations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_emp_posts_history_post_list_id` FOREIGN KEY (`post_id`) REFERENCES `post_list` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_emp_posts_history_state_list_id` FOREIGN KEY (`state_id`) REFERENCES `state_list` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_emp_posts_history_status_list_id` FOREIGN KEY (`status_id`) REFERENCES `status_list` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `fk_message_source_message` FOREIGN KEY (`id`) REFERENCES `source_message` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `organizations`
--
ALTER TABLE `organizations`
  ADD CONSTRAINT `FK_organizations_districts_id` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_organizations_state_list_id` FOREIGN KEY (`state`) REFERENCES `state_list` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `organizations_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `organization_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `FK_roles_post_list_def_role` FOREIGN KEY (`id`) REFERENCES `post_list` (`def_role`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
