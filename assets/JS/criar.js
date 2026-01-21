import { URL_BASE } from "./Configs.js";
import { ids } from "./Configs.js"
import { listar } from "./Configs.js";
listar()


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

    const response = await fetch("API/Criar.php", { method: "POST", body: Form });

    let dados = await response.json();

    console.log(dados)
    if (dados.success === true) {
        window.location.href = `${URL_BASE}manga/${dados.id}`;
    }
}


document.getElementById(ids[ids.length - 1]).addEventListener("keydown", function (e) {
    if (e.key === "Enter") {
        e.preventDefault(); // impede submit
        criar();        // chama a busca
    }
});

document.querySelector("#voltar").addEventListener("click", () => {
    window.location.href = `${URL_BASE}`;
})



document.getElementById("criar").addEventListener("click", criar)