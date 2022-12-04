import { Form_check, Add_record } from "./main2.js";

// Bootstrap modal show
const exampleModal = document.getElementById('exampleModal');
exampleModal.addEventListener('show.bs.modal', event => {});

// Get localstorage item
let income_list = JSON.parse(localStorage.getItem('income_card'));

Form_check("incomes", 1, income_list, "income_card");

//Add_record(income_list,"income_card");




