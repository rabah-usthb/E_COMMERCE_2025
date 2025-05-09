import * as form from './form.js';

const passwordError = document.getElementById('passError');
const passwordLabel = passwordError.querySelector('span');

const confirmError = document.getElementById('confError');
const confirmLabel = confirmError.querySelector('span');

const nameError = document.getElementById('nameError');
const nameLabel = nameError.querySelector('span');

const emailError = document.getElementById('emailError');
const emailLabel = emailError.querySelector('span');

const passwordField   = document.getElementById('register-pass');
const confirmField   = document.getElementById('register-conf');
const nameField  = document.getElementById('register-name');
const emailField  = document.getElementById('register-email');

const passwordIcon = document.getElementById('see_icon');
const ConfirmIcon = document.getElementById('see_icon_conf');

const formSign = document.getElementById('form'); 


function togglePasswordSign() {
    form.togglePassword(passwordField,passwordIcon);
}

function toggleConfirmSign() {
    form.togglePassword(confirmField,ConfirmIcon);
}

function validateEmailSign() {
    return form.validateEmailAlone(emailField);
}

function validateNameSign() {
    return form.validateUserNameAlone(nameField);
}

function validatePasswordSign() {
    return form.validatePassword(passwordField);
}


function validateConfirmSign() {
    return form.validateConfirmPassword(confirmField,passwordField);
}

function sendPost() {
    
    const email = emailField.value.replace(/\s/g, '');
    const username = nameField.value;
    const password = passwordField.value;

    console.log(email,' ',username,' ',password);

    fetch('signCheck.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({
          action:   'check',   
          username: username,
          email:    email,
          password: password
        })
      })
      .then(res => res.json())  
      .then(data => {            
       updateError(data);
     
      });
}


function updateError(data) {
    if(data.name_error!==''){
       nameLabel.textContent = data.name_error;
       visibleNameErrorSign();
    }

    if(data.email_error!==''){
        emailLabel.textContent = data.email_error;
        visibleEmailErrorSign();
    }
}

function clearAllSign() {
    clearConfirmErrorSign();
    clearPasswordErrorSign();
    clearNameErrorSign();
    clearEmailErrorSign();
}

function visiblePasswordErrorSign() {
    form.visibleError(passwordError,passwordField);
}

function visibleConfirmErrorSign() {
    form.visibleError(confirmError,confirmField);
}

function visibleEmailErrorSign() {
    form.visibleError(emailError,emailField);
}
function visibleNameErrorSign() {
    form.visibleError(nameError,nameField);
}

function clearPasswordErrorSign() {
    form.clearError(passwordError,passwordField);
}

function clearConfirmErrorSign() {
    form.clearError(confirmError,confirmField);
}

function clearNameErrorSign() {
    form.clearError(nameError,nameField);
}

function clearEmailErrorSign() {
    form.clearError(emailError,emailField);
}


function blurPasswordSign() {
    const error = validatePasswordSign();
    if(error!=null) {
        passwordLabel.textContent = error;
        visiblePasswordErrorSign();
        return true;
    }
    return false;
}

function blurConfirmSign() {
    const error = validateConfirmSign();
    if(error!=null) {
        confirmLabel.textContent = error;
        visibleConfirmErrorSign();
        return true;
    }
    return false;
}

function blurEmailSign() {
    const error = validateEmailSign();
    if(error!=null) {
        emailLabel.textContent = error;
        visibleEmailErrorSign();
        return true;
    }
    return false;
}

function blurNameSign() {
    const error = validateNameSign();
    if(error!=null) {
        nameLabel.textContent = error;
        visibleNameErrorSign();
        return true;
    }

    return false;
}

function submitSign (event) {
    event.preventDefault();
    clearAllSign();
    const error = !(blurNameSign()) && !(blurEmailSign()) && !(blurConfirmSign()) && !(blurPasswordSign());
    if(!error) {
        return;
    }

    sendPost();
}

passwordField.addEventListener('blur', blurPasswordSign);
passwordField.addEventListener('focus',clearPasswordErrorSign);

confirmField.addEventListener('blur', blurConfirmSign);
confirmField.addEventListener('focus',clearConfirmErrorSign);

nameField.addEventListener('blur', blurNameSign);
nameField.addEventListener('focus', clearNameErrorSign);

emailField.addEventListener('blur', blurEmailSign);
emailField.addEventListener('focus', clearEmailErrorSign);

passwordIcon.addEventListener('click',togglePasswordSign);
ConfirmIcon.addEventListener('click',toggleConfirmSign);

formSign.addEventListener('submit',submitSign);