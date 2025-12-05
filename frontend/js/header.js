document.addEventListener('DOMContentLoaded', () => {
    const header = document.querySelector('header');
    const searchInput = document.querySelector('.search-input');


    window.addEventListener('scroll', () => {
        if (window.scrollY > 100) {
            header.classList.add('scrolled');
            searchInput.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
            searchInput.classList.remove('scrolled');
        }
    });
});
