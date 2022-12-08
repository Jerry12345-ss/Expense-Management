const toogle = document.querySelector('.navbar-toggler');
const sidebar_nav = document.querySelector('.sidebar-navbar');
const content_wrapper = document.querySelector('.content-wrapper');

// SideBar Toggle 
toogle.addEventListener('click',()=>{
    sidebar_nav.classList.toggle('toggle');
    content_wrapper.classList.toggle('toggle');
});

// 如果無跳頁，toggle class 功能正常；反之有跳頁則不會運行 toggle class => 解法 : 在每個 page 初始值加上相對應的 active
$('.sidebar-navbar ul li').on('click',function(){
    $('.sidebar-navbar ul li').removeClass('active');

    $('.sidebar-navbar ul li').each(()=>{
        $(this).addClass('active')
    })
});

// Input date default today 
let today = new Date();
let dd = ("0" + (today.getDate())).slice(-2);
let mm = ("0" + (today.getMonth() +　1)).slice(-2);
let yyyy = today.getFullYear();
today = `${yyyy}-${mm}-${dd}`;
$("#date").attr("value", today);

// Submitting new income / expense form 
export function Form_check(file_name, parameter, list, list_name){
    $('.content-wrapper form').submit((event)=>{
        let amount_val = document.querySelector('#amount'); 
        let description_val = document.querySelector('#description');
        let date_val = document.querySelector('#date');

        let formData = {
            amount : amount_val.value,
            description : description_val.value,
            date : date_val.value,
        };

        if(formData.date > today){
            Swal.fire({
                icon : 'error',
                title : '輸入錯誤',
                text : '您所輸入的日期錯誤!',
                showCloseButton: true
            });
        }else{
            Form_submit(formData, parameter);

            if(!list){   // if list isn't exist, pass an empty to list
                list = [];
            }
            list.push(formData);   // add new income or expense record to List
            localStorage.setItem(`${list_name}`,JSON.stringify(list));    // store key/value in localstorage and transform data into JSON string

            Swal.fire({
                icon : 'success',
                title : '新增成功',
                showCloseButton: true
            }).then(()=>{
                window.location.href = `../pages/${file_name}.php`;
            });
            $('#exampleModal').modal('hide');

            amount_val.value = "";
            description_val.value = "";
            date_val.value = today;
        }

        event.preventDefault();
    })
}

// POST form data with AJAX request
const Form_submit = (formData, parameter) =>{
    $.ajax({
        url : `../Add_record.php?request=${parameter}`,
        type : 'POST',
        data : formData,
        dataType : 'json',
        success : (response)=>{
            console.log(response);
        },
        error : (error)=>{
            console.log(error);
        }
    })
}

// Show income / expense record
export function Add_record(list, list_name){
    let list_content = document.querySelector(`.record-content .row`);
    let li = "";

    if(list){
       list.forEach((value, id)=>{
        li += `
            <div class='col-sm-6 col-lg-4 mb-3'>
                <div class='card' id=${list_name}>
                    <div class='card-date card-header d-flex justify-content-between align-items-center'>
                        <div class='card-date'>${value.date}</div>
                        <div class='btn-group'>
                           <div class='edit-card card-btn'>
                               <a href='#'>+</a>
                           </div>
                           <div class='delete-card card-btn'>
                               <a href='#'>-</a>
                           </div> 
                        </div>
                    </div>
                    <div class='card-body d-flex justify-content-between'>
                        <div class='card-description'>${value.description}</div>
                        <div calss='card-amount' style='font-weight:600'>$ ${value.amount}</div>
                    </div>
                </div>
            </div>
        `
       })
    }

    list_content.innerHTML = li;
}