-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 03 nov. 2024 à 12:37
-- Version du serveur : 5.7.31
-- Version de PHP : 8.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `donkey_fb`
--

-- --------------------------------------------------------

--
-- Structure de la table `aime`
--

DROP TABLE IF EXISTS `aime`;
CREATE TABLE IF NOT EXISTS `aime` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `utilisateur_id` int(11) DEFAULT NULL,
  `date_like` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  KEY `utilisateur_id` (`utilisateur_id`)
) ENGINE=MyISAM AUTO_INCREMENT=104 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `aime`
--

INSERT INTO `aime` (`id`, `post_id`, `utilisateur_id`, `date_like`) VALUES
(6, 11, 29, '2024-10-31'),
(2, 33, 27, '2024-10-31'),
(3, 25, 25, '2024-10-31'),
(4, 11, 29, '2024-10-31'),
(5, 11, 29, '2024-10-31'),
(7, 48, 27, '2024-10-31'),
(8, 48, 27, '2024-10-31'),
(9, 48, 27, '2024-10-31'),
(10, 48, 27, '2024-10-31'),
(11, 48, 27, '2024-10-31'),
(12, 48, 27, '2024-10-31'),
(13, 46, 27, '2024-10-31'),
(14, 46, 27, '2024-10-31'),
(15, 23, 27, '2024-10-31'),
(16, 23, 27, '2024-10-31'),
(17, 49, 27, '2024-10-31'),
(18, 49, 27, '2024-10-31'),
(19, 49, 27, '2024-10-31'),
(20, 49, 27, '2024-10-31'),
(21, 49, 27, '2024-10-31'),
(22, 49, 27, '2024-10-31'),
(23, 49, 27, '2024-10-31'),
(24, 49, 27, '2024-10-31'),
(25, 49, 27, '2024-10-31'),
(26, 49, 27, '2024-10-31'),
(27, 49, 27, '2024-10-31'),
(28, 49, 27, '2024-10-31'),
(29, 49, 27, '2024-10-31'),
(30, 49, 27, '2024-10-31'),
(31, 48, 27, '2024-10-31'),
(32, 48, 27, '2024-10-31'),
(33, 49, 27, '2024-10-31'),
(34, 49, 27, '2024-10-31'),
(35, 49, 27, '2024-10-31'),
(36, 49, 27, '2024-10-31'),
(37, 49, 27, '2024-10-31'),
(38, 49, 27, '2024-10-31'),
(39, 49, 27, '2024-10-31'),
(40, 49, 27, '2024-10-31'),
(41, 49, 27, '2024-11-01'),
(42, 49, 27, '2024-11-01'),
(43, 49, 27, '2024-11-01'),
(44, 49, 27, '2024-11-01'),
(45, 49, 27, '2024-11-01'),
(46, 49, 27, '2024-11-01'),
(47, 48, 27, '2024-11-01'),
(48, 46, 27, '2024-11-01'),
(49, 14, 27, '2024-11-01'),
(50, 32, 27, '2024-11-01'),
(51, 31, 27, '2024-11-01'),
(52, 30, 27, '2024-11-01'),
(53, 50, 27, '2024-11-01'),
(54, 50, 27, '2024-11-01'),
(55, 30, 27, '2024-11-01'),
(56, 29, 27, '2024-11-01'),
(57, 51, 27, '2024-11-01'),
(58, 52, 29, '2024-11-02'),
(59, 61, 29, '2024-11-02'),
(60, 60, 29, '2024-11-02'),
(61, 60, 29, '2024-11-02'),
(62, 60, 29, '2024-11-02'),
(63, 57, 29, '2024-11-02'),
(64, 60, 29, '2024-11-02'),
(65, 56, 29, '2024-11-02'),
(66, 55, 29, '2024-11-02'),
(67, 60, 29, '2024-11-02'),
(68, 60, 29, '2024-11-02'),
(69, 63, 29, '2024-11-02'),
(70, 64, 29, '2024-11-02'),
(71, 65, 29, '2024-11-02'),
(72, 63, 29, '2024-11-02'),
(73, 57, 29, '2024-11-02'),
(74, 57, 29, '2024-11-02'),
(75, 57, 29, '2024-11-02'),
(76, 56, 29, '2024-11-02'),
(77, 56, 29, '2024-11-02'),
(78, 55, 29, '2024-11-02'),
(79, 55, 29, '2024-11-02'),
(80, 54, 29, '2024-11-02'),
(81, 54, 29, '2024-11-02'),
(82, 63, 29, '2024-11-02'),
(83, 57, 29, '2024-11-02'),
(84, 53, 29, '2024-11-02'),
(85, 52, 29, '2024-11-02'),
(86, 52, 29, '2024-11-02'),
(87, 52, 29, '2024-11-02'),
(88, 52, 29, '2024-11-02'),
(89, 63, 29, '2024-11-02'),
(90, 63, 29, '2024-11-02'),
(91, 66, 29, '2024-11-02'),
(92, 66, 29, '2024-11-02'),
(93, 66, 29, '2024-11-02'),
(94, 67, 46, '2024-11-03'),
(95, 68, 46, '2024-11-03'),
(96, 68, 46, '2024-11-03'),
(97, 69, 47, '2024-11-03'),
(98, 69, 47, '2024-11-03'),
(99, 69, 47, '2024-11-03'),
(100, 70, 29, '2024-11-03'),
(101, 70, 29, '2024-11-03'),
(102, 70, 29, '2024-11-03'),
(103, 63, 29, '2024-11-03');

