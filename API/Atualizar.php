<?php

    require __DIR__ . '/../Config/config.php';
    header('Content-Type: application/json');

    
    try {

        if(!empty($_GET)){
            
            $id = (int)$_GET['id'];
        
        } else {
            
            $id = (int)$_POST['id'];
        
        }
        $nome = $_POST['nome'];
        $cap = $_POST['cap'];
        $scan = $_POST['scan'];
        $status = $_POST['status'];
        if($id <= 0){
            http_response_code(400);
            echo json_encode([
                'sucesso' => false,
                'error' => 'ID invalido'
            ]);
            exit;
        }

        if(!$nome || !$cap || !$scan ){
            http_response_code(500);
            echo json_encode([
                'sucesso' => false,
                'error' => 'Campo obrigatorio faltanto'
            ]);
            exit;
        }

        if($id !== 0){
            $sql = $pdo->prepare("SELECT id FROM status WHERE LOWER(nome) = LOWER(?)");
            $sql->execute([$status]);
            $status_query = $sql->fetch(PDO::FETCH_ASSOC);

            if(!$status_query){
                http_response_code(400);
                echo json_encode([
                    'sucess' => false,
                    'error' => 'Status Inválido'
                ]);
                exit;
            }
            
            $status_id = (int)$status_query['id'];

            $sql = $pdo->prepare("UPDATE manga SET nome = ?, cap = ?, scan = ?, status_id = ?, dataa = curdate() WHERE id = ? ");
            $sql->execute([$nome, $cap, $scan, $status_id, $id]);
            
            $sqll = $pdo->prepare("SELECT * FROM manga WHERE id = ?");
            $sqll->execute([$id]);
            $dados = $sqll->fetch(PDO::FETCH_ASSOC);
        }

        $data = $dados['dataa'];

        echo json_encode(['message' => 'funcionou', 'dataa' => $data]);

    } catch (Throwable $e) {
        http_response_code(500);

        echo json_encode([
            'sucesso' => false,
            'message' => 'Erro interno do servidor',
            'details' => $e->getMessage()
        ]);
    }
