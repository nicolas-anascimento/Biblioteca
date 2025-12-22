<?php
    require __DIR__ . '/../Config/config.php';
    header("Content-Type: application/json");
    $nome = $_POST['nome'];
    $cap = $_POST['cap'];
    $scan = $_POST['scan'];
    $hiato = strtolower($_POST['hiato'] ?? '') === 'sim' ? 1 : 0;
    

    $sql = $pdo->prepare("INSERT INTO manga(nome, cap, scan, hiato, dataa) VALUES (?, ?, ?, ?, curdate())");
    $sql->execute([$nome, $cap, $scan, $hiato]);
    $id = $pdo->lastInsertId();
    
    echo json_encode(['sucess' => true, 'id' => $id]);

?>