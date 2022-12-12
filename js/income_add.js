import { Form_check, Date_setting } from "./main5.js";

// Bootstrap modal show
const exampleModal = document.getElementById('exampleModal');
exampleModal.addEventListener('show.bs.modal', event => {});

let today = Date_setting();
$("#date").attr("value", today);

Form_check("incomes", 1, "insert", today);