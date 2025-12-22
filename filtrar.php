<?php
    require __DIR__ . "/Config/config.php";
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $scan = isset($_POST['scan']) ? trim($_POST['scan']) : '';
        $hiato = isset($_POST['hiato']) ? trim($_POST['hiato']) : '';
        
        if($hiato !== '' && $scan !== '') {
            $sql = $pdo->prepare("SELECT * FROM manga WHERE scan like ? and hiato = ?");
            $sql->execute(["%$scan%", $hiato]);
            $result = $sql->fetchAll();
        } elseif($scan !== ''){
            $sql = $pdo->prepare("SELECT * FROM manga WHERE scan like ?");
            $sql->execute(["%$scan%"]);
            $result = $sql->fetchAll();
        } elseif($hiato !== ''){
            $hiato = strtolower($hiato) == 'sim' ? 1 : 0;
            $sql = $pdo->prepare("SELECT * FROM manga WHERE hiato = ?");
            $sql->execute([$hiato]);
            $result = $sql->fetchAll();
        }
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
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
            <form method="post" id="aa" autocomplete="off">
                <label for="scan">scan:</label><br>
                <input type="text" id="scan" name="scan"><br><br>
                <label for="hiato">hiato:</label><br>
                <input type="text" id="hiato" name="hiato"><br><br>
                <input type="submit" value="Pesquisar">
                <a href="index.php"><input type="button" value="Voltar"></a>
            </form>
        <table>
            <thead>
            <tr>
                <th>Nome</th>
                <th>Cap</th>
                <th>Scan</th>
                <th>Hiato</th>
                <th>Data</th>
            </tr>
            </thead>

            <tbody>
            <?php
            if (!empty($result)) {
                foreach ($result as $m)  {
                    echo "<tr>";
                    echo "<td> <a href='exibir.php?id=".$m['id']."'>".htmlspecialchars($m['nome'])."</a> </td>";
                    echo "<td>".htmlspecialchars($m['cap'])."</td>";
                    echo "<td>".htmlspecialchars($m['scan'])."</td>";
                    $hiato = $m['hiato'] == 0 ? "Não" : "Sim";
                    echo "<td>".htmlspecialchars($hiato)."</td>";
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
        function mostrarTodos(){
            document.getElementById("nome").value = "--todos--";
            document.querySelector("form").submit();
        }

        function limpar(){
            document.getElementById("nome").value = "";
            document.querySelector("form").submit();
        };
    </script>

</body>
</html>