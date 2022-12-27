// Calculate show
const calculate_button = document.querySelector('.calculate-button');
const calculate = document.querySelector('.calculate-content');

const toggleCalculate = () =>{
    calculate.classList.toggle('show');
}

calculate_button.addEventListener('click', toggleCalculate);

window.addEventListener('click', (event)=>{
    if(event.target == calculate){
        toggleCalculate();
    }
});

// Calculate 
const allNumber = document.querySelectorAll('.number');
const allOperator = document.querySelectorAll('.operator');
const equal = document.getElementById('equal');
const clearAll = document.getElementById('clearAll');
const clear = document.getElementById('clear');
const currentNumberEl = document.querySelector('.current-operand');

let numberCurrent = '';
let numberTotal = '';
let notCalculating = false;
let isEqualClicked = false;
let isDecimalAdded = false;

let isOperatorClickedFirst = false;
let isOperatorAdded = false;
let tempResult = null;
let lastOperator = null;

// Display the input Number
function displayInput(){
    notCalculating = true;
    if(isEqualClicked && notCalculating){
        //clearAll();
        isEqualClicked = false;
        notCalculating = false;
    }

    let currentNumber = this.dataset.value;
    console.log(currentNumber);
    if(currentNumber === '.' && !isDecimalAdded){
        isDecimalAdded = true;
    }else if(currentNumber === "." && isDecimalAdded){
        return;
    }

    numberCurrent += currentNumber;
    currentNumberEl.innerHTML = numberCurrent;
    // isOperatorAdded = true;
    // isOperatorClickedFirst = false;
}

// Add Operator 
function addOperator(){
    if(!isOperatorClickedFirst){
        return;
    }
    let currentOperatorDisplay = this.innerHTML;
    let currentOperator = this.dataset.value;

    if(!isOperatorAdded){
        isOperatorAdded = true;
        isDecimalAdded = false;
        notCalculating = false;
        isEqualClicked = false;

        if(!numberTotal){
            tempResult;
        }
        if(numberCurrent && numberTotal && tempResult){
            calculateTotal();
        }else{
            if(tempResult){
                tempResult = tempResult;
            }else{
                tempResult = numberCurrent;
            }
        }
        clearInput(currentOperatorDisplay, false);
        lastOperator = currentOperator;
    }else if(isDecimalAdded){
        clearInput(currentOperatorDisplay, true);
        lastOperator = currentOperator;
    }
    updateTempResult();
}

// Number Event Listener 
allNumber.forEach((number)=>{
    number.addEventListener('click', displayInput);
});

// Operator Event Listener
allOperator.forEach((operator)=>{
    operator.addEventListener('click', addOperator);
});

// Equal Event Listener
equal.addEventListener('click',()=>{
    console.log(3);
});

// Clear All Event Listener
clearAll.addEventListener('click',()=>{
    console.log(4);
});

// Clear last Event Listener
clear.addEventListener('click',()=>{
    console.log(5);
});

// KeyBoard Events
window.addEventListener('keydown',(e)=>{
    if(
        e.key == 1 ||
        e.key == 2 ||
        e.key == 3 ||
        e.key == 4 ||
        e.key == 5 ||
        e.key == 6 ||
        e.key == 7 ||
        e.key == 8 ||
        e.key == 9 ||
        e.key == 0 ||
        e.key == '.'
    ){
        clickBtn(e.key);
    }else if(
        e.key == '+' ||
        e.key == '-' ||
        e.key == '*' ||
        e.key == '/' 
    ){
        operationBtn(e.key);
    }else if(e.key === 'Enter' || e.key === '='){
        return finalResult();
    }else if(e.key === 'Backspace'){
        clearLast();
    }
});

const clickBtn = (key) =>{
    allNumber.forEach((button)=>{
        if(button.dataset.value == key){
            // 未知 button.click()寫法
            button.click();
        }
    });
}

const operationBtn = (key) =>{
    allOperator.forEach((button)=>{
        if(button.dataset.value == key){
            // 未知 button.click()寫法
            button.click();
        }
    })
}