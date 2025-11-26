<?php

    require "server.php";

    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $nome = isset('nome') ? trim($_POST['nome']) : '';
        if($nome != ''){
            $nome = mysqli_real_escape_string($conn, $nome);
            

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
            <form method="post">
                <label for="nome">Nome:</label><br>
                <input type="text" id="nome" name="nome"><br><br>
                <input type="submit" value="Pesquisar">
                <input type="button" value="Limpar">
            </form>
                <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Cap</th>
                    <th>Scan</th>
                    <th>Hiato</th>
                    <th>Dataa</th>
                </tr>
            </thead>
            <tbody>
            <?php
            // Percorre cada linha de resultado e exibe na tabela
            while ($produtos = mysqli_fetch_assoc($result)):
            ?>
                <tr>
                    <td><?= htmlspecialchars($produtos['id']) ?></td>
                    <td><?= htmlspecialchars($produtos['nome']) ?></td>
                    <td><?= htmlspecialchars($produtos['cap']) ?></td>
                    <td><?= htmlspecialchars($produtos['scan']) ?></td>
                    <td><?= htmlspecialchars($produtos['hiato']) ?></td>
                    <td><?= htmlspecialchars($produtos['dataa']) ?></td>
                    <td>
                        <a href="editar.php?id=<?= $produtos['id'] ?>">Editar</a> |
                        <a href="excluir.php?id=<?= $produtos['id'] ?>"
                           onclick="return confirm('Tem certeza que deseja excluir este produto?');">
                            Excluir
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>

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