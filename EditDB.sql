SHOW TABLES;

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

CREATE TABLE user (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT, firstname VARCHAR(80) NOT NULL, lastname VARCHAR(80) NOT NULL, email VARCHAR(250) NOT NULL, address VARCHAR(250) NOT NULL, birthday DATE NULL, password VARCHAR(255) NOT NULL, isAdmin BOOLEAN NOT NULL, isClient BOOLEAN NOT NULL, isVIP BOOLEAN NOT NULL
);

INSERT INTO `user` (`firstname`, `lastname`, `email`, `address`, `password`, `isAdmin`, `isClient`, `isVIP`) VALUES
('John', 'Doe', 'johndoe@gmail.com', '42 rue du test 99999 nul part', '123456', 1, 0, 0),
('Jane', 'Doe', 'janedoe@gmail.com', '64 rue de l\'essai 88888 quelque part', 'test', 0, 1, 1);

UPDATE user SET isAdmin = 1 WHERE id = 1;

UPDATE user SET isClient = 1 WHERE id = 3;

UPDATE user SET isVIP = 1 WHERE id = 3;

SELECT birthday from user WHERE firstname = 'Philippe';

INSERT INTO user `birthday` VALUES ('1993-01-24') WHERE firstname = 'Philippe';
