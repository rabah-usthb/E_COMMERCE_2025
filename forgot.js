import * as form from './form.js';

const emailError = document.getElementById('emailError');
const emailLabel = emailError.querySelector('span');

const dbError = document.getElementById('bdError');
const dbLabel = dbError.querySelector('span');

const emailField  = document.getElementById('log-email');
const formForgot = document.getElementById('form'); 

function sendPost() {
    
    let email = emailField.value;

    if(form.atEmail.test(email)) {
        email = email.replace(/\s/g, '');
    }
   

    fetch('ForgotCheck.php', {
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

function updateError(data) {
    console.log(data)
    if(data.error!==''){
       dbLabel.textContent = data.error;
       visibleDbErrorForgot();
    }
}

function validateEmailForgot() {
    return form.validateEmailName(emailField);
}


function clearAllForgot() {
    clearEmailErrorForgot();
    clearDBErrorForgot();
}

function visibleDbErrorForgot() {
    form.visibleErrors(dbError,emailField,passwordField);
}

function clearDBErrorForgot() {
    form.clearErrors(dbError,emailField,passwordField);
}


function visibleEmailErrorForgot() {
    form.visibleError(emailError,emailField);
}


function clearEmailErrorForgot() {
    form.clearError(emailError,emailField);
}


function blurEmailForgot() {
    const error = validateEmailForgot();

    if(error!=null) {
        emailLabel.textContent = error;
        visibleEmailErrorForgot();
        return true;

    }
    return false;
}


function submitForgot (event) {
    event.preventDefault();
    clearAllForgot();

    const emailNameError = blurEmailForgot();

    const error = !(emailNameError);


    if(!error) {
        return;
    }

    sendPost();
}


emailField.addEventListener('blur', blurEmailForgot);
emailField.addEventListener('focus', clearEmailErrorForgot);

formForgot.addEventListener('submit',submitForgot);
