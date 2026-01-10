<?php 
    require __DIR__ . '/server.php';
    function voltar(){
        $lista_aberta = ["login.php"];
        $url = basename($_SERVER["PHP_SELF"]);
        if(!in_array($url, $lista_aberta)){
            header("Location: login.php");
        }
    }

    define('URL_BASE', 'Biblioteca');
    session_start();
    if(isset($_COOKIE["Lembrar"]) && !isset($_SESSION["user"])){
        $hash = $_COOKIE["Lembrar"];
        $sql = $pdo->prepare("SELECT u.id id, u.nome nome FROM cookie c INNER JOIN user u on u.id = c.id_user WHERE c.hash = ?");
        $sql->execute([$hash]);
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        if(empty($result)){
            voltar();
        } else {
            $_SESSION["id"] = $result["id"];
            $_SESSION["user"] = $result["nome"];
        }
    }
    if(!isset($_SESSION["user"]) && !isset($_COOKIE["Lembrar"])){
        voltar();
    }


?>