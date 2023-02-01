let email_input = document.querySelector('#email');
let error_div = document.querySelector('.error-message');

// Forget password From ( input email )
document.querySelector('.card-body .forget_form').addEventListener('submit',(event)=>{
    let email = email_input.value;

    if(email === ''){
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
                    error_div.innerHTML = `
                        <div class='error'>
                            <p>無效的電子郵件</p>
                        </div>
                    `; 
                }else if(response === '1'){
                    error_div.innerHTML = `
                        <div class='error'>
                            <p>此電子郵件尚未註冊</p>
                        </div>
                    `; 
                }else if(response === 'success'){
                    window.location.href = '../login/verifyEmail.php'
                }else{
                    // Mail could not be sent
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
