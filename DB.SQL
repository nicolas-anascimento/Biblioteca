drop DATABASE if exists leitura;

CREATE DATABASE IF NOT EXISTS leitura;

use leitura;

CREATE TABLE status(
	id int PRIMARY KEY AUTO_INCREMENT,
	nome varchar(50) NOT NULL
);

insert into status(nome) values ('Lendo');
insert into status(nome) values ('Dropado');
insert into status(nome) values ('Hiato');
insert into status(nome) values ('Planejo ler');

CREATE TABLE user(
	id INT PRIMARY KEY AUTO_INCREMENT,
	nome VARCHAR(100) NOT NULL UNIQUE,
	senha varchar(500) NOT NULL
);

INSERT INTO user(nome, senha) VALUES ("nicolas", "123");
INSERT INTO user(nome, senha) VALUES ("a", "123");

CREATE TABLE cookie(
	id INT PRIMARY KEY AUTO_INCREMENT,
	id_user INT NOT NULL,
	hash VARCHAR(500) UNIQUE NOT NULL,
	data DATETIME NOT NULL,
	FOREIGN KEY (id_user) REFERENCES user(id)
);

create TABLE manga(
    id int PRIMARY KEY AUTO_INCREMENT,
	nome varchar(200),
	cap varchar(10),
	scan varchar(50),
	status_id int,
	dataa date,
	id_user int NOT NULL ,
	FOREIGN KEY (id_user) REFERENCES user(id),
	FOREIGN KEY (status_id) REFERENCES status(id)
);


insert into manga(nome, cap, scan, status_id, dataa, id_user) values ('ab', 1, 'a', 1, curdate(), 1);
insert into manga(nome, cap, scan, status_id, dataa, id_user) values ('bc', 2, 'b', 1, curdate(), 1)