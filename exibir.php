<?php
    require "server.php";
    $manga = [];
    function pesquisar(){
        global $id, $conn, $manga;
        $sql = "SELECT * FROM manga WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) !== 0){
            $manga = mysqli_fetch_assoc($result);
            if ($manga['hiato'] == 0){
                $manga['hiato'] = 'Não';
            } else {
                $manga['hiato'] = 'Sim';
            }

        }
    };
    $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
    if ($id !== 0){
        pesquisar();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';
        $cap = isset($_POST['cap']) ? (int) $_POST['cap'] : 0;
        $hiato = isset($_POST['hiato']) ? trim($_POST['hiato']) : '';
        $hiato = strtolower($hiato);
        $scan = isset($_POST['scan']) ? trim($_POST['scan']) : '';
        if ($hiato == 'sim'){
            $hiato = 1;
        } else {
            $hiato = 0;
        }
        $sql = "UPDATE manga SET nome = '$nome', cap = $cap, scan = '$scan', hiato = $hiato, dataa = curdate() WHERE id = $id ";

        mysqli_query($conn, $sql);
        pesquisar();
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <div class="conteudo">
            <h1>Pesquisar</h1><br>
            <form method="post" id="aa">
                <label for="nome">Nome:</label><br>
                <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($manga['nome']) ?>"><br><br>
                <label for="cap">Capítulo:</label><br>
                <input type="text" id="cap" name="cap" value="<?= htmlspecialchars($manga['cap']) ?>"><br><br>
                <label for="scan">Scan:</label><br>
                <input type="text" id="scan" name="scan" value="<?= htmlspecialchars($manga['scan']) ?>"><br><br>
                <label for="hiato">Hiato:</label><br>
                <input type="text" id="hiato" name="hiato" value="<?= htmlspecialchars($manga['hiato']) ?>"><br><br>
                <label for="nome">Data:</label><br>
                <input type="text" id="data" name="data" value="<?= htmlspecialchars($manga['dataa']) ?>" readonly><br><br>
                <input type="submit" value="Editar">
                <a href="index.php"> <input type="button" value="Voltar"> </a>
            </form>
        </div>
    </div>    
    <script>
        console.log("<?php echo "$nome, $cap, $hiato, $scan"; ?>")
    </script>
</body>
</html>