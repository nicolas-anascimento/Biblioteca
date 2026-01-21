import { URL_BASE } from "./Configs.js";
import { ids } from "./Configs.js"
import { listar } from "./Configs.js";

listar()

const url = window.location.pathname
const partes = url.split("/");
let id = null

partes.forEach((p, i) => {
    if (p == "Manga") {
        id = partes[i + 1]
    }
})
async function pesquisar(){
    const Form = new FormData();
    Form.append('id', id)

    let response = await fetch(`${URL_BASE}API/Pesquisar.php`, {method: 'POST', body: Form});
    response = await response.json();

    console.log(response);
    ids.forEach(i => {
        document.querySelector(`#${i}`).value = response[i]
    })
    document.querySelector("#data").value = response.data
    


}

pesquisar()
// console.log(id);

ids.forEach(id => {
    document.getElementById(id).addEventListener("keydown", function (e) {
        if (e.key === "Enter") {
            e.preventDefault();
            Atualizar();
        }
    });
})


async function Atualizar() {
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

    let response = await fetch("API/Atualizar.php", { method: "POST", body: Form });

    let dados = await response.json();

    console.log(dados);

    document.getElementById('data').value = dados.dataa
    return dados
}

document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") {
        window.location.href = `${URL_BASE}Home/`;
    }
})

document.getElementById("voltar").addEventListener("click", (k) => {
    window.location.href = `${URL_BASE}Home/`;
})

document.getElementById("excluir").addEventListener("click", async function (e) {
    const confirmado = confirm('Tem Certeza que deseja excluir este manga?');
    if (confirmado) {
        let Form = new FormData;
        Form.append("id", id)

        const response = await fetch(`${URL_BASE}API/excluir.php`, { method: "POST", body: Form })
        const dados = await response.json();

        console.log(dados)

        if (dados.sucess == true) {
            window.location.href = `${URL_BASE}`
        }
    }
})