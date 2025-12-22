<?php
    require __DIR__ . "/Config/config.php";
/*
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';
        $cap = isset($_POST['cap']) ? (int) $_POST['cap'] : 0;
        $hiato = isset($_POST['hiato']) ? trim($_POST['hiato']) : '';
        $hiato = strtolower($hiato) == 'sim' ? 1 : 0;
        $scan = isset($_POST['scan']) ? trim($_POST['scan']) : '';
        $sql = $pdo->prepare("INSERT INTO manga(nome, cap, scan, hiato, dataa, url) values (?, ?, ?, ?, curdate(), 'a')");
        $sql->execute([$nome, $cap, $scan, $hiato]);
        $id = $pdo->lastInsertId();
        header("Location: exibir.php?id=$id");
    } 
*/
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <div class="conteudo">
            <h1>Adicionar</h1><br>
            <form method="post" autocomplete="off">
                <label for="nome">Nome:</label><br>
                <input type="text" id="nome" name="nome"><br><br>
                <label for="cap">Capítulo:</label><br>
                <input type="text" id="cap" name="cap"><br><br>
                <label for="scan">Scan:</label><br>
                <input type="text" id="scan" name="scan"><br><br>
                <label for="hiato">Hiato:</label><br>
                <input type="text" id="hiato" name="hiato"><br><br>
                <input type="button" value="Criar" id="criar">
                <a href="index.php"> <input type="button" value="Voltar"> </a>
            </form>
        </div>
    </div>    
    <script>
        document.querySelector("#criar").addEventListener("click", async () => {
            const nome = document.getElementById("nome").value;
            const cap = document.getElementById("cap").value;
            const scan = document.getElementById("scan").value;
            const hiato = document.getElementById("hiato").value;
            const Form = new FormData();
            Form.append('nome', nome);
            Form.append('cap', cap);
            Form.append('scan', scan);
            Form.append('hiato', hiato);
            const response = await fetch("API/Criar.php", {method:"POST", body: Form});    

            let dados = await response.json();
            console.log(dados)
            window.location.href="exibir.php?id="+dados.id;
        })        
    </script>
</body>
</html>