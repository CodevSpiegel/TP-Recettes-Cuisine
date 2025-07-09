-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 09 juil. 2025 à 20:25
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `recettes`
--

-- --------------------------------------------------------

--
-- Structure de la table `ingredients`
--

DROP TABLE IF EXISTS `ingredients`;
CREATE TABLE IF NOT EXISTS `ingredients` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ingredients`
--

INSERT INTO `ingredients` (`id`, `name`) VALUES
(1, 'Farine'),
(2, 'Oeufs'),
(3, 'Lait'),
(4, 'Sucre'),
(5, 'Beurre'),
(6, 'Chocolat noir'),
(7, 'Pommes'),
(8, 'Poulet'),
(9, 'Riz'),
(10, 'Tomates'),
(11, 'Oignons'),
(12, 'Ail');

-- --------------------------------------------------------

--
-- Structure de la table `ingredients_recipes`
--

DROP TABLE IF EXISTS `ingredients_recipes`;
CREATE TABLE IF NOT EXISTS `ingredients_recipes` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `ingredient_id` int UNSIGNED NOT NULL,
  `recipe_id` int UNSIGNED NOT NULL,
  `quantity` decimal(6,2) NOT NULL,
  `unity` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ingredients_recipes_recipe_id_foreign` (`recipe_id`),
  KEY `ingredients_recipes_ingredient_id_foreign` (`ingredient_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ingredients_recipes`
--

INSERT INTO `ingredients_recipes` (`id`, `ingredient_id`, `recipe_id`, `quantity`, `unity`) VALUES
(1, 1, 1, 250.00, 'g'),
(2, 2, 1, 3.00, 'unités'),
(3, 3, 1, 500.00, 'ml'),
(4, 4, 1, 50.00, 'g'),
(5, 6, 2, 200.00, 'g'),
(6, 5, 2, 150.00, 'g'),
(7, 1, 2, 50.00, 'g'),
(8, 7, 3, 4.00, 'unités'),
(9, 1, 3, 200.00, 'g'),
(10, 4, 3, 70.00, 'g'),
(11, 11, 4, 2.00, 'unités'),
(12, 12, 4, 3.00, 'gousses'),
(13, 10, 4, 200.00, 'g'),
(14, 10, 5, 3.00, 'unités'),
(15, 3, 5, 125.00, 'ml');

-- --------------------------------------------------------

--
-- Structure de la table `recipes`
--

DROP TABLE IF EXISTS `recipes`;
CREATE TABLE IF NOT EXISTS `recipes` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `duration` int NOT NULL,
  `difficulty` enum('facile','normale','difficile') COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `recipes`
--

INSERT INTO `recipes` (`id`, `name`, `description`, `duration`, `difficulty`) VALUES
(1, 'Crêpes simples', 'Recette classique de crêpes légères et moelleuses, parfaites pour le petit-déjeuner ou le goûter.', 30, 'facile'),
(2, 'Gâteau au chocolat fondant', 'Un gâteau au chocolat riche et décadent, avec un cœur coulant.', 45, 'normale'),
(3, 'Tarte aux pommes', 'Une tarte aux pommes traditionnelle, croustillante et parfumée.', 60, 'normale'),
(4, 'Curry de poulet', 'Un curry de poulet savoureux et épicé, accompagné de riz.', 75, 'difficile'),
(5, 'Salade de tomates et mozzarella', 'Une salade fraîche et simple, idéale pour l\'été.', 15, 'facile');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
