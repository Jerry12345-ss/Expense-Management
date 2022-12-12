// Delete card
const deleteCard = (value,id) =>{
    Swal.fire({
        icon : 'warning',
        title : '你確定要刪除嗎?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: 'indianred',
        confirmButtonText: '確定',
        cancelButtonText: '取消',
    }).then((result)=>{
        if(result.isConfirmed){
            $.ajax({
                url : `../Delete_card.php?request=${value}&action=delete`,
                type : 'POST',
                data : { id : id },
                // dataType : 'json',
                success : (response)=>{
                    console.log(response);

                    if(response == "income"){
                        window.location.href = '../pages/incomes.php';
                    }else if(response == "expense"){
                        window.location.href = '../pages/expenses.php';
                    }
                },
                error : (error)=>{
                    console.log(error);
                }
            });
        }
    });
}