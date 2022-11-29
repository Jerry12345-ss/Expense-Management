// Navbar username list show toggle and icon exchange
const nav_username = document.querySelector('.nav-username');
const logout = document.querySelector('.username-logout');

const arrow = $('.bxs-chevron-down');

nav_username.addEventListener('click',()=>{
    logout.classList.toggle('show');

    if(arrow.hasClass('bxs-chevron-down')){
        arrow.removeClass('bxs-chevron-down').addClass('bxs-chevron-up');
    }else if(arrow.hasClass('bxs-chevron-up')){
        arrow.removeClass('bxs-chevron-up').addClass('bxs-chevron-down');
    }
});