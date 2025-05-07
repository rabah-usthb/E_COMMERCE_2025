const numberRegex      = /\d/;
const lowerLetterRegex = /[a-z]/;
const upperLetterRegex = /[A-Z]/;
const specialRegex     = /[^\w\s]/;
const atEmail          = /@/;
const underRepeated    = /__/;
const EmailRegex       = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
const userNameRegex    = /^[a-zA-Z]+[\w\s]+$/;

export function togglePassword(passwordField,icon) {
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        icon.classList.replace('bx-hide', 'bx-show');
    } else {
        passwordField.type = 'password';
        icon.classList.replace('bx-show', 'bx-hide');
    }
}

export function validateUserName(value) {
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

export function validateEmail(value) {
      value = value.replace(/\s/g, '');
    if (underRepeated.test(value)) {
        return "Email/UserName can't contain '__'";
    } else if (!EmailRegex.test(value)) {
        return "Email not properly written";
    }
    return null;
}

export function validateUserNameAlone(nameField) {
    
    const text  = nameField.value.trim();
    const value = text.replace(/\s/g, '');
    
    if (text.length===0) {
        return "UserName can't be empty";
    }
    else if (underRepeated.test(value)) {
        return "UserName can't contain '__'";
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

export function validateEmailAlone(emailField) {
    const text  = emailField.value.trim();
    const value = text.replace(/\s/g, '');
    
    if (text.length===0) {
        return "Email can't be empty";
    }
    else if (underRepeated.test(value)) {
        return "Email can't contain '__'";
    } else if (!EmailRegex.test(value)) {
        return "Email not properly written";
    }
    return null;
}

export function validateEmailName(nameEmailField) {
    const text  = nameEmailField.value.trim();
    if (text.length === 0) {
        return "Email/UserName can't be empty";
    } else if (atEmail.test(text)) {
        return validateEmail(text);
    } else {
        return validateUserName(text);
    }
}

export function validateConfirmPassword(confirmPasswordField,passwordField) {
    const conf_text = confirmPasswordField.value;
    const pass_text = passwordField.value;

    const value = conf_text.replace(/\s/g, '');

    if (value.length === 0) {
        return "Please fill the Confirm-Password field";
    } else if (conf_text !==pass_text) {
        return "Confirm-Password And Password Must Be Same";
    }
    return null; 
}


export function validatePassword(passwordField) {
    const text = passwordField.value;

    console.log("password ", {passwordField});

    const value = text.replace(/\s/g, '');

    if (value.length === 0) {
        return "Please Fill The Password Field";
    } else if (text.length < 8) {
        return "At Least 8 Characters";
    } else if (!lowerLetterRegex.test(text)) {
        return "At Least One Lowercase Letter";
    } else if (!upperLetterRegex.test(text)) {
        return "At Least One Uppercase Letter";
    } else if (!numberRegex.test(text)) {
        return "At Least One Number";
    } else if (!specialRegex.test(text)) {
        return "At Least One Special Character";
    }
    return null;
}

export function visibleError(errorTool_Tip,field) {
    errorTool_Tip.style.visibility = 'visible'; 
    field.classList.add('error');
}


export function clearError(errorTool_Tip,field) {
    errorTool_Tip.style.visibility = 'hidden'; 
    field.classList.remove('error');
}
