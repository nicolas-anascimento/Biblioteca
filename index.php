<?php
    $manga = [
        'id' => '',
        'nome' => '',
        'cap' => '',
        'scan' => '',
        'hiato' => '',
        'dataa' => ''
    ];
    require "server.php";

    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';
        if($nome !== ''){
            $nome = mysqli_real_escape_string($conn, $nome);
            $sql = "SELECT * FROM manga WHERE nome = '$nome'";
            $result = mysqli_query($conn, $sql);
        }
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
            <form method="post" id="aa">
                <label for="nome">Nome:</label><br>
                <input type="text" id="nome" name="nome"><br><br>
                <input type="submit" value="Pesquisar">
                <input type="button" value="Limpar" onclick="location.reload()">
            </form>
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Cap</th>
                <th>Scan</th>
                <th>Hiato</th>
                <th>Data</th>
            </tr>
            </thead>

            <tbody>
            <?php
            if (isset($result) && mysqli_num_rows($result) > 0) {

                // LOOP CORRETO
                while ($m = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>".htmlspecialchars($m['id'])."</td>";
                    echo "<td>".htmlspecialchars($m['nome'])."</td>";
                    echo "<td>".htmlspecialchars($m['cap'])."</td>";
                    echo "<td>".htmlspecialchars($m['scan'])."</td>";
                    echo "<td>".htmlspecialchars($m['hiato'])."</td>";
                    echo "<td>".htmlspecialchars($m['dataa'])."</td>";
                    echo "</tr>";
                }
            }
            ?>
            </tbody>
        </table>

        </div>
    </div>

    <script>
        function limparFormulario(){
            document.getElementById("aa").reset();
        }

    </script>

</body>
</html>