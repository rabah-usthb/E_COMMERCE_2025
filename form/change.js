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

const changeButton   = document.getElementById('ChangeBtn');
const changeIcon  = document.getElementById('changeIcon');

const formChange = document.getElementById('form'); 

function sendPost() {
    
    const password = passwordField.value;
    form.setSubmitting(changeButton,changeIcon,true);

    const urlParams = new URLSearchParams(window.location.search);
    const userId    = urlParams.get('user_id');

    fetch(`change.php?user_id=${encodeURIComponent(userId)}`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({
          action:   'modify', 
          password: password
        })
      })
      .then(res => res.json())  
      .then(data => {  
       form.setSubmitting(changeButton,changeIcon,false);          
       updateError(data);
     
      });
}


function togglePasswordChange() {
    form.togglePassword(passwordField,passwordIcon);
}

function toggleConfirmChange() {
    form.togglePassword(confirmField,ConfirmIcon);
}

function notifyToken() {
    alert('You have successfully Changed Your Password, You Will Proceed To The Login Page To Continue');
    window.location.href = 'login.php';
}

function updateError(data) {
    console.log(data)
    if(data.error!==''){
       dbLabel.textContent = data.error;
       visibleDbErrorChange();
    }
    else {
     notifyToken();
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
    form.visibleError(dbError,passwordField);
}

function clearDBErrorChange() {
    form.clearError(dbError,passwordField);
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

    const passError = blurPasswordChange();
    const confError = blurConfirmChange();

    const error = ! (passError) && !(confError);


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
