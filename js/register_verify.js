let name_input = document.querySelector('#name');
let email_input = document.querySelector('#email');
let password_input = document.querySelector('#password');
let conf_input = document.querySelector('#con_password');

let input = document.querySelectorAll('.card-body .form-control');
let submit_button = document.querySelector('.card-body .form-btn');
let error_div = document.querySelector('.messagebox');
let name_val,email_val,pass_val,con_val;

// check input condition before form submit
const input_Check = () =>{ 
    // if user not fill the input, and then show error message  
    const Check = (input) =>{
        let value = input.value;
        if(value !== ""){
            input.style.borderColor =  '#ced4da';
            input.closest('div').lastElementChild.style.display = 'none';
            return true;
         }else{
            input.style.borderColor =  'red';
            input.closest('div').lastElementChild.style.display = 'block';
            input.closest('div').lastElementChild.innerHTML = `
             <div class='error'>
                 <span>請輸入此欄位</span>
             </div>
            `;
            return false;
         }
    }

    // addEventListener bind two events method 
    ['blur','input'].forEach(evt=>{
        name_input.addEventListener(evt,()=>{
            name_val = Check(name_input);
        });
    });

    ['blur','input'].forEach(evt=>{
        email_input.addEventListener(evt,()=>{
            email_val = Check(email_input);

            // check email contains @ whether
            if(email_input.value !== ""){
                if(email_input.value.includes('@') === false){
                    email_input.style.borderColor =  'red';
                    email_input.closest('div').lastElementChild.style.display = 'block';
                    email_input.closest('div').lastElementChild.innerHTML = `
                    <div class='error'>
                        <span>請在電子郵件地址中包含「@」。「1」未包含「@」。</span>
                    </div>
                    `;
                    email_val = false;
                }else{
                    email_input.style.borderColor =  '#ced4da';
                    email_input.closest('div').lastElementChild.style.display = 'none';
                    email_val = true;
                }
            }
        });
    });
    
    ['blur','input'].forEach(evt=>{
        password_input.addEventListener(evt,()=>{
            pass_val = Check(password_input);

            // check password length grather than 8 whether
            if(password_input.value !== ""){
                if(password_input.value.length < 8){
                    password_input.style.borderColor =  'red';
                    password_input.closest('div').lastElementChild.style.display = 'block';
                    password_input.closest('div').lastElementChild.innerHTML = `
                    <div class='error'>
                        <span>密碼長度不得少於8個字元</span>
                    </div>
                    `;
                    pass_val = false;
                }else{
                    password_input.style.borderColor =  '#ced4da';
                    password_input.closest('div').lastElementChild.style.display = 'none';
                    pass_val = true;
                }
            }
        });
    });

    ['blur','input'].forEach(evt=>{
        conf_input.addEventListener(evt,()=>{
            con_val = Check(conf_input);
        });
    });
}

// if all inputs condition are 'true', button status is open, otherwise close
input.forEach(filter_input=>{
    input_Check();
    filter_input.addEventListener('keyup',()=>{
        if(name_val == true && email_val == true && pass_val == true && con_val == true){
            document.querySelector('.form-btn').disabled = false;
        }else{
            document.querySelector('.form-btn').disabled = true;
        }
    })
})

$('.card-body form').submit((event)=>{
    submit_button.innerHTML = 'Loading <span class="loader"></span>';
    submit_button.disabled = true;

    let data = {
        name : name_input.value,
        email : email_input.value,
        password : password_input.value,
        con_password : conf_input.value
    };

    $.ajax({
        url : '../login/register_process.php',
        type : 'POST',
        data : data,
        success : (response)=>{
            if(response === 'success'){
                window.location.href = '../login/verifyEmail.php?mode=registerUser';
            }else{
                submit_button.innerHTML = '註冊';
                submit_button.disabled = false;
                showErrorMessage(response);

                name_input.value = "";
                email_input.value = "";
                password_input.value = "";
                conf_input.value = "";
            }
        },
        error : (error)=>{
            console.log(error);
        }
    });

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