const grid = document.querySelector(".menu_grid");
const list = document.querySelector(".menu_list");

const prev_page = document.querySelector(".prev_page_btn");
const current_page = document.querySelector(".current_page");
const next_page = document.querySelector(".next_page_btn");

const filter_btn = document.querySelector(".filter_btn");
const filter_modal = document.querySelector(".filter_modal");
const back_screen = document.querySelector(".back_screen");
const modal_filter_btn = document.querySelector("#modal_filter_btn");

filter_btn.addEventListener("click", () => {
    filter_modal.classList.toggle("hidden");
    back_screen.classList.toggle("hidden");
});

modal_filter_btn.addEventListener("click", () => {
    filter_modal.classList.toggle("hidden");
    back_screen.classList.toggle("hidden");
});