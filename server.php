<?php
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $banco = "leitura";

    $conn = mysqli_connect($servidor, $usuario, $senha, $banco);
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    if(!$conn){
        die("Falha na conexão: " . mysqli_connect_error());
    }

//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

/* 

CREATE DATABASE IF NOT EXISTS leitura;

use leitura;

create TABLE manga(
    id int PRIMARY KEY AUTO_INCREMENT,
	nome varchar(200),
	cap float,
	scan varchar(50),
	hiato boolean,
	dataa date,
	url varchar(2083)
)

*/


?>

