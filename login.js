const passwordError = document.getElementById('passError');
const passwordLabel = passwordError.querySelector('label');

console.log(passwordLabel);

const nameEmailError = document.getElementById('nameEmailError');
const nameEmailLabel = nameEmailError.querySelector('label');

const passwordField   = document.getElementById('log-pass');
const nameEmailField  = document.getElementById('log-email');

const numberRegex      = /\d/;
const lowerLetterRegex = /[a-z]/;
const upperLetterRegex = /[A-Z]/;
const specialRegex     = /[^\w\s]/;
const atEmail          = /@/;
const underRepeated    = /__/;
const EmailRegex       = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
const userNameRegex    = /^[a-zA-Z]+[\w\s]+$/;

function togglePassword() {
    const icon = document.getElementById('see_icon');
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        icon.classList.replace('bx-show', 'bx-hide');
    } else {
        passwordField.type = 'password';
        icon.classList.replace('bx-hide', 'bx-show');
    }
}

function validateUserName(value) {
    if (underRepeated.test(value)) {
        return "Email/UserName can't contain '__'";
    } else if (value.length < 4) {
        return "UserName must be at least 4 characters";
    } else if (value.length > 15) {
        return "UserName must be at most 15 characters";
    } else if (specialRegex.test(value)) {
        return "UserName can't have special characters";
    } else if (!userNameRegex.test(value)) {
        return "UserName not properly written";
    }
    return null;
}

function validateEmail(value) {
    value = value.replace(/\s/g, '');
    if (underRepeated.test(value)) {
        return "Email/UserName can't contain '__'";
    } else if (!EmailRegex.test(value)) {
        return "Email not properly written";
    }
    return null;
}

function validateEmailName() {
    const text    = nameEmailField.value.trim();
    if (text.length === 0) {
        return "Email/UserName can't be empty";
    } else if (atEmail.test(text)) {
        return validateEmail(text);
    } else {
        return validateUserName(text);
    }
}

function validatePassword() {
    const text = passwordField.value;
    value = text.replace(/\s/g, '');
    
    if (value.length === 0) {
        return "Please fill the password field";
    } else if (text.length < 8) {
        return "At least 8 characters";
    } else if (!lowerLetterRegex.test(text)) {
        return "At least one lowercase letter";
    } else if (!upperLetterRegex.test(text)) {
        return "At least one uppercase letter";
    } else if (!numberRegex.test(text)) {
        return "At least one number";
    } else if (!specialRegex.test(text)) {
        return "At least one special character";
    }
    return null;
}


function clearAll() {
    clearNameEmailError();
    clearPasswordError();
}

function visiblePasswordError() {
    passwordError.style.visibility = 'visible'; 
}

function visibleNameEmailError() {
    nameEmailError.style.visibility = 'visible'; 
}

function clearPasswordError() {
    passwordError.style.visibility = 'hidden'; 
}

function clearNameEmailError() {
    nameEmailError.style.visibility = 'hidden'; 
}


function blurPassword() {
    error = validatePassword();
    if(error!=null) {
        passwordLabel.textContent = error;
        visiblePasswordError();

    }
}

function blurNameEmail() {
    error = validateEmailName();
    if(error!=null) {
        nameEmailLabel.textContent = error;
        visibleNameEmailError();

    }
}




passwordField.addEventListener('blur', blurPassword);
passwordField.addEventListener('focus',clearPasswordError);

nameEmailField.addEventListener('blur', blurNameEmail);
nameEmailField.addEventListener('focus', clearNameEmailError);

