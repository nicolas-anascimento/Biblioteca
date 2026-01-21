<?php
    require __DIR__ . "/Config/config.php";
    

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
    <link rel="stylesheet" href="/Biblioteca/assets/CSS/style.css">
</head>
<body>
    <div class="container">
        <div class="conteudo">
            <h1>Pesquisar</h1><br>
            <form method="post" id="aa" autocomplete="off">
                <label for="nome">Nome:</label><br>
                <input type="text" id="nome" name="nome"><br><br>
                <input type="button" value="Pesquisar" id="pesquisa" onclick="pesquisar()">
                <a href="Criar"><input type="button" id="criar" value="Criar"></a>
            <!--<a href="filtrar.php"><input type="button" id="filtrar" value="filtrar"></a> -->
            <!--<input type="button" value="todos" id="mostrar" onclick="mostrarTodos()"> -->
                <input type="button" value="Limpar" id="limpar_" onclick="limpar()">
            </form>
        <table>
            <thead>
            <tr>
                <th>Nome</th>
                <th>Cap</th>
                <th>Scan</th>
                <th>Status</th>
                <th>Data</th>
            </tr>
            </thead>

            <tbody id="Lista"> </tbody>

        </table>

        <div id="resultado"> </div>
        

        </div>
    </div>

    <script type="module" src="/Biblioteca/assets/JS/index.js"></script>

</body>
</html>