import * as form from './form.js';

const passwordError = document.getElementById('passError');
const passwordLabel = passwordError.querySelector('span');

const nameEmailError = document.getElementById('nameEmailError');
const nameEmailLabel = nameEmailError.querySelector('span');

const dbError = document.getElementById('bdError');
const dbLabel = dbError.querySelector('span');

const passwordField   = document.getElementById('log-pass');
const nameEmailField  = document.getElementById('log-email');

const loginButton   = document.getElementById('LogInBtn');
const loginIcon  = document.getElementById('loginIcon');

const passwordIcon = document.getElementById('see_icon');

const formLogin = document.getElementById('form'); 





function sendPost() {

    form.setSubmitting(loginButton,loginIcon,true);
    let nameEmail = nameEmailField.value;

    if(form.atEmail.test(nameEmail)) {
        nameEmail = nameEmail.replace(/\s/g, '');
    }
   
    const password = passwordField.value;


    fetch('loginCheck.php', {
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
       form.setSubmitting(loginButton,loginIcon,false);         
       updateError(data);
      });
}

function updateError(data) {
    console.log(data)
    if(data.error!==''){
       dbLabel.textContent = data.error;
       visibleDbErrorLogin();
    }
    else {
        loadMainPage(data.status);
    }
}

function loadMainPage(status) {
        if(status === 'user') {
        window.location.href = '../MainPage/mainPage.php';
        }
        else{
         window.location.href = '../admin/adminDashBoard.php';
        }
}

function togglePasswordLogin() {
    form.togglePassword(passwordField,passwordIcon);
}


function validateEmailNameLogin() {
    return form.validateEmailName(nameEmailField);
}

function validatePasswordLogin() {
    return form.validatePassword(passwordField);
}


function clearAllLogin() {
    clearNameEmailErrorLogin();
    clearPasswordErrorLogin();
    clearDBErrorLogin();
}

function visibleDbErrorLogin() {
    form.visibleErrors(dbError,nameEmailField,passwordField);
}

function clearDBErrorLogin() {
    form.clearErrors(dbError,nameEmailField,passwordField);
}

function visiblePasswordErrorLogin() {
    form.visibleError(passwordError,passwordField);
}

function visibleNameEmailErrorLogin() {
    form.visibleError(nameEmailError,nameEmailField);
}

function clearPasswordErrorLogin() {
    form.clearError(passwordError,passwordField);
}

function clearNameEmailErrorLogin() {
    form.clearError(nameEmailError,nameEmailField);
}


function blurPasswordLogin() {

    const error = validatePasswordLogin();

    if(error!=null) {
        passwordLabel.textContent = error;
        visiblePasswordErrorLogin();
        return true;

    }

    return false;
}

function blurNameEmailLogin() {
    const error = validateEmailNameLogin();

    if(error!=null) {
        nameEmailLabel.textContent = error;
        visibleNameEmailErrorLogin();
        return true;

    }
    return false;
}


function submitLogin (event) {
    event.preventDefault();
    clearAllLogin();

    const emailNameError = blurNameEmailLogin();
    const passError = blurPasswordLogin();

    const error = !(emailNameError)  && !(passError);


    if(!error) {
        return;
    }

    sendPost();
}

passwordField.addEventListener('blur', blurPasswordLogin);
passwordField.addEventListener('focus',clearPasswordErrorLogin);

nameEmailField.addEventListener('blur', blurNameEmailLogin);
nameEmailField.addEventListener('focus', clearNameEmailErrorLogin);

passwordIcon.addEventListener('click',togglePasswordLogin);

formLogin.addEventListener('submit',submitLogin);
