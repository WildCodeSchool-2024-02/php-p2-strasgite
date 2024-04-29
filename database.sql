-- Active: 1711641097871@@localhost@3306@projet2
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
-- Création de la table `room` si elle n'existe pas Alex
--
CREATE TABLE IF NOT EXISTS `room` (
    `id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT, `title` VARCHAR(100) NOT NULL, `description` TEXT NOT NULL, `type` VARCHAR(50) NOT NULL, `bed_type` VARCHAR(50) NOT NULL
);

--
-- Contenu de la table `room` Alex
--
INSERT INTO
    `room` (
        `id`, `title`, `description`, `type`, `bed_type`
    )
VALUES (
        1, 'La Suite Enchantée', 'Plongez dans un monde de magie et d\'élégance dans notre suite enchantée. Cette chambre spacieuse est ornée de détails raffinés, d\'un lit drapé de voiles soyeuses et d\'un coin salon confortable. Profitez de vues panoramiques sur notre jardin luxuriant depuis votre propre balcon privé. Laissez-vous emporter par le charme de cette suite et vivez une expérience inoubliable.', 'Luxe', 'A baldaquin'
    ),
    (
        2, 'La Chambre Bohème', 'Découvrez un refuge bohème où le confort moderne rencontre l\'ambiance artistique. Cette chambre est décorée avec des couleurs vives, des tissus ethniques et des œuvres d\'art originales, créant une atmosphère chaleureuse et accueillante. Dotée d\'un lit moelleux et d\'une salle de bains privative, cette chambre vous invite à vous détendre et à vous ressourcer dans un cadre unique.', 'Sénateur', 'King-size'
    ),
    (
        3, 'La Suite Romantique', 'Vivez une escapade romantique dans notre suite romantique, conçue pour les amoureux en quête d\'intimité et de confort. Avec sa cheminée et son bain à remous pour deux personnes, cette suite offre le cadre idéal pour une escapade romantique. Détendez-vous sur votre terrasse privée avec vue sur les montagnes ou profitez d\'un dîner aux chandelles dans notre salle à manger intime.', 'Présidentielle', 'A baldaquin'
    ),
    (
        4, 'La Chambre Rustique', 'Retrouvez le charme de la campagne dans notre chambre rustique, décorée dans un style champêtre élégant. Les poutres en bois, les meubles en bois massif et les accents rustiques créent une atmosphère chaleureuse et authentique. Installez-vous près de la cheminée avec un bon livre ou profitez de l\'air frais sur votre terrasse privée. Cette chambre offre une expérience paisible et relaxante.', 'Confort', '2x Simple'
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

--
-- Création table `contact`
--
CREATE TABLE IF NOT EXISTS contact (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT, lastname VARCHAR(45) NOT NULL, firstname VARCHAR(45) NOT NULL, email VARCHAR(80) NOT NULL, subject VARCHAR(45) NOT NULL, message TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS user (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT, firstname VARCHAR(80) NOT NULL, lastname VARCHAR(80) NOT NULL, email VARCHAR(250) NOT NULL, address VARCHAR(250) NOT NULL, birthday DATE NULL, password VARCHAR(255) NOT NULL, isAdmin BOOLEAN NOT NULL DEFAULT '0', isClient BOOLEAN NOT NULL DEFAULT '0', isVIP BOOLEAN NOT NULL DEFAULT '0'
);

INSERT INTO
    `user` (
        `firstname`, `lastname`, `email`, `address`, `password`, `isAdmin`, `isClient`, `isVIP`
    )
VALUES (
        'John', 'Doe', 'johndoe@gmail.com', '42 rue du test 99999 nul part', '123456', 1, 0, 0
    ),
    (
        'Jane', 'Doe', 'janedoe@gmail.com', '64 rue de l\'essai 88888 quelque part', 'test', 0, 1, 1
    );

-- UPDATE user SET isAdmin = 1 WHERE id = 1;

-- UPDATE user SET isClient = 1 WHERE id = 3;

-- UPDATE user SET isVIP = 1 WHERE id = 3;

CREATE TABLE IF NOT EXISTS reservation (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT, user_id INT NULL, room_id INT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, isBooked BOOLEAN NOT NULL DEFAULT '0', FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE, FOREIGN KEY (room_id) REFERENCES room (id) ON DELETE CASCADE
);

CREATE TABLE avis (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT, description TEXT NOT NULL, note INT NULL, avis_room_id INT NOT NULL, avis_user_id int NOT NULL, isVisible BOOLEAN NOT NULL, foreign KEY (avis_room_id) REFERENCES room (id), FOREIGN KEY (avis_user_id) REFERENCES user (id)
);

ALTER TABLE avis add isVisible BOOLEAN;

CREATE TABLE IF NOT EXISTS service (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT, reservation_id INT NULL, breakfast BOOLEAN NOT NULL DEFAULT '0', minibar BOOLEAN NOT NULL DEFAULT '0', parking BOOLEAN NOT NULL DEFAULT '0', service24 BOOLEAN NOT NULL DEFAULT '0', driver BOOLEAN NOT NULL DEFAULT '0', FOREIGN KEY (reservation_id) REFERENCES reservation (id) ON DELETE CASCADE
);