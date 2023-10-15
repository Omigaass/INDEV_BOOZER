document.addEventListener("DOMContentLoaded", () => {
    const objects = document.querySelectorAll(".object_shield, .object_image_shield, .object_info, .object_price, .object_price_symbol, .object_price_whole, .object_price_fraction, .object_description");
    const menu_grid = document.querySelector(".menu_grid");
    const menu_list = document.querySelector(".menu_list");

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