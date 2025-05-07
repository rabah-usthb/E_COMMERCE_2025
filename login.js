import * as form from './form.js';

const passwordError = document.getElementById('passError');
const passwordLabel = passwordError.querySelector('span');

const nameEmailError = document.getElementById('nameEmailError');
const nameEmailLabel = nameEmailError.querySelector('span');

const passwordField   = document.getElementById('log-pass');
const nameEmailField  = document.getElementById('log-email');

const passwordIcon = document.getElementById('see_icon');

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
    clearNameEmailError();
    clearPasswordError();
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

    }
}

function blurNameEmailLogin() {
    const error = validateEmailNameLogin();
    if(error!=null) {
        nameEmailLabel.textContent = error;
        visibleNameEmailErrorLogin();

    }
}




passwordField.addEventListener('blur', blurPasswordLogin);
passwordField.addEventListener('focus',clearPasswordErrorLogin);

nameEmailField.addEventListener('blur', blurNameEmailLogin);
nameEmailField.addEventListener('focus', clearNameEmailErrorLogin);

passwordIcon.addEventListener('click',togglePasswordLogin);
