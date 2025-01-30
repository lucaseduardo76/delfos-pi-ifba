document.getElementById("closeModal").addEventListener("click", () => {
    document.getElementById("modal").style.opacity = "0";

    const timer = setTimeout(() => {
        document.getElementById("modalLogin").style.display = "none";
    }, 450);
});

document.getElementById("loginButton").addEventListener("click", () => {
    document.getElementById("modalLogin").style.display = "flex";

    const timer = setTimeout(() => {
        document.getElementById("modal").style.opacity = "1";
    }, 10);
});


document.getElementById("closeModalBtn").addEventListener("click", () => {
    document.getElementById("popup").style.display = "none";
});


document.addEventListener("DOMContentLoaded", function () {
    const cpfInput = document.querySelector('input[name="cpf"]');
    const telefoneInput = document.querySelector('input[name="telefone"]');

    function formatCPF(value) {
        return value
            .replace(/\D/g, "") // Remove tudo que não for número
            .replace(/^(\d{3})(\d)/, "$1.$2") // Coloca o primeiro ponto
            .replace(/^(\d{3})\.(\d{3})(\d)/, "$1.$2.$3") // Coloca o segundo ponto
            .replace(/\.(\d{3})(\d)/, ".$1-$2") // Coloca o hífen
            .slice(0, 14); // Limita a 14 caracteres
    }

    function formatTelefone(value) {
        return value
            .replace(/\D/g, "") // Remove tudo que não for número
            .replace(/^(\d{2})(\d)/, "($1) $2") // Adiciona o DDD
            .replace(/(\d{5})(\d)/, "$1-$2") // Adiciona o hífen no número de 9 dígitos
            .slice(0, 15); // Limita a 15 caracteres
    }

    cpfInput.addEventListener("input", function (e) {
        e.target.value = formatCPF(e.target.value);
    });

    telefoneInput.addEventListener("input", function (e) {
        e.target.value = formatTelefone(e.target.value);
    });
});

