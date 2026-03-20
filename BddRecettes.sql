-- phpMyAdmin SQL Dump
--

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `BddRecettes.sql`
--

--
-- Table structure for table `Recette`
--
CREATE TABLE `Recette` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `listeIng` JSON,
  `description` varchar(2000),
  `photo` varchar(255) DEFAULT NULL,
  `listeTag` JSON,
) -- ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `ingredients` (
  `idIng` int(11) NOT NULL,
  `nomIng` varchar(255) NOT NULL,
  `photoIng` varchar(255) DEFAULT NULL,
) -- ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`idIng`);

CREATE TABLE `Tag`(
  `nom` varchar(255) NOT NULL,
) --ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `Tag`
  ADD PRIMARY KEY (`nom`);
  

INSERT INTO `Recette` (`id`, `titre`, `listeIng`, `description`, `photo`, `listeTag`) VALUES
(1,'Crepes','','Une recette originaire de bretagne','crepes.jpg','');
UPDATE Recette 
SET listeIng = '["farine", "oeuf", "lait", "sucre"]' 
WHERE id = 1;
UPDATE Recette 
SET listeTag = '["dessert", "facile"]' 
WHERE id = 1;

ALTER TABLE `Recette`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `Recette`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

