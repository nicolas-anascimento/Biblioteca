<?php
    require "env_config.php";
    $servidor = $_ENV['SERVER'];
    $user = $_ENV['USER'];
    $pass = $_ENV['PASS'];
    $banco = $_ENV["BANCO"];

try {
    $pdo = new PDO("mysql:host=$servidor; dbname=$banco;charset=utf8", $user, $pass);
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);


} catch (PDOException $e) {
    die("Erro na conexão: ". $e->getMessage());
}


?>

