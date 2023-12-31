document.addEventListener("DOMContentLoaded", () => {
    const grid_view = document.querySelector(".grid_view");
    const list_view = document.querySelector(".list_view");

    const back_screen = document.querySelector(".back_screen");

    const filter_menu_btn = document.querySelector(".filter_menu_btn");
    const filter_modal = document.querySelector(".filter_modal");
    const modal_filter_btn = document.querySelector(".m_filter_close");

    filter_menu_btn.addEventListener("click", () => {
        filter_modal.classList.toggle("hidden");
        back_screen.classList.toggle("hidden");
    });

    modal_filter_btn.addEventListener("click", () => {
        filter_modal.classList.toggle("hidden");
        back_screen.classList.toggle("hidden");
    });

    const objects = document.querySelectorAll(".p_start, .p_img_div, .p_info_div, .p_info_price, .p_info_price_discount, .p_symble, .p_price, .p_info_text, .p_title, .p_autor, .p_date, .p_line, .p_menu, .p_btn");

    function toggleListView() {
        objects.forEach((item) => {
            item.classList.add("list_view");
        });
        grid_view.classList.remove("m_active");
        list_view.classList.add("m_active");
    }
    function toggleGridView() {
        objects.forEach((item) => {
            item.classList.remove("list_view");
        });
        grid_view.classList.add("m_active");
        list_view.classList.remove("m_active");
    }

    grid_view.addEventListener("click", toggleGridView);
    list_view.addEventListener("click", toggleListView);

});
