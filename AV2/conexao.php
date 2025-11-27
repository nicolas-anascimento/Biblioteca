<?php
// conexao.php
// -----------------------------------------------
// Configurações de conexão com o banco de dados
// -----------------------------------------------
$servidor = "localhost";   // Endereço do servidor MySQL
$usuario  = "root";        // Usuário padrão do XAMPP
$senha    = "";            // Senha (vazia por padrão no XAMPP)
$banco    = "loja"; // Nome do banco de dados

// -----------------------------------------------
// Tentativa de conexão
// -----------------------------------------------
$conn = mysqli_connect($servidor, $usuario, $senha, $banco);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// -----------------------------------------------
// Verifica se ocorreu algum erro na conexão
// -----------------------------------------------
if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}

// -----------------------------------------------
// Caso tenha dado tudo certo
// -----------------------------------------------
/*
echo "Conexão realizada com sucesso!";
*/


?>