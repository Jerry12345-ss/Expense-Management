let email_input = document.querySelector('#email');
let error_div = document.querySelector('.messagebox');
let submit_button = document.querySelector('.card-body .form-btn');

// Forget password From ( input email )
document.querySelector('.card-body .forget_form').addEventListener('submit',(event)=>{
    submit_button.innerHTML = 'Loading <span class="loader"></span>';
    submit_button.disabled = true;

    let email = email_input.value;

    if(email === ''){
        submit_button.innerHTML = '傳送驗證碼';
        submit_button.disabled = false;
        showErrorMessage('請輸入您的電子郵件');
    }else{
        $.ajax({
            url : '../login/forget_process.php',
            type : 'POST',
            data : { email : email },
            success : (response)=>{
                if(response === 'success'){
                    window.location.href = '../login/verifyEmail.php?mode=forgetPassword';
                }else{
                    submit_button.innerHTML = '傳送驗證碼';
                    submit_button.disabled = false;
                    showErrorMessage(response);
                    email_input.value = "";
                }
            },
            error : (error)=>{
                console.log(error);
            }
        })
    }

    function showErrorMessage(errormessage){
        error_div.innerHTML = `
            <div class='msg msg-danger'>
                <div class='msg-icon'>
                    <i class="fa-solid fa-xmark"></i>
                </div>
                <div class='msg-content'>
                    <p>${errormessage}</p>
                </div>
            </div>
        `;
    }

    event.preventDefault();
});