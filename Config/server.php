<?php
require "env_config.php";

$servidor = $_ENV['SERVER'] ?? '';
$user     = $_ENV['USER'] ?? '';
$pass     = $_ENV['PASS'] ?? '';
$banco    = $_ENV['BANCO'] ?? '';

$port = $_ENV['PORT'] ?? null;
$port = ($port !== null && $port !== '') ? (int)$port : null;

$dsn = "mysql:host={$servidor};" . ($port ? "port={$port};" : "") . "dbname={$banco};charset=utf8mb4";

try {
    if($servidor == '' || $user == '' || $banco == ''){
      die("Error, configuração do ENV erradas ou inexistentes");
    }
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,

        // PDO::MYSQL_ATTR_SSL_CA => __DIR__ . "/../certs/ca.crt",
        // PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
    ];

    $pdo = new PDO($dsn, $user, $pass, $options);

} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage() . "\n" . $e->getCode());
}

