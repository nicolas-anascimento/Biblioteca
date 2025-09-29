<?php
    /*
    fazer um código para que procure o manhwa ou mangá e coloque os dados dele ai, caso queria atualizar algo peça para inserir os novos dados (cap e data ou atualizar o hiato)
    */
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $nome = $_POST['nome'] ?? '';
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <div class="conteudo">
            <h1>Pesquisar</h1><br>
            <form method="post">
                <label for="nome">Nome:</label><br>
                <input type="text" id="nome" name="nome"><br><br>
                <input type="submit" value="Pesquisar">
                <input type="button" value="Limpar">
            </form>

        </div>
    </div>


</body>
</html>