function configurarNavegacao(navbarSelector) {
    const navbar_btns = document.querySelectorAll(navbarSelector);

    navbar_btns.forEach(navbar_btn => {
        navbar_btn.addEventListener("click", () => {
        const telaId = navbar_btn.id.replace("navbar_", "");

        window.location.href = `ABRE_${telaId.toUpperCase()}.html`;
        });
    });
}