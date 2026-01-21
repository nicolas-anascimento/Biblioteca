<?php
require __DIR__ . '/../Config/config.php';
header("Content-Type: application/json");

try {
    $nome = $_POST['nome'] ?? '';
    $cap = $_POST['cap'] ?? '';
    $scan = $_POST['scan'] ?? '';
    $status = $_POST['status'] ?? '';

    if ($nome == '' || $cap == '' || $scan == '' || $status == '') {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => "Campos obrigatórios vazios",
        ]);
        exit;
    }

    $sql = $pdo->prepare("SELECT id FROM status WHERE LOWER(nome) = LOWER(?)");
    $sql->execute([$status]);
    $status_query = $sql->fetch(PDO::FETCH_ASSOC);
    $status_id = (int) $status_query['id'] ?? 0;

    if ($status_id == 0) {
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'message' => "O status é inválido"
        ]);
        exit;
    }


    $sql = $pdo->prepare("INSERT INTO manga(nome, cap, scan, status_id, dataa, id_user) VALUES (?, ?, ?, ?, curdate(), ?)");
    $sql->execute([$nome, $cap, $scan, $status_id, $_SESSION["id"]]);
    $id = $pdo->lastInsertId();

    echo json_encode(['sucess' => true, 'id' => $id]);

} catch (Throwable $e) {
    http_response_code(500);

    echo json_encode([
        'success' => false,
        'message' => 'Erro interno do servidor',
        'details' => $e->getMessage()
    ]);
}
?>