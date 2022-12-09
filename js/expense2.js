import { Form_check , Add_record } from "./main.js";

// Bootstrap modal show
const exampleModal = document.getElementById('exampleModal');
exampleModal.addEventListener('show.bs.modal', event => {});

// Get localstorage item
let expense_list = JSON.parse(localStorage.getItem('expense_card'));

Form_check("expenses", 2, expense_list, "expense_card");

//Add_record(expense_list,"expense_card");