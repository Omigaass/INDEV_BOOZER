function configurarNavegacao(navbarSelector) {
    const navbar_btns = document.querySelectorAll(navbarSelector);

    navbar_btns.forEach(navbar_btn => {
        navbar_btn.addEventListener("click", () => {
        const telaId = navbar_btn.id.replace("navbar_", "");

        window.location.href = `ABRE_${telaId.toUpperCase()}.html`;
        });
    });
}

function configurarMenu(menuSelector) {
    const card_btns = document.querySelectorAll(menuSelector);

    card_btns.forEach(card_btn => {
        card_btn.addEventListener("click", () => {
        const telaId = card_btn.id.replace("card_", "");

        window.location.href = `ABRE_${telaId.toUpperCase()}.html`;
        });
    });
}