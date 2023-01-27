// User Log out 
const logout = (parameter) => {
    let url_path = '';
    let redirect_path = '';

    if(parameter === 0){
        url_path = './login/logout.php';
        redirect_path = './login/login.php';
    }else if(parameter === 1){
        url_path = '../login/logout.php';
        redirect_path = '../login/login.php';
    }

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
                url : url_path,
                type : 'POST',
                success : ()=>{
                    window.location.href = redirect_path;
                },
                error : (error)=>{
                    console.log(error);
                }
            });
        }
    });
}