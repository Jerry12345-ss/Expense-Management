import { Form_check, Add_record, Date_setting } from "./main3.js";

// Get localstorage item
let income_list = JSON.parse(localStorage.getItem('income_card'));

let today = Date_setting();
Form_check("incomes", 1, income_list, "income_card", "update", today);

//Add_record(income_list,"income_card");




