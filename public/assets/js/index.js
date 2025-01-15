const header = document.querySelector("header#header");

document.addEventListener("scroll", () => {
  if (window.scrollY > 75) {
    header.classList.add("header-scrolled");
  } else {
    header.classList.remove("header-scrolled");
  }
});
