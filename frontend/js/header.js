document.addEventListener("DOMContentLoaded", () => {
  const header = document.querySelector("header");
  const searchInput = document.querySelector(".search-input");

  window.addEventListener("scroll", () => {
    if (window.scrollY > 200) {
      header.classList.add("scrolled");
      searchInput.classList.add("scrolled");
    } else {
      header.classList.remove("scrolled");
      searchInput.classList.remove("scrolled");
    }
  });

  document.addEventListener("DOMContentLoaded", () => {
    const platformBtns = document.querySelector(".platform-btn-mobile");
    if (!platformBtns) return;

    window.addEventListener("scroll", () => {
      platformBtns.classList.toggle("hidden", window.scrollY > 0);
    });
  });
});
