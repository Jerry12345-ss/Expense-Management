$('.card-body form').submit((event)=>{
    let name_val = document.querySelector('#name');
    let email_val = document.querySelector('#email');
    let password_val = document.querySelector('#password');
    let conf_val = document.querySelector('#con_password');

    let data = {
        name : name_val.value,
        email : email_val.value,
        password : password_val.value,
        con_password : conf_val.value
    };

    $.ajax({
        url : '../login/register_process.php',
        type : 'POST',
        data : data,
        success : (response)=>{
            Handler(response);
        },
        error : (error)=>{
            console.log(error);
        }
    });
    
    event.preventDefault();
});

const Handler = (error) =>{
    const error_div = document.querySelector('.error-message');
    if(error === "註冊成功"){
        window.location.href = '../login/login.php';
    }else{
        error_div.innerHTML = `
        <div class='error'>
            <p>${error}</p>
        </div>
    `
    }
}

