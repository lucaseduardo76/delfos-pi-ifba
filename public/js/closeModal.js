document.getElementById("closeModal").addEventListener("click", () => {
    document.getElementById("modalLogin").style.display = "none";
});

document.getElementById("loginButton").addEventListener("click", () => {
    document.getElementById("modalLogin").style.display = "flex";
});