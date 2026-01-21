export const URL_BASE = "/Biblioteca/"
export const ids = ['nome', 'cap', 'scan', 'status']

const response = await fetch(`${URL_BASE}API/lista.php`)
const data = await response.json();

export const stats = data.Status


export function listar(){
    const lista = document.querySelector("#status_lista")

    stats.forEach(s =>{
        const option = document.createElement("option")
        option.value = s.nome
        lista.appendChild(option);
    })
}


