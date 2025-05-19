import * as form from './form.js';

const emailError = document.getElementById('emailError');
const emailLabel = emailError.querySelector('span');

const dbError = document.getElementById('bdError');
const dbLabel = dbError.querySelector('span');

const emailField  = document.getElementById('log-email');
const formSend = document.getElementById('form'); 

const sendButton   = document.getElementById('sendBtn');
const sendIcon  = document.getElementById('sendIcon');


function sendPost() {
    
    form.setSubmitting(sendButton,sendIcon,true);
    let email = emailField.value;

    if(form.atEmail.test(email)) {
        email = email.replace(/\s/g, '');
    }
   

    fetch('sendCheck.php', {
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
       visibleDbErrorsend();
       form.setSubmitting(sendButton,sendIcon,false);
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
        form.setSubmitting(sendButton,sendIcon,false);      
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

function validateEmailsend() {
    return form.validateEmailAlone(emailField);
}


function clearAllsend() {
    clearEmailErrorsend();
    clearDBErrorsend();
}

function visibleDbErrorsend() {
    form.visibleError(dbError,emailField);
}

function clearDBErrorsend() {
    form.clearError(dbError,emailField);
}


function visibleEmailErrorsend() {
    form.visibleError(emailError,emailField);
}


function clearEmailErrorsend() {
    form.clearError(emailError,emailField);
}


function blurEmailsend() {
    const error = validateEmailsend();

    if(error!=null) {
        emailLabel.textContent = error;
        visibleEmailErrorsend();
        return true;

    }
    return false;
}


function submitsend (event) {
    event.preventDefault();
    clearAllsend();

    const emailNameError = blurEmailsend();

    const error = !(emailNameError);


    if(!error) {
        return;
    }

    sendPost();
}


emailField.addEventListener('blur', blurEmailsend);
emailField.addEventListener('focus', clearEmailErrorsend);

formSend.addEventListener('submit',submitsend);
