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
        $hiato = strtolower($_POST['hiato'] ?? '') === 'sim' ? 1 : 0;

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
            $sql = $pdo->prepare("UPDATE manga SET nome = ?, cap = ?, scan = ?, hiato = ?, dataa = curdate() WHERE id = ? ");
            $sql->execute([$nome, $cap, $scan, $hiato, $id]);
            
            $sqll = $pdo->prepare("SELECT * FROM manga WHERE id = ?");
            $sqll->execute([$id]);
            $dados = $sqll->fetch(PDO::FETCH_ASSOC);
        }

        $data = $dados['dataa'];

        echo json_encode(['resposta' => 'funcionou', 'dataa' => $data]);

    } catch (Throwable $e) {
        http_response_code(500);

        echo json_encode([
            'sucesso' => false,
            'mensagem' => 'Erro interno do servidor',
            'details' => e->getMessage()
        ]);
    }
