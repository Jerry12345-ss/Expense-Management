// Calculate show
const calculate_button = document.querySelector('main .calculate-button');
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
class Calculator{
    constructor(previousOperandText, currentOperandText){
        this.previousOperandText = previousOperandText;
        this.currentOperandText = currentOperandText;
        this.clearAll();
    }

    // Clear all
    clearAll(){
        this.currentOperand = '';
        this.previousOperand = '';
        this.operation = undefined;
        this.isCompute = false;
    }

    // Clear 
    claer(){
        this.currentOperand = this.currentOperand.toString().slice(0, -1);
        console.log(`New currentOperand : ${this.currentOperand}`);
    }

    // Add number
    appendNumber(number){
        if(this.isCompute == true && this.previousOperand == ''){
            this.currentOperand = '';
            this.isCompute = false;
        }
        if(number === '.' && this.currentOperand.includes('.')){
            return '';
        }
        
        if(this.currentOperand.length === 15){
            this.currentOperand = this.currentOperand.toString();
            alert('無法輸入超過15位數!')
        }else{
            this.currentOperand = this.currentOperand.toString() + number.toString();
        }
        console.log(`currentOperand : ${this.currentOperand}`);
    }

    // Add operatinon
    chooseOperation(operation){
        if(this.currentOperand === ''){
            return;
        }
        if(this.previousOperand !== ''){
            this.compute();
        }
        this.operation = operation;
        this.previousOperand = this.currentOperand;
        this.currentOperand = '';
        console.log(`operation : ${this.operation}`);
        console.log(`previousOperand : ${this.previousOperand}`);
    }

    // Compute
    compute(){
        let result;
        let prev = parseFloat(this.previousOperand);
        let current = parseFloat(this.currentOperand);
        if(isNaN(prev) || isNaN(current)){
            return;
        }

        switch(this.operation){
            case '+':
                result = prev + current;
                break;
            case '-':
                result = prev - current;
                break;
            case 'x':
                result = prev * current;
                break;
            case '÷':
                result = prev / current;
                break;
            default:
                return; 
        }

        this.currentOperand = result;
        this.operation = undefined;
        this.previousOperand = '';
        this.isCompute = true;
        console.log(`result : ${result}`);
    }

    // Get display number ( integer / decima )
    getDisplayNumber(number){
        let stringNumber = number.toString();
        let integerDigits = parseFloat(stringNumber.split('.')[0]);
        let decimaDigits = stringNumber.split('.')[1];
        let integerDisplay;

        if(isNaN(integerDigits)){
            integerDisplay = '';
        }else{
            integerDisplay = integerDigits.toLocaleString('en', { maximumFractionDigits : 0 });
        }

        if(decimaDigits != null){
            return `${integerDisplay}.${decimaDigits}`;
        }else{
            return integerDisplay;
        }
    }
    
    // Update display input  
    updateDisplay(){
        this.currentOperandText.innerText = this.getDisplayNumber(this.currentOperand);
        if (this.operation != null) {
            this.previousOperandText.innerText = `${this.getDisplayNumber(this.previousOperand)} ${this.operation}`;
        } else {
            this.previousOperandText.innerText = '';
        }
    
        if(this.currentOperand.length > 13 && this.currentOperand.length <= 15){
            this.currentOperandText.style.fontSize = '1.9rem';
            this.currentOperandText.style.transition = 'all 0.3s'
        }else{
            this.currentOperandText.style.fontSize = '2.3rem';
            this.currentOperandText.style.transition = 'all 0.3s'
        }
    }
}

const numberBtn = document.querySelectorAll('.number');
const operationBtn = document.querySelectorAll('.operator');
const equalBtn = document.getElementById('equal');
const clearBtn = document.getElementById('clear');
const clearAllBtn = document.getElementById('clearAll');
const previousOperandText = document.querySelector('[data-previous-operand]');
const currentOperandText = document.querySelector('[data-current-operand]');

// Create objects 
const calculator = new Calculator(previousOperandText, currentOperandText);

// Number event listener
numberBtn.forEach(button => {
    button.addEventListener('click', ()=>{
        calculator.appendNumber(button.innerText);
        calculator.updateDisplay();
    })
});

// Operation event listener
operationBtn.forEach(button => {
    button.addEventListener('click', ()=>{
        calculator.chooseOperation(button.innerText);
        calculator.updateDisplay();
    })
});

// Equal event listener
equalBtn.addEventListener('click', ()=>{
    calculator.compute();
    calculator.updateDisplay();
});

// Clear event listener
clearBtn.addEventListener('click', ()=>{
    calculator.claer();
    calculator.updateDisplay();
});

// Clear all  event listener
clearAllBtn.addEventListener('click', ()=>{
    calculator.clearAll();
    calculator.updateDisplay();
});

// KeyBoard events
window.addEventListener('keydown', (e)=>{
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
        calculator.appendNumber(e.key);
        calculator.updateDisplay();
    }else if(
        e.key == '+' ||
        e.key == '-' ||
        e.key == '*' ||
        e.key == '/'
    ){
        let key_operation = e.key;
        if(e.key == '/'){
            key_operation = '÷';
        }else if(e.key == '*'){
            key_operation = 'x';
        }

        calculator.chooseOperation(key_operation);
        calculator.updateDisplay();
    }else if(e.key === 'Enter' || e.key === '='){
        calculator.compute();
        calculator.updateDisplay();
    }else if(e.key === 'Backspace'){
        calculator.claer();
        calculator.updateDisplay();
    }
})