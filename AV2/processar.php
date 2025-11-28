<?php
// processar.php
require 'conexao.php'; // Conecta ao banco

// -----------------------------------------------
// Verifica se o formulário foi enviado por POST
// -----------------------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura e trata os dados enviados pelo formulário
    $nome  = isset($_POST['nome'])  ? trim($_POST['nome'])  : '';
    $categoria = isset($_POST['categoria']) ? trim($_POST['categoria']) : '';
    $preco    = isset($_POST['preco'])    ? (float) $_POST['preco']    : 0.00;
    $quantidade    = isset($_POST['quantidade'])    ? (int)($_POST['quantidade'])    : 0;

    // Verifica se os campos obrigatórios foram preenchidos
    if ($nome !== '' && $categoria !== '' && $preco > 0.00 && $quantidade !== 0) {
        // Escapa os valores para evitar problemas com caracteres especiais
        $nome_  = mysqli_real_escape_string($conn, $nome);
        $categoria_ = mysqli_real_escape_string($conn, $categoria);

        // Monta o comando SQL de inserção
        $sql = "INSERT INTO produtos (nome, categoria, preco, quantidade)
                VALUES ('$nome_', '$categoria_', $preco, $quantidade)";

        // Executa o comando no banco
        mysqli_query($conn, $sql);
    }
}

// -----------------------------------------------
// Após processar, redireciona de volta para index.php
// -----------------------------------------------
header('Location: index.php');
exit;
