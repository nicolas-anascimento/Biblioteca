<?php
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $banco = "leitura";

    $conn = new mysqli($servidor, $usuario, $senha, $banco);

    if ($conn->connect_error){
        die("Error na conexão: ". $conn->connect_error);
    } else {
        echo "Funcionando!";
    }


//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    function pesquisar($nome){
        global $conn;
        $sql = "SELECT * from demo where name like '%$nome%'"
        $resultado = $conn->query($sql);
    }

?>