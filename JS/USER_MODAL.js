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

const userDelete = document.querySelectorAll(".user_delete");
const userDelete_modal = document.querySelector(".userDelete_modal");
const userDelete_close = document.querySelector(".m_userDelete_close");
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

userDelete.forEach(button => {
    button.addEventListener("click", () => {
        userDelete_modal.classList.toggle("hidden");
        back_screen.classList.toggle("hidden");
    });
});

userDelete_close.addEventListener("click", () => {
    userDelete_modal.classList.toggle("hidden");
    back_screen.classList.toggle("hidden");
});

document.querySelector(".userBasic").addEventListener("click", f_showBasic);
document.querySelector(".userAddress").addEventListener("click", f_showAddress);
document.querySelector(".userContact").addEventListener("click", f_showContact);
document.querySelector(".userConfirmChange").addEventListener("click", f_showConfirm);

function f_hideAll() {
    document.querySelector(".userBasic_form").classList.remove("active");
    document.querySelector(".userAddress_form").classList.remove("active");
    document.querySelector(".userContact_form").classList.remove("active");
    document.querySelector(".userConfirmChange_form").classList.remove("active");
}

function f_activateTab(tab) {
    document.querySelector(".userBasic").classList.remove("active");
    document.querySelector(".userAddress").classList.remove("active");
    document.querySelector(".userContact").classList.remove("active");
    document.querySelector(".userConfirmChange").classList.remove("active");
    tab.classList.add("active");
}

function f_showBasic() {
    f_hideAll();
    f_activateTab(document.querySelector(".userBasic"));
    document.querySelector(".userBasic_form").classList.add("active");
}

function f_showAddress() {
    f_hideAll();
    f_activateTab(document.querySelector(".userAddress"));
    document.querySelector(".userAddress_form").classList.add("active");
}

function f_showContact() {
    f_hideAll();
    f_activateTab(document.querySelector(".userContact"));
    document.querySelector(".userContact_form").classList.add("active");
}

function f_showConfirm() {
    f_hideAll();
    f_activateTab(document.querySelector(".userConfirmChange"));
    document.querySelector(".userConfirmChange_form").classList.add("active");
}

