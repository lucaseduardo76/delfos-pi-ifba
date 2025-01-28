document.getElementById("closeModal").addEventListener("click", () => {
    document.getElementById("modal").style.opacity = "0";

    const timer =setTimeout(() => {
        document.getElementById("modalLogin").style.display = "none";
    }, 450);
});

document.getElementById("loginButton").addEventListener("click", () => {
    document.getElementById("modalLogin").style.display = "flex";

    const timer = setTimeout(() => {
        document.getElementById("modal").style.opacity = "1";
    }, 10);
});

