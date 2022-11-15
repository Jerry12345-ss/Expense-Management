const toogle = document.querySelector('.navbar-toggler');
const sidebar_nav = document.querySelector('.sidebar-navbar');

// SideBar Toggle 
toogle.addEventListener('click',()=>{
    sidebar_nav.classList.toggle('toggle');
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
export default function Form_check(file_name,parameter){
    $('.content-wrapper form').submit((event)=>{
        let amount_val = document.querySelector('#amount'); 
        let description_val = document.querySelector('#description');
        let date_val = document.querySelector('#date');

        let month = Date.getMonth()+1;

        let formData = {
            amount : amount_val.value,
            description : description_val.value,
            date : date_val.value,
        };

        if(formData.date > today){
            Swal.fire({
                icon : 'error',
                title : '輸入錯誤',
                text : '您所輸入的日期錯誤!'
            });
        }else{
            Form_submit(formData,parameter,month);
            Swal.fire({
                icon : 'success',
                title : '新增成功'
            }).then(()=>{
                console.log(month);
                // window.location.href = `../pages/${file_name}.php`
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
const Form_submit = (formData,parameter) =>{
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

