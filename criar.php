<?php
    require __DIR__ . "/Config/config.php";
    $sql = $pdo->prepare("SELECT nome FROM status");
    $sql->execute();
    $lista = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <div class="conteudo">
            <h1>Adicionar</h1><br>
            <form method="post" autocomplete="off">
                <label for="nome">Nome:</label><br>
                <input type="text" id="nome" name="nome"><br><br>
                <label for="cap">Capítulo:</label><br>
                <input type="text" id="cap" name="cap"><br><br>
                <label for="scan">Scan:</label><br>
                <input type="text" id="scan" name="scan"><br><br>
                <label for="status">Status:</label><br>
                <input type="text" list="lista_status" id="status" name="status"><br><br>
                <input type="button" value="Criar" onclick="criar()" id="criar">
                <input type="button" value="Voltar" onclick="window.location.href='index.php'">
            </form>
        </div>
    </div>    
    <script>   

        const ids = ['nome', 'cap', 'scan', 'status'];

        ids.forEach(id =>{
            document.getElementById(id).addEventListener("keydown", function (e) {
                if (e.key === "Enter") {
                    e.preventDefault(); // impede submit
                    criar();        // chama a busca
                }
            });             
        })


        async function criar() {
            const nome = document.getElementById("nome").value;
            const cap = document.getElementById("cap").value;
            const scan = document.getElementById("scan").value;
            const status = document.getElementById("status").value;
            const Form = new FormData();
            Form.append('nome', nome);
            Form.append('cap', cap);
            Form.append('scan', scan);
            Form.append('status', status);
            const response = await fetch("API/Criar.php", {method:"POST", body: Form});    

            let dados = await response.json();
            console.log(dados)
            window.location.href="exibir.php?id="+dados.id;
        }
    </script>

    <datalist id="lista_status">
        <?php if(!empty($lista)): foreach($lista as $l): ?>
            <option value="<?=$l['nome']?>">
        <?php endforeach; endif; ?>
    </datalist>

</body>
</html>