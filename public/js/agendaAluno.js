

function abrirmodal(id) {

    const textConfirmacao = (n) => {
        if (n == 1) {
            return "Agendamento Confirmado"

        } else if (n == 0) {
            return "Agendamento Pendente de confirmação"
        }
    }

    for (let aula of listaAulas) {
        if (aula.id == id) {
            // Pegando os elementos do DOM
            const textArea = document.getElementById("textArea");
            const hora = document.getElementById("hora");
            const data = document.getElementById("data");
            const idAulaHidden = document.getElementById("idAulaHidden");
            const conf = document.getElementById("conf");
            const aluno = document.getElementById("aluno");

            // Verifica se os elementos existem antes de modificar
            if (textArea) textArea.innerHTML = aula.dificuldade;
            if (hora) hora.value = aula.hora;
            if (data) data.value = aula.data;
            if (idAulaHidden) idAulaHidden.value = aula.id;
            if (conf) conf.value = textConfirmacao(aula.confirmada);
            if (aluno) aluno.value = aula.aluno;
        }
    }



    // Exibe o modal, verificando se o elemento existe
    const modalRegister = document.getElementById("modalRegister");
    if (modalRegister) modalRegister.style.display = "flex";

    // Adiciona opacidade após um pequeno atraso
    setTimeout(() => {
        const modal = document.getElementById("modal");
        if (modal) modal.style.opacity = "1";
    }, 10);
}


document.addEventListener("DOMContentLoaded", function () {




    document.getElementById("closeModalRg").addEventListener("click", () => {

        document.getElementById("modal").style.opacity = "0";

        const timer = setTimeout(() => {
            document.getElementById("modalRegister").style.display = "none";
            document.getElementById("textArea").innerHTML = "";
            document.getElementById("hora").value = "";
            document.getElementById("data").value = "";
            document.getElementById("idAulaHidden").value = "";
            document.getElementById("aluno").value = "";

        }, 450);



    });

    document.addEventListener("keydown", function (event) {
        if (event.key === "Escape") {
            document.getElementById("modal").style.opacity = "0";

            const timer = setTimeout(() => {
                document.getElementById("modalRegister").style.display = "none";
                document.getElementById("textArea").innerHTML = "";
                document.getElementById("hora").value = "";
                document.getElementById("data").value = "";
                document.getElementById("idAulaHidden").value = "";
                document.getElementById("aluno").value = "";
            }, 450);
    
    
        }
    });
});

