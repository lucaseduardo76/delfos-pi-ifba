document.addEventListener("DOMContentLoaded", function () {
    const agendaButton = document.getElementById("agendaButton");
    const dropdownMenu = document.getElementById("dropdownMenu");

    if (!agendaButton || !dropdownMenu) {
        console.error("Erro: Elementos não encontrados!");
        return;
    }

    agendaButton.addEventListener("click", function (event) {
        event.stopPropagation(); // Evita que o clique se propague
        dropdownMenu.classList.toggle("show");
    });

    document.addEventListener("click", function (event) {
        if (!dropdownMenu.contains(event.target) && !agendaButton.contains(event.target)) {
            dropdownMenu.classList.remove("show");
        }
    });
});