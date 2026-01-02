<?php
    require __DIR__ . '/../Config/config.php';
    header("Content-Type: application/json");
    $nome = $_POST['nome'];
    $cap = $_POST['cap'];
    $scan = $_POST['scan'];
    $status = $_POST['status'];

    $sql = $pdo->prepare("SELECT id FROM status WHERE LOWER(nome) = LOWER(?)");
    $sql->execute([$status]);
    $status_query = $sql->fetch(PDO::FETCH_ASSOC);    
    $status_id = (int)$status_query['id'];

    
    

    $sql = $pdo->prepare("INSERT INTO manga(nome, cap, scan, status_id, dataa) VALUES (?, ?, ?, ?, curdate())");
    $sql->execute([$nome, $cap, $scan, $status_id]);
    $id = $pdo->lastInsertId();
    
    echo json_encode(['sucess' => true, 'id' => $id]);

?>