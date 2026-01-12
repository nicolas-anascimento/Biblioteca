<?php
    require __DIR__ . "/Config/config.php";
    

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <div class="conteudo">
            <h1>Pesquisar</h1><br>
            <form method="post" id="aa" autocomplete="off">
                <label for="nome">Nome:</label><br>
                <input type="text" id="nome" name="nome"><br><br>
                <input type="button" value="Pesquisar" id="pesquisa" onclick="pesquisar()">
                <a href="criar.php"><input type="button" id="criar" value="Criar"></a>
            <!--<a href="filtrar.php"><input type="button" id="filtrar" value="filtrar"></a> -->
            <!--<input type="button" value="todos" id="mostrar" onclick="mostrarTodos()"> -->
                <input type="button" value="Limpar" id="limpar_" onclick="limpar()">
            </form>
        <table>
            <thead>
            <tr>
                <th>Nome</th>
                <th>Cap</th>
                <th>Scan</th>
                <th>Status</th>
                <th>Data</th>
            </tr>
            </thead>

            <tbody id="Lista"> </tbody>

        </table>

        <div id="resultado"> </div>
        

        </div>
    </div>

    <script>
        function limpar(){
            document.getElementById("nome").value = "";
            pesquisar();
        };


        document.getElementById("nome").addEventListener("keydown", function (e) {
            if (e.key === "Enter") {
                e.preventDefault(); // impede submit
                pesquisar();        // chama a busca
            }
        });        

        async function pesquisar(){
            const tbody = document.getElementById("Lista");
            const nome = document.getElementById("nome").value
            const div = document.getElementById("resultado")

            const Form = new FormData();
            Form.append('nome', nome );

            let result = await fetch("API/Pesquisar.php", {method:"POST", body: Form});

            result = await result.json();
            console.log(result)
            if (result.length > 0) {
                tbody.innerHTML = '';
                div.innerHTML = '';
                result.forEach(m => {
                    const tr = document.createElement("tr");

                    tr.innerHTML = `
                        <td>
                            <a href="exibir.php?id=${m.id}">
                                ${m.nome}
                            </a>
                        </td>
                        <td>${m.cap}</td>
                        <td>${m.scan}</td>
                        <td>${m.status}</td>
                        <td>${m.data}</td>
                    `;

                    tbody.appendChild(tr);
                    div.style.margin = "";
                    div.style.minHeight = "";
                });
            } else {
                div.innerHTML = ''
                tbody.innerHTML = ''
                const p = document.createElement("p")
                p.innerHTML = "Nenhum Resultado"
                div.style.margin =  "20px auto";
                div.style.minHeight = "50px";
                div.appendChild(p)
            }
        }  
        
        pesquisar();
    </script>

</body>
</html>