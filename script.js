const menuIcon = document.getElementById("menuIcon");
const menu = document.getElementById("menu");

menuIcon.addEventListener("mouseenter", () => {
    menu.classList.add("menu-open");
});

menu.addEventListener("mouseleave", () => {
    menu.classList.remove("menu-open");
});

menuIcon.addEventListener("mouseleave", () => {
    if (!menu.matches(':hover')) {
        menu.classList.remove("menu-open");
    }
});
