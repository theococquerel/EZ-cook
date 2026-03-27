-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 24 mars 2026 à 15:41
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
(1, 'farine', 'imagesingredient/farine.jpg'),
(2, 'oeuf', 'imagesingredient/oeuf.jpg'),
(3, 'lait', 'imagesingredient/lait.jpg'),
(4, 'sucre', 'imagesingredient/sucre.jpg'),
(5, 'pain', 'imagesingredient/pain.jpg'),
(6, 'pâtes', 'imagesingredient/pates.jpg'),
(7, 'lardons', 'imagesingredient/lardons.jpg'),
(8, 'steak', 'imagesingredient/steak.jpg'),
(9, 'fromage', 'imagesingredient/fromage.jpg'),
(10, 'saucisses', 'imagesingredient/saucisses.jpg'),
(11, 'oignons', 'imagesingredient/oignons.jpg'),
(12, 'tomates', 'imagesingredient/tomates.jpg'),
(13, 'piment', 'imagesingredient/piment.jpg'),
(14, 'pomme', 'imagesingredient/pomme.jpg'),
(15, 'crevettes', 'imagesingredient/crevettes.jpg'),
(16, 'moules', 'imagesingredient/moules.jpg'),
(17, 'chocolat noir', 'imagesingredient/chocolatnoir.jpg'),
(18, 'beurre', 'imagesingredient/beurre.jpg'),
(19, 'fraise', 'imagesingredient/fraise.jpg'),
(20, 'orange', 'imagesingredient/orange.jpg'),
(21, 'raisin', 'imagesingredient/raisin.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `recette`
--

drop table if exists `recette`;
CREATE TABLE `recette` (
  `id` int(10) UNSIGNED NOT NULL,
  `titre` varchar(255) DEFAULT NULL,
  `listeIdIng` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`listeIdIng`)),
  `description` varchar(2000) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `listeTag` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`listeTag`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table contenant les recettes';

--
-- Déchargement des données de la table `recette`
--

INSERT INTO `recette` (`id`, `titre`, `listeIdIng`, `description`, `photo`, `listeTag`) VALUES
(1, 'Crêpes', '[1, 2, 3, 4]', 'Une recette originaire de bretagne', 'imagesrecettes/crepes.jpg', '[\"dessert\", \"facile\"]'),
(2, 'Pain Perdu', '[2, 3, 5]', 'Une recette parfaite pour éviter le gachis de pain', 'imagesrecettes/painperdu.jpg', '[\"dessert\", \"facile\",\"antigaspi\"]'),
(3, 'Pâtes carbonara', '[6, 2, 7]', 'Une recette italienne délicieuse', 'imagesrecettes/patescarbonara.jpg', '[\"plat\",\"facile\", \"bon marché\"]'),
(4, 'Burger Maison', '[8, 5, 9]', 'Un délicieux burger fait maison', 'imagesrecettes/burgermaison.jpg', '[\"facile\", \"bon marché\"]'),
(5, 'Rougail', '[10, 11, 12, 13]', "Un plat originaire de la Réunion", 'imagesrecettes/rougail.jpg', '[\"hiver\", \"bon marché\"]'),
(6, 'Tarte aux pommes', '[1, 2, 14, 4]', 'Une tarte aux pommes simple et délicieuse', 'imagesrecettes/tarteauxpommes.jpg', '[\"dessert\", \"facile\"]'),
(7, 'Omelette', '[2, 7, 15]', 'Une omelette rapide et savoureuse', 'imagesrecettes/omelette.jpg', '[\"facile\", \"bon marché\"]'),
(8, 'Omelette de la Mer', '[2, 16, 15]', 'Une omelette inspirée par les plats marins', 'imagesrecettes/omelettemarine.jpg', '[\"facile\", \"bon marché\"]'),
(9, 'Brownie', '[17, 2, 18, 4, 1]', 'Un brownie au chocolat fondant', 'imagesrecettes/brownie.jpg', '[\"dessert\", \"long\"]'),
(10, 'Salade de fruits', '[14, 19, 20, 21]', 'Une salade de fruits fraîche et vitaminée', 'imagesrecettes/saladedefruits.jpg', '[\"dessert\", \"facile\"]');






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
('antigaspi'),
('bon marché'),
('hiver'),
('long');

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
