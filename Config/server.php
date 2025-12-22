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


?>