-- --------------------------------------------------------

--
-- Structure de la table `amitie`
--

DROP TABLE IF EXISTS `amitie`;
CREATE TABLE IF NOT EXISTS `amitie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur_id_1` int(11) DEFAULT NULL,
  `utilisateur_id_2` int(11) DEFAULT NULL,
  `date_amitie` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `utilisateur_id_1` (`utilisateur_id_1`),
  KEY `utilisateur_id_2` (`utilisateur_id_2`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `utilisateur_id` int(11) DEFAULT NULL,
  `contenu` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  KEY `utilisateur_id` (`utilisateur_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int(11) DEFAULT NULL,
  `contenu` text NOT NULL,
  `date_publication` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `utilisateur_id` (`utilisateur_id`)
) ENGINE=MyISAM AUTO_INCREMENT=71 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id`, `utilisateur_id`, `contenu`, `date_publication`) VALUES
(1, 2, 'Bonjour de Cézanne', '2024-10-24'),
(2, 9, 'Bonjour de Verdi', '2024-10-24'),
(3, 2, 'Les pommes de Cézanne', '2024-10-24'),
(7, 7, 'Les neiges d\'antan', '2024-10-24'),
(5, 2, 'Peindre sur le motif - Cézanne', '2024-10-24'),
(6, 9, 'Nabucco de Verdi', '2024-10-24'),
(8, 25, 'message de aaa', '2024-10-29'),
(9, 25, 'ceci est un message de aaa', '2024-10-29'),
(10, 25, 'ceci est un message de boss', '2024-10-29'),
(11, 25, 'MESSAGE DE LL', '2024-10-29'),
(12, 27, 'message de boss', '2024-10-29'),
(13, 27, 'Message de BOSS', '2024-10-29'),
(14, 27, 'zzzzzzzzzzzzzzzzzzzz', '2024-10-29'),
(15, 27, 'new new new', '2024-10-29'),
(16, 27, 'message new', '2024-10-29'),
(17, 27, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2024-10-29'),
(18, 27, 'nouveau message', '2024-10-29'),
(20, 27, 'message avec vérifications', '2024-10-30'),
(21, 27, 'post du matin', '2024-10-30'),
(22, 27, '8.57', '2024-10-30'),
(23, 27, 'post 9.47', '2024-10-30'),
(24, 27, 'post = 9.53', '2024-10-30'),
(25, 27, 'post 9.54', '2024-10-30'),
(26, NULL, 'post 10.00', '2024-10-30'),
(27, NULL, 'zzz', '2024-10-30'),
(28, 27, 'post 10.00', '2024-10-30'),
(29, 27, 'post 10.08', '2024-10-30'),
(30, 27, 'post 10.10 MODIFIER AU 31/10', '2024-10-31'),
(31, 27, 'post 10.12', '2024-10-30'),
(32, 27, 'post 10.16 BOSS', '2024-10-31'),
(33, 27, 'nouveau au 31 ***modif au 1/10 WWWWWWWWWWWWWW', '2024-10-31'),
(46, 29, 'vide nouveau', '2024-10-01'),
(48, 29, 'test aaa  MODIF 1/10', '2024-11-01'),
(49, 27, 'test pour like', '2024-10-31'),
(50, 27, 'test 1/11 modif', '2024-11-01'),
(51, 27, 'test new répartition functions', '2024-11-01'),
(52, 27, 'nouveau aaa  bbbb', '2024-10-31'),
(53, 29, 'message 2/11', '2024-11-02'),
(54, 29, 'new message', '2024-11-02'),
(55, 29, 'nouveau', '2024-11-02'),
(56, 29, 'nouveau message', '2024-11-02'),
(57, 29, 'aaa', '2024-11-02'),
(67, 46, 'new***', '2024-11-03');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `mot_de_passe`) VALUES
(26, 'admin', '$2y$10$xXQI.mfknR2NPUQvZVo.TOb5OHoVHVk7374ImF5UOimawBJVAQSM6'),
(2, 'Paul Cézanne', 'peinture'),
(9, 'Giuseppe Verdi', 'opéra'),
(8, 'Henri Beyle', 'écrivain'),
(14, 'François', '$2y$10$uDGK9/BLeLar/pvSzV485ORrXD6BgYId2XqRp9QabI4la/Ne16GlO'),
(11, 'Clark Kent alias Superman', 'superman'),
(47, 'test', '$2y$10$4YWq5XDF1EAudj8F7.hTFOSyx7gXJtk2hoP9kr1YamZnTFsDYd4Pa'),
(29, 'super', '$2y$10$AVO9WnGsd6/HHaGZxpRAoOGS4QI6k6Zg5hfuF1pCPBX5jamGgTFfa'),
(28, 'LL', '$2y$10$.MQ4JZKyMYEOW/lmPZWaqekotZiKfXWSWC1ALCBAJZrS2ibkP65R2'),
(27, 'boss', '$2y$10$KcuByTsirNd3ABfUogr5oeOfDoVcQhgC3uXWvLHL6.PA3alWiczGK'),
(25, 'aaa', '$2y$10$ESjOb54dOlq8LKjPiSPfcuu3UaBUrQdvynwqUNq2JMNVS2Xx7mQW6');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
