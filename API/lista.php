<?php
require __DIR__ . '/../Config/config.php';
header("Content-Type: application/json");

try {
    $sql = $pdo->prepare("SELECT * FROM status");
    $sql->execute();
    $status = $sql->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "success" => true,
        "Status" => $status
    ]);

} catch (Throwable $e) {
    echo json_encode([
        "success" => false,
        "erro" => "Erro: " .  $e->getMessage()
    ]);
}
