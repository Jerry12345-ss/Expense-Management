const toogle = document.querySelector('.navbar-toggler');
const sidebar_nav = document.querySelector('.sidebar-navbar');

toogle.addEventListener('click',()=>{
    sidebar_nav.classList.toggle('toggle');
});

$('.sidebar-navbar ul li').on('click',function(event){
    $('.sidebar-navbar ul li').removeClass('active');

    $('.sidebar-navbar ul li').each(()=>{
        $(this).addClass('active')
    })

    event.preventDefault();
    return false;
})

