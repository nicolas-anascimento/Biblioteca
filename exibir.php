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

    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    if ($id !== 0){
        pesquisar();
    }

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
                <input type="text" id="nome" name="nome" onchange="Atualizar()" value="<?= htmlspecialchars($manga['nome']) ?>"><br><br>

                <label for="cap">Capítulo:</label><br>
                <input type="text" id="cap" name="cap" onchange="Atualizar()" value="<?= htmlspecialchars($manga['cap']) ?>"><br><br>

                <label for="scan">Scan:</label><br>
                <input type="text" id="scan" name="scan" onchange="Atualizar()" value="<?= htmlspecialchars($manga['scan']) ?>"><br><br>

                <label for="hiato">Hiato:</label><br>
                <input type="text" id="hiato" name="hiato" onchange="Atualizar()" value="<?= htmlspecialchars($manga['hiato']) ?>"><br><br>

                <label for="data">Data:</label><br>
                <input type="text" id="data" name="data" onchange="Atualizar()" value="<?= htmlspecialchars($manga['dataa']) ?>" readonly><br><br>

                <a href="index.php"><input type="button" value="Voltar"></a>
                <a href="excluir.php?id=<?=htmlspecialchars($id)?>"><input type="Button" value="Excluir" onclick="return confirm('Tem Certeza que deseja excluir este manga?')"></a>

            </form>
        </div>
    </div>    
    <script>
        console.log(<?= htmlspecialchars($id) ?>)
        
        async function Atualizar() {
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
        }    
    </script>
</body>
</html>