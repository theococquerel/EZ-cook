SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

INSERT INTO `Recette` (`id`, `titre`, `listeIng`, `description`, `photo`, `listeTag`) VALUES
(1,'Crepes','','Une recette originaire de bretagne','crepes.jpg','');
UPDATE Recette 
SET listeIng = '["farine", "oeuf", "lait", "sucre"]' 
WHERE id = 1;
UPDATE Recette 
SET listeTag = '["dessert", "facile"]' 
WHERE id = 1;

INSERT INTO `ingredients` (`idIng`, `nomIng`, `photoIng`) VALUES
(1,'farine','farine.jpg'),
(2,'oeuf','oeuf.jpg'),
(3,'lait','lait.jpg'),
(4,'sucre','sucre.jpg');

INSERT INTO `Tag` (`nom`) VALUES
('dessert'),
('facile');