document.addEventListener("DOMContentLoaded", () => {
    const menu_grid = document.querySelector(".menu_grid");
    const menu_list = document.querySelector(".menu_list");

    const prev_page = document.querySelector(".prev_page_btn");
    const current_page = document.querySelector(".current_page");
    const next_page = document.querySelector(".next_page_btn");

    const filter_btn = document.querySelector(".filter_btn");
    const filter_modal = document.querySelector(".filter_modal");
    const back_screen = document.querySelector(".back_screen");
    const modal_filter_btn = document.querySelector("#modal_filter_btn");

    const book_menu = document.querySelector(".book_menu");
    const book_menu_btn = document.querySelector("#book_menu_btn");
    const book_modal = document.querySelector(".book_modal");

    filter_btn.addEventListener("click", () => {
        filter_modal.classList.toggle("hidden");
        back_screen.classList.toggle("hidden");
    });

    modal_filter_btn.addEventListener("click", () => {
        filter_modal.classList.toggle("hidden");
        back_screen.classList.toggle("hidden");
    });

    book_menu.addEventListener("click", () => {
        book_modal.classList.toggle("hidden");
        back_screen.classList.toggle("hidden");
    });

    modal_book_btn.addEventListener("click", () => {
        book_modal.classList.toggle("hidden");
        back_screen.classList.toggle("hidden");
    });

    const objects = document.querySelectorAll(".object_shield, .object_image_shield, .object_info, .object_price, .object_price_symbol, .object_price_whole, .object_price_fraction, .object_description");

    function toggleListView() {
        objects.forEach((item) => {
            item.classList.add("list_view");
        });
    }
    function toggleGridView() {
        objects.forEach((item) => {
            item.classList.remove("list_view");
        });
    }

    menu_grid.addEventListener("click", toggleGridView);
    menu_list.addEventListener("click", toggleListView);
});