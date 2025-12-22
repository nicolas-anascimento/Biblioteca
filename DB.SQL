drop DATABASE if exists leitura;

CREATE DATABASE IF NOT EXISTS leitura;

use leitura;

create TABLE users(
    id int PRIMARY KEY AUTO_INCREMENT,
	nome varchar(200) NOT NULL UNIQUE,
    senha varchar(200) NOT NULL
);

create TABLE manga(
    id int PRIMARY KEY AUTO_INCREMENT,
	nome varchar(200),
	cap varchar(10),
	scan varchar(50),
	hiato boolean,
	dataa date
);


insert into users(nome, senha) values ("nicolas", "senha123");
insert into manga(nome, cap, scan, hiato, dataa) values ('a', 1, 'a', 0, curdate());
insert into manga(nome, cap, scan, hiato, dataa) values ('b', 2, 'b', 0, curdate())