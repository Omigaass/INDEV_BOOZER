const open_menu = document.querySelector("#open_menu_btn");
const menu = document.querySelector(".menu_sec");

open_menu.addEventListener("click", () => {
    if (menu.classList.contains("menu_sec_open")) {
        menu.classList.remove("menu_sec_open");
        open_menu.style.transform = "rotateZ(0deg)";
    } else {
        menu.classList.add("menu_sec_open");
        open_menu.style.transform = "rotateZ(180deg)";
    }
});