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


function clearAllLogin() {
    clearNameEmailError();
    clearPasswordError();
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

    }
}

function blurConfirmSign() {
    const error = validateConfirmSign();
    if(error!=null) {
        confirmLabel.textContent = error;
        visibleConfirmErrorSign();

    }
}

function blurEmailSign() {
    const error = validateEmailSign();
    if(error!=null) {
        emailLabel.textContent = error;
        visibleEmailErrorSign();

    }
}

function blurNameSign() {
    const error = validateNameSign();
    if(error!=null) {
        nameLabel.textContent = error;
        visibleNameErrorSign();

    }
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

