<?php
    require __DIR__ . "/Config/config.php";
    $sql = $pdo->prepare("SELECT * FROM manga");
    $sql->execute();
    $result = $sql->fetchAll();


    if($_SERVER['REQUEST_METHOD'] === "POST"){
        if($_POST['nome'] !== ''){

            $nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';
            if($nome !== ''){
                $sql = $pdo->prepare("SELECT * FROM manga WHERE nome LIKE ? ");
                $sql->execute(["%$nome%"]);
                $result = $sql->fetchAll();
            }
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
                <label for="nome">Nome:</label><br>
                <input type="text" id="nome" name="nome"><br><br>
                <input type="submit" value="Pesquisar">
                <a href="criar.php"><input type="button" id="criar" value="Criar"></a>
                <a href="filtrar.php"><input type="button" id="criar" value="filtrar"></a>
            <!--   <input type="button" value="todos" id="mostrar" onclick="mostrarTodos()"> -->
                <input type="button" value="Limpar" id="limpar_" onclick="limpar()">
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