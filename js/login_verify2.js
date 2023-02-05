// Login verify 先以另建 login_verify 為主, export / import modules 之後弄
let email_input = document.querySelector('#email');
let password_input = document.querySelector('#password');

let input = document.querySelectorAll('.card-body .form-control');
let email_val,pass_val;

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
        });
    });
}

// if all inputs condition are 'true', button status is open, otherwise close
input.forEach(filter_input=>{
    input_Check();
    filter_input.addEventListener('keyup',()=>{
        if(email_val == true && pass_val == true){
            document.querySelector('.form-btn').disabled = false;
        }else{
            document.querySelector('.form-btn').disabled = true;
        }
    })
})

$('.card-body form').submit((event)=>{
    let data = {
        email : email_input.value,
        password : password_input.value,
        remember : document.querySelector('form-check-input')
    };

    $.ajax({
        url : '../login/login_process.php',
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

// handling error and success after form submit
const Handler = (res) =>{
    const error_div = document.querySelector('.error-message');
    
    if(res === "登入成功"){
        window.location.href = '../index.php';
    }else{
        error_div.innerHTML = `
            <div class='error-msg msg-danger'>
                <div class='msg-icon'>
                    <i class="fa-solid fa-xmark"></i>
                </div>
                <div class='msg-content'>
                    <p>${res}</p>
                </div>
            </div>
        `;
        
        email_input.value = "";
        password_input.value = "";
    }
}

