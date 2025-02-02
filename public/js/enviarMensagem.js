document.getElementById("btnEnviar").addEventListener("click", () => {
    document.getElementById("modalConfirmed").style.display = "flex";

    const timer = setTimeout(() => {
        document.getElementById("modalCn").style.opacity = "1";
    }, 450);
});

document.getElementById("closeModalCn").addEventListener("click", () => {
    document.getElementById("modalCn").style.opacity = "0";

    const timer = setTimeout(() => {
        document.getElementById("modalConfirmed").style.display = "none";
    }, 450);
});