const open_menu = document.querySelector(".open_menu_btn");
const menu = document.querySelector(".menu_sec");
const visual_buttons = document.querySelector(".visual_buttons");
const pagination_buttons = document.querySelector(".pagination_buttons");
const filter_button = document.querySelector(".filter_button");

open_menu.addEventListener("click", () => {
    if (menu.classList.contains("menu_sec_open")) {
        menu.classList.remove("menu_sec_open");
        open_menu.style.transform = "rotateZ(0deg)";
        open_menu.style.backgroundColor = "var(--azul-quente)";
        visual_buttons.style.backgroundColor = "var(--azul-quente-light)";
        pagination_buttons.style.backgroundColor = "var(--azul-quente-light)";
        filter_button.style.backgroundColor = "var(--azul-quente-light)";
    } else {
        menu.classList.add("menu_sec_open");
        open_menu.style.transform = "rotateZ(180deg)";
        open_menu.style.backgroundColor = "var(--azul-morno)";
        visual_buttons.style.backgroundColor = "var(--azul-morno-light)";
        pagination_buttons.style.backgroundColor = "var(--azul-morno-light)";
        filter_button.style.backgroundColor = "var(--azul-morno-light)";
    }
});