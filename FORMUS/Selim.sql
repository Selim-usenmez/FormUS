-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 10 déc. 2024 à 15:58
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `Selim`
--

-- --------------------------------------------------------

--
-- Structure de la table `contrats`
--

CREATE TABLE `contrats` (
  `id` int(11) NOT NULL,
  `utilisateur_id` int(11) DEFAULT NULL,
  `type_contrat` varchar(100) DEFAULT NULL,
  `date_contrat` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `repartition` text DEFAULT NULL,
  `nomPartenariat` varchar(255) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `modalitesBancaires` text DEFAULT NULL,
  `gestionActivites` text DEFAULT NULL,
  `departPartenaire` text DEFAULT NULL,
  `nonConcurrence` varchar(255) DEFAULT NULL,
  `modificationAccord` varchar(255) DEFAULT NULL,
  `juridiction` varchar(255) DEFAULT NULL,
  `titre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `contrats`
--

INSERT INTO `contrats` (`id`, `utilisateur_id`, `type_contrat`, `date_contrat`, `description`, `repartition`, `nomPartenariat`, `adresse`, `modalitesBancaires`, `gestionActivites`, `departPartenaire`, `nonConcurrence`, `modificationAccord`, `juridiction`, `titre`) VALUES
(9, 9, NULL, '2024-01-02', 'uuuuu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'zizi'),
(16, 12, NULL, '2024-01-01', 'jjjjjjjjjjjjj', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ddddddd'),
(17, 13, NULL, '2024-09-12', 'sfg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'qhj'),
(22, 14, NULL, '2024-10-07', 'je suis petit', 'a', 'b', 'v', 's', 'q', 'a', 'a', 'z', 'oui', 'adopté'),
(26, 17, NULL, '2024-10-07', 'Selim me doit des sous', '-20$', 'PRÊT DE GAGE', '58 rue de l\'emprunt', 'Paypal', 'Selim doit travailler honnêtement pour rembourser Karen ', 'Mort', '5', 'Prêt remboursé', 'Auvergnes Rhônes-ALPES', 'provisoire'),
(28, 18, NULL, '2024-01-01', 'fffffffff', 'ffffffff', 'fffffffff', 'ffffffffffffff', 'ffffffffff', 'ffffffff', 'fffffffffffffffff', 'fffffffffffffffffffffff', 'fffffffffffffffff', 'ffffffffffffff', 'frrrrrrrrrrrrrrrr'),
(114, 15, NULL, '2010-10-10', 'je sais pas', 'ddd', 'dd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'essaie'),
(116, 15, NULL, '2010-10-10', 'eeeeee', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'jusnior'),
(119, 15, NULL, '2012-12-12', 'eeeeee', 'tt', 'dddd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'kkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk'),
(120, 15, NULL, '2010-10-10', 'zzzzzzz', 'z', 'zz', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'aaaaa'),
(121, 15, NULL, '2010-10-10', 'eee', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'aaaaaaaa'),
(122, 15, NULL, '2010-10-10', 'essais', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'teste'),
(123, 15, NULL, '2010-10-10', 'testetstee', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'teste2'),
(124, 15, NULL, '2010-10-10', 'zzzzzzzz', 'ggggggg', 'ffffff', 'ddddddd', 'dsssssss', 'qqqqqqqqq', 'd', 'd', 'd', 'd', 'aaaaaaaa'),
(125, 15, NULL, '2010-10-10', 'aaaaaaaaaa', 'ggggggg', 'ggggggg', 'e', 'e', 'e', 'ee', 'e', 'e', 'e', 'teste de merde'),
(126, 15, NULL, '2010-10-10', 'eeeeee', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'teste de con'),
(127, 15, NULL, '2024-11-06', 'dddddd', 'eee', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'ddddd'),
(128, 15, NULL, '2024-11-20', 'ddddddddd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'ddddd'),
(129, 15, NULL, '2024-11-06', 'jjjjjjjjj', 'ddddd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'jjjjjjj'),
(130, 15, NULL, '2010-10-10', 'z', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'aaaaaaaa'),
(131, 15, NULL, '2024-11-06', 'ddddd', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'dddddd'),
(132, 15, NULL, '2024-11-10', 'eeeeee', 'd', 'd', 'd', 'd', 'd', 'd', 'dd', 'd', 'd', 'zzzzzz'),
(133, 15, NULL, '2010-10-10', 'erreee', 'z', 'z', 'zz', 'z', 'z', 'z', 'zz', 'z', 'z', 'azerty'),
(134, 15, NULL, '2024-11-06', 'ddddddd', 'ddd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'ddddddd'),
(135, 15, NULL, '2024-11-14', 'zzzzzzzz', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'zz', 'z', 'rrrrrrrrrrrrrr'),
(136, 15, NULL, '2024-11-07', 'eeeeeeee', 'f', 'f', 'f', 'f', 'f', 'f', 'f', 'f', 'f', 'zzzzzzzzzz'),
(137, 15, NULL, '2010-10-10', 'eeeeeee', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'zzzzzzz'),
(138, 15, NULL, '2010-10-10', 'ddddddd', '', '', '', '', '', '', '', '', '', 'pppppppppp'),
(139, 15, NULL, '2010-10-10', 'eeeeeeee', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'eeeeee'),
(140, 15, NULL, '2010-10-10', 'eeeeee', 'dd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'aaaaaaaa'),
(141, 15, NULL, '2024-11-06', 'ddddd', 'ddd', 'dddd', 'dddd', 'ddd', 'ddd', 'ddd', 'ddd', 'd', 'dddddd', 'ddddddd'),
(142, 15, NULL, '2024-11-07', 'dddddd', 'dddd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'eeeeeeeee'),
(143, 15, NULL, '2024-11-06', 'eeeeeeee', 'eeeeee', 'eeeee', 'eeee', 'eeeeee', 'eeeee', 'eeeee', 'eeeee', 'ee', 'eeeeee', 'eeeeee'),
(144, 15, NULL, '2010-10-10', 'dddddddd', 'ttttttt', 't', 't', 't', 't', 't', 't', 't', 't', 'alert'),
(145, 15, NULL, '2010-01-10', 'un teste pour la famille', '', '', '', '', '', '', '', '', '', 'selem'),
(146, 15, NULL, '2020-12-12', 'je sais pas', '', '', '', '', '', '', '', '', '', 'selemjr'),
(147, 15, NULL, '2010-10-10', 'eeeee', '', '', '', '', '', '', '', '', '', 'eee'),
(148, 15, NULL, '2010-10-10', 'ddddddd', '', '', '', '', '', '', '', '', '', 'zzzzzz'),
(149, 15, NULL, '2010-10-10', 'eeeee', '', '', '', '', '', '', '', '', '', 'zzzzzz'),
(150, 15, NULL, '2010-10-10', 'eeee', '', '', '', '', '', '', '', '', '', 'zzzzz'),
(151, 15, NULL, '2010-10-10', 'eeeee', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'eeeeeee'),
(152, 15, NULL, '2010-10-10', 'eeeeeee', '', '', '', '', '', '', '', '', '', 'eeee'),
(153, 15, NULL, '2010-10-10', 'eeeeee', '', '', '', '', '', '', '', '', '', 'eeeeee'),
(154, 15, NULL, '2010-10-10', 'eeeee', 'f', 'f', 'f', 'f', 'f', 'f', 'f', 'f', 'f', 'eeeeee'),
(155, 15, NULL, '2024-11-06', 'eeeeee', 'eeee', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'd', 'eeeee'),
(156, 15, NULL, '2024-11-06', 'dddd', 'ffff', 'f', 'f', 'f', 'f', 'f', 'f', 'f', 'f', 'ptdr'),
(157, 15, NULL, '2024-11-06', 'dddd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'ddd'),
(158, 15, NULL, '2010-10-10', 'eeeee', 'f', 'f', 'f', 'f', 'f', 'f', 'f', 'f', 'f', 'eeeeeee'),
(159, 15, NULL, '2010-10-10', 'rrrrrr', 'e', 'e', 'e', 'e', 'ee', 'e', 'e', 'e', 'e', 'tttttttttttt'),
(160, 15, NULL, '2010-10-10', 'eeeee', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'eeeeee'),
(161, 15, NULL, '2010-10-10', 'eeeee', 'e', 'e', 'e', 'e', 'e', 'e', 'ee', 'e', 'e', 'aaaaaaaaa'),
(162, 15, NULL, '2012-12-12', 'un jour', 'ddd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'selem'),
(163, 15, NULL, '2010-10-10', 'eeeeee', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'eeeeeee'),
(164, 15, NULL, '2010-10-10', 'eeeeee', 'e', 'e', 'e', 'e', 'ee', 'e', 'e', 'e', 'e', 'jesaispas'),
(165, 15, NULL, '2024-11-10', 'teste', 'dd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'teste'),
(166, 15, NULL, '2010-10-10', 'je serais pas de tdiere', 'oooooooooo', 'oooooo', 'p', 'p', 'p', 'p', 'p', 'p', 'p', 'teste de con'),
(167, 15, NULL, '2010-10-10', 'eeeee', 'e', 'ee', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'kkkkkkkkk'),
(168, 15, NULL, '2010-10-10', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'tester'),
(169, 15, NULL, '2024-11-10', 'eeeee', 'r', 'rr', 'r', 'r', 'r', 'rr', 'r', 'r', 'r', 'eeeeee'),
(170, 15, NULL, '2010-10-30', 'eeeee', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'teste final ?'),
(171, 15, NULL, '2010-10-20', 'dddd', 'd', 'd', 'd', 'd', 'd', 'd', 'dd', 'd', 'dd', 'eeeee'),
(172, 15, NULL, '2024-11-10', 'eeeeeeeee', 'eeeeeee', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'eeeeee'),
(173, 15, NULL, '2024-11-10', 'zzz', 'z', 'z', 'z', 'zz', 'z', 'z', 'z', 'z', 'z', 'jjjjj'),
(174, 15, NULL, '2024-11-10', 'bonjour', 'eeeeeee', 'e', 'ee', 'e', 'e', 'e', 'e', 'ee', 'e', 'teste de vie'),
(175, 15, NULL, '2010-10-10', 'eeeeee', 's', 's', 's', 's', 's', 's', 's', 's', 's', 'teste chatbotcree'),
(176, 15, NULL, '2010-10-10', 'teste d merde qui fini pas', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'dddddd'),
(177, 15, NULL, '2024-11-10', 'dddddd', 'e', 'e', 'ee', 'e', 'e', 'e', 'e', 'e', 'e', 'a l\'aide '),
(178, 15, NULL, '2010-10-10', 'ddeeeeeee', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'dd', 'tester e'),
(179, 15, NULL, '2024-11-10', 'dddddddd', 'd', 'd', 'dd', 'd', 'dd', 'd', 'd', 'd', 'd', 'dddddd'),
(180, 15, NULL, '2010-10-10', 'ddddd', 'd', 'd', 'd', 'd', 'd', 'd', 'dd', 'd', 'd', 'eeeee'),
(181, 15, NULL, '2024-11-10', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'd'),
(182, 15, NULL, '2010-10-10', 'd', 'ee', 'e', 'e', 'e', 'e', 'ee', 'e', 'e', 'ee', 'ssss'),
(183, 15, NULL, '2010-10-10', 'ddddd', 'd', 'd', 'd', 'd', 'dd', 'd', 'd', 'd', 'd', 'bonjour'),
(184, 15, NULL, '2024-11-10', 'ddddd', 'ddddddd', 'd', 'd', 'd', 'd', 'd', 'd', 'dd', 'd', 'd'),
(185, 15, NULL, '2010-10-10', 'ddddd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'dd', 'd'),
(186, 15, NULL, '2010-10-10', 'dddd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'dd', 'ddddd'),
(187, 15, NULL, '2010-10-10', 'eeeeee', 'dd', 'd', 'dd', 'd', 'd', 'd', 'd', 'd', 'd', 'R'),
(188, 15, NULL, '2024-11-10', 'ddddd', 'f', 'f', 'f', 'f', 'f', 'f', 'f', 'f', 'f', 'dddddd'),
(189, 15, NULL, '2010-10-10', 'dddd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'ddddddd'),
(190, 15, NULL, '2010-10-10', 'dddddddd', 'd', 'd', 'd', 'd', 'd', 'dd', 'd', 'd', 'd', 'tttttttttttttttttt'),
(191, 15, NULL, '2024-11-10', 'ddddd', 'f', 'f', 'f', 'f', 'ff', 'f', 'f', 'f', 'f', 'dddd'),
(192, 15, NULL, '2010-10-10', 'dddddd', 'e', 'e', 'e', 'e', 'e', 'ee', 'e', 'ee', 'ee', 'fffffff'),
(193, 15, NULL, '2010-10-10', 'ddddd', '', '', '', '', '', '', '', '', '', 'eeeeeeeee'),
(194, 15, NULL, '2010-10-10', 'dddd', '', '', '', '', '', '', '', '', '', 'gjgjgjgjfjkkd'),
(195, 15, NULL, '2010-10-10', 'ddddd', '', '', '', '', '', '', '', '', '', 'dddddd'),
(196, 15, NULL, '2010-10-10', 'poste a prouvoir', 'aucun', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'demande de formulaire de contrat'),
(198, 15, NULL, '2010-10-10', 'dddddd', 'f', 'f', 'f', 'f', 'f', 'f', 'f', 'f', 'f', 'eeeeeee'),
(199, 15, NULL, '2010-10-10', 'ddd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'kk'),
(200, 15, NULL, '2024-11-12', 'testetste dhf fjf', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'teste manuel'),
(201, 15, NULL, '2010-10-10', 'd', 'u', 'u', 'uu', 'u', 'u', 'u', 'u', 'u', 'u', 'salut'),
(202, 15, NULL, '2010-10-10', 'd', 'f', 'f', 'f', 'f', 'f', 'f', 'f', 'f', 'f', 'gorge'),
(203, 15, NULL, '2010-10-10', 'd', 'rr', 'rr', 'r', 'rr', 'rr', 'r', 'r', 'r', 'r', 'teste officiel'),
(204, 15, NULL, '2010-10-10', 'eeeee', 'df', 'df', 'df', 'd', 'fd', 'f', 'fd', 'f', 'df', 'ppppppppp'),
(205, 15, NULL, '2024-11-12', 'ddd', 'd', 'd', 'd', 'd', 'd', 'd', 'dd', 'dd', 'd', 'dddd'),
(206, 15, NULL, '2010-10-10', 'ddddddd', 'df', 'df', 'df', 'f', 'f', 'f', 'ff', 'f', 'f', 'dddddd'),
(207, 21, NULL, '2024-08-12', 'je veux avoir un 20 si possible.\r\n', '50/50', 'un bonne note :)', '38 rue pierre dupont', 'PayPal', 'France', 'licenciment', 'a vie c\'est mon prof', 'octogone sans règles', 'France Lyon', 'un 20/20 ??'),
(208, 15, NULL, '2024-11-13', 'eeeee', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'eeeee'),
(209, 15, NULL, '2010-10-10', 'dddd', 'dd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'selem'),
(211, 15, NULL, '2024-09-20', 'je sais pas', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'teste de bonté'),
(212, 15, NULL, '2010-10-10', 'dddd', 'rrrr', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'roro'),
(213, 15, NULL, '2010-10-10', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'dd', 'd', 'teste'),
(214, 15, NULL, '2024-11-28', 'dddd', 'd', 'd', 'dd', 'd', 'd', 'd', 'd', 'dddddd', 'd', 'dddd'),
(215, 23, NULL, '2024-11-28', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste 1'),
(217, 21, NULL, '2010-10-10', 'd', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'alexis'),
(218, 15, NULL, '2025-07-27', 'aiudhauidiz', 'qd', 'lucas', 'qdqazdd', 'qdqsddqsd', 'qsdsqdqdsqsd', 'qsdsqdqsddsq', 'qdqsdqsd', 'qsdsdqqsdqsd', 'qsdqsdqsdqsd', 'Lucas'),
(219, 15, NULL, '2010-10-10', 'ee', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'my g');

-- --------------------------------------------------------

--
-- Structure de la table `partenaires`
--

CREATE TABLE `partenaires` (
  `id` int(11) NOT NULL,
  `contrat_id` int(11) DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `contribution` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `partenaires`
--

INSERT INTO `partenaires` (`id`, `contrat_id`, `nom`, `contribution`) VALUES
(12, 22, 'selil', 'slip'),
(23, 26, 'Karen', '20$'),
(27, 28, 'fffffff', 'ffffffffffff'),
(28, 28, 'ffffff', 'ffffffffffff'),
(29, 28, 'fffffff', 'ffffffffffffllllllllllllll'),
(30, 28, 'mmmmmmmmmmmmm', 'pppplllllllllllllll'),
(175, 128, 'ddddd', 'd'),
(176, 128, 'd', 'd'),
(177, 128, 'd', 'd'),
(178, 132, 'dddd', 'd'),
(179, 132, 'd', 'd'),
(180, 134, 'ddddd', 'ddddd'),
(181, 134, 'dddd', 'dddddddd'),
(182, 136, 'ccccccc', 'ddddddd'),
(183, 137, 'dddddd', 'dddddd'),
(184, 137, 'fffff', 'ddf'),
(185, 142, 'cxxxxxxxx', 'ccccc'),
(186, 143, 'eeeee', 'eeeeeeee'),
(187, 144, 'eeeeeee', 'eeeeeeeee'),
(188, 144, 'rrrrrrrr', 'rrrrrrrrrr'),
(189, 144, 'rtt', 'tttttttttt'),
(190, 151, NULL, NULL),
(191, 151, NULL, NULL),
(192, 151, NULL, NULL),
(193, 154, 'eeeee', 'eeeeee'),
(194, 154, 'errrrrrrr', 'rrrrrrr'),
(195, 155, 'dddd', 'dddd'),
(196, 155, 'rrrr', 'ggggg'),
(197, 156, 'dd', 'ddd'),
(198, 156, 'ddd', 'ddd'),
(199, 157, 'dddd', 'ddddd'),
(201, 165, 'jesairais pas te dire', 'salutation'),
(202, 165, 'il est gay ou pas ', 'on sais pas '),
(203, 165, 'arrete ee merde', 'hjkl'),
(204, 168, 'eeeee', 'e'),
(205, 168, 'e', 'e'),
(206, 174, 'e', 'eeee'),
(207, 174, 'eeeee', 'eeeeeee'),
(208, 175, 'eeeeeee', 'rrrrrr'),
(209, 175, 'tttttt', 'fdf'),
(210, 175, 's', 's'),
(211, 176, 'dddd', 'd'),
(212, 176, 'd', 'd'),
(213, 177, 'dddd', 'ddddd'),
(214, 177, 'fffff', 'fffff'),
(215, 178, 'ddddd', 'd'),
(216, 178, 'd', 'd'),
(217, 179, 'ddddd', 'ddddddd\r\n'),
(218, 179, 'dddd', 'ddddd'),
(219, 180, 'ddddd', 'd'),
(220, 180, 'd', 'd'),
(221, 181, 'dd', 'd'),
(222, 181, 'ddd', 'dddddd'),
(223, 184, 'dd', 'ddd'),
(224, 185, 'ddddddd', 'd'),
(225, 185, 'd', 'd'),
(226, 185, 'd', 'd'),
(227, 188, 'ddd', 'dddd'),
(228, 188, 'ffff', 'ffff'),
(229, 191, 'ddddd', 'dddd'),
(230, 191, 'ddd', 'ddddd'),
(231, 196, 'jean', 'contable'),
(232, 196, 'patrick la trick', 'dev en IA'),
(233, 196, 'je sais âs', 'il est pas là'),
(237, 198, 'jesiaspas', 'd'),
(238, 198, 'd', 'd'),
(239, 198, 'd', 'd'),
(240, 198, 'f', 'f'),
(241, 199, 'd', 'd'),
(242, 199, 'd', 'd'),
(243, 199, 'd', 'd'),
(244, 200, 'oui', 'ouii'),
(245, 200, 'non', 'non'),
(246, 200, 'aiiaii', 'aiiaiiia'),
(247, 200, 'wlay ', 'walay'),
(248, 201, 'u', 'u'),
(249, 201, 'u', 'u'),
(250, 201, 'u', 'u'),
(251, 201, 'u', 'u'),
(252, 202, 'ddd', 'dddd'),
(253, 202, 'f', 'f'),
(254, 202, 'f', 'f'),
(255, 203, 'r', 'r'),
(256, 203, 'r', 'r'),
(257, 203, 'r', 'r'),
(258, 204, 'd', 'f'),
(259, 204, 'f', 'd'),
(260, 204, 'f', 'df'),
(261, 205, 'dd', 'dddd'),
(262, 205, 'ddd', 'ddd'),
(263, 206, 'f', 'f'),
(264, 206, 'fdf', 'd'),
(265, 206, 'd', 'df'),
(266, 207, 'Mr.usenmez', 'élève'),
(267, 207, 'Mr.langloy', 'professeur'),
(268, 208, 'eeeee', 'eeeeeee'),
(269, 208, 'eeeee', 'eee'),
(270, 209, 'ddd', 'ff'),
(271, 209, 'dd', 'ff'),
(275, 211, 'azizi', 'le bon'),
(276, 211, 'mehmoud', 'le gerent'),
(277, 211, 'hasan', 'hamzou'),
(278, 211, 'dd', 'je ais pas'),
(279, 212, 'ddddd', 'fffff'),
(280, 212, 'rrrrr', 'eeeeee'),
(281, 212, 'dddd', 'fffff'),
(282, 213, 'd', 'd'),
(283, 213, 'dd', 'd'),
(284, 214, 'ddd', 'd'),
(285, 214, 'ddd', 'd'),
(286, 214, 'd', 'd'),
(287, 215, 'teste', 'teste'),
(288, 215, 'teste', 'teste'),
(291, 217, 'e', 'e'),
(292, 217, 'e', 'e'),
(293, 217, 'e', 'e'),
(294, 218, 'a', 'z'),
(295, 218, 'e', 'r'),
(296, 218, 'q', 's'),
(297, 218, 'd', 'f'),
(298, 218, 'f', 'f'),
(300, 114, 'df', 'dddd'),
(301, 219, 'd', 'd'),
(302, 219, 'd', 'd'),
(303, 219, 'd', 'd'),
(304, 114, 'ffff', 'ff'),
(305, 114, 'ffff', 'ff'),
(306, 114, 'ppp', 'ppp'),
(308, 116, 'azizi', 'zz');

-- --------------------------------------------------------

--
-- Structure de la table `Table_utilisateur`
--

CREATE TABLE `Table_utilisateur` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Table_utilisateur`
--

INSERT INTO `Table_utilisateur` (`id`, `nom`, `prenom`, `email`, `password`) VALUES
(9, 'rebeu', 'deter', 'mangetamere@caca.com', '$2y$10$zsPsrDGSgCXWNdlrXDSCfu.S6iUkuXBFuu8C6ZspHdn.sU3O0vDHC'),
(10, 'XD', 'X', 'a.r@kk.com', '$2y$10$624CyQSzu9jx6i5Nj56vwOaNX4wUYCJRgMYC9bqS43E3Ciy9Lhoti'),
(11, 'a', 'r', 'a.rn@h.com', '$2y$10$LaabeMadyCMFxAaIE6Ss6uwCqkSYe3dT9wAvUVXUN5rlyphQzhrOC'),
(12, 'mehmout', 'asseni', 'alexis@gmail.com', '$2y$10$Bha2eIwRksjk2QUo3.gRzebmLKYmRwWrtXJAJxegUpeB6TjmfwXEa'),
(13, 'azer', 'azer', 'azer@azer', '$2y$10$lh.oqPM/YLqFrjDpwNrwlu6T3ynAt5s8p393CWG5qMQWrOM64DyyG'),
(14, 'usenmez', 'semih', 'usenmezsemih@gmail.com', '$2y$10$pk6BRUMsn8QCYXS7WlWVmuNzWAfTTk/qgYsbG7F2WUXYHNGOzjSbS'),
(15, 'usenmez', 'selim', 's.usenmez@eleve.leschartreux.net', '$2y$10$Uvs6GXqa2sLjaz9tzijT2eMFZTTEwIPYzU8XHaBgel4OVeWf/HHVu'),
(16, 'VACHOT', 'Syméon', 's.vachot@eleve.leschartreux.net', '$2y$10$GEjJhtxn/Blj3GPvLgNU2egf2ozIQg9Mls.uLokmjldZvLxU6cKii'),
(17, 'fdp', 'karen', 'karen@fdp.com', '$2y$10$r8ks/UyYDowmHBG.ax.6xOPr/GqO7/j4LHLcEtA2rH8koOkSnRQ6m'),
(18, 'aziz', 'mofo', 'azizmofo@gmail.com', '$2y$10$PfsLWHSxC6kDBd2Oy/wONeL0w/vrQTsGs9.KsOSS54rl5oHT8zaGi'),
(19, 'hui', 'lili', 'selimim@hotmail.fr', '$2y$10$Xk70ZPU7XO3NIStSocJIb.K1cbJuataD2J7pLA2GWq8URsX/JFGBa'),
(20, 'Paret', 'Louis', 'l.paret@eleve.leschartreux.net', '$2y$10$ayPDv/miIweC4TDwobDUyeAy/Bs.KNWjFyikA2Q6QQsKT8HRnkTpu'),
(21, 'le meilleur Prof', 'meilleur prof', 'lemailleurprof@gmail.com', '$2y$10$itjlq9ZwzN3k78hymZqQce0ayHIuZcpZThEBrQOAxH1.jg0mpfICW'),
(22, 'enculer ', 'fdp de merde', 'grossemerde@gmail.com', '$2y$10$4xnRPq.P4fHtHGduNGxg3uyiiZZzi3rV/Sy8whyRcg9Xp5RB6e.Iy'),
(23, 'Présentation Mr.langloy ', 'Présentation Mr.langloy ', 'az@gmail.com', '$2y$10$5uOZ6khHi7SSc6P2buJoXekgQ9imNSG/DXpE9KhErNkVzzHaX9/Bq'),
(24, 'dddd', 'ddddd', 'zzzzzzzz@gmail.com', '$2y$10$jSPxVbvLkghl/TSrV1bGWeWtEtkvFnCS0ieGUPpLTnuLNQ9eq6Vbu'),
(25, 'alban', 'langloy', 'al@gmail.com', '$2y$10$A.P6hXqXQBJ9jF/.ELzJa.yu4gzBTrePAt8UufZQpRa2C6gsgEw4y');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `contrats`
--
ALTER TABLE `contrats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_utilisateur` (`utilisateur_id`);

--
-- Index pour la table `partenaires`
--
ALTER TABLE `partenaires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_contrat_id` (`contrat_id`);

--
-- Index pour la table `Table_utilisateur`
--
ALTER TABLE `Table_utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `contrats`
--
ALTER TABLE `contrats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=220;

--
-- AUTO_INCREMENT pour la table `partenaires`
--
ALTER TABLE `partenaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=309;

--
-- AUTO_INCREMENT pour la table `Table_utilisateur`
--
ALTER TABLE `Table_utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `contrats`
--
ALTER TABLE `contrats`
  ADD CONSTRAINT `fk_utilisateur` FOREIGN KEY (`utilisateur_id`) REFERENCES `table_utilisateur` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `partenaires`
--
ALTER TABLE `partenaires`
  ADD CONSTRAINT `fk_contrat_id` FOREIGN KEY (`contrat_id`) REFERENCES `contrats` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `partenaires_ibfk_1` FOREIGN KEY (`contrat_id`) REFERENCES `contrats` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
