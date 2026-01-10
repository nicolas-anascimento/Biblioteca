<?php
    require __DIR__ . "/Config/config.php";
    $manga = [];
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    if ($id !== 0){
        $sql = $pdo->prepare("SELECT m.nome nome, m.cap cap, m.scan scan, s.nome status, m.dataa data FROM manga m INNER JOIN status s ON s.id = m.status_id WHERE m.id = ?");
        $sql->execute([$id]);
        $manga = $sql->fetch(PDO::FETCH_ASSOC);
    }

    $sql = $pdo->prepare("SELECT nome FROM status");
    $sql->execute();
    $lista = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($manga['nome'])?></title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <div class="conteudo">
            <h1><?= htmlspecialchars($manga['nome']) ?></h1><br>
            <form method="post" id="aa" autocomplete="off">

                <label for="nome">Nome:</label><br>
                <input type="text" id="nome" name="nome" onchange="Atualizar()" value="<?= htmlspecialchars($manga['nome']) ?>"><br><br>

                <label for="cap">Capítulo:</label><br>
                <input type="text" id="cap" name="cap" onchange="Atualizar()" value="<?= htmlspecialchars($manga['cap']) ?>"><br><br>

                <label for="scan">Scan:</label><br>
                <input type="text" id="scan" name="scan" onchange="Atualizar()" value="<?= htmlspecialchars($manga['scan']) ?>"><br><br>

                <label for="status">Status:</label><br>
                <input type="text" id="status" list="status_lista" name="status" onchange="Atualizar()" value="<?= htmlspecialchars($manga['status']) ?>"><br><br>

                <label for="data">Data:</label><br>
                <input type="text" id="data" name="data" onchange="Atualizar()" value="<?= htmlspecialchars($manga['data']) ?>" readonly><br><br>

                <a href="index.php"><input type="button" value="Voltar"></a>
                <input type="Button" value="Excluir" id="excluir">

            </form>
        </div>
    </div>    
    <script>
        console.log(<?= htmlspecialchars($id) ?>)
        
        const ids = ['nome', 'cap', 'scan', 'status'];

        ids.forEach(id =>{
            document.getElementById(id).addEventListener("keydown", function (e) {
                if (e.key === "Enter") {
                    e.preventDefault(); 
                    Atualizar();        
                }
            });             
        })        
        

        async function Atualizar() {
            const id = <?php echo($id); ?>;
            const nome = document.getElementById("nome").value;
            const cap = document.getElementById("cap").value;
            const scan = document.getElementById("scan").value;
            const status = document.getElementById("status").value;
            
            const Form = new FormData();
            Form.append('id', id);
            Form.append('nome', nome);
            Form.append('cap', cap);
            Form.append('scan', scan);
            Form.append('status', status);

            let response = await fetch("API/Atualizar.php", {method:"POST", body: Form});    

            let dados = await response.json();

            console.log(dados);

            document.getElementById('data').value = dados.dataa
            return dados
        }

        document.addEventListener("keydown", async (e) => {
            if(e.key === "Escape"){ 
                window.location.href = "index.php";
            }
        })        
        
        document.getElementById("excluir").addEventListener("click", async function (e) {
            const confirmado = confirm('Tem Certeza que deseja excluir este manga?');
            if(confirmado){
                id = <?php echo($id) ?>;
                let Form = new FormData;
                Form.append("id", id)

                const response = await fetch("/API/excluir.php", {method: "POST", body: Form})
                const dados = await response.json();

                console.log(dados)

                if(dados.sucess == true){
                    window.location.href="index.php"
                }
            }
        })

        
    </script>

    <datalist id="status_lista">
        <?php if(!empty($lista)): foreach($lista as $l): ?>
            <option value="<?=$l['nome']?>">
        <?php endforeach; endif; ?>
    </datalist>
</body>
</html>