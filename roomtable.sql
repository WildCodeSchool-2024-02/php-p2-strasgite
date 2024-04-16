-- Active: 1711641097871@@localhost@3306@projet2

SHOW TABLES;

CREATE TABLE rooms (
id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
name VARCHAR(80) NOT NULL,
date DATE NULL,
booked BOOLEAN NOT NULL,
description TEXT NOT NULL,
bed INT NOT NULL,
rooms INT NULL
);

INSERT INTO `rooms` (`name`, `booked`, `description`, `bed`) VALUES
('Chambre 1', 0, 'Chambre très éclairée et parfaite pour un couple sans enfants', 1),
('Chambre 2', 0, 'Chambre simple, rustique et avec la plus belle vue sur Strasbourg', 2),
('Chambre 3', 0, 'Petit chambre située au rez-de-chaussée de la maison, elle offre un accès direct et une vue sur le jardin', 1),
('Chambre 4', 0, 'Chambre très éclairée et parfaite pour un couple sans enfants', 1);
