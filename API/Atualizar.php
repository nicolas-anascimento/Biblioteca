<?php

    require __DIR__ . '/../Config/config.php';
    header('Content-Type: application/json');
    if(!empty($_GET)){
        $id = (int)$_GET['id'];
    } else {
        $id = (int)$_POST['id'];
    }
    $nome = $_POST['nome'];
    $cap = $_POST['cap'];
    $scan = $_POST['scan'];
    $hiato = strtolower($_POST['hiato'] ?? '') === 'sim' ? 1 : 0;
    
    if($id !== 0){
        $sql = $pdo->prepare("UPDATE manga SET nome = ?, cap = ?, scan = ?, hiato = ?, dataa = curdate() WHERE id = ? ");
        $sql->execute([$nome, $cap, $scan, $hiato, $id]);
        
        $sqll = $pdo->prepare("SELECT * FROM manga WHERE id = ?");
        $sqll->execute([$id]);
        $dados = $sqll->fetch(PDO::FETCH_ASSOC);
    }

    $data = $dados['dataa'];

    echo json_encode(['resposta' => 'funcionou', 'dataa' => $data]);

?>