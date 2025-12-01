<?php
    $servidor = "localhost";
    $user = "root";
    $pass = "";
    $banco = "leitura";

try {
    $pdo = new PDO("mysql:host=$servidor; dbname=$banco;charset=utf8", $user, $pass);
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);


} catch (PDOException $e) {
    die("Erro na conexão: ". $e->getMessage());
}

    
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

/* 

drop DATABASE if exists leitura;

CREATE DATABASE IF NOT EXISTS leitura;

use leitura;

create TABLE users(
    id int PRIMARY KEY AUTO_INCREMENT,
	nome varchar(200),
    senha varchar(200)
);

create TABLE manga(
    id int PRIMARY KEY AUTO_INCREMENT,
	nome varchar(200),
	cap float,
	scan varchar(50),
	hiato boolean,
	dataa date,
	idu int,
    foreign key (idu) reference users(id)
);

insert into manga(nome, cap, scan, hiato, dataa, url) values ('a', 1, 'a', 0, curdate(), 'b');
insert into manga(nome, cap, scan, hiato, dataa, url) values ('b', 2, 'b', 0, curdate(), 'b')

*/


?>

