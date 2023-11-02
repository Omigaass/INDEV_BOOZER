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


document.querySelector(".userBasic").addEventListener("click", f_showBasic);
document.querySelector(".userAddress").addEventListener("click", f_showAddress);
document.querySelector(".userContact").addEventListener("click", f_showContact);

function f_hideAll() {
    document.querySelector(".userBasic_form").classList.remove("active");
    document.querySelector(".userAddress_form").classList.remove("active");
    document.querySelector(".userContact_form").classList.remove("active");
}

function f_activateTab(tab) {
    document.querySelector(".userBasic").classList.remove("active");
    document.querySelector(".userAddress").classList.remove("active");
    document.querySelector(".userContact").classList.remove("active");
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

//--------------------------------------------------------------------------

const userPrev = document.querySelectorAll(".userPrev");
const userNext = document.querySelectorAll(".userNext");

function navigate(button, direction) {
    // Encontrar o formulário ativo atualmente
    const currentForm = document.querySelector(".userEditForm.active");
    const currentBtn = document.querySelector(".f_nav_btn.active");

    if (direction === 'next') {
        const targetForm = currentForm.nextElementSibling;
        const targetBtn = currentBtn.nextElementSibling;
        if (targetForm) {
            // Esconder o formulário atual e mostrar o próximo
            currentForm.classList.remove("active");
            targetForm.classList.add("active");
            currentBtn.classList.remove("active");
            targetBtn.classList.add("active");
        }
    } else if (direction === 'prev') {
        const targetForm = currentForm.previousElementSibling;
        const targetBtn = currentBtn.previousElementSibling;
        if (targetForm) {
            // Esconder o formulário atual e mostrar o anterior
            currentForm.classList.remove("active");
            targetForm.classList.add("active");
            currentBtn.classList.remove("active");
            targetBtn.classList.add("active");
        }
    }
}

userPrev.forEach(button => {
    button.addEventListener("click", () => {
        navigate(button, 'prev');
    });
});

userNext.forEach(button => {
    button.addEventListener("click", () => {
        navigate(button, 'next');
    });
});
