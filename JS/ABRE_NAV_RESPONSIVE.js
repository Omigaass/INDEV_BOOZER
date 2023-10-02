
document.addEventListener("DOMContentLoaded", () => {
    const navBtn = document.querySelector('.navbar_button');
    const navBody = document.querySelector('.navbar_body');
    const navItems = document.querySelectorAll('.navbar_item');

    if (navBtn && navItems.length > 0) {
        navBtn.addEventListener("click", () => {
            navBody.classList.toggle("navbar_body_active");
            navBtn.classList.toggle("navbar_button_active");
            navItems.forEach(navItem => {
                navItem.classList.toggle("navbar_item_active");
            });
        });
    }
});