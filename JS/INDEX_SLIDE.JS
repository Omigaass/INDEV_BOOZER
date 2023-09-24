const left = document.querySelector(".leftside_sec");
const right = document.querySelector(".rightside_sec");
const register = document.querySelector(".signup_body");
const login = document.querySelector(".signin_body");
const form = document.querySelector(".login_form_sec");
const title = document.querySelector(".leftside_title");
const subtitle = document.querySelector(".leftside_subtitle");

function slide() {
    const toggleClass = (element, className, slideClassName) => {
        element.classList.toggle(className);
        element.classList.toggle(slideClassName);
    };

    toggleClass(right, "rightside_sec", "rightside_sec_slide");
    toggleClass(left, "leftside_sec", "leftside_sec_slide");
    toggleClass(register, "signup_body", "signup_body_slide");
    toggleClass(login, "signin_body", "signin_body_slide");
    toggleClass(form, "login_form_sec", "login_form_sec_slide");
    toggleClass(title, "leftside_title", "leftside_title_slide");
    toggleClass(subtitle, "leftside_subtitle", "leftside_subtitle_slide");
}