<?php
    $msg = '';
    $resultado = [];
    include("server.php");

    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $nome = $_POST['nome'] ?? '';
        pesquisar($nome);
        global $msg;
        $msg = 'f';
    }
    echo gettype($resultado);
    for($x=0;$x<count($resultado);$x++){
        echo $resultado[$x];
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

    <script>
        let msg = "<?php echo $msg; ?>"
        //let resultado = "<?php echo $resultado; ?>"
        console.log(msg)
        //console.log(resultado)
    </script>

</body>
</html>