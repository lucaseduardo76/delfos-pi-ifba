document.addEventListener("DOMContentLoaded", function () {
    const slider = document.querySelector(".slider");
    const prevBtn = document.querySelector(".slider-btn.prev");
    const nextBtn = document.querySelector(".slider-btn.next");

    let currentIndex = 0;
    const itemWidth = document.querySelector(".slider-item").offsetWidth + 20; // Largura + gap
    const totalItems = document.querySelectorAll(".slider-item").length;
    const visibleItems = Math.floor(document.querySelector(".slider-container").offsetWidth / itemWidth);
    const maxIndex = Math.max(0, totalItems - visibleItems); // Evita valores negativos

    function updateSliderPosition() {
        slider.style.transform = `translateX(${-currentIndex * itemWidth}px)`;
        updateButtons();
    }

    function updateButtons() {
        prevBtn.disabled = currentIndex === 0;
        nextBtn.disabled = currentIndex >= maxIndex;
    }

    nextBtn.addEventListener("click", () => {
        if (currentIndex < maxIndex) {
            currentIndex++;
            updateSliderPosition();
        }
    });

    prevBtn.addEventListener("click", () => {
        if (currentIndex > 0) {
            currentIndex--;
            updateSliderPosition();
        }
    });

    // Inicializa os botões no estado correto
    updateButtons();
});



document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".slider-container").forEach((sliderContainer) => {
        const slider = sliderContainer.querySelector(".slider");
        const prevBtn = sliderContainer.querySelector(".slider-btn.prev");
        const nextBtn = sliderContainer.querySelector(".slider-btn.next");

        let currentIndex = 0;
        const itemWidth = sliderContainer.querySelector(".slider-item").offsetWidth + 20; // Largura do item + gap
        const visibleItems = Math.floor(sliderContainer.offsetWidth / itemWidth);
        const totalItems = slider.querySelectorAll(".slider-item").length;
        const maxIndex = totalItems - visibleItems; // Considera os itens visíveis na tela

        function updateSliderPosition() {
            slider.style.transform = `translateX(${-currentIndex * itemWidth}px)`;
        }

        nextBtn.addEventListener("click", () => {
            if (currentIndex < maxIndex) {
                currentIndex++;
                updateSliderPosition();
            }
        });

        prevBtn.addEventListener("click", () => {
            if (currentIndex > 0) {
                currentIndex--;
                updateSliderPosition();
            }
        });
    });
});
