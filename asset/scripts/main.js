let nav_bar = document.querySelector("header nav");
let harm_btn = document.querySelector(".harm");
let cover_bg = document.querySelector(".cover-bg");
let nav_list = document.querySelectorAll(".nav-list a");
let cancel_btn = document.querySelector(".cancel");

// for nav

harm_btn.addEventListener("click", () => {
  nav_bar.classList.toggle("active");
  cover_bg.classList.toggle("active");
  harm_btn.classList.toggle("active");
});

cover_bg.addEventListener("click", () => {
  cover_bg.classList.remove("active");
  nav_bar.classList.remove("active");
  harm_btn.classList.remove("active");
});

nav_list.forEach((nav_li) => {
  nav_li.addEventListener("click", () => {
    cover_bg.classList.remove("active");
    nav_bar.classList.remove("active");
    harm_btn.classList.remove("active");
  });
});

