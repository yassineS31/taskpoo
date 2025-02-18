-task- Création de la base de données
CREATE DATABASE task CHARSET utf8mb4;
USE task;

-- Création des tables
CREATE TABLE `account`(
id_account INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
firstname VARCHAR(50) NOT NULL,
lastname VARCHAR(50) NOT NULL,
email VARCHAR(50) UNIQUE NOT NULL,
`password` VARCHAR(100) NOT NULL
)ENGINE=InnoDB;

CREATE TABLE task(
id_task INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
title VARCHAR(50) NOT NULL,
content VARCHAR(250) NOT NULL,
create_at DATETIME DEFAULT now() NOT NULL,
`status` TINYINT(1) DEFAULT 0,
id_account INT NOT NULL
)ENGINE=InnoDB;

CREATE TABLE task_category(
id_task INT NOT NULL,
id_category INT NOT NULL,
PRIMARY KEY(id_task, id_category)
)ENGINE=InnoDB;

CREATE TABLE category(
id_category INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
`name` VARCHAR(50) UNIQUE NOT NULL
)ENGINE=InnoDB;

-- Ajout des contraintes de clés étrangéres

ALTER TABLE task
ADD CONSTRAINT fk_create_account
FOREIGN KEY(id_account)
REFERENCES `account`(id_account)
ON DELETE CASCADE;

ALTER TABLE task_category
ADD CONSTRAINT fk_add_task
FOREIGN KEY(id_task)
REFERENCES task(id_task)
ON DELETE CASCADE;

ALTER TABLE task_category
ADD CONSTRAINT fk_add_category
FOREIGN KEY(id_category)
REFERENCES category(id_category)
ON DELETE CASCADE;