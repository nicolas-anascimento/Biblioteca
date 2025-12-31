<?php
    require __DIR__ . "/../Config/config.php";
    header("Content-Type: application/json");
    
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';

    if($nome === ''){
        $sql = $pdo->prepare('SELECT * FROM manga ORDER BY nome');
        $sql->execute();
    } else {
        $sql = $pdo->prepare("SELECT * FROM manga WHERE nome like ?");
        $sql->execute(["%$nome%"]);
    }

$result = $sql->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($result);

?>