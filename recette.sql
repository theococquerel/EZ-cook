-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 20 mars 2026 à 13:32
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bddrecettes`
--

-- --------------------------------------------------------

--
-- Structure de la table `ingredient`
--
drop table if exists `ingredient`;
CREATE TABLE `ingredient` (
  `idIng` int(10) NOT NULL,
  `nomIng` varchar(255) DEFAULT NULL,
  `photoIng` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ingredient`
--

INSERT INTO `ingredient` (`idIng`, `nomIng`, `photoIng`) VALUES
(1, 'farine', 'farine.jpg'),
(2, 'oeuf', 'oeuf.jpg'),
(3, 'lait', 'lait.jpg'),
(4, 'sucre', 'sucre.jpg');
(5, 'pain', 'pain.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `recette`
--

drop table if exists `recette`;
CREATE TABLE `recette` (
  `id` int(10) UNSIGNED NOT NULL,
  `titre` varchar(255) DEFAULT NULL,
  `listeIng` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`listeIng`)),
  `description` varchar(2000) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `listeTag` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`listeTag`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table contenant les recettes';

--
-- Déchargement des données de la table `recette`
--

INSERT INTO `recette` (`id`, `titre`, `listeIng`, `description`, `photo`, `listeTag`) VALUES
(1, 'Crêpes', '[\"farine\", \"oeuf\", \"lait\", \"sucre\"]', 'Une recette originaire de bretagne', 'crepes.jpg', '[\"dessert\", \"facile\"]');
INSERT INTO `recette` (`id`, `titre`, `listeIng`, `description`, `photo`, `listeTag`) VALUES
(2, 'Pain Perdu', '[\"oeuf\", \"lait\", \"pain\"]', 'Une recette parfaite pour éviter le gachis de pain', 'painperdu.jpg', '[\"dessert\", \"facile\",\"antigaspi\"]');
-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

drop table if exists `tag`;
CREATE TABLE `tag` (
  `nomTag` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Une table pour tout les tag (les themes)';

--
-- Déchargement des données de la table `tag`
--

INSERT INTO `tag` (`nomTag`) VALUES
('dessert'),
('facile'),
('antigaspi');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`idIng`);

--
-- Index pour la table `recette`
--
ALTER TABLE `recette`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`nomTag`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
