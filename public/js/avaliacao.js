document.addEventListener("DOMContentLoaded", function () {
    const stars = document.querySelectorAll(".star");
    const inputAvaliacao = document.getElementById("avaliacaoInput");
    let selectedRating = 5; // Armazena a avaliação do usuário
    
    

    stars.forEach((star, index) => {
        star.addEventListener("mouseover", function () {
            highlightStars(index + 1);
        });

        star.addEventListener("mouseout", function () {
            highlightStars(selectedRating); // Retorna à avaliação salva
        });

        star.addEventListener("click", function () {
            selectedRating = index + 1;
            inputAvaliacao.value = selectedRating; // Salva a avaliação no formulário
        });
    });

    function highlightStars(value) {
        stars.forEach((star, index) => {
            star.classList.toggle("active", index < value);
        });
    }

    highlightStars(selectedRating);
});

document.getElementById("closeModalCh").addEventListener("click", () => {
    document.getElementById("modalCheck").style.opacity = "0";

    const timer = setTimeout(() => {
        document.getElementById("modalCheck").style.display = "none";
    }, 450);
});

const checkAula = (id) => {
    document.getElementById("modalCheck").style.display = "flex";
    document.getElementById("idAulaConluida").value = id;
    const timer = setTimeout(() => {
        document.getElementById("modalCheck").style.opacity = "1";
    }, 10);
};


document.getElementById("checkConfirm").addEventListener("click", () => {
    document.getElementById("modalCheck").style.opacity = "0";

    const timer = setTimeout(() => {
        document.getElementById("modalCheck").style.display = "none";
    }, 450);
});