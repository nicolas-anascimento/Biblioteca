<?php
    require __DIR__ . "/../Config/config.php";
    header("Content-Type: application/json");
    if(empty($_GET)){
        $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    } else {
        $nome = $_GET['nome'];
    }

    if($nome === ''){
        $sql = $pdo->prepare("SELECT m.id id, m.nome nome, m.cap cap, m.scan scan, s.nome status, m.dataa data FROM manga m INNER JOIN status s ON s.id = m.status_id ORDER BY nome");
        $sql->execute();
    } else {
        $sql = $pdo->prepare("SELECT m.id id, m.nome nome, m.cap cap, m.scan scan, s.nome status, m.dataa data FROM manga m INNER JOIN status s ON s.id = m.status_id WHERE m.nome LIKE ? ORDER BY nome");
        $sql->execute(["%$nome%"]);
    }

$result = $sql->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($result);

?>