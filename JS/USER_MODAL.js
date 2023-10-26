const back_screen = document.querySelector(".back_screen");

const userInsert = document.querySelector(".user_create");
const userInsert_modal = document.querySelector(".userInsert_modal");
const userInsert_close = document.querySelector(".m_userInsert_close");

const userView = document.querySelectorAll(".user_view");
const userView_modal = document.querySelector(".userView_modal");
const userView_close = document.querySelector(".m_userView_close");

const userBuy = document.querySelectorAll(".user_buy");
const userBuy_modal = document.querySelector(".userBuy_modal");
const userBuy_close = document.querySelector(".m_userBuy_close");

userView.forEach(button => {
    button.addEventListener("click", function() {
        const parentElementID = this.parentElement.id;
        // Faça o que você precisa com o parentElementID
        // Por exemplo, console.log(parentElementID);
        
        // Aqui, "this" se refere ao botão que foi clicado.
    });
});

userBuy.forEach(button => {
    button.addEventListener("click", function() {
        const parentElementID = this.parentElement.id;
        // Faça o que você precisa com o parentElementID
        // Por exemplo, console.log(parentElementID);
        
        // Aqui, "this" se refere ao botão que foi clicado.
    });
});

userInsert.addEventListener("click", () => {
    userInsert_modal.classList.toggle("hidden");
    back_screen.classList.toggle("hidden");
});

userInsert_close.addEventListener("click", () => {
    userInsert_modal.classList.toggle("hidden");
    back_screen.classList.toggle("hidden");
});

userView.forEach(button => {
    button.addEventListener("click", () => {
        userView_modal.classList.toggle("hidden");
        back_screen.classList.toggle("hidden");
    });
});

userView_close.addEventListener("click", () => {
    userView_modal.classList.toggle("hidden");
    back_screen.classList.toggle("hidden");
});

userBuy.forEach(button => {
    button.addEventListener("click", () => {
        userBuy_modal.classList.toggle("hidden");
        back_screen.classList.toggle("hidden");
    });
});

userBuy_close.addEventListener("click", () => {
    userBuy_modal.classList.toggle("hidden");
    back_screen.classList.toggle("hidden");
});
