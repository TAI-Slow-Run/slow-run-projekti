// document.getElementById("hamburger").addEventListener("click", () => {
//     const menu = document.getElementById("list_menu");
//     menu.classList.toggle("active");
// });

const offScreenMenu = document.querySelector(".off-screen-menu");

document.getElementById("hamburger").addEventListener("click", () => {
    offScreenMenu.classList.toggle("active");
});