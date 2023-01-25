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
export function Date_setting(){
    let today = new Date();
    let dd = ("0" + (today.getDate())).slice(-2);
    let mm = ("0" + (today.getMonth() +　1)).slice(-2);
    let yyyy = today.getFullYear();
    today = `${yyyy}-${mm}-${dd}`;
    return today;
}

// Submitting new income / expense form 
export function Form_check(file_name, parameter, action, today){
    $('.content-wrapper form').submit((event)=>{
        let amount_val = document.querySelector('#amount'); 
        let description_val = document.querySelector('#description');
        let date_val = document.querySelector('#date');

        let formData = {
            amount : amount_val.value,
            description : description_val.value,
            date : date_val.value,
            // year : new Date(date_val.value).getFullYear()
        };


        if(formData.date > today){
            Swal.fire({
                icon : 'error',
                title : '輸入錯誤',
                text : '您所輸入的日期錯誤!',
                showCloseButton: true
            });
        }else{
            if(action == "insert"){
                Form_submit(formData, parameter, action);

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
            }else{
                Form_submit(formData, parameter, action);

                Swal.fire({
                    icon : 'success',
                    title : '修改成功',
                    showCloseButton: true
                }).then(()=>{
                    window.location.href = `../pages/${file_name}.php`;
                });
            }
        }

        event.preventDefault();
    })
}

// POST form data with AJAX request
const Form_submit = (formData, parameter, action) =>{
    if(action == "insert"){
        $.ajax({
            url : `../Insert_edit.php?request=${parameter}&action=${action}`,
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
    }else{
        let a = document.querySelector('.content-wrapper form');
        let id =a.id;
        
        $.ajax({
            url : `../Insert_edit.php?request=${parameter}&action=${action}&id=${id}`,
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
}