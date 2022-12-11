import { Form_check , Add_record, Date_setting } from "./main3.js";

// Bootstrap modal show
const exampleModal = document.getElementById('exampleModal');
exampleModal.addEventListener('show.bs.modal', event => {});

// Get localstorage item
let expense_list = JSON.parse(localStorage.getItem('expense_card'));

let today = Date_setting();
$("#date").attr("value", today);

Form_check("expenses", 2, expense_list, "expense_card","insert",today);

//Add_record(expense_list,"expense_card");