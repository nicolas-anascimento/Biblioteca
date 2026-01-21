<?php

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($manga['nome'])?></title>
    <link rel="stylesheet" href="/Biblioteca/assets/CSS/style.css">
</head>
<body>
    <div class="container">
        <div class="conteudo">
            <h1><?= htmlspecialchars($manga['nome']) ?></h1><br>
            <form method="post" id="aa" autocomplete="off">

                <label for="nome">Nome:</label><br>
                <input type="text" id="nome" name="nome" onchange="Atualizar()"><br><br>

                <label for="cap">Capítulo:</label><br>
                <input type="text" id="cap" name="cap" onchange="Atualizar()" ><br><br>

                <label for="scan">Scan:</label><br>
                <input type="text" id="scan" name="scan" onchange="Atualizar()" ><br><br>

                <label for="status">Status:</label><br>
                <input type="text" id="status" list="status_lista" name="status" onchange="Atualizar()"><br><br>

                <label for="data">Data:</label><br>
                <input type="text" id="data" name="data" readonly><br><br>

                <input type="button" id="voltar" value="Voltar">
                <input type="Button" value="Excluir" id="excluir">

            </form>
        </div>
    </div>    

    <datalist id="status_lista"></datalist>


    <script type="module" src="/Biblioteca/assets/JS/exibir.js"></script>


</body>
</html>