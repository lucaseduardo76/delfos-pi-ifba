document.addEventListener("DOMContentLoaded", function () {
    const emailItems = document.querySelectorAll(".email-item");

    emailItems.forEach((item) => {
        item.addEventListener("click", function () {
            const emailId = item.getAttribute("data-email-id");
            const emailToShow = document.getElementById(emailId);

            if (emailToShow) {
                const isHidden = emailToShow.classList.contains("hidden");

                // Esconde todos os emails antes de abrir o correto
                document.querySelectorAll(".email-content").forEach((email) => {
                    email.classList.add("hidden");
                    email.style.display = "none";
                });

                // Se estava escondido, agora mostra
                if (isHidden) {
                    emailToShow.classList.remove("hidden");
                    emailToShow.style.display = "flex";
                }
            }
        });
    });
});