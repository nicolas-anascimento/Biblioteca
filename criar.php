<?php
require __DIR__ . "/Config/config.php";
$sql = $pdo->prepare("SELECT nome FROM status");
$sql->execute();
$lista = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar</title>
    <link rel="stylesheet" href="/Biblioteca/assets/CSS/style.css">
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
                <label for="status">Status:</label><br>
                <input type="text" list="status_lista" id="status" name="status"><br><br>
                <input type="button" value="Criar" id="criar">
                <input type="button" value="Voltar" id="voltar">
            </form>
        </div>
    </div>

    <datalist id="status_lista"></datalist>

    <script type="module" src="/Biblioteca/assets/JS/criar.js"></script>



</body>

</html>