<?php 
    require __DIR__ . "/../Config/server.php";
    header("Content-Type: application/json");
    
    try{
        
        $id = (int)($_POST['id'] ?? 0);
        
        if($id <= 0){
            http_response_code(400);
            echo json_encode([
                "success" => false,
                "mensagem" => "id Inválido"
            ]);
            exit;
        }
        
        $sql = $pdo->prepare("DELETE FROM manga WHERE id = $id");
        $sql->execute();
        
        echo json_encode([
            'success' => true
        ]);
    } catch (Throwable $e){
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'message' => 'Erro interno do servidor',
            'details' => $e->getMessage()
        ]);        
    }
?>
