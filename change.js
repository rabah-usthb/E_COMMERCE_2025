import * as form from './form.js';

const passwordError = document.getElementById('passError');
const passwordLabel = passwordError.querySelector('span');

const confirmError = document.getElementById('confError');
const confirmLabel = confirmError.querySelector('span');

const dbError = document.getElementById('bdError');
const dbLabel = dbError.querySelector('span');

const passwordField   = document.getElementById('register-pass');
const confirmField   = document.getElementById('register-conf');

const passwordIcon = document.getElementById('see_icon');
const ConfirmIcon = document.getElementById('see_icon_conf');

const formChange = document.getElementById('form'); 

function sendPost() {
    
    let email = emailField.value;

    if(form.atEmail.test(email)) {
        email = email.replace(/\s/g, '');
    }
   

    fetch('ChangeCheck.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({
          action:   'check',   
          nameEmail: nameEmail,
          password: password
        })
      })
      .then(res => res.json())  
      .then(data => {            
       updateError(data);
     
      });
}


function togglePasswordChange() {
    form.togglePassword(passwordField,passwordIcon);
}

function toggleConfirmChange() {
    form.togglePassword(confirmField,ConfirmIcon);
}


function updateError(data) {
    console.log(data)
    if(data.error!==''){
       dbLabel.textContent = data.error;
       visibleDbErrorChange();
    }
}


function validatePasswordChange() {
    return form.validatePassword(passwordField);
}


function validateConfirmChange() {
    return form.validateConfirmPassword(confirmField,passwordField);
}


function clearAllChange() {
    clearConfirmErrorChange();
    clearPasswordErrorChange();
    clearDBErrorChange();
}

function visibleDbErrorChange() {
    form.visibleErrors(dbError,emailField,passwordField);
}

function clearDBErrorChange() {
    form.clearErrors(dbError,emailField,passwordField);
}


function visiblePasswordErrorChange() {
    form.visibleError(passwordError,passwordField);
}

function visibleConfirmErrorChange() {
    form.visibleError(confirmError,confirmField);
}


function clearPasswordErrorChange() {
    form.clearError(passwordError,passwordField);
}

function clearConfirmErrorChange() {
    form.clearError(confirmError,confirmField);
}

function blurPasswordChange() {

    const error = validatePasswordChange();
    if(error!=null) {
        passwordLabel.textContent = error;
        visiblePasswordErrorChange();
        return true;
    }
    return false;
}

function blurConfirmChange() {
    const error = validateConfirmChange();
    if(error!=null) {
        confirmLabel.textContent = error;
        visibleConfirmErrorChange();
        return true;
    }
    return false;
}

function submitChange (event) {
    event.preventDefault();
    clearAllChange();

    const emailNameError = blurEmailChange();

    const error = !(emailNameError);


    if(!error) {
        return;
    }

    sendPost();
}


passwordField.addEventListener('blur', blurPasswordChange);
confirmField.addEventListener('blur', blurConfirmChange);

passwordField.addEventListener('focus', clearPasswordErrorChange);
confirmField.addEventListener('focus', clearConfirmErrorChange);

passwordIcon.addEventListener('click',togglePasswordChange);
ConfirmIcon.addEventListener('click',toggleConfirmChange);

formChange.addEventListener('submit',submitChange);
