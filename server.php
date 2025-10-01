<?php
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $banco = "leitura";

    $conn = new mysqli($servidor, $usuario, $senha, $banco);

    if ($conn->connect_error){
        die("");
        $msg = "Error na conexão: ". $conn->connect_error;
    } else {
        $msg = "Funcionando!";
    }


//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
$resultado = [];
    function pesquisar($nome){
        global $conn, $resultado;
        $sql = "SELECT * from manga where nome like '%$nome%'";
        $res = $conn->query($sql);

        if($res && $res->num_rows > 0){
            while($row = $res->fetch_assoc()){
                $resultado[] = $row;
            }
        }
    }

/* 
create TABLE manga(
    ID int PRIMARY KEY AUTO_INCREMENT,
	Nome varchar(200),
	Cap float,
	Scan varchar(50),
	Hiato boolean,
	Dataa date,
	url varchar(2083)
)

*/


?>

