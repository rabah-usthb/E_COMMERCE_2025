import * as form from './form.js';

const emailError = document.getElementById('emailError');
const emailLabel = emailError.querySelector('span');

const dbError = document.getElementById('bdError');
const dbLabel = dbError.querySelector('span');

const emailField  = document.getElementById('log-email');
const formForgot = document.getElementById('form'); 

const forgotButton   = document.getElementById('ForgotBtn');
const forgotIcon  = document.getElementById('sendIcon');


function sendPost() {
    
    form.setSubmitting(forgotButton,forgotIcon,true);
    let email = emailField.value;

    if(form.atEmail.test(email)) {
        email = email.replace(/\s/g, '');
    }
   

    fetch('forgotCheck.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({
          action:   'check',   
          email: email
        })
      })
      .then(res => res.json())  
      .then(data => {            
       updateError(data);
     
      });
}

function updateError(data) {
    console.log(data)
    if(data.email_error!==''){
       dbLabel.textContent = data.email_error;
       visibleDbErrorForgot();
       form.setSubmitting(forgotButton,forgotIcon,false);
    }

    else {
        sendPostToken(data);
    }
}



function sendPostToken(data) {

    fetch('sendToken.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({
          action:   data.action,   
          email:    data.email,
          type: data.type
        })
      })
      .then(res => res.json())  
      .then(data => {      
        form.setSubmitting(forgotButton,forgotIcon,false);      
       loadTokenView(data);
     
      });
}

function loadTokenView(data) {

    const f = document.createElement('form');
    f.method = 'POST';
    f.action = 'viewToken.php';
  
    for (const [name, value] of Object.entries(data)) {
      const inp = document.createElement('input');
      inp.type  = 'hidden';
      inp.name  = name;
      inp.value = value;
      f.appendChild(inp);
    }
  
 
    document.body.appendChild(f);
    f.submit();
}

function validateEmailForgot() {
    return form.validateEmailAlone(emailField);
}


function clearAllForgot() {
    clearEmailErrorForgot();
    clearDBErrorForgot();
}

function visibleDbErrorForgot() {
    form.visibleError(dbError,emailField);
}

function clearDBErrorForgot() {
    form.clearError(dbError,emailField);
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
