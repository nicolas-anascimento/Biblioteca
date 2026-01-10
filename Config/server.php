<?php
    require "env_config.php";
    $servidor = $_ENV['SERVER'];
    $user = $_ENV['USER'];
    $pass = $_ENV['PASS'];
    $banco = $_ENV["BANCO"];
    $port = isset($_ENV['PORT']) ? (int)$_ENV['PORT'] : '';
    if(!isset($port)){
        $dsn = "mysql:host=$servidor;port=$port;dbname=$banco;charset=utf8mb4";
    } else {
        $dsn = "mysql:host=$servidor;dbname=$banco;charset=utf8mb4";
    }

try {
    $options = [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES => false,
    
      //PDO::MYSQL_ATTR_SSL_CA => __DIR__ . "/../certs/ca.crt",
      //PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false, // para não travar por validação
    ];
    
    $pdo = new PDO($dsn, $user, $pass, $options);


} catch (PDOException $e) {
    die("Erro na conexão: ". $e->getMessage());
}


?>