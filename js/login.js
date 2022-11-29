// Navbar hamburger
const nav_hamburger = document.querySelector('.nav-hamburger');
const navbar = document.querySelector('.nav-list');

nav_hamburger.addEventListener('click',()=>{
    navbar.classList.toggle('active');
});