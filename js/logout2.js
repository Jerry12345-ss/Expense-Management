// Navbar username list show toggle and icon exchange
// const nav_username = document.querySelector('.nav-username');
// const logout = document.querySelector('.username-logout');

// const arrow = $('.bxs-chevron-down');

// nav_username.addEventListener('click',()=>{
//     logout.classList.toggle('show');

//     if(arrow.hasClass('bxs-chevron-down')){
//         arrow.removeClass('bxs-chevron-down').addClass('bxs-chevron-up');
//     }else if(arrow.hasClass('bxs-chevron-up')){
//         arrow.removeClass('bxs-chevron-up').addClass('bxs-chevron-down');
//     }
// });

// User Log out 
const log_out = document.querySelector('.bx-log-out');

log_out.addEventListener('click',()=>{
    Swal.fire({
        icon : 'question',
        title : '您確定要登出嗎 ?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: 'indianred',
        confirmButtonText: '確定',
        cancelButtonText: '取消',
    }).then((result) => {
        if(result.isConfirmed){
            $.ajax({
                url : `../login/logout.php`,
                type : 'POST',
                success : ()=>{
                    window.location.href = '../login/login.php'
                },
                error : (error)=>{
                    console.log(error);
                }
            });
        }
    });
});