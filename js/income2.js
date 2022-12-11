import { Form_check, Add_record, Date_setting } from "./main3.js";

// Bootstrap modal show
const exampleModal = document.getElementById('exampleModal');
exampleModal.addEventListener('show.bs.modal', event => {});

// Get localstorage item
let income_list = JSON.parse(localStorage.getItem('income_card'));

let today = Date_setting();
$("#date").attr("value", today);

Form_check("incomes", 1, income_list, "income_card", "insert",today);

//Add_record(income_list,"income_card");




