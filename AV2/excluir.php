<?php
// Excluir.php
require 'conexao.php'; // Conexão com o banco

// --------------------------------------------------------
// Pega o ID enviado via GET
// --------------------------------------------------------
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Se o ID for válido, tenta excluir
if ($id > 0) {
    $sql = "DELETE FROM produtos WHERE id = $id";
    mysqli_query($conn, $sql);
}
// Após excluir (ou se ID for inválido), volta para a página principal
header('Location: index.php');
exit;
?>