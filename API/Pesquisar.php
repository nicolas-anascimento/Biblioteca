<?php
    require __DIR__ . "/../Config/config.php";
    header("Content-Type: application/json");

try{    

    if(empty($_GET)){
        $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    } else {
        $nome = $_GET['nome'];
    }

    if($nome === ''){
        $sql = $pdo->prepare("SELECT m.id id, m.nome nome, m.cap cap, m.scan scan, s.nome status, m.dataa data FROM manga m INNER JOIN status s ON s.id = m.status_id WHERE m.id_user = ? ORDER BY nome");
        $sql->execute([$_SESSION["id"]]);
    } else {
        $sql = $pdo->prepare("SELECT m.id id, m.nome nome, m.cap cap, m.scan scan, s.nome status, m.dataa data FROM manga m INNER JOIN status s ON s.id = m.status_id WHERE m.nome LIKE ? AND m.id_user = ? ORDER BY nome");
        $sql->execute(["%$nome%", $_SESSION["id"]]);
    }

    $result = $sql->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($result);

} catch (Throwable $e){
    http_response_code(400);
    echo json_encode([
        "sucess" => false,
        "message" => "Falha interna do servidor",
        "Error" => $e->getMessage()
    ]);
}
