<?php
    require __DIR__ . "/Config/config.php";
    $manga = [];
    function pesquisar(){
        global $id, $pdo, $manga;
        $sql = $pdo->prepare("SELECT * FROM manga WHERE id = ?");
        $sql->execute([$id]);
        $manga = $sql->fetch();
        if(!empty($manga)){
            $manga['hiato'] = $manga['hiato'] == 0 ? 'Não' : 'Sim';
        }
    };

    $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;


    if ($id !== 0){
        pesquisar();
    }

/*
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';
        $cap = isset($_POST['cap']) ? (int) $_POST['cap'] : 0;
        $hiato = isset($_POST['hiato']) ? trim($_POST['hiato']) : '';
        $hiato = strtolower($hiato) == 'sim' ? 1 : 0;
        $scan = isset($_POST['scan']) ? trim($_POST['scan']) : '';
        $sql = $pdo->prepare("UPDATE manga SET nome = ?, cap = ?, scan = ?, hiato = ?, dataa = curdate() WHERE id = ? ");
        $sql->execute([$nome, $cap, $scan, $hiato, $id]);
        pesquisar();
    }
*/

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
            <h1>Pesquisar</h1><br>
            <form method="post" id="aa" autocomplete="off">
                <label for="nome">Nome:</label><br>
                <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($manga['nome']) ?>"><br><br>
                <label for="cap">Capítulo:</label><br>
                <input type="text" id="cap" name="cap" value="<?= htmlspecialchars($manga['cap']) ?>"><br><br>
                <label for="scan">Scan:</label><br>
                <input type="text" id="scan" name="scan" value="<?= htmlspecialchars($manga['scan']) ?>"><br><br>
                <label for="hiato">Hiato:</label><br>
                <input type="text" id="hiato" name="hiato" value="<?= htmlspecialchars($manga['hiato']) ?>"><br><br>
                <label for="data">Data:</label><br>
                <input type="text" id="data" name="data" value="<?= htmlspecialchars($manga['dataa']) ?>" readonly><br><br>
                <input type="button" value="Editar" id="atualizar">
                <a href="index.php"><input type="button" value="Voltar"></a>
                <a href="excluir.php?id=<?=htmlspecialchars($id)?>"><input type="Button" value="Excluir" onclick="return confirm('Tem Certeza que deseja excluir este manga?')"></a>

            </form>
        </div>
    </div>    
    <script>
        console.log(<?= htmlspecialchars($id) ?>)
        document.querySelector("#atualizar").addEventListener("click", async () => {
            const id = <?=htmlspecialchars($id);?>;
            const nome = document.getElementById("nome").value;
            const cap = document.getElementById("cap").value;
            const scan = document.getElementById("scan").value;
            const hiato = document.getElementById("hiato").value;
            
            const Form = new FormData();
            Form.append('id', id);
            Form.append('nome', nome);
            Form.append('cap', cap);
            Form.append('scan', scan);
            Form.append('hiato', hiato);

            let response = await fetch("API/Atualizar.php", {method:"POST", body: Form});    

            let dados = await response.json();

            console.log(dados);

            document.getElementById('data').value = dados.dataa
        })    
    </script>
</body>
</html>