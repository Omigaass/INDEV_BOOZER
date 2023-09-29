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
        visual_buttons.style.opacity = "0";
        pagination_buttons.style.backgroundColor = "var(--azul-quente-light)";
        pagination_buttons.style.opacity = "0";
        filter_button.style.backgroundColor = "var(--azul-quente-light)";
        filter_button.style.opacity = "0";
    } else {
        menu.classList.add("menu_sec_open");
        open_menu.style.transform = "rotateZ(180deg)";
        open_menu.style.backgroundColor = "var(--azul-morno)";
        visual_buttons.style.backgroundColor = "var(--azul-morno-light)";
        visual_buttons.style.opacity = "1";
        pagination_buttons.style.backgroundColor = "var(--azul-morno-light)";
        pagination_buttons.style.opacity = "1";
        filter_button.style.backgroundColor = "var(--azul-morno-light)";
        filter_button.style.opacity = "1";
    }
});


const slider = document.querySelector(".alternate_visual_btn");
const visualSlider = document.querySelector(".visual_slider");
const grid = document.querySelector("#slider_grid");
const list = document.querySelector("#slider_list");


slider.addEventListener("click", () => {
  visualSlider.classList.toggle("slide");

  if (list.classList.contains("hidden")) {
      grid.classList.add("hidden");
      list.classList.remove("hidden");
  } else {
      list.classList.add("hidden");
      grid.classList.remove("hidden");
    }
  });


