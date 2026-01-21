<?php
    require __DIR__ . "/Config/config.php";
    $msg = '';

    $sql = $pdo->prepare("DELETE FROM cookie WHERE data < NOW()");
    $sql->execute();

    $sql = $pdo->prepare("SELECT * FROM user WHERE senha NOT LIKE '$2y$%'");
    $sql->execute();
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    if(!empty($result)){
        foreach($result as $s){
            $senha = $s["senha"];
            $ss = password_get_info($senha);
            if($ss["algoName"] !== "bcrypt"){
                $senha_nova = password_hash($senha, PASSWORD_DEFAULT);
                $sql = $pdo->prepare("UPDATE user SET senha = ? WHERE id = ?");
                $sql->execute([$senha_nova, $s["id"]]);
            }
        }
    }

    if(isset($_SESSION["user"])){
        header("Location: Home/");
    }

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        
        $nome = $_POST["nome"] ?? '';
        $senha = $_POST["senha"] ?? '';
        
        
        if($nome == '' || $senha == ''){
            $msg = 'Campos obrigatórios estão vazios';
        } else {
            $sql = $pdo->prepare("SELECT * FROM user WHERE nome = ?");
            $sql->execute([$nome]);
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            
            if(!empty($result)){
                if(password_verify($senha, $result["senha"])){
                    $_SESSION["user"] = $nome;
                    $_SESSION["id"] = $result["id"];
                    $token = bin2hex(random_bytes(32));
                    $token_hash = hash("sha256", $token);

                    setcookie("Lembrar", $token_hash, time() + 30 * 24 * 60 * 60, "/", "", false, true);

                    $sql = $pdo->prepare("INSERT INTO cookie(id_user, hash, data) VALUE (?, ?, DATE_ADD(NOW(), INTERVAL 1 MONTH))");
                    $sql->execute([$_SESSION["id"], $token_hash]);

                    header("Location: Home/");
                } else {
                    $msg = "Senha incorreta";
                }
            } else {
                $msg = "Usuário não encontrado!";
            }
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/Biblioteca/assets/CSS/style.css">
    <link rel="stylesheet" href="/Biblioteca/assets/CSS/style_login.css">
</head>
<body>
    <div class="container">
        <div class="conteudo">
            <form method="post">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome">
                
                <label for="senha">Senha:</label>
                <input type="password" name="senha" id="senha">
                <?php if($msg !== ''): ?>
                    <p><?= $msg ?> </p>
                    <br>
                <?php endif ?>
                <input type="submit" value="Logar">
            </form>            
        </div>
    </div>
</body>
</html>