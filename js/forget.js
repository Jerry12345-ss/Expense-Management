let email_input = document.querySelector('#email');
let error_div = document.querySelector('.error-message');

document.querySelector('.card-body form').addEventListener('submit',(event)=>{
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
                }else{
                    console.log(response);
                }
            },
            error : (error)=>{
                console.log(error);
            }
        })
    }

    event.preventDefault();
})