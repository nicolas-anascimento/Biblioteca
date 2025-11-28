<?php
// editar.php
require 'conexao.php'; // Inclui a conexão e session_start()

// ----------------------------------------------------------------------
// (U)PDATE - Lógica para ATUALIZAR o produto (quando o formulário é enviado)
// ----------------------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // 1. Captura os dados do formulário
    $id         = isset($_POST['id']) ? (int) $_POST['id']                : 0;
    $nome       = isset($_POST['nome']) ? trim($_POST['nome'])             : '';
    $categoria  = isset($_POST['categoria']) ? trim($_POST['categoria'])   : '';
    $preco      = isset($_POST['preco']) ? (float) $_POST['preco']         : 0.0;
    $quantidade = isset($_POST['quantidade']) ? (int) $_POST['quantidade'] : 0;

    // 2. Validação
    if ($id <= 0 || empty($nome) || $preco < 0 || $quantidade < 0) {
        $_SESSION['mensagem'] = "Dados inválidos. Verifique o formulário.";
        $_SESSION['msg_tipo'] = "erro";
        // Redireciona de volta para o index (ou poderia ser para o próprio editar.php?id=$id)
        header('Location: index.php');
        exit;
    }

    // 3. Prepara a consulta SQL (Prepared Statement)
    $sql = "UPDATE produtos 
            SET nome = ?, categoria = ?, preco = ?, quantidade = ?
            WHERE id = ?";
    
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // 4. Binda os parâmetros ("ssdi" + "i" do ID)
        mysqli_stmt_bind_param($stmt, "ssdii", $nome, $categoria, $preco, $quantidade, $id);

        // 5. Executa
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['mensagem'] = "Produto atualizado com sucesso!";
            $_SESSION['msg_tipo'] = "sucesso";
        } else {
            $_SESSION['mensagem'] = "Erro ao atualizar o produto: " . mysqli_stmt_error($stmt);
            $_SESSION['msg_tipo'] = "erro";
        }
        
        mysqli_stmt_close($stmt);

    } else {
        $_SESSION['mensagem'] = "Erro ao preparar a consulta: " . mysqli_error($conn);
        $_SESSION['msg_tipo'] = "erro";
    }

    // Fecha a conexão e redireciona
    mysqli_close($conn);
    header('Location: index.php');
    exit;
}

// ----------------------------------------------------------------------
// (R)EAD - Lógica para CARREGAR os dados do produto (quando a página é aberta)
// ----------------------------------------------------------------------
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Se o ID for inválido, volta para o Início
if ($id <= 0) {
    $_SESSION['mensagem'] = "ID do produto inválido.";
    $_SESSION['msg_tipo'] = "erro";
    header('Location: index.php');
    exit;
}

// Busca os dados do produto no banco (COM PREPARED STATEMENT)
$sql = "SELECT * FROM produtos WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Verifica se encontrou o produto
if (mysqli_num_rows($result) == 0) {
    $_SESSION['mensagem'] = "Produto não encontrado.";
    $_SESSION['msg_tipo'] = "erro";
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header('Location: index.php');
    exit;
}

// Pega os dados em formato de array associativo
$produto = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Editar Produto #<?= htmlspecialchars($produto['id']) ?></h1>

        <form action="editar.php" method="post">
            <input type="hidden" name="id" value="<?= htmlspecialchars($produto['id']) ?>">

            <label>Nome do Produto:
                <input type="text" name="nome" required
                       value="<?= htmlspecialchars($produto['nome']) ?>">
            </label>

            <label>Categoria:
                <input type="text" name="categoria"
                       value="<?= htmlspecialchars($produto['categoria']) ?>">
            </label>

            <label>Preço (R$):
                <input type="number" name="preco" step="0.01" min="0" required
                       value="<?= htmlspecialchars($produto['preco']) ?>">
            </label>

            <label>Quantidade:
                <input type="number" name="quantidade" min="0" required
                       value="<?= htmlspecialchars($produto['quantidade']) ?>">
            </label>

            <button type="submit">Salvar Alterações</button>
        </form>

        <p><a href="index.php">Voltar para a lista</a></p>
    </div>
</body>
</html>