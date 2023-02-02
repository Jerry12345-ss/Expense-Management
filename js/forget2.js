let email_input = document.querySelector('#email');
let error_div = document.querySelector('.error-message');
let submit_button = document.querySelector('.card-body .form-btn');

// Forget password From ( input email )
document.querySelector('.card-body .forget_form').addEventListener('submit',(event)=>{
    submit_button.innerHTML = 'Loading <span class="loader"></span>';
    submit_button.disabled = true;

    let email = email_input.value;

    if(email === ''){
        submit_button.innerHTML = '傳送驗證碼';
        submit_button.disabled = false;
        error_div.innerHTML = `
            <div class='error'>
                <p>請輸入您的電子郵件</p>
            </div>
        `;
    }else{
        $.ajax({
            url : '../login/forget_process.php',
            type : 'POST',
            data : { email : email },
            success : (response)=>{
                if(response === '0'){
                    submit_button.innerHTML = '傳送驗證碼';
                    submit_button.disabled = false;
                    error_div.innerHTML = `
                        <div class='error'>
                            <p>無效的電子郵件</p>
                        </div>
                    `; 
                }else if(response === '1'){
                    submit_button.innerHTML = '傳送驗證碼';
                    submit_button.disabled = false;
                    error_div.innerHTML = `
                        <div class='error'>
                            <p>此電子郵件尚未註冊</p>
                        </div>
                    `; 
                }else if(response === 'success'){
                    window.location.href = '../login/verifyEmail.php'
                }else{
                    // Mail could not be sent
                    submit_button.innerHTML = '傳送驗證碼';
                    submit_button.disabled = false;
                    console.log(response);
                }
            },
            error : (error)=>{
                console.log(error);
            }
        })
    }

    event.preventDefault();
});