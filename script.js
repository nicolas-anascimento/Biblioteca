document.querySelector("#criar").addEventListener("click", async () => {
    const nome = document.getElementById("nome").value;
    const cap = document.getElementById("nome").value;
    const scan = document.getElementById("nome").value;
    const hiato = document.getElementById("nome").value;
    const Form = new FormData();
    Form.append('nome', nome);
    Form.append('cap', cap);
    Form.append('scan', scan);
    Form.append('hiato', hiato);
    await fetch("/API/Criar.php", {method:"POST", body: form});    
})