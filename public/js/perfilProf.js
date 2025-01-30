document.getElementById("agendarBtn").addEventListener("click", () => {
    document.getElementById("modalRegister").style.display = "flex";

    const timer = setTimeout(() => {
        document.getElementById("modal").style.opacity = "1";
    }, 10);
});

document.getElementById("closeModalRg").addEventListener("click", () => {
    document.getElementById("modal").style.opacity = "0";

    const timer = setTimeout(() => {
        document.getElementById("modalRegister").style.display = "none";
    }, 450);
});


document.getElementById("closeModalCn").addEventListener("click", () => {
    document.getElementById("modalCn").style.opacity = "0";

    const timer = setTimeout(() => {
        document.getElementById("modalConfirmed").style.display = "none";
    }, 450);
});


document.getElementById("linkBtn").addEventListener("click", () => {
    document.getElementById("modalLink").style.display = "flex";

    const timer = setTimeout(() => {
        document.getElementById("modalLi").style.opacity = "1";
    }, 10);
});

document.getElementById("closeModalLi").addEventListener("click", () => {
    document.getElementById("modalLi").style.opacity = "0";

    const timer = setTimeout(() => {
        document.getElementById("modalLink").style.display = "none";
    }, 450);
});