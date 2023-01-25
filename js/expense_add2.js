import { Form_check , Date_setting } from "./main2.js";

// Bootstrap modal show
const exampleModal = document.getElementById('exampleModal');
exampleModal.addEventListener('show.bs.modal', event => {});

let today = Date_setting();
$("#date").attr("value", today);

Form_check("expenses", 2, "insert", today);