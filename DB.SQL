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

create TABLE manga(
    id int PRIMARY KEY AUTO_INCREMENT,
	nome varchar(200),
	cap varchar(10),
	scan varchar(50),
	status_id int,
	dataa date,
	FOREIGN KEY (status_id) REFERENCES status(id)
);


insert into manga(nome, cap, scan, status_id, dataa) values ('a', 1, 'a', 1, curdate());
insert into manga(nome, cap, scan, status_id, dataa) values ('b', 2, 'b', 1, curdate())