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

--
-- Création table `contact`
--
CREATE TABLE IF NOT EXISTS contact (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT, lastname VARCHAR(45) NOT NULL, firstname VARCHAR(45) NOT NULL, email VARCHAR(80) NOT NULL, message TEXT NOT NULL
);


CREATE TABLE rooms (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT, name VARCHAR(80) NOT NULL, date DATE NULL, booked BOOLEAN NOT NULL, description TEXT NOT NULL, bed INT NOT NULL, rooms INT NULL
);

INSERT INTO
    `rooms` (
        `name`, `booked`, `description`, `bed`
    )
VALUES (
        'Chambre 1', 0, 'Chambre très éclairée et parfaite pour un couple sans enfants', 1
    ),
    (
        'Chambre 2', 0, 'Chambre simple, rustique et avec la plus belle vue sur Strasbourg', 2
    ),
    (
        'Chambre 3', 0, 'Petit chambre située au rez-de-chaussée de la maison, elle offre un accès direct et une vue sur le jardin', 1
    ),
    (
        'Chambre 4', 0, 'Chambre très éclairée et parfaite pour un couple sans enfants', 1
    );

CREATE TABLE IF NOT EXISTS user (
id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
firstname VARCHAR(80) NOT NULL,
lastname VARCHAR(80) NOT NULL,
email VARCHAR(250) NOT NULL,
address VARCHAR(250) NOT NULL,
birthday DATE NULL,
password VARCHAR(255) NOT NULL,
isAdmin BOOLEAN NOT NULL DEFAULT '0',
isClient BOOLEAN NOT NULL DEFAULT '0',
isVIP BOOLEAN NOT NULL DEFAULT '0'
);

INSERT INTO `user` (`firstname`, `lastname`, `email`, `address`, `password`, `isAdmin`, `isClient`, `isVIP`) VALUES
('John', 'Doe', 'johndoe@gmail.com', '42 rue du test 99999 nul part', '123456', 1, 0, 0),
('Jane', 'Doe', 'janedoe@gmail.com', '64 rue de l\'essai 88888 quelque part', 'test', 0, 1, 1);

UPDATE user SET isAdmin = 1 WHERE id=1;

UPDATE user SET isClient = 1 WHERE id=3;

UPDATE user SET isVIP = 1 WHERE id=3;

SELECT birthday from user WHERE firstname = 'Philippe';

INSERT INTO user `birthday` VALUES ('1993-01-24') WHERE firstname = 'Philippe';
