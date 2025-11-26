<?php
// index.php
require 'conexao.php'; // Inclui o arquivo de conexão

// -----------------------------------------------
// Busca todos os carros cadastrados no banco
// -----------------------------------------------
$sql = "SELECT * FROM produtos ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Cadastro de Produtos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Cadastro de Produto</h1>

    <h2>Novo Produto</h2>
    <!-- Formulário para cadastrar um novo carro -->
    <form action="processar.php" method="post">

        <label>Nome:
           <br> <input type="text" name="nome" required>
        </label><br><br>

        <label>Categoria:
            <br><input type="text" name="categoria" required>
        </label><br><br>

        <label>Preço:
            <br><input type="text" name="preco" required>
        </label><br><br>

        <label>Quantidade:
            <br><input type="text" name="quantidade" required>
        </label><br><br>

        <button type="submit">Cadastrar</button>
    </form>

    <h2>Produtos Cadastrados</h2>

    <?php
    // Verifica se a consulta retornou algum registro
    if ($result && mysqli_num_rows($result) > 0):
    ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>categoria</th>
                    <th>preco</th>
                    <th>quantidade</th>
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
                    <td><?= htmlspecialchars($produtos['categoria']) ?></td>
                    <td><?= htmlspecialchars($produtos['preco']) ?></td>
                    <td><?= htmlspecialchars($produtos['quantidade']) ?></td>
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
    <?php else: ?>
        <p>Nenhum Produto cadastrado.</p>
    <?php endif; ?>

</body>
</html>
