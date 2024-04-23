-- Active: 1711381363336@@127.0.0.1@3306@projet2
-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 26 Octobre 2017 à 13:53
-- Version du serveur :  5.7.19-0ubuntu0.16.04.1
-- Version de PHP :  7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!40101 SET NAMES utf8mb4 */
;

--
-- Base de données :  `simple-mvc`
--

-- --------------------------------------------------------

--
-- Structure de la table `item`
--

CREATE TABLE `item` (
    `id` int(11) UNSIGNED NOT NULL, `title` varchar(255) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

--
-- Contenu de la table `item`
--

INSERT INTO
    `item` (`id`, `title`)
VALUES (1, 'Stuff'),
    (2, 'Doodads'),
    (3, 'Doodles'),
    (4, 'Itsybits');

--
-- Création de la table `room` si elle n'existe pas
--
CREATE TABLE IF NOT EXISTS `room` (
    `id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT, `title` VARCHAR(100) NOT NULL, `description` TEXT NOT NULL, `type` VARCHAR(50) NOT NULL, `bed_type` VARCHAR(50) NOT NULL
);

--
-- Contenu de la table `room` pour le moment et à titre d'exemple
--
INSERT INTO
    `room` (
        `id`, `title`, `description`, `type`, `bed_type`
    )
VALUES (
        1, 'Chambre1', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi pariatur nobis velit deserunt dicta perferendis fugiat tempora quod hic sit, a officiis culpa praesentium maxime mollitia ab accusantium repudiandae? Perspiciatis!', 'Luxe', '1x Double XXL'
    ),
    (
        2, 'Chambre2', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi pariatur nobis velit deserunt dicta perferendis fugiat tempora quod hic sit, a officiis culpa praesentium maxime mollitia ab accusantium repudiandae? Perspiciatis!', 'Sénateur', '2x Simple'
    ),
    (
        3, 'Chambre3', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi pariatur nobis velit deserunt dicta perferendis fugiat tempora quod hic sit, a officiis culpa praesentium maxime mollitia ab accusantium repudiandae? Perspiciatis!', 'Présidentielle', '1x Simple XXL'
    ),
    (
        4, 'Chambre4', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi pariatur nobis velit deserunt dicta perferendis fugiat tempora quod hic sit, a officiis culpa praesentium maxime mollitia ab accusantium repudiandae? Perspiciatis!', 'Confort', '1x Double'
    );
--
-- Index pour les tables exportées
--

--
-- Index pour la table `item`
--
ALTER TABLE `item` ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `item`
--
ALTER TABLE `item`
MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT = 3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;
